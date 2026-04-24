import time
import json
import redis
import os
from mikrotik import get_connection, reset_connection
from datetime import datetime

print("🔥 WORKER STARTED", flush=True)

r = redis.Redis(
    host=os.getenv("REDIS_HOST", "redis"),
    port=int(os.getenv("REDIS_PORT", 6379)),
    decode_responses=True
)

# Hitung traffic
def update_daily_traffic(r, total_bytes):
    last = r.get("mikrotik:last_total")

    if last:
        diff = total_bytes - int(last)

        # hindari negatif (misal router reboot)
        if diff > 0:
            r.incrby("mikrotik:traffic_today", diff)

    r.set("mikrotik:last_total", total_bytes)


def run():
    print("CONNECTING MIKROTIK...", flush=True)
    conn = None

    while True:
        try:
            if conn is None:
                print("RECONNECTING...", flush=True)
                conn = get_connection()
                print("CONNECTED!", flush=True)

            print("FETCH ALL INTERFACES...", flush=True)

            interfaces = list(conn("/interface/print"))

            # total semua interface
            total_bytes = 0

            for iface in interfaces:
                name = iface.get("name")

                stats = iface  # dari /interface print
                rx = int(stats.get("rx-byte", 0))
                tx = int(stats.get("tx-byte", 0))

                total_bytes += (rx + tx)

            # update traffic today
            update_daily_traffic(r, total_bytes)


            result = {}

            for iface in interfaces:
                name = iface.get("name")

                try:
                    monitor = conn(
                        "/interface/monitor-traffic",
                        interface=name,
                        once=True
                    )

                    data = list(monitor)[0]

                    result[name] = {
                        "rx": int(data.get("rx-bits-per-second", 0)),
                        "tx": int(data.get("tx-bits-per-second", 0))
                    }

                except Exception as e:
                    print(f"ERROR IFACE {name}: {e}", flush=True)

            print("SAVE:", result, flush=True)
            
            # Mendapatkan traffic
            r.set("mikrotik:traffic", json.dumps(result))

            # Mendapatkan nama interface
            interface_list = [iface.get("name") for iface in interfaces]
            r.set("mikrotik:interfaces", json.dumps(interface_list))

            # Tambahkan ini setelah SAVE traffic

            # SYSTEM RESOURCE
            resource = list(conn("/system/resource/print"))[0]

            # IDENTITY
            identity = list(conn("/system/identity/print"))[0]

            # HEALTH
            health = list(conn("/system/health/print"))
            health = health[0] if health else {}

            # ACTIVE USERS
            active_users = len(list(conn("/ip/hotspot/active/print")))

            # MEMORY %
            total_mem = int(resource.get("total-memory", 0))
            free_mem = int(resource.get("free-memory", 0))

            memory_usage = 0
            if total_mem > 0:
                memory_usage = round((total_mem - free_mem) / total_mem * 100, 2)

            data = {
                "uptime": resource.get("uptime"),
                "cpu": resource.get("cpu-load"),
                "memory": memory_usage,
                "temperature": health.get("temperature") or health.get("board-temperature"),
                "identity": identity.get("name"),
                "version": resource.get("version"),
                "active_users": active_users
            }

            traffic_today = r.get("mikrotik:traffic_today") or 0

            data["traffic_today"] = round(int(traffic_today) / 1024 / 1024, 2)

            r.set("mikrotik:health", json.dumps(data))


            now = datetime.now().strftime("%H:%M")

            if now == "00:00":
                r.set("mikrotik:traffic_today", 0)

            time.sleep(2)

        except Exception as e:
            print("ERROR LOOP:", e, flush=True)

            # 🔥 RESET GLOBAL CONNECTION (WAJIB)
            reset_connection()

            # 🔥 RESET LOCAL CONNECTION
            conn = None

            time.sleep(5)

if __name__ == "__main__":
    run()
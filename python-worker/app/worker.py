import time
import json
import redis
import os
from mikrotik import get_connection, reset_connection

print("🔥 WORKER STARTED", flush=True)

r = redis.Redis(
    host=os.getenv("REDIS_HOST", "redis"),
    port=int(os.getenv("REDIS_PORT", 6379)),
    decode_responses=True
)

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
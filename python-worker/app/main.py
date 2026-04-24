from fastapi import FastAPI, WebSocket, WebSocketDisconnect
import redis
import json
import os
import asyncio
from app.mikrotik import get_connection

app = FastAPI()

r = redis.Redis(
    host=os.getenv("REDIS_HOST", "redis"),
    port=int(os.getenv("REDIS_PORT", 6379)),
    decode_responses=True
)

@app.websocket("/ws/traffic")
async def websocket_traffic(websocket: WebSocket):
    await websocket.accept()
    print("WS CONNECTED")

    selected_interface = "ether1"  # default

    try:
        while True:
            # 🔥 TERIMA DARI CLIENT (non-blocking)
            try:
                msg = await asyncio.wait_for(websocket.receive_text(), timeout=0.1)
                selected_interface = msg
                print("SELECTED:", selected_interface)
            except asyncio.TimeoutError:
                pass

            data = r.get("mikrotik:traffic")

            if not data:
                response = {"download": 0, "upload": 0}
            else:
                try:
                    parsed = json.loads(data)
                except:
                    parsed = {}

                iface = parsed.get(selected_interface, {})

                response = {
                    "download": int(iface.get("rx", 0)),
                    "upload": int(iface.get("tx", 0)),
                }

            await websocket.send_text(json.dumps(response))
            await asyncio.sleep(2)

    except WebSocketDisconnect:
        print("Client disconnected")


@app.get("/api/interfaces")
def get_interfaces():
    data = r.get("mikrotik:interfaces")

    if not data:
        return []

    return json.loads(data)


@app.get("/api/mikrotik/health")
def mikrotik_health():
    data = r.get("mikrotik:health")

    if not data:
        return {"error": "No data from worker"}

    return json.loads(data)


# python-worker/app/mikrotik.py

from librouteros import connect
import os
import threading

_connection = None
_lock = threading.Lock()


def get_connection():
    global _connection

    if _connection is None:
        with _lock:
            if _connection is None:
                _connection = connect(
                    host=os.getenv("MIKROTIK_HOST"),
                    username=os.getenv("MIKROTIK_USER"),
                    password=os.getenv("MIKROTIK_PASS"),
                    port=int(os.getenv("MIKROTIK_PORT", 8728)),
                )
    return _connection

def reset_connection():
    global _connection
    with _lock:
        _connection = None


# def get_system_resource():
#     api = get_connection()
#     return list(api.path("/system/resource"))[0]


# def get_identity():
#     api = get_connection()
#     return list(api.path("/system/identity"))[0]


# def get_active_users():
#     api = get_connection()
#     return len(list(api.path("/ip/hotspot/active")))

# def get_system_health():
#     api = get_connection()
#     data = list(api.path("/system/health"))

#     if len(data) > 0:
#         return data[0]

#     return {}
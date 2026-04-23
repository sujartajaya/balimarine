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
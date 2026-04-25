from fastapi import FastAPI
from pydantic import BaseModel
from app.services.validator_service import validate_email
from app.validators import disposable, free, skiplist
from app.config import DISPOSABLE_FILE, FREE_FILE, SKIPLIST_FILE, MAX_ATTEMPT, BLOCK_TTL
from app.cache.redis_client import r, set_block, is_blocked

app = FastAPI()

# init data saat startup
@app.on_event("startup")
def startup():
    disposable.init(DISPOSABLE_FILE)
    free.init(FREE_FILE)
    skiplist.init(SKIPLIST_FILE)

class EmailRequest(BaseModel):
    email: str
    mac: str

@app.get("/health")
def health():
    return {"status": "ok"}


# 🔥 CONFIG (bisa nanti kamu pindah ke ENV)
# MAX_ATTEMPT = 3
# BLOCK_TTL = 300  # 5 menit


@app.post("/validate")
def validate(req: EmailRequest):
    mac = req.mac
    email = req.email

    # 🚫 cek apakah sedang diblok
    if is_blocked(mac):
        ttl = r.ttl(f"block:{mac}")
        return {
            "email": email,
            "mac": mac,
            "blocked": True,
            "retry_after": ttl,
            "message": "Terlalu banyak percobaan. Coba lagi nanti."
        }

    # 🔍 jalankan validator
    result = validate_email(email)

    # ❌ kalau tidak valid → increment counter
    if not result["is_valid"]:
        key = f"attempt:{mac}"
        attempt = r.incr(key)

        # set expire kalau pertama kali
        if attempt == 1:
            r.expire(key, BLOCK_TTL)

        # 🚨 kalau melebihi limit → block
        if attempt >= MAX_ATTEMPT:
            set_block(mac, BLOCK_TTL)

            # 🔥 hapus attempt biar tidak numpuk
            r.delete(key)

            return {
                "email": email,
                "mac": mac,
                "blocked": True,
                "message": "Terlalu banyak percobaan. Diblokir 5 menit."
            }

        return {
            **result,
            "attempt": attempt,
            "remaining": MAX_ATTEMPT - attempt
        }

    # ✅ kalau valid → reset counter
    r.delete(f"attempt:{mac}")

    return {
        **result,
        "attempt": 0
    }
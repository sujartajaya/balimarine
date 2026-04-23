#!/bin/bash

echo "START WORKER..."
python app/worker.py &

echo "START API..."
exec uvicorn app.main:app --host 0.0.0.0 --port 9000 --reload
@extends('layouts.admin')

@section('content')
<div class="p-6">
    <h2 class="text-xl font-bold mb-4">Realtime Traffic</h2>

    <!-- SELECT INTERFACE -->
    <div class="mb-4">
        <label class="block mb-1">Pilih Interface</label>
        <select id="interfaceSelect" 
    class="w-64 px-4 py-2 rounded-lg bg-blue-900 text-white border border-blue-700 
           focus:outline-none focus:ring-2 focus:ring-cyan-400 focus:border-cyan-400
           transition">>
            <option value="ether1">ether1</option>
            <option value="ether2">ether2</option>
        </select>
    </div>

    <!-- CARD -->
    <div class="flex gap-4 mb-6">
        <div class="bg-white text-black p-4 rounded shadow w-48 text-center">
            <p class="text-gray-500">Download</p>
            <div id="download" class="text-xl font-bold">0 Mbps</div>
        </div>

        <div class="bg-white text-black p-4 rounded shadow w-48 text-center">
            <p class="text-gray-500">Upload</p>
            <div id="upload" class="text-xl font-bold">0 Mbps</div>
        </div>
    </div>

    <!-- CHART CARD -->
    <div class="bg-white rounded-xl shadow p-4 max-w-4xl">
        <canvas id="trafficChart" style="height:300px;"></canvas>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
let ws;
let selectedInterface = "ether1";

// 🔥 CONNECT WS
function connectWS() {
    if (ws) ws.close();

    const protocol = location.protocol === "https:" ? "wss" : "ws";

    ws = new WebSocket(`${protocol}://${location.host}/ws/traffic`);

    ws.onopen = () => {
        console.log("WS CONNECTED");
        ws.send(selectedInterface); // kirim default
    };

    ws.onmessage = (event) => {
        const data = JSON.parse(event.data);

        const rx = data.download;
        const tx = data.upload;

        const rxMbps = (rx / 1_000_000).toFixed(2);
        const txMbps = (tx / 1_000_000).toFixed(2);

        document.getElementById("download").innerText = rxMbps + " Mbps";
        document.getElementById("upload").innerText = txMbps + " Mbps";

        updateChart(rx, tx);
    };

    ws.onclose = () => console.log("WS CLOSED");
}

// 🔥 LOAD INTERFACE DARI API
function loadInterfaces() {
    fetch("/api/interfaces")
        .then(res => res.json())
        .then(data => {
            const select = document.getElementById("interfaceSelect");
            select.innerHTML = "";

            data.forEach(i => {
                const opt = document.createElement("option");
                opt.value = i;
                opt.text = i;
                select.appendChild(opt);
            });

            // set default dari API
            if (data.length > 0) {
                selectedInterface = data[0];
            }

            connectWS(); // connect setelah load interface
        })
        .catch(err => {
            console.error("Failed load interfaces", err);
            connectWS(); // fallback tetap connect
        });
}

// 🔥 CHART
const ctx = document.getElementById("trafficChart").getContext("2d");

const chart = new Chart(ctx, {
    type: "line",
    data: {
        labels: [],
        datasets: [
            {
                label: "Download",
                data: [],
                borderColor: "#3b82f6",
                backgroundColor: "rgba(59,130,246,0.2)",
                fill: true,
                tension: 0.4,
            },
            {
                label: "Upload",
                data: [],
                borderColor: "#ef4444",
                backgroundColor: "rgba(239,68,68,0.2)",
                fill: true,
                tension: 0.4,
            },
        ],
    },
    options: {
        animation: false,
        responsive: true,
        maintainAspectRatio: false, // 🔥 penting biar tinggi ikut style
        plugins: {
            legend: {
                labels: {
                    color: "#000" // 🔥 teks legend jadi hitam
                }
            }
        },
        scales: {
            x: {
                ticks: {
                    color: "#000"
                },
                grid: {
                    color: "rgba(0,0,0,0.1)"
                }
            },
            y: {
                beginAtZero: true,
                ticks: {
                    color: "#000",
                    callback: (v) => (v / 1_000_000).toFixed(1) + " Mbps",
                },
                grid: {
                    color: "rgba(0,0,0,0.1)"
                }
            }
        }
    },
});

function updateChart(rx, tx) {
    const time = new Date().toLocaleTimeString();

    chart.data.labels.push(time);
    chart.data.datasets[0].data.push(rx);
    chart.data.datasets[1].data.push(tx);

    if (chart.data.labels.length > 30) {
        chart.data.labels.shift();
        chart.data.datasets.forEach(d => d.data.shift());
    }

    chart.update();
}

// 🔥 HANDLE SELECT
document.getElementById("interfaceSelect").addEventListener("change", (e) => {
    selectedInterface = e.target.value;

    console.log("Switch to:", selectedInterface);

    // reset chart biar clean
    chart.data.labels = [];
    chart.data.datasets.forEach(d => d.data = []);
    chart.update();

    if (ws && ws.readyState === WebSocket.OPEN) {
        ws.send(selectedInterface);
    }
});

// INIT
loadInterfaces();
</script>

@endsection
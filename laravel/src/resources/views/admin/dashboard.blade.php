@extends('layouts.admin')

@section('title', 'Admin Dashboard')

@section('content')

<div class="space-y-6">

    <!-- TOP CARDS -->
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">

        <div class="bg-blue-500/40 p-4 rounded-xl">
            Total Users
            <h2 class="text-xl font-bold">{{ $totalUsers }}</h2>
        </div>

        <div class="bg-cyan-500/40 p-4 rounded-xl">
            Active Sessions
            <h2 class="text-xl font-bold">{{ $activeSessions }}</h2>
        </div>

        <!-- 🔥 REALTIME TRAFFIC -->
        <div class="bg-purple-500/40 p-4 rounded-xl">
            Ether1 Download
            <h2 id="rx" class="text-xl font-bold">0 Mbps</h2>
        </div>

        <div class="bg-pink-500/40 p-4 rounded-xl">
            Ether1 Upload
            <h2 id="tx" class="text-xl font-bold">0 Mbps</h2>
        </div>

    </div>

    <!-- 🔥 GRAPH -->
    <div class="bg-white rounded-xl p-4">
        <canvas id="trafficChart" height="100"></canvas>
    </div>

    <!-- 🔥 TOP USERS -->
    <div class="bg-white rounded-xl p-4 text-black">
        <h3 class="font-bold mb-3">Top 5 Traffic Users</h3>

        <table class="w-full text-sm">
            <thead>
                <tr class="border-b">
                    <th>User</th>
                    <th>Traffic (MB)</th>
                </tr>
            </thead>
            <tbody>
                @foreach($topUsers as $u)
                <tr class="border-b">
                    <td>{{ $u->username }}</td>
                    <td>{{ number_format($u->total/1024/1024, 2) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>

<!-- CHART JS -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
let chart;

function initChart() {
    const ctx = document.getElementById("trafficChart").getContext("2d");

    // 🔥 GRADIENT DOWNLOAD
    const gradientBlue = ctx.createLinearGradient(0, 0, 0, 300);
    gradientBlue.addColorStop(0, "rgba(59,130,246,0.4)");
    gradientBlue.addColorStop(1, "rgba(59,130,246,0)");

    // 🔥 GRADIENT UPLOAD
    const gradientRed = ctx.createLinearGradient(0, 0, 0, 300);
    gradientRed.addColorStop(0, "rgba(239,68,68,0.4)");
    gradientRed.addColorStop(1, "rgba(239,68,68,0)");

    chart = new Chart(ctx, {
        type: "line",
        data: {
            labels: [],
            datasets: [
                {
                    label: "Download",
                    data: [],
                    borderColor: "#3b82f6",
                    backgroundColor: gradientBlue,
                    fill: true,
                    tension: 0.4,
                    pointRadius: 0,
                    borderWidth: 3,
                },
                {
                    label: "Upload",
                    data: [],
                    borderColor: "#ef4444",
                    backgroundColor: gradientRed,
                    fill: true,
                    tension: 0.4,
                    pointRadius: 0,
                    borderWidth: 2,
                }
            ]
        },
        options: {
            animation: false,
            responsive: true,
            interaction: {
                mode: "index",
                intersect: false,
            },
            plugins: {
                legend: {
                    labels: {
                        color: "#111",
                        font: {
                            size: 12,
                            weight: "bold"
                        }
                    }
                },
                tooltip: {
                    backgroundColor: "#111",
                    titleColor: "#fff",
                    bodyColor: "#fff",
                    padding: 10,
                    callbacks: {
                        label: (ctx) => {
                            return ctx.dataset.label + ": " +
                                (ctx.raw / 1_000_000).toFixed(2) + " Mbps";
                        }
                    }
                }
            },
            scales: {
                x: {
                    grid: {
                        display: false
                    },
                    ticks: {
                        color: "#666",
                        maxTicksLimit: 6
                    }
                },
                y: {
                    grid: {
                        color: "rgba(0,0,0,0.05)"
                    },
                    ticks: {
                        color: "#666",
                        callback: (v) => (v / 1_000_000).toFixed(1) + " Mbps"
                    }
                }
            }
        }
    });
}

function connectWS() {

    const protocol = location.protocol === "https:" ? "wss" : "ws";

    ws = new WebSocket(`${protocol}://${location.host}/ws/traffic`);

    ws.onopen = () => {
        ws.send("ether1"); // default
    };

    ws.onmessage = (e) => {
        const data = JSON.parse(e.data);

        const rx = data.download;
        const tx = data.upload;

        document.getElementById("rx").innerText = (rx/1_000_000).toFixed(2) + " Mbps";
        document.getElementById("tx").innerText = (tx/1_000_000).toFixed(2) + " Mbps";

        const time = new Date().toLocaleTimeString();

        chart.data.labels.push(time);
        chart.data.datasets[0].data.push(rx);
        chart.data.datasets[1].data.push(tx);

        if (chart.data.labels.length > 20) {
            chart.data.labels.shift();
            chart.data.datasets.forEach(d => d.data.shift());
        }

        chart.update();
    };
}

initChart();
connectWS();
</script>

@endsection
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <title>Dashboard Admin Koperasi</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: 'Inter', sans-serif;
            background: #f0f2f5;
        }

        .sidebar {
            position: fixed;
            width: 220px;
            height: 100vh;
            background: #34699A;
            color: white;
            padding: 1rem;
        }

        .sidebar .brand {
            text-align: center;
            margin: 40px 0 30px;
        }

        .sidebar .brand h2 {
            margin: 0;
            font-size: 1.5rem;
            letter-spacing: 1px;
        }

        .sidebar .brand h5 {
            margin: 5px 0 0;
            font-weight: normal;
            font-style: italic;
            font-size: 0.9rem;
        }

        .sidebar a {
            color: #fff;
            display: block;
            margin-top: 1rem;
            text-decoration: none;
        }

        .main {
            margin-left: 240px;
            padding: 2rem;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
        }

        .header h1 {
            font-size: 1.5rem;
            margin: 0;
        }


        .logo-title {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .header-logo {
            width: 70px;
            height: 70px;
            object-fit: contain;
        }



        .logout-btn {
            background-color: #d9534f;
            color: #fff;
            padding: 0.5rem 1rem;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 0.9rem;
        }

        .logout-btn:hover {
            background-color: #c9302c;
        }

        .welcome-msg {
            margin-bottom: 1.5rem;
        }

        .info-boxes {
            display: flex;
            gap: 1rem;
            margin-bottom: 2rem;
        }

        .info-box {
            flex: 1;
            padding: 1rem 1.2rem;
            border-radius: 12px;
            background: linear-gradient(90deg, #4facfe 0%, #00f2fe 100%);
            color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .info-box:nth-child(2) {
            background: linear-gradient(90deg, #43e97b 0%, #38f9d7 100%);
        }

        .info-box:nth-child(3) {
            background: linear-gradient(90deg, #ff758c 0%, #ff7eb3 100%);
        }

        .info-box:nth-child(4) {
            background: linear-gradient(90deg, #43cea2 0%, #185a9d 100%);
        }

        .info-box h4 {
            margin: 0;
            font-size: 1rem;
        }

        .info-data {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin: 0.5rem 0;
        }

        .info-data p {
            font-size: 1.6rem;
            margin: 0;
        }

        .info-icon i {
            font-size: 3rem;
            /* Ikon dibesarkan */
            opacity: 0.3;
            /* Transparan tanpa mengubah warna */
        }


        .progress-bar {
            background: rgba(255, 255, 255, 0.3);
            border-radius: 10px;
            height: 6px;
            overflow: hidden;
        }

        .progress {
            height: 100%;
            background: white;
            border-radius: 10px;
        }

        .charts-wrapper {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .chart-card {
            background: #fff;
            border-radius: 10px;
            padding: 1rem;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
        }

        .donuts-vertical {
            display: flex;
            flex-direction: column;
            gap: 1rem;
            background: white;
            padding: 1rem;
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        }

        .donut-box canvas {
            max-width: 120px;
            margin: 0 auto;
        }

        canvas {
            max-width: 100%;
        }

        #barChart {
            height: 250px !important;
        }

        #horizontalBarChart {
            height: 200px !important;
        }

        .bar-charts-row {
            display: flex;
            gap: 1rem;
            margin-top: 2rem;
        }

        .bar-chart-half {
            flex: 1;
            background: white;
            padding: 1rem;
            border-radius: 12px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body>
    <div class="sidebar">
        <div class="brand">
            <h2>KOBIBAT</h2>
            <h5>" Koperasi Bisa Hebat "</h5>
        </div>
        <a href="#">Dashboard</a>
        <a href="{{ route('articles.index') }}">Artikel</a>
        <a href="{{ route('pendaftaran.index') }}">Kelola Anggota</a>
    </div>

    <div class="main">
        <div class="header">
            <div class="logo-title">
                <img src="{{ asset('images/logo-SMK.png') }}" alt="Logo Koperasi" class="header-logo">
                <h1>Dashboard Admin</h1>
            </div>
            @csrf
            <button class="logout-btn" type="submit">Logout</button>
        </div>


        <div class="welcome-msg">
            <p><strong>Selamat datang!</strong> Anda login sebagai admin.</p>
        </div>

        <div class="info-boxes">
            <div class="info-box anggota">
                <h4>Jumlah Anggota</h4>
                <div class="info-data">
                    <p>3.659</p>
                    <div class="info-icon"><i class="fas fa-users"></i></div>
                </div>
                <div class="progress-bar">
                    <div class="progress" style="width: 60%"></div>
                </div>
            </div>

            <div class="info-box simpanan">
                <h4>Total Simpanan</h4>
                <div class="info-data">
                    <p>Rp 44.542.000</p>
                    <div class="info-icon"><i class="fas fa-coins"></i></div>
                </div>
                <div class="progress-bar">
                    <div class="progress" style="width: 30%"></div>
                </div>
            </div>

            <div class="info-box pinjaman">
                <h4>Total Pinjaman</h4>
                <div class="info-data">
                    <p>Rp 2.334.200</p>
                    <div class="info-icon"><i class="fas fa-hand-holding-usd"></i></div>
                </div>
                <div class="progress-bar">
                    <div class="progress" style="width: 40%"></div>
                </div>
            </div>

            <div class="info-box kas">
                <h4>Kas Koperasi</h4>
                <div class="info-data">
                    <p>Rp 3.987.210</p>
                    <div class="info-icon"><i class="fas fa-wallet"></i></div>
                </div>
                <div class="progress-bar">
                    <div class="progress" style="width: 70%"></div>
                </div>
            </div>
        </div>

        <div class="charts-wrapper">
            <div class="chart-card">
                <h4>Statistik Simpan, Pinjam, Kas</h4>
                <canvas id="multiLineChart"></canvas>
            </div>

            <div class="donuts-vertical">
                <div class="donut-box">
                    <h4>Simpanan - 60%</h4>
                    <canvas id="donut1"></canvas>
                </div>
                <div class="donut-box">
                    <h4>Pinjaman - 40%</h4>
                    <canvas id="donut2"></canvas>
                </div>
                <div class="donut-box">
                    <h4>Kas - 70%</h4>
                    <canvas id="donut3"></canvas>
                </div>
            </div>
        </div>

        <div class="bar-charts-row">
            <div class="bar-chart-half">
                <h4>Simpanan per Anggota</h4>
                <canvas id="barChart"></canvas>
            </div>
            <div class="bar-chart-half">
                <h4>Pinjaman per Anggota</h4>
                <canvas id="horizontalBarChart"></canvas>
            </div>
        </div>
    </div>

    <script>
        new Chart(document.getElementById("horizontalBarChart"), {
            type: 'bar',
            data: {
                labels: ["Ahmad", "Budi", "Citra", "Dewi"],
                datasets: [{
                    label: "Pinjaman (Rp)",
                    data: [2000000, 1800000, 2200000, 2100000],
                    backgroundColor: ["#ff9f40", "#9966ff", "#ff6384", "#4bc0c0"]
                }]
            },
            options: {
                indexAxis: 'y',
                responsive: true,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    x: {
                        beginAtZero: true
                    }
                }
            }
        });

        new Chart(document.getElementById("multiLineChart"), {
            type: 'line',
            data: {
                labels: ["Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Agu", "Sep", "Okt"],
                datasets: [{
                        label: "Simpanan",
                        data: [1200, 1300, 1250, 1350, 1280, 1400, 1320, 1450, 1380, 1500],
                        borderColor: "#36a2eb",
                        backgroundColor: "transparent",
                        borderWidth: 3,
                        tension: 0.5,
                        fill: false,
                        pointRadius: 0,
                        pointHoverRadius: 6
                    },
                    {
                        label: "Pinjaman",
                        data: [1400, 1250, 1380, 1220, 1350, 1200, 1320, 1180, 1300, 1160],
                        borderColor: "#ff6384",
                        backgroundColor: "transparent",
                        borderWidth: 3,
                        tension: 0.5,
                        fill: false,
                        pointRadius: 0,
                        pointHoverRadius: 6
                    },
                    {
                        label: "Kas",
                        data: [1100, 1150, 1120, 1180, 1140, 1200, 1160, 1220, 1180, 1240],
                        borderColor: "#4bc0c0",
                        backgroundColor: "transparent",
                        borderWidth: 3,
                        tension: 0.5,
                        fill: false,
                        pointRadius: 0,
                        pointHoverRadius: 6
                    }
                ]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            usePointStyle: true, // Gunakan bentuk titik, bukan kotak
                            pointStyle: 'circle', // Bentuk lingkaran
                            boxWidth: 10,
                            boxHeight: 10,
                            padding: 15,
                            color: '#333',
                            font: {
                                size: 14,
                                family: 'Arial'
                            }
                        }
                    },
                    tooltip: {
                        mode: 'index',
                        intersect: false,
                        backgroundColor: '#fff',
                        titleColor: '#111',
                        bodyColor: '#222',
                        borderColor: '#ddd',
                        borderWidth: 1
                    }
                },
                interaction: {
                    mode: 'index',
                    intersect: false
                },
                scales: {
                    x: {
                        grid: {
                            display: true, // Tampilkan garis vertikal
                            color: '#e0e0e0', // Warna garis vertikal
                            lineWidth: 1 // Ketebalan garis
                        }
                    },
                    y: {
                        beginAtZero: false,
                        grid: {
                            display: true, // Tampilkan garis horizontal
                            color: '#e0e0e0', // Warna garis horizontal
                            lineWidth: 1 // Ketebalan garis
                        }
                    }
                }
            }
        });

        new Chart(document.getElementById("barChart"), {
            type: 'bar',
            data: {
                labels: ["Ahmad", "Budi", "Citra", "Dewi"],
                datasets: [{
                    label: "Simpanan (Rp)",
                    data: [5000000, 7000000, 4500000, 6000000],
                    backgroundColor: ["#36a2eb", "#ff6384", "#4bc0c0", "#ffcd56"],
                    barThickness: 25, // ketebalan batang bar
                    maxBarThickness: 30, // batas maksimal ketebalan batang
                    categoryPercentage: 0.4, // ruang kategori
                    barPercentage: 0.9 // lebar relatif tiap batang
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    x: {
                        grid: {
                            display: false
                        }
                    },
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: "#eee"
                        }
                    }
                }
            }
        });

        const getColorByValue = (value) => {
            let r, g, b;

            if (value < 50) {
                const ratio = value / 50;
                r = 231;
                g = Math.round(76 + (196 - 76) * ratio);
                b = 60;
            } else {
                const ratio = (value - 50) / 50;
                r = Math.round(241 - (241 - 46) * ratio);
                g = Math.round(196 + (204 - 196) * ratio);
                b = Math.round(15 + (113 - 15) * ratio);
            }

            return `rgb(${r}, ${g}, ${b})`; // <-- ini diperbaiki
        };

        const donutChart = (id, value) => {
            const color = getColorByValue(value);

            new Chart(document.getElementById(id), {
                type: 'doughnut',
                data: {
                    labels: ["Aktif", "Sisa"],
                    datasets: [{
                        data: [value, 100 - value],
                        backgroundColor: [color, "#eeeeee"],
                        borderWidth: 0
                    }]
                },
                options: {
                    cutout: '70%',
                    plugins: {
                        legend: {
                            display: false
                        }
                    }
                }
            });
        };

        donutChart("donut1", 60); // Simpanan
        donutChart("donut2", 40); // Pinjaman
        donutChart("donut3", 70); // Kas
    </script>
</body>

</html>

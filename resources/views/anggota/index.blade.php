<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Anggota - KOBIBAT</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #2c3e50;
            --secondary-color: #3498db;
            --accent-color: #e74c3c;
            --light-color: #ecf0f1;
        }
        
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #333;
        }
        
        .header {
            background-color: var(--primary-color);
            color: white;
            padding: 1rem 0;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        
        .logo {
            font-size: 1.8rem;
            font-weight: bold;
        }
        
        .user-info {
            text-align: right;
        }
        
        .main-container {
            max-width: 1200px;
            margin: 2rem auto;
            padding: 0 15px;
        }
        
        .page-title {
            color: var(--primary-color);
            border-bottom: 2px solid var(--secondary-color);
            padding-bottom: 0.5rem;
            margin-bottom: 1.5rem;
        }
        
        .card {
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            border: none;
        }
        
        .card-header {
            background-color: var(--secondary-color);
            color: white;
            border-radius: 10px 10px 0 0 !important;
            font-weight: bold;
        }
        
        .table th {
            background-color: var(--primary-color);
            color: white;
            vertical-align: middle;
        }
        
        .table td {
            vertical-align: middle;
        }
        
        .status-badge {
            font-size: 0.85rem;
            padding: 0.35rem 0.65rem;
            border-radius: 50rem;
        }
        
        .footer {
            background-color: var(--primary-color);
            color: white;
            text-align: center;
            padding: 1rem 0;
            margin-top: 2rem;
        }
        
        .info-box {
            background-color: #e8f4fc;
            border-left: 4px solid var(--secondary-color);
            padding: 1rem;
            margin-bottom: 1.5rem;
            border-radius: 4px;
        }
        
        @media (max-width: 768px) {
            .header-content {
                text-align: center;
            }
            
            .user-info {
                text-align: center;
                margin-top: 1rem;
            }
            
            .table-responsive {
                font-size: 0.9rem;
            }
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header class="header">
        <div class="container">
            <div class="row align-items-center header-content">
                <div class="col-md-6">
                    <div class="logo">
                        <i class="fas fa-coins me-2"></i>KOBIBAT Koperasi
                    </div>
                </div>
                <div class="col-md-6 user-info">
                    <i class="fas fa-user-circle me-1"></i> Pengguna Anggota
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <div class="main-container">
        <h1 class="page-title">Data Anggota Koperasi</h1>
        
        <div class="info-box">
            <i class="fas fa-info-circle me-2"></i> Halaman ini menampilkan data anggota yang terdaftar di koperasi KOBIBAT.
        </div>
        
        <div class="card">
            <div class="card-header">
                <i class="fas fa-users me-2"></i> Daftar Anggota
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Alamat</th>
                                <th>Telepon</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Budi Santoso</td>
                                <td>budisantoso@example.com</td>
                                <td>Jl. Merdeka No. 123, Jakarta</td>
                                <td>081234567890</td>
                                <td><span class="badge bg-success status-badge">Aktif</span></td>
                            </tr>
                            <tr>
                                <td>Siti Rahayu</td>
                                <td>siti.rahayu@example.com</td>
                                <td>Jl. Sudirman No. 45, Bandung</td>
                                <td>081298765432</td>
                                <td><span class="badge bg-success status-badge">Aktif</span></td>
                            </tr>
                            <tr>
                                <td>Dewi Anggraini</td>
                                <td>dewi.anggraini@example.com</td>
                                <td>Jl. Gatot Subroto No. 78, Surabaya</td>
                                <td>085712345678</td>
                                <td><span class="badge bg-success status-badge">Aktif</span></td>
                            </tr>
                            <tr>
                                <td>Joko Prasetyo</td>
                                <td>joko.prasetyo@example.com</td>
                                <td>Jl. Diponegoro No. 56, Yogyakarta</td>
                                <td>081355557777</td>
                                <td><span class="badge bg-success status-badge">Aktif</span></td>
                            </tr>
                            <tr>
                                <td>Rina Wijaya</td>
                                <td>rina.wijaya@example.com</td>
                                <td>Jl. Asia Afrika No. 89, Bandung</td>
                                <td>082144446666</td>
                                <td><span class="badge bg-success status-badge">Aktif</span></td>
                            </tr>
                            <tr>
                                <td>Ahmad Fauzi</td>
                                <td>ahmad.fauzi@example.com</td>
                                <td>Jl. Teuku Umar No. 11, Bali</td>
                                <td>081277778888</td>
                                <td><span class="badge bg-warning text-dark status-badge">Menunggu</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        
        <div class="d-flex justify-content-between align-items-center mt-4">
            <div class="text-muted">
                Menampilkan 6 dari 56 anggota
            </div>
            <nav>
                <ul class="pagination">
                    <li class="page-item disabled"><a class="page-link" href="#">Sebelumnya</a></li>
                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item"><a class="page-link" href="#">Selanjutnya</a></li>
                </ul>
            </nav>
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <p>&copy; 2025 Koperasi KOBIBAT. Hak Cipta Dilindungi.</p>
            <p class="mb-0">Sistem Informasi Koperasi</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
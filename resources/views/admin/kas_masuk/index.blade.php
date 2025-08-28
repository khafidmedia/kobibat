<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Kas Masuk KOBIBAT</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #2c3e50;
            --secondary: #3498db;
            --accent: #e74c3c;
            --light: #ecf0f1;
            --dark: #2c3e50;
            --success: #28a745;
        }
        
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            padding-bottom: 2rem;
        }
        
        .header {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            padding: 1.5rem 0;
            margin-bottom: 2rem;
            border-radius: 0 0 10px 10px;
        }
        
        .card {
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            border: none;
            margin-bottom: 20px;
        }
        
        .card-header {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            border-radius: 10px 10px 0 0 !important;
            font-weight: 600;
        }
        
        .btn-primary {
            background-color: var(--secondary);
            border: none;
            padding: 10px 20px;
        }
        
        .btn-primary:hover {
            background-color: var(--primary);
        }
        
        .btn-danger {
            background-color: var(--accent);
            border: none;
        }
        
        .table th {
            background-color: var(--primary);
            color: white;
        }
        
        .total-box {
            background: linear-gradient(135deg, var(--secondary), var(--primary));
            color: white;
            padding: 15px;
            border-radius: 8px;
            text-align: center;
            margin-bottom: 20px;
        }
        
        .form-control:focus {
            border-color: var(--secondary);
            box-shadow: 0 0 0 0.25rem rgba(52, 152, 219, 0.25);
        }
        
        .notification {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 1050;
            animation: fadeIn 0.5s, fadeOut 0.5s 2.5s forwards;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        
        @keyframes fadeOut {
            from { opacity: 1; }
            to { opacity: 0; }
        }

        #emptyState {
            transition: all 0.3s ease;
        }
        
        .badge-sumber {
            padding: 5px 10px;
            border-radius: 4px;
            font-size: 12px;
            font-weight: 600;
        }
        
        .badge-pinjaman {
            background-color: #6f42c1;
            color: white;
        }
        
        .badge-pokok {
            background-color: #fd7e14;
            color: white;
        }
        
        .badge-wajib {
            background-color: #e83e8c;
            color: white;
        }
        
        .badge-sukarela {
            background-color: #17a2b8;
            color: white;
        }
        
        .badge-lainnya {
            background-color: #6c757d;
            color: white;
        }
        
        .info-box {
            background-color: #f8f9fa;
            border-left: 4px solid var(--secondary);
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 4px;
        }
        
        .keterangan-cell {
            max-width: 200px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }
        
        .keterangan-cell:hover {
            overflow: visible;
            white-space: normal;
            background-color: white;
            z-index: 10;
            position: relative;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body>
    <div class="header text-center">
        <h1><i class="fas fa-hand-holding-usd me-2"></i>Sistem Kas Masuk KOBIBAT</h1>
        <p class="lead">Dashboard untuk mengelola kas masuk koperasi</p>
    </div>

    <div class="container">
        <div class="info-box">
            <h5><i class="fas fa-info-circle me-2"></i>Informasi Sumber Kas</h5>
            <p class="mb-0">Sistem ini untuk mencatat kas masuk dari berbagai sumber di Koperasi KOBIBAT.</p>
        </div>
        
        <div class="row">
            <div class="col-md-5">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0"><i class="fas fa-plus-circle me-2"></i>Tambah Kas Masuk</h5>
                    </div>
                    <div class="card-body">
                        <form id="kasForm">
                            <div class="mb-3">
                                <label for="tanggal" class="form-label">Tanggal</label>
                                <input type="date" class="form-control" id="tanggal" required>
                            </div>
                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama Anggota</label>
                                <select class="form-select" id="nama" required>
                                    <option value="" selected disabled>-- Pilih Anggota --</option>
                                    <option value="Ahmad Supriyadi">Ahmad Supriyadi</option>
                                    <option value="Siti Rahayu">Siti Rahayu</option>
                                    <option value="Budi Santoso">Budi Santoso</option>
                                    <option value="Dewi Lestari">Dewi Lestari</option>
                                    <option value="Joko Widodo">Joko Widodo</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="sumber" class="form-label">Sumber Kas</label>
                                <select class="form-select" id="sumber" required>
                                    <option value="" selected disabled>-- Pilih Sumber Kas --</option>
                                    <option value="Pinjaman Pokok">Pinjaman Pokok</option>
                                    <option value="Simpanan Pokok">Simpanan Pokok</option>
                                    <option value="Simpanan Wajib">Simpanan Wajib</option>
                                    <option value="Simpanan Sukarela">Simpanan Sukarela</option>
                                    <option value="Angsuran Pinjaman">Angsuran Pinjaman</option>
                                    <option value="Bunga Pinjaman">Bunga Pinjaman</option>
                                    <option value="Administrasi">Biaya Administrasi</option>
                                    <option value="Denda Keterlambatan">Denda Keterlambatan</option>
                                    <option value="Lainnya">Lainnya</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="jumlah" class="form-label">Jumlah (Rp)</label>
                                <input type="number" class="form-control" id="jumlah" placeholder="Masukkan jumlah" min="0" required>
                            </div>
                            <div class="mb-3">
                                <label for="keterangan" class="form-label">Keterangan (Opsional)</label>
                                <textarea class="form-control" id="keterangan" rows="2" placeholder="Tambahkan keterangan jika perlu"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">
                                <i class="fas fa-save me-2"></i>Simpan
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            
            <div class="col-md-7">
                <div class="total-box">
                    <h4><i class="fas fa-wallet me-2"></i>Total Kas Masuk</h4>
                    <h2 id="totalKas">Rp 0</h2>
                </div>
                
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0"><i class="fas fa-history me-2"></i>Data Kas Masuk</h5>
                        <button class="btn btn-sm btn-light" onclick="clearAllData()">
                            <i class="fas fa-trash me-1"></i>Hapus Semua
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>Tanggal</th>
                                        <th>Nama</th>
                                        <th>Sumber Kas</th>
                                        <th>Jumlah</th>
                                        <th>Keterangan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody id="dataKas">
                                    <!-- Data akan dimuat di sini -->
                                </tbody>
                            </table>
                        </div>
                        <div id="emptyState" class="text-center py-4">
                            <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                            <p class="text-muted">Belum ada data kas masuk.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Notification -->
    <div id="notification" class="notification alert alert-success" role="alert" style="display: none;"></div>

    <script>
        // Inisialisasi data contoh untuk demonstrasi
        function initializeSampleData() {
            if (!localStorage.getItem('kasMasuk')) {
                const sampleData = [
                    {
                        id: 1,
                        tanggal: '2023-08-21',
                        nama: 'Siti Rahayu',
                        sumber: 'Pinjaman Pokok',
                        jumlah: 120000,
                        keterangan: 'Pinjaman modal usaha'
                    },
                    {
                        id: 2,
                        tanggal: '2023-08-26',
                        nama: 'Dewi Lestari',
                        sumber: 'Simpanan Wajib',
                        jumlah: 20000,
                        keterangan: 'Simpanan wajib bulan Agustus'
                    }
                ];
                localStorage.setItem('kasMasuk', JSON.stringify(sampleData));
            }
        }

        // Fungsi untuk menentukan class badge berdasarkan sumber kas
        function getBadgeClass(sumber) {
            switch(sumber) {
                case 'Pinjaman Pokok':
                    return 'badge-pinjaman';
                case 'Simpanan Pokok':
                    return 'badge-pokok';
                case 'Simpanan Wajib':
                    return 'badge-wajib';
                case 'Simpanan Sukarela':
                    return 'badge-sukarela';
                case 'Angsuran Pinjaman':
                case 'Bunga Pinjaman':
                    return 'badge-pinjaman';
                case 'Administrasi':
                case 'Denda Keterlambatan':
                    return 'badge-lainnya';
                default:
                    return 'badge-lainnya';
            }
        }

        // Fungsi untuk memuat data dari localStorage
        function loadKasData() {
            initializeSampleData();
            const kasMasuk = JSON.parse(localStorage.getItem('kasMasuk')) || [];
            const tableBody = document.getElementById('dataKas');
            const emptyState = document.getElementById('emptyState');
            const totalKasElement = document.getElementById('totalKas');
            
            // Hitung total kas
            let totalKas = 0;
            
            // Kosongkan tabel
            tableBody.innerHTML = '';
            
            // Jika tidak ada data, tampilkan pesan
            if (kasMasuk.length === 0) {
                emptyState.style.display = 'block';
            } else {
                emptyState.style.display = 'none';
                
                // Isi tabel dengan data
                kasMasuk.forEach(function(kas) {
                    totalKas += kas.jumlah;
                    const badgeClass = getBadgeClass(kas.sumber);
                    
                    const row = document.createElement('tr');
                    row.innerHTML = `
                        <td>${formatDate(kas.tanggal)}</td>
                        <td>${kas.nama}</td>
                        <td><span class="badge-sumber ${badgeClass}">${kas.sumber}</span></td>
                        <td>Rp ${formatNumber(kas.jumlah)}</td>
                        <td class="keterangan-cell" title="${kas.keterangan || 'Tidak ada keterangan'}">
                            ${kas.keterangan || '-'}
                        </td>
                        <td>
                            <button class="btn btn-sm btn-danger" onclick="deleteKas(${kas.id})">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    `;
                    tableBody.appendChild(row);
                });
            }
            
            // Update total kas
            totalKasElement.textContent = `Rp ${formatNumber(totalKas)}`;
        }
        
        // Fungsi untuk menyimpan data ke localStorage
        function saveKasData(kasData) {
            let kasMasuk = JSON.parse(localStorage.getItem('kasMasuk')) || [];
            kasMasuk.push(kasData);
            localStorage.setItem('kasMasuk', JSON.stringify(kasMasuk));
        }
        
        // Fungsi untuk menghapus data kas
        function deleteKas(id) {
            if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
                let kasMasuk = JSON.parse(localStorage.getItem('kasMasuk')) || [];
                kasMasuk = kasMasuk.filter(kas => kas.id !== id);
                localStorage.setItem('kasMasuk', JSON.stringify(kasMasuk));
                
                showNotification('Data kas masuk berhasil dihapus!', 'success');
                loadKasData();
            }
        }
        
        // Fungsi untuk menghapus semua data
        function clearAllData() {
            if (confirm('Apakah Anda yakin ingin menghapus semua data? Tindakan ini tidak dapat dibatalkan.')) {
                localStorage.removeItem('kasMasuk');
                showNotification('Semua data kas masuk telah dihapus!', 'info');
                loadKasData();
            }
        }
        
        // Fungsi untuk menampilkan notifikasi
        function showNotification(message, type) {
            const notification = document.getElementById('notification');
            notification.textContent = message;
            notification.className = `notification alert alert-${type}`;
            notification.style.display = 'block';
            
            // Sembunyikan notifikasi setelah 3 detik
            setTimeout(() => {
                notification.style.display = 'none';
            }, 3000);
        }
        
        // Fungsi untuk memformat angka (ribuan separator)
        function formatNumber(num) {
            return num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        }
        
        // Fungsi untuk memformat tanggal
        function formatDate(dateString) {
            const options = { day: '2-digit', month: '2-digit', year: 'numeric' };
            return new Date(dateString).toLocaleDateString('id-ID', options);
        }
        
        // Event listener ketika halaman dimuat
        document.addEventListener('DOMContentLoaded', function() {
            // Set tanggal default ke hari ini
            const today = new Date().toISOString().substr(0, 10);
            document.getElementById('tanggal').value = today;
            
            // Muat data saat halaman dimuat
            loadKasData();
            
            // Handle form submission
            document.getElementById('kasForm').addEventListener('submit', function(e) {
                e.preventDefault();
                
                // Ambil nilai dari form
                const tanggal = document.getElementById('tanggal').value;
                const nama = document.getElementById('nama').value;
                const sumber = document.getElementById('sumber').value;
                const jumlah = document.getElementById('jumlah').value;
                const keterangan = document.getElementById('keterangan').value;
                
                // Validasi form
                if (!tanggal || !nama || !sumber || !jumlah) {
                    showNotification('Harap isi semua field yang wajib diisi!', 'danger');
                    return;
                }
                
                // Buat objek data kas
                const kasMasuk = {
                    id: Date.now(), // ID unik berdasarkan timestamp
                    tanggal: tanggal,
                    nama: nama,
                    sumber: sumber,
                    jumlah: parseInt(jumlah),
                    keterangan: keterangan
                };
                
                // Simpan ke localStorage
                saveKasData(kasMasuk);
                
                // Reset form (kecuali tanggal)
                document.getElementById('nama').value = '';
                document.getElementById('sumber').value = '';
                document.getElementById('jumlah').value = '';
                document.getElementById('keterangan').value = '';
                
                // Tampilkan notifikasi
                showNotification('Data kas masuk berhasil disimpan!', 'success');
                
                // Muat ulang data
                loadKasData();
            });
        });
    </script>
</body>
</html>
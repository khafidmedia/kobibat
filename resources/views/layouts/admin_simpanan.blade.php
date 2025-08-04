<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Simpanan Koperasi Bisa Hebat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    @yield('content')

</body>
</html>
<!-- Modal Gambar -->
<div class="modal fade" id="modalGambar" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content bg-dark">
            <div class="modal-body text-center">
                <img id="gambarModalSrc" src="" class="img-fluid rounded">
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS langsung disisipkan -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
    function tampilkanGambar(src) {
        const gambar = document.getElementById('gambarModalSrc');
        gambar.src = src;

        const modal = new bootstrap.Modal(document.getElementById('modalGambar'));
        modal.show();
    }
</script>


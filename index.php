<?php // index.php ?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>AsiaClean Laundry- Sistem Transaksi</title>

  <!-- Font & Icons -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
  <script src="https://unpkg.com/feather-icons"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

  <!-- Custom CSS -->
  <link rel="stylesheet" href="style.css">
  <script src="script.js" defer></script>
</head>
<body>

  <!-- NAVBAR -->
  <nav class="navbar navbar-expand-lg bg-transparent py-3">
    <div class="container">
      <a class="navbar-brand fw-bold text-white d-flex align-items-center gap-2" href="#">
        <i data-feather="droplet"></i> AsiaClean Laundry
      </a>
      <button class="navbar-toggler bg-light" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
        <ul class="navbar-nav gap-3">
          <li class="nav-item"><a class="nav-link text-white fw-semibold active d-flex align-items-center gap-1" href="#home"><i data-feather="home"></i> Home</a></li>
          <li class="nav-item"><a class="nav-link text-white fw-semibold d-flex align-items-center gap-1" href="#layanan"><i data-feather="grid"></i> Layanan</a></li>
          <li class="nav-item"><a class="nav-link text-white fw-semibold d-flex align-items-center gap-1" href="#" onclick="showHistory()"><i data-feather="clock"></i> Riwayat</a></li>
          <li class="nav-item"><a class="nav-link text-white fw-semibold d-flex align-items-center gap-1" href="#kontak"><i data-feather="phone"></i> Kontak</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- HOME -->
  <section id="home" class="py-5 container">
    <div class="row align-items-center">
      <div class="col-md-6 text-center text-md-start mb-4 mb-md-0">
        <h1 class="fw-bold text-white mb-3">Layanan Laundry No.1 di Indonesia</h1>
        <p class="text-light">Cepat • Bersih • Wangi — Layanan profesional dengan hasil maksimal.</p>
        <button class="btn btn-warning fw-semibold me-2" onclick="scrollToForm()">Mulai Transaksi</button>
        <button class="btn btn-outline-light fw-semibold" onclick="showHistory()">Lihat Riwayat</button>
      </div>
      <div class="col-md-6 text-center">
        <img src="https://static.vecteezy.com/system/resources/previews/005/226/412/non_2x/laundry-with-wash-and-drying-machines-in-flat-background-illustration-dirty-cloth-lying-in-basket-and-women-are-washing-clothes-for-banner-or-poster-vector.jpg" alt="Laundry Machine" class="img-fluid rounded" style="width:320px;">
      </div>
    </div>
  </section>

  <!-- FORM TRANSAKSI -->
  <section id="form-area" class="py-5 container">
    <div class="row g-4">
      <!-- Form -->
      <div class="col-md-6">
        <div class="card glass p-4">
          <h3 class="text-white fw-bold mb-2">Input Transaksi</h3>
          <p class="text-light mb-4">Isi data pelanggan & pilih layanan</p>

          <label class="form-label text-white">Nama Pelanggan</label>
          <input id="nama" type="text" class="form-control mb-3" placeholder="Contoh: Budi Santoso">

          <label class="form-label text-white">Nomor Telepon</label>
          <input id="telp" type="text" class="form-control mb-3" placeholder="0812xxxxxxx">

          <label class="form-label text-white">Berat Cucian (kg)</label>
          <input id="berat" type="number" min="0" class="form-control mb-4" placeholder="Masukkan berat (kg)">

          <label class="form-label text-white">Pilih Layanan</label>
          <div class="d-flex flex-wrap gap-3 mb-4">
            <label class="service text-white"><input type="radio" name="layanan" value="5000" checked><div><i data-feather="cloud"></i> <span class="svc-title">Cuci Saja</span></div></label>
            <label class="service text-white"><input type="radio" name="layanan" value="8000"><div><i data-feather="coffee"></i> <span class="svc-title">Cuci + Setrika</span></div></label>
            <label class="service text-white"><input type="radio" name="layanan" value="6000"><div><i data-feather="loader"></i> <span class="svc-title">Setrika Saja</span></div></label>
            <label class="service text-white"><input type="radio" name="layanan" value="18000"><div><i data-feather="zap"></i> <span class="svc-title">Kilat 3 Jam</span></div></label>
          </div>

          <div class="d-flex gap-2">
            <button class="btn btn-primary fw-semibold" onclick="hitungLaundry()">Hitung</button>
            <button class="btn btn-outline-light fw-semibold" onclick="resetForm()">Reset</button>
          </div>
        </div>
      </div>

      <!-- Hasil Struk -->
      <div class="col-md-6">
        <div class="card glass p-4">
          <h3 class="text-white fw-bold mb-2">Struk Pembayaran</h3>
          <p class="text-light">Hasil transaksi akan muncul di sini</p>
          <div id="hasil" class="p-3 bg-transparent rounded text-light"><div class="empty">Belum ada transaksi</div></div>
          <div class="d-flex justify-content-center gap-2 mt-3">
            <button class="btn btn-warning fw-semibold" onclick="printReceipt()">Cetak Struk</button>
            <button class="btn btn-outline-light fw-semibold" onclick="showHistory()">Riwayat</button>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- LAYANAN -->
  <section id="layanan" class="py-5 container text-center">
    <h2 class="text-white fw-bold mb-4"><i class="bi bi-basket"></i> Layanan Kami</h2>
    <div class="row g-4">
      <div class="col-md-4">
        <div class="card glass p-4 text-white h-100">
          <i class="bi bi-cloud fs-1 mb-3"></i>
          <h5 class="fw-bold">Cuci Saja</h5>
          <p>Proses cepat & bersih dengan pewangi lembut. Hanya Rp 5.000/kg.</p>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card glass p-4 text-white h-100">
          <i class="bi bi-droplet-half fs-1 mb-3"></i>
          <h5 class="fw-bold">Cuci + Setrika</h5>
          <p>Hasil wangi, rapi, dan siap pakai. Hanya Rp 8.000/kg.</p>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card glass p-4 text-white h-100">
          <i class="bi bi-lightning-charge fs-1 mb-3"></i>
          <h5 class="fw-bold">Kilat 3 Jam</h5>
          <p>Layanan super cepat untuk kebutuhan mendesak. Rp 18.000/kg.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- KONTAK -->
  <section id="kontak" class="py-5 container text-center">
    <h2 class="text-white fw-bold mb-4"><i class="bi bi-telephone"></i> Hubungi Kami</h2>
    <div class="row g-4 justify-content-center">
      <div class="col-md-4">
        <div class="card glass text-white p-4 h-100">
          <i class="bi bi-geo-alt fs-1 mb-3"></i>
          <p>Jl. Mawar No.123, Jakarta</p>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card glass text-white p-4 h-100">
          <i class="bi bi-envelope fs-1 mb-3"></i>
          <p>info@asiacleanlaundry.com</p>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card glass text-white p-4 h-100">
          <i class="bi bi-whatsapp fs-1 mb-3"></i>
          <p>0812-3456-7890</p>
        </div>
      </div>
    </div>
  </section>

  <!-- MODAL RIWAYAT -->
  <div class="modal fade" id="historyModal" tabindex="-1" aria-labelledby="historyModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content glass text-white p-3">
        <div class="modal-header border-0">
          <h5 class="modal-title fw-bold"><i data-feather="clock"></i> Riwayat Transaksi</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body" id="historyBody">
          <p class="empty text-center text-light">Belum ada riwayat transaksi</p>
        </div>
        <div class="modal-footer border-0 d-flex justify-content-between">
          <button class="btn btn-danger" onclick="clearHistory()">Hapus Semua</button>
          <button class="btn btn-outline-light" data-bs-dismiss="modal">Tutup</button>
        </div>
      </div>
    </div>
  </div>

  <!-- FOOTER -->
  <footer class="text-center py-3 text-light">
    <small>© 2025 AsiaClean Laundry. All rights reserved.</small>
  </footer>

<script>
  document.addEventListener("DOMContentLoaded", () => {
    if (window.feather) feather.replace();
  });
</script>

</body>
</html>

// Scroll halus ke form input
function scrollToForm() {
  document.getElementById("form-area").scrollIntoView({ behavior: "smooth" });
}

// Fungsi utama untuk menghitung transaksi laundry
function hitungLaundry() {
  const nama = document.getElementById("nama").value.trim();
  const telp = document.getElementById("telp").value.trim();
  const berat = parseFloat(document.getElementById("berat").value);
  const layananEl = document.querySelector('input[name="layanan"]:checked');

  if (!nama || !telp || isNaN(berat) || berat <= 0 || !layananEl) {
    alert("Harap isi semua data dengan benar!");
    return;
  }

  const hargaPerKg = parseInt(layananEl.value);
  const layananNama =
    layananEl.nextElementSibling.querySelector(".svc-title").textContent;
  const total = berat * hargaPerKg;

  // Buat isi struk
  const receipt = `
    <div class="struk text-white">
      <h4 class="fw-bold mb-3 text-center">Sorcha Laundry</h4>
      <div class="row"><strong>Nama</strong><span>${nama}</span></div>
      <div class="row"><strong>Telepon</strong><span>${telp}</span></div>
      <div class="row"><strong>Layanan</strong><span>${layananNama}</span></div>
      <div class="row"><strong>Berat</strong><span>${berat} kg</span></div>
      <div class="row"><strong>Total</strong><span>Rp ${total.toLocaleString(
        "id-ID"
      )}</span></div>
      <p class="mt-3"><small>Tanggal: ${new Date().toLocaleString(
        "id-ID"
      )}</small></p>
    </div>
  `;

  document.getElementById("hasil").innerHTML = receipt;

  // Simpan ke localStorage
  const history = JSON.parse(localStorage.getItem("laundryHistory")) || [];
  history.push({
    nama,
    telp,
    layanan: layananNama,
    berat,
    total,
    date: new Date().toISOString(),
  });
  localStorage.setItem("laundryHistory", JSON.stringify(history));
}

// Fungsi reset form
function resetForm() {
  document.getElementById("nama").value = "";
  document.getElementById("telp").value = "";
  document.getElementById("berat").value = "";
  document.querySelector('input[name="layanan"][value="5000"]').checked = true;
  document.getElementById("hasil").innerHTML =
    '<div class="empty text-light">Belum ada transaksi</div>';
}

// Fungsi cetak struk
function printReceipt() {
  const hasil = document.getElementById("hasil").innerHTML;
  if (hasil.includes("Belum ada transaksi")) {
    alert("Belum ada transaksi untuk dicetak!");
    return;
  }
  const printWindow = window.open("", "_blank");
  printWindow.document.write(`
    <html>
      <head><title>Struk Laundry</title></head>
      <body>${hasil}</body>
    </html>
  `);
  printWindow.print();
}

// Fungsi tampilkan riwayat transaksi (dalam modal)
function showHistory() {
  const history = JSON.parse(localStorage.getItem("laundryHistory")) || [];
  const historyBody = document.getElementById("historyBody");

  if (history.length === 0) {
    historyBody.innerHTML =
      '<p class="empty text-center text-light">Belum ada riwayat transaksi</p>';
  } else {
    historyBody.innerHTML = history
      .map(
        (item, index) => `
      <div class="border-bottom border-light py-2">
        <strong>${index + 1}. ${item.nama}</strong><br>
        <small>${item.layanan} - ${
          item.berat
        } kg - Rp ${item.total.toLocaleString("id-ID")}</small><br>
        <small class="text-secondary">${new Date(item.date).toLocaleString(
          "id-ID"
        )}</small>
      </div>
    `
      )
      .join("");
  }

  const historyModal = new bootstrap.Modal(
    document.getElementById("historyModal")
  );
  historyModal.show();
}

// Hapus semua riwayat
function clearHistory() {
  if (confirm("Yakin ingin menghapus semua riwayat transaksi?")) {
    localStorage.removeItem("laundryHistory");
    document.getElementById("historyBody").innerHTML =
      '<p class="empty text-center text-light">Belum ada riwayat transaksi</p>';
  }
}

// Aktifkan ikon Feather & highlight navbar
document.addEventListener("DOMContentLoaded", function () {
  if (window.feather) feather.replace();

  const navLinks = document.querySelectorAll(".nav-link");
  navLinks.forEach((link) => {
    link.addEventListener("click", function () {
      navLinks.forEach((l) => l.classList.remove("active"));
      this.classList.add("active");
    });
  });
});

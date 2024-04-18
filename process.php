<?php
// Set zona waktu ke Asia/Jakarta (WIB)
date_default_timezone_set('Asia/Jakarta');

// Fungsi untuk mengambil data waktu saat ini dalam format tertentu
function getCurrentDateTime() {
    return date("Y-m-d H:i:s");
}

// Proses hanya dilakukan jika ada data yang dikirimkan dari form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari form
    $id_ml = $_POST["id_ml"];
    $server = $_POST["server"];
    $nominal = $_POST["nominal"];
    $metode_pembayaran = $_POST["metode_pembayaran"];
    $nomor_pembayaran = $_POST["nomor_pembayaran"];

    // Validasi data (contoh validasi sederhana)
    if (empty($id_ml) || empty($server) || empty($nominal) || empty($metode_pembayaran) || empty($nomor_pembayaran)) {
        echo "Semua kolom harus diisi.";
    } else {
        // Siapkan array data transaksi
        $data_transaksi = [
            "ID Mobile Legends" => $id_ml,
            "Server" => $server,
            "Nominal" => $nominal,
            "Metode Pembayaran" => $metode_pembayaran,
            "Nomor Pembayaran" => $nomor_pembayaran,
            "Waktu Transaksi" => getCurrentDateTime()
        ];

        // Cek jika ID dan server sesuai untuk menambahkan username
        if ($id_ml == "902756958" && $server == "12570") {
            $data_transaksi["Username"] = "Vionaree";
        }

        // Konversi array data transaksi ke format JSON
        $json_data = json_encode($data_transaksi);

        // Simpan data transaksi ke file teks (contoh)
        file_put_contents("data_transaksi.txt", $json_data . "\n", FILE_APPEND);

        echo "Top-up berhasil diproses!";
    }
} else {
    // Redirect jika halaman dipanggil secara langsung (bukan dari form)
    header("Location: topup_mobile_legends.html");
    exit;
}
?>

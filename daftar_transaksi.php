<?php
include "conn.php";
// Kode Anda untuk mengambil data dari API Tripay
$apiKey = 'DEV-I2nRxqZX4WE3IwdGAaD4OxVivJMjpmVX28z5gEue';
$payload = [
    'page' => 1,
    'per_page' => 5,
    'sort' => 'desc'
];

$curl = curl_init();

curl_setopt_array($curl, [
    CURLOPT_FRESH_CONNECT  => true,
    CURLOPT_URL            => 'https://tripay.co.id/api-sandbox/merchant/transactions?' . http_build_query($payload),
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_HEADER         => false,
    CURLOPT_HTTPHEADER     => ['Authorization: Bearer ' . $apiKey],
    CURLOPT_FAILONERROR    => false,
    CURLOPT_IPRESOLVE      => CURL_IPRESOLVE_V4
]);

$response = curl_exec($curl);
$error = curl_error($curl);

curl_close($curl);

// Memeriksa error
if (!empty($error)) {
    echo $error;
    // Mengatasi error sesuai kebutuhan Anda
} else {
    // Membaca respons JSON
    $data = json_decode($response, true);

    // Memeriksa apakah data berhasil di-parse
    if ($data !== null) {
        // Iterasi melalui transaksi
        foreach ($data['data'] as $transaction) {
            // Menduga Anda memiliki koneksi database ($db) yang sudah dibuat

            // Memeriksa status pembayaran dalam respons API
            $statusPembayaranAPI = $transaction['status'];

            // Hanya update jika status pembayaran di API adalah "PAID"
            if ($statusPembayaranAPI === 'PAID') {
                // Memeriksa nomor referensi dalam respons API
                $nomorReferensiAPI = $transaction['merchant_ref'];
                $whatsap = $transaction['customer_phone'];
                $nama = $transaction['customer_name'];
                $amount = $transaction['amount'];

                $biaya = number_format($amount,0,",",".");
                $payment_name = $transaction['payment_name'];
                $checkout_url = $transaction['checkout_url'];

                // Cari transaksi dengan nomor referensi yang sesuai di database
                $query = "SELECT * FROM santris WHERE no_referensi = '$nomorReferensiAPI'";
                $result = mysqli_query($conn, $query);

                if ($result) {
                    // Jika transaksi ditemukan, update status menjadi 'paid' jika status belum 'PAID'
                    if (mysqli_num_rows($result) > 0) {
                        $row = mysqli_fetch_assoc($result);
                        $statusPembayaranDatabase = $row['status_bayar'];

                        // Memeriksa apakah status di database belum 'PAID'
                        if ($statusPembayaranDatabase !== 'PAID') {
                            $updateQuery = "UPDATE santris SET status_bayar = 'PAID' WHERE no_referensi = '$nomorReferensiAPI'";
                            $updateResult = mysqli_query($conn, $updateQuery);

                            // Memeriksa apakah query pembaruan berhasil dijalankan
                            if ($updateResult) {
                                $apiUrl = "https://wa.srv11.wapanels.com/send-message";

                                // Parameter API
                                $params = [
                                    'api_key' => 'b68c71446f813d6cb5796530281d37d3a94d5dbd',
                                    'sender' => '6283821886966',
                                    'number' => $whatsap,
                                    'message' => "*Assalamualaikum warahmatullahi wabarakatuh*

*Selamat !* *$nama* akun anda sudah aktif dan dapat melanjutkan ke tahap selanjutnya.

Berikut adalah invoice Pendaftaran :

Status Pembayaran : *LUNAS*
nama peserta : *$nama*
no whatsapp : *$whatsap*
nomor referensi : *$nomorReferensiAPI*
Jumlah Bayar : *Rp. $biaya*
Pembayaran Melalui : *$payment_name*

Detail Transaksi anda dapat dilihat dengan menekan tautan berikut :
$checkout_url

silahkan login di https://psb.sekolahimpian.com/login

Jika tautan tidak dapat ditekan, silahkan untuk menyimpan nomor ini terlebih dahulu
"
                                ];


                                // Membuat URL lengkap dengan parameter
                                $fullUrl = $apiUrl . '?' . http_build_query($params);

                                // Menggunakan cURL untuk melakukan HTTP GET request
                                $ch = curl_init();
                                curl_setopt($ch, CURLOPT_URL, $fullUrl);
                                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

                                $response = curl_exec($ch);

                                if (curl_errno($ch)) {
                                    echo 'Error: ' . curl_error($ch);
                                } else {
                                    echo 'Response: ' . $response;
                                }

                                curl_close($ch);
                                exit();
                            } else {
                                echo "Gagal memperbarui status pembayaran untuk nomor referensi $nomorReferensiAPI di database.";
                            }
                        } else {
                            echo "Status pembayaran untuk nomor referensi $nomorReferensiAPI sudah 'PAID' di database.";
                        }
                    } else {
                        echo "Tidak ada data yang diupdate.";
                    }
                }
            }
        }
    }
}

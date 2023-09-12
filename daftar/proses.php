<?php
include '../conn.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Ambil data dari formulir
    $nama_santri = $_POST['nama_santri'];
    $whatsapp = $_POST['whatsapp'];
    $password = $_POST['password']; // Tetap menggunakan kata sandi dalam teks biasa di sini
    $school = $_POST['school'];
    $biaya_daftar = $_POST['biaya_daftar'];
    $status_bayar = $_POST['status_bayar'];
    $method = $_POST['method'];

    // Membuat nomor referensi acak 10 digit
    $no_referensi = mt_rand(1000000000, 9999999999);

    // Konversi nomor referensi ke string
    $no_referensi_str = strval($no_referensi);

    // Enkripsi kata sandi sebelum menyimpannya ke database
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Lakukan pengecekan apakah nomor WhatsApp sudah terdaftar
    $checkQuery = "SELECT id FROM santris WHERE whatsapp = '$whatsapp'";
    $checkResult = mysqli_query($conn, $checkQuery);

    if (mysqli_num_rows($checkResult) > 0) {
        // Nomor WhatsApp sudah terdaftar, tampilkan pesan kesalahan
        echo "<h4>Nomor WhatsApp sudah terdaftar. Silakan gunakan nomor WhatsApp lain.</h4>";
        echo "<a href='index.php'>Kembali</a>";
    } else {

        $sql = "INSERT INTO santris (nama_santri, whatsapp, password, program_psb, biaya_daftar, status_bayar, no_referensi, method)
                VALUES ('$nama_santri', '$whatsapp', '$hashed_password', '$school', '$biaya_daftar', '$status_bayar', 'daftar-$no_referensi_str', '$method')";

        if ($conn->query($sql) === TRUE) {


            $santri_id = $conn->insert_id;

            $sql_ayah = "INSERT INTO detail_ayah (santri_id)
                 VALUES ('$santri_id')";

            if ($conn->query($sql_ayah) === TRUE) {
            } else {
                echo "Error saat menyimpan data ayah: " . $conn->error;
            }

            $sql_ibu = "INSERT INTO detail_ibu (santri_id)
                VALUES ('$santri_id')";

            if ($conn->query($sql_ibu) === TRUE) {
            } else {
                echo "Error saat menyimpan data ibu: " . $conn->error;
            }

            $sql_santri = "INSERT INTO detail_santri (santri_id)
                VALUES ('$santri_id')";

            if ($conn->query($sql_santri) === TRUE) {
            } else {
                echo "Error saat menyimpan data ibu: " . $conn->error;
            }

            $apiKey       = 'DEV-I2nRxqZX4WE3IwdGAaD4OxVivJMjpmVX28z5gEue';
            $privateKey   = 'C7CSX-ds62g-l2IXl-KqYbx-w5YcE';
            $merchantCode = 'T24264';
            $merchantRef  = 'daftar-' . $no_referensi_str; // Gunakan nomor referensi yang telah di-generate
            $amount       = $biaya_daftar; // Ganti dengan jumlah yang sesuai

            $data = [
                'method'         => $method,
                'merchant_ref'   => $merchantRef,
                'amount'         => $amount,
                'customer_name'  => $nama_santri, // Gunakan nama santri sebagai nama pelanggan
                'customer_email' => 'emailpelanggan@domain.com', // Ganti dengan email pelanggan yang sesuai
                'customer_phone' => $whatsapp, // Gunakan nomor WhatsApp sebagai nomor telepon pelanggan
                'order_items'    => [
                    [
                        'sku'         => 'FB-06',
                        'name'        => 'Pendaftaran Santri', // Ganti dengan nama produk yang sesuai
                        'price'       => $biaya_daftar, // Gunakan biaya pendaftaran sebagai harga
                        'quantity'    => 1,
                        'product_url' => 'https://psb.sekolahimpian.com', // Ganti dengan URL produk yang sesuai
                        'image_url'   => 'https://psb.sekolahimpian.com', // Ganti dengan URL gambar produk yang sesuai
                    ]
                ],
                'return_url'   => 'https://psb.sekolahimpian.com/login', // Ganti dengan URL redirect yang sesuai
                'expired_time' => (time() + (24 * 60 * 60)), // 24 jam
                'signature'    => hash_hmac('sha256', $merchantCode . $merchantRef . $amount, $privateKey)
            ];

            $curl = curl_init();

            curl_setopt_array($curl, [
                CURLOPT_FRESH_CONNECT  => true,
                CURLOPT_URL            => 'https://tripay.co.id/api-sandbox/transaction/create',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_HEADER         => false,
                CURLOPT_HTTPHEADER     => ['Authorization: Bearer ' . $apiKey],
                CURLOPT_FAILONERROR    => false,
                CURLOPT_POST           => true,
                CURLOPT_POSTFIELDS     => http_build_query($data),
                CURLOPT_IPRESOLVE      => CURL_IPRESOLVE_V4
            ]);

            $response = curl_exec($curl);
            $error = curl_error($curl);

            curl_close($curl);

            if (empty($error)) {
                $responseData = json_decode($response, true);
                $checkout = $responseData['data']['checkout_url'];
                if ($responseData && $responseData['data'] && $responseData['data']['checkout_url']) {
                    // Jika transaksi Tripay berhasil, alihkan ke halaman pembayaran Tripay
                    header("Location: " . $responseData['data']['checkout_url']);

                    // URL API
                    $apiUrl = "https://wa.srv11.wapanels.com/send-message";

                    $amount = number_format("$amount", 0, ",", ".");
                    // Parameter API
                    $params = [
                        'api_key' => 'b68c71446f813d6cb5796530281d37d3a94d5dbd',
                        'sender' => '6283821886966',
                        'number' => $whatsapp,
                        'message' => "*Assalamualaikum warahmatullahi wabarakatuh*

Terima Kasih  *$nama_santri* telah mendaftar di *Sekolah Impian*.

Berikut adalah invoice Pendaftaran :

Status Pembayaran : *BELUM LUNAS*
nama peserta : *$nama_santri*
no whatsapp : *$whatsapp*
nomor referensi : *$merchantRef*
Jumlah Bayar : *Rp. $amount* 
Metode Bayar : *$method*

Detail Transaksi anda dapat dilihat di $checkout

Jika sudah melakukan pembayaran, silahkan login di https://psb.sekolahimpian.com/login

*Akun dibuat* 
whatsapp : *$whatsapp*
password : *$password*
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
                    // Jika gagal membuat permintaan pembayaran
                    echo "Gagal membuat permintaan pembayaran. Error: " . $responseData['message'];
                }
            } else {
                // Jika gagal melakukan koneksi ke server Tripay
                echo "Gagal melakukan koneksi ke server Tripay. Error: " . $error;
            }
        } else {
            echo "Error saat menyimpan data santri: " . $conn->error;
        }
    }
}

$conn->close();

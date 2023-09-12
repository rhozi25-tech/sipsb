<?php

$apiKey = 'DEV-I2nRxqZX4WE3IwdGAaD4OxVivJMjpmVX28z5gEue';

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_FRESH_CONNECT  => true,
  CURLOPT_URL            => 'https://tripay.co.id/api-sandbox/merchant/payment-channel',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_HEADER         => false,
  CURLOPT_HTTPHEADER     => ['Authorization: Bearer '.$apiKey],
  CURLOPT_FAILONERROR    => false,
  CURLOPT_IPRESOLVE      => CURL_IPRESOLVE_V4
));

$response = curl_exec($curl);
$error = curl_error($curl);

curl_close($curl);

$data_channel = json_decode($response, true);

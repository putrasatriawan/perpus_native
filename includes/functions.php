<?php
function sanitize_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function generate_barcode($id) {
    // Fungsi sederhana untuk generate barcode (dalam praktik nyata gunakan library seperti TCPDF)
    return "LIB" . str_pad($id, 6, '0', STR_PAD_LEFT);
}

function calculate_expiry_date($registration_date) {
    $date = new DateTime($registration_date);
    $date->add(new DateInterval('P3M')); // Tambah 3 bulan
    return $date->format('Y-m-d');
}
?>
<?php
// ===== PENGATURAN: sesuaikan dengan MySQL Anda =====
$DB_HOST = "localhost";
$DB_NAME = "timekeeper";
$DB_USER = "root";
$DB_PASS = "";                          // XAMPP biasanya kosong

$ADMINS   = ["bayu", "nanoe biroe"];    // huruf kecil
$FIELDS   = ["kat", "jdl", "pen", "thb", "tv", "dl", "ty"];
$KATEGORI = ["Cover Song", "New Song", "Podcast", "Karakoe"];

function jsonOut($data, $code = 200) {
    http_response_code($code);
    header("Content-Type: application/json; charset=utf-8");
    echo json_encode($data, JSON_UNESCAPED_UNICODE);
    exit;
}

try {
    $pdo = new PDO("mysql:host=$DB_HOST;charset=utf8mb4", $DB_USER, $DB_PASS, [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);

    // Buat database otomatis
    $pdo->exec("CREATE DATABASE IF NOT EXISTS `$DB_NAME` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
    $pdo->exec("USE `$DB_NAME`");

    // Buat tabel otomatis (data awal hanya diisi saat tabel pertama kali dibuat)
    $tabelBaru = $pdo->query("SHOW TABLES LIKE 'daftar'")->rowCount() === 0;

    $pdo->exec("CREATE TABLE IF NOT EXISTS daftar (
        id  INT AUTO_INCREMENT PRIMARY KEY,
        kat VARCHAR(30)  NOT NULL DEFAULT 'Cover Song',
        jdl VARCHAR(255) NOT NULL DEFAULT '',
        pen VARCHAR(255) NOT NULL DEFAULT '',
        thb VARCHAR(255) NOT NULL DEFAULT '',
        tv  VARCHAR(20)  NOT NULL DEFAULT '',
        dl  VARCHAR(20)  NOT NULL DEFAULT '',
        ty  VARCHAR(20)  NOT NULL DEFAULT ''
    ) CHARACTER SET utf8mb4");

    // Tabel lama belum punya kolom thb: tambahkan otomatis
    if ($pdo->query("SHOW COLUMNS FROM daftar LIKE 'thb'")->rowCount() === 0) {
        $pdo->exec("ALTER TABLE daftar ADD COLUMN thb VARCHAR(255) NOT NULL DEFAULT '' AFTER pen");
    }

    if ($tabelBaru) {
        // kat, jdl, pen, thb, tv, dl, ty
        $awal = [
            ["Cover Song", "Tresna Lintas Planet",        "Risma",    "", "2026-11-22", "2026-11-22", "2026-11-27"],
            ["Cover Song", "Berita Buruk",                "De lonce", "", "2026-11-22", "2026-12-03", "2026-12-04"],
            ["Cover Song", "Tresna Sing Harus Ngelahang", "Jody",     "", "",           "2026-12-10", ""],
            ["Cover Song", "Ngerupuk Sube Paek",          "",         "", "",           "",           ""],
            ["Cover Song", "Timpal Ngamah Timpal",        "",         "", "",           "",           ""],
            ["New Song",   "kong x kong",                 "",         "", "",           "",           ""],
            ["New Song",   "Nu Happy",                    "",         "", "",           "",           ""],
            ["New Song",   "Move ON",                     "",         "", "",           "",           ""],
            ["New Song",   "separo angkihan",             "",         "", "",           "",           ""],
        ];
        $st = $pdo->prepare("INSERT INTO daftar (kat,jdl,pen,thb,tv,dl,ty) VALUES (?,?,?,?,?,?,?)");
        foreach ($awal as $r) { $st->execute($r); }
    }
} catch (PDOException $e) {
    jsonOut(["error" => "Koneksi database gagal: " . $e->getMessage()], 500);
}
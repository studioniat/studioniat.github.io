<?php
require "koneksi.php";

$aksi = $_GET["aksi"] ?? "list";
$in   = json_decode(file_get_contents("php://input"), true) ?? [];

// Hanya admin yang boleh mengubah data
function wajibAdmin() {
    global $ADMINS, $in;
    $nama = strtolower(trim($in["nama"] ?? ""));
    if (!in_array($nama, $ADMINS, true)) {
        jsonOut(["error" => "Hanya admin yang boleh mengubah data."], 403);
    }
}

switch ($aksi) {

    // READ: ambil semua baris
    case "list":
        $rows = $pdo->query("SELECT id," . implode(",", $FIELDS) . " FROM daftar ORDER BY id")->fetchAll();
        jsonOut(["rows" => $rows]);

    // CREATE: tambah baris kosong
    case "tambah":
        wajibAdmin();
        $pdo->exec("INSERT INTO daftar () VALUES ()");
        jsonOut(["ok" => true, "id" => (int)$pdo->lastInsertId()]);

    // UPDATE: ubah satu kolom
    case "ubah":
        wajibAdmin();
        $id    = (int)($in["id"] ?? 0);
        $field = $in["field"] ?? "";
        $nilai = mb_substr(trim((string)($in["nilai"] ?? "")), 0, 255);

        if ($id <= 0 || !in_array($field, $FIELDS, true)) {
            jsonOut(["error" => "Data tidak valid."], 400);
        }
        if ($field === "kat" && !in_array($nilai, $KATEGORI, true)) {
            jsonOut(["error" => "Kategori tidak valid."], 400);
        }
        if (in_array($field, ["tv", "dl", "ty"], true)
            && $nilai !== "" && !preg_match('/^\d{4}-\d{2}-\d{2}$/', $nilai)) {
            jsonOut(["error" => "Format tanggal tidak valid."], 400);
        }

        $st = $pdo->prepare("UPDATE daftar SET `$field` = :v WHERE id = :id");
        $st->execute([":v" => $nilai, ":id" => $id]);
        jsonOut(["ok" => true]);

    // DELETE: hapus satu baris
    case "hapus":
        wajibAdmin();
        $id = (int)($in["id"] ?? 0);
        if ($id <= 0) jsonOut(["error" => "Data tidak valid."], 400);
        $st = $pdo->prepare("DELETE FROM daftar WHERE id = :id");
        $st->execute([":id" => $id]);
        jsonOut(["ok" => true]);

    default:
        jsonOut(["error" => "Aksi tidak dikenal."], 400);
}
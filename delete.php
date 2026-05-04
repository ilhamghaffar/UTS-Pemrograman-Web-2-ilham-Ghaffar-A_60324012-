<?php
require_once 'config/database.php';

// Validasi ID dari GET
if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: index.php?message=ID tidak valid");
    exit;
}

$id = intval($_GET['id']);

// Cek keberadaan data
$check = $conn->prepare("SELECT id_kategori FROM kategori WHERE id_kategori = ?");
$check->bind_param("i", $id);
$check->execute();
$result = $check->get_result();

if ($result->num_rows == 0) {
    header("Location: index.php?message=Data tidak ditemukan");
    exit;
}

// Delete data
$delete = $conn->prepare("DELETE FROM kategori WHERE id_kategori = ?");
$delete->bind_param("i", $id);
$delete->execute();

// Cek hasil delete
if ($delete->affected_rows > 0) {
    header("Location: index.php?message=Data berhasil dihapus");
} else {
    header("Location: index.php?message=Gagal menghapus data");
}
exit;
?>
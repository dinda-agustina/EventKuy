<?php
ob_start();
include 'config.php';
include '.includes/header.php';

function checkRole(...$requiredRoles) {
    if (!isset($_SESSION['role']) || !in_array($_SESSION['role'], $requiredRoles)) {
        header("Location: no_akses.php");
        exit();
    }
}

checkRole('admin');
//ambil data post yang akan diedit dari database(gantilah ini dengan metode pengambilan data yang sesuai)
$eventIdToEdit = $_GET['id_event']; // sesuaikan dengan cara anda mendapatkan id post yang akan di edit
$query = "SELECT * FROM event WHERE id_event = $eventIdToEdit";
$result = $conn->query($query);

if ($result->num_rows > 0){
    $post = $result->fetch_assoc();
}else{
    echo "Post not found.";
    exit();
}

ob_end_flush();
?>

<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Forms /</span>Edit Event</h4>
    <div class="row">
        <!-- form controls -->
        <div class="col-md-10">
            <div class="card mb-4">
                <div class="card-body">
                    <form method="POST" action="proses_event.php">
                        <input type="hidden" name="id_event" value="<?php echo $eventIdToEdit; ?>">
                        <div class="mb-3">
                            <label for="nama_event" class="form-label">Nama Event</label>
                            <input type="text" class="form-control" id="nama_event" name="nama_event" value="<?=$post ['nama_event']?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="penyelenggara" class="form-label">Penyelenggara</label>
                            <input type="text" class="form-control" id="penyelenggara" name="penyelenggara" value="<?=$post ['penyelenggara']?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="tgl_mulai" class="form-label">Tanggal/Waktu Mulai</label>
                            <div class="col-md-10">
                                <input class="form-control" type="datetime-local" id="tgl_mulai" name="tgl_mulai" value="<?php echo date('Y-m-d H:i:s', strtotime($post['tgl_mulai'])); ?>" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="tgl_selesai" class="form-label">Tanggal/Waktu Selesai</label>
                            <div class="col-md-10">
                                <input class="form-control" type="datetime-local"  id="tgl_selesai" name="tgl_selesai" value="<?php echo date('Y-m-d H:i:s', strtotime($post['tgl_selesai'])); ?>" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="id_kategori" class="form-label">Kategori</label>
                            <select class="form-select" id="id_kategori" name="id_kategori" value="" required>
                                <!-- fecth categories from the database and populate the option -->
                                <option value="" selected disabled>Pilih Salah Satu</option>
                                <?php
                                $queryKategori = "SELECT * FROM kategori_event";
                                $resultKategori = $conn->query($queryKategori);
                                if ($resultKategori->num_rows > 0) {
                                    while ($row = $resultKategori->fetch_assoc()){
                                        $selected = ($row["id_kategori"] == $post["id_kategori"]) ? "selected" : "";
                                        echo "<option value='" . $row["id_kategori"] . "' $selected>" . $row["nama_kategori"] . "</option>";
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="lokasi" class="form-label">Lokasi Event</label>
                            <textarea  class="form-control" id="lokasi" name="lokasi" required><?=$post ['lokasi']?></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="keterangan" class="form-label">Deskripsi Event</label>
                            <textarea  class="form-control" id="keterangan" name="keterangan"  required><?=$post ['keterangan']?></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="kuota" class="form-label">Kuota</label>
                            <input type="number" class="form-control" id="kuota" name="kuota" value="<?=$post ['kuota']?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="jumlah_peserta" class="form-label">Jumlah Peserta</label>
                            <input type="number" class="form-control" id="jumlah_peserta" name="jumlah_peserta" value="0" readonly>
                        </div>
                        <button type="submit" name="update" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include '.includes/footer.php'; ?>
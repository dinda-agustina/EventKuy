<?php
ob_start(); // Mulai output buffering

include 'config.php';
include '.includes/header.php';

function checkRole(...$requiredRoles) {
    if (!isset($_SESSION['role']) || !in_array($_SESSION['role'], $requiredRoles)) {
        header("Location: no_akses.php");
        exit();
    }
}

checkRole('admin');

ob_end_flush(); // Kirim output buffered ke browser
?>

<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Forms /</span>Event Baru</h4>
    <div class="row">
        <!-- Form control -->
        <div class="col-md-10">
            <div class="card mb-4">
                <div class="card-body">
                    <form method="POST" action="proses_event.php" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="nama_event" class="form-label">Nama Event</label>
                            <input type="text" class="form-control" id="nama_event" name="nama_event" required>
                        </div>
                        <div class="mb-3">
                            <label for="penyelenggara" class="form-label">Penyelenggara</label>
                            <input type="text" class="form-control" id="penyelenggara" name="penyelenggara" required>
                        </div>
                        <div class="mb-3">
                            <label for="tgl_mulai" class="form-label">Tanggal/Waktu Mulai</label>
                            <div class="col-md-10">
                                <input type="datetime-local" class="form-control" id="tgl_mulai" name="tgl_mulai" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="tgl_selesai" class="form-label">Tanggal/Waktu Selesai</label>
                            <div class="col-md-10">
                                <input type="datetime-local" class="form-control" id="tgl_selesai" name="tgl_selesai" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="id_kategori" class="form-label">Kategori</label>
                            <select class="form-select" id="id_kategori" name="id_kategori" required>
                                <!-- Fetch categories from the database and populate the option -->
                                <option value="" selected disabled>Pilih Salah Satu</option>
                                <?php
                                $query = "SELECT * FROM kategori_event";
                                $result = $conn->query($query);
                                if ($result->num_rows > 0){
                                    while($row = $result->fetch_assoc()){
                                        echo "<option value='".$row["id_kategori"] . "'>" . $row["nama_kategori"] . "</option>";
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="lokasi" class="form-label">Lokasi Event</label>
                            <textarea class="form-control" id="lokasi" name="lokasi" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="keterangan" class="form-label">Deskripsi Event</label>
                            <textarea class="form-control" id="keterangan" name="keterangan" required></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="kuota" class="form-label">Kuota</label>
                            <input type="number" class="form-control" id="kuota" name="kuota" required>
                        </div>
                        <div class="mb-3">
                            <label for="jumlah_peserta" class="form-label">Jumlah Peserta</label>
                            <input type="number" class="form-control" id="jumlah_peserta" name="jumlah_peserta" value="0" readonly>
                        </div>

                        <button type="submit" name="simpan" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include '.includes/footer.php'; ?>

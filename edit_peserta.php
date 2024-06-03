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
// Get the post that will be edited from the database
$pesertaIdToEdit = $_GET['id_peserta'];
$query = "SELECT * FROM peserta WHERE id_peserta = $pesertaIdToEdit";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    $post = $result->fetch_assoc();
} else {
    echo "Post not found.";
    exit();
}


ob_end_flush();
?>

<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Forms /</span>Edit Peserta</h4>
    <div class="row">
        <div class="col-md-10">
            <div class="card mb-4">
                <div class="card-body">
                    <form method="POST" action="proses_peserta.php">
                        <input type="hidden" name="id_peserta" value="<?php echo $pesertaIdToEdit; ?>">
                        <div class="mb-3">
                            <label for="nama_lengkap" class="form-label">Nama Peserta</label>
                            <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" value="<?=$post['nama_lengkap']?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="text" class="form-control" id="email" name="email" value="<?=$post['email']?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="jk" class="form-label">Jenis Kelamin</label>
                            <select class="form-select" id="jk" name="jk" required>
                                <option disabled>Pilih</option>
                                <option value="Laki-laki" <?php if($post['jk'] == 'Laki-laki') echo 'selected'; ?>>Laki-laki</option>
                                <option value="Perempuan" <?php if($post['jk'] == 'Perempuan') echo 'selected'; ?>>Perempuan</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="usia" class="form-label">Usia</label>
                            <input class="form-control" type="number" id="usia" name="usia" value="<?=$post['usia']?>" required/>
                        </div>
                        <div class="mb-3">
                            <label for="alamat" class="form-label">Alamat</label>
                            <textarea class="form-control" id="alamat" name="alamat" required><?=$post['alamat']?></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="id_event" class="form-label">Event</label>
                            <select class="form-select" id="id_event" name="id_event" required>
                                <option value="" selected disabled>Pilih Salah Satu</option>
                                <?php
                                $queryEvent = "SELECT * FROM event";
                                $resultEvent = $conn->query($queryEvent);
                                if ($resultEvent->num_rows > 0) {
                                    while ($row = $resultEvent->fetch_assoc()){
                                        $selected = ($row["id_event"] == $post["id_event"]) ? "selected" : "";
                                        echo "<option value='" . $row["id_event"] . "' $selected>" . $row["nama_event"] . "</option>";
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <button type="submit" name="update" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include '.includes/footer.php'; ?>

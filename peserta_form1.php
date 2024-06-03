<?php
include 'config.php';
include '.includes/header1.php';

$query="SELECT * FROM peserta WHERE user_id = $userId";
$exec = mysqli_query($conn, $query);
$nama = mysqli_fetch_assoc($exec);

if (isset($_SESSION['user_id'])){
    $userId = $_SESSION['user_id'];
} else {
    echo "Error: user_id not set in the session.";
    exit();
}

?>

<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Forms /</span>Daftar Peserta</h4>
    <div class="row">
        <!-- Form control -->
        <div class="col-md-10">
            <div class="card mb-4">
                <div class="card-body">
                    <form method="POST" action="proses_peserta1.php" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="nama_lengkap" class="form-label">Nama Peserta</label>
                            <?php if ($nama !== null && isset($nama["nama_lengkap"])) { ?>
                                <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" value="<?=$nama["nama_lengkap"]?>" required>
                            <?php } else { ?>
                                <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" required>
                            <?php } ?>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <?php if ($nama !== null && isset($nama["email"])) { ?>
                                <input type="email" class="form-control" id="email" name="email" value="<?=$nama["email"]?>" required>
                            <?php } else { ?>
                                <input type="email" class="form-control" id="email" name="email" required>
                            <?php } ?>
                        </div>
                        <div class="mb-3">
                        <label for="jk" class="form-label">Jenis Kelamin</label>
                        <?php if ($nama !== null && isset($nama["jk"])) { ?>
                            <select class="form-select" id="jk" name="jk" required>
                                <option disabled>Pilih</option>
                                <option value="Laki-laki" <?php if($nama['jk'] == 'Laki-laki') echo 'selected'; ?>>Laki-laki</option>
                                <option value="Perempuan" <?php if($nama['jk'] == 'Perempuan') echo 'selected'; ?>>Perempuan</option>
                            </select>
                        <?php }else{ ?>
                            <select class="form-select" id="jk" name="jk">
                                <option selected disabled>Pilih</option>
                                <option value="Laki-laki">Laki-laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                        <?php } ?>  
                        
                        </div>
                        <div class="mb-3">
                            <label for="usia" class="form-label">Usia</label>
                        <div class="col-md-10">
                        <?php if ($nama !== null && isset($nama["usia"])) { ?>
                            <input class="form-control" type="number" id="usia" name="usia" value="<?=$nama["usia"]?>" required/>
                        <?php }else{ ?>
                            <input class="form-control" type="number" id="usia" name="usia" required/>
                        <?php } ?>
                        </div>
                        </div>
                        <div class="mb-3">
                            <label for="alamat" class="form-label">Alamat</label>
                            <?php if ($nama !== null && isset($nama["alamat"])) { ?>
                                <textarea  class="form-control" id="alamat" name="alamat" required><?=$nama['alamat']?></textarea>
                            <?php } else { ?>
                                <textarea  class="form-control" id="alamat" name="alamat" required></textarea>
                            <?php } ?>
                        </div>
                        <div class="mb-3">
                            <label for="id_event" class="form-label">Event</label>
                            <select class="form-select" id="id_event" name="id_event" required>
                                <!-- fecth categories from the database and populate the option -->
                                <option value="" selected disabled>Pilih Salah Satu</option>
                                <?php
                                $query = "SELECT * FROM event";
                                $result = $conn->query($query);
                                if ($result->num_rows > 0){
                                    while($row = $result->fetch_assoc()){
                                        echo "<option value='".$row["id_event"] . "'>" . $row["nama_event"] . "</option>";
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        
                        
                        <button type="submit" name="simpan" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include '.includes/footer.php'; ?>
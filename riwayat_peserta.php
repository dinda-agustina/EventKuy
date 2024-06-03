<?php
ob_start();
include 'config.php';
include '.includes/header.php';

$title = "Peserta";
include '.includes/toast_messages.php';

function checkRole(...$requiredRoles) {
    if (!isset($_SESSION['role']) || !in_array($_SESSION['role'], $requiredRoles)) {
        header("Location: no_akses.php");
        exit();
    }
}

checkRole('admin');

ob_end_flush();
?>

<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class=" text-muted fw-light">Dashboard/</span>Riwayat</h4>
    <div class="card">
        <!-- hoverable table rows -->
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4>Riwayat Peserta</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive text-nowrap">
                    <table id="datatable" class="table table-hover">
                        <thead class="table-info">
                            <tr class="text-center">
                                <th width="50px">#</th>
                                <th>Kejadian</th>
                                <th>Nama Peserta</th>
                                <th>Nama Event</th>
                                <th>User</th>
                                <th>Pada</th>
                                
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            <!-- query untuk membaca data dari table database -->
                            <?php
                            $index=1;
                            $query = "SELECT * FROM peserta_log ";
                            $exec = mysqli_query($conn,$query);

                            if (!$exec) {
                                die("Query failed: " . mysqli_error($conn));
                            }
                            
                            while($peserta = mysqli_fetch_assoc($exec)) :
                            ?>

                            <tr data-bs-toggle="modal" data-bs-target="#pesertaRiwayatModal"
                                data-id="<?= $peserta['id']; ?>"
                                data-eventtype="<?= $peserta['event_type']; ?>"
                                data-idpeserta="<?= $peserta['id_peserta']; ?>"
                                data-namalengkap="<?= $peserta['nama_lengkap']; ?>"
                                data-email="<?= $peserta['email']; ?>"
                                data-jk="<?= $peserta['jk']; ?>"
                                data-usia="<?= $peserta['usia']; ?>"
                                data-alamat="<?= $peserta['alamat']; ?>"
                                data-namaevent="<?= $peserta['nama_event']; ?>"
                                data-username="<?= $peserta['username']; ?>"
                                data-logtime="<?= $peserta["log_time"]; ?>">
                                <td><?= $index++; ?></td>
                                <td><?= $peserta['event_type']; ?> </td>
                                <td><?= $peserta['nama_lengkap']; ?> </td>
                                <td><?= $peserta['nama_event']; ?> </td>
                                <td><?= $peserta['username']; ?> </td>
                                <td><?= $peserta['log_time']; ?> </td>
                                
                            </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!--/hoverable table rows  -->
    </div>
</div>


<?php include 'modalRiwayatPeserta.php'; ?>
<!-- /content -->

<?php include '.includes/footer.php'; ?>

<script>
document.addEventListener('DOMContentLoaded', (peserta_riwayat) => {
    var pesertaRiwayatModal = document.getElementById('pesertaRiwayatModal');
    
    pesertaRiwayatModal.addEventListener('show.bs.modal', function (peserta_riwayat) {
        var button = peserta_riwayat.relatedTarget;
        
        var eventType = button.getAttribute('data-eventtype');
        var namaLengkap = button.getAttribute('data-namalengkap');
        var email = button.getAttribute('data-email');
        var jk = button.getAttribute('data-jk');
        var usia = button.getAttribute('data-usia');
        var alamat = button.getAttribute('data-alamat');
        var namaEvent = button.getAttribute('data-namaevent');
        var userName = button.getAttribute('data-username');
        var logTime = button.getAttribute('data-logtime');
        
        var modalEventType = pesertaRiwayatModal.querySelector('#modalEventType');
        var modalNamaLengkap = pesertaRiwayatModal.querySelector('#modalNamaLengkap');
        var modalEmail = pesertaRiwayatModal.querySelector('#modalEmail');
        var modalJk = pesertaRiwayatModal.querySelector('#modalJk');
        var modalUsia = pesertaRiwayatModal.querySelector('#modalUsia');
        var modalAlamat = pesertaRiwayatModal.querySelector('#modalAlamat');
        var modalNamaEvent = pesertaRiwayatModal.querySelector('#modalNamaEvent');
        var modalUserName = pesertaRiwayatModal.querySelector('#modalUserName');
        var modalLogTime = pesertaRiwayatModal.querySelector('#modalLogTime');
        
        modalEventType.value = eventType;
        modalNamaLengkap.value = namaLengkap;
        modalEmail.value = email;
        modalJk.value = jk;
        modalUsia.value = usia;
        modalAlamat.value = alamat;
        modalNamaEvent.value = namaEvent;
        modalUserName.value = userName;
        modalLogTime.value = logTime;
    });
});
</script>

<?php
ob_start();
include 'config.php';
include '.includes/header.php';

$title = "Event";
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
                <h4>Riwayat Event</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive text-nowrap">
                    <table id="datatable" class="table table-hover">
                        <thead class="table-info">
                            <tr class="text-center">
                                <th width="50px">#</th>
                                <th>Kejadian</th>
                                <th>Nama Event</th>
                                <th>Kuota</th>
                                <th>Jumlah Peserta</th>
                                <th>Kategori</th>
                                <th>Pada</th>
                                
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            <!-- query untuk membaca data dari table database -->
                            <?php
                            $index=1;
                            $query = "SELECT * FROM event_log ";
                            $exec = mysqli_query($conn,$query);

                            if (!$exec) {
                                die("Query failed: " . mysqli_error($conn));
                            }
                            
                            while($data = mysqli_fetch_assoc($exec)) :
                            ?>

                            <tr data-bs-toggle="modal" data-bs-target="#eventRiwayatModal"
                                data-id="<?= $data['id']; ?>"
                                data-eventtype="<?= $data['event_type']; ?>"
                                data-idevent="<?= $data['id_event']; ?>"
                                data-namaevent="<?= $data['nama_event']; ?>"
                                data-penyelenggara="<?= $data['penyelenggara']; ?>"
                                data-tglmulai="<?= $data['tgl_mulai']; ?>"
                                data-tglselesai="<?= $data['tgl_selesai']; ?>"
                                data-lokasi="<?= $data['lokasi']; ?>"
                                data-keterangan="<?= $data['keterangan']; ?>"
                                data-kuota="<?= $data['kuota']; ?>"
                                data-jumlahPeserta="<?= $data['jumlah_peserta']; ?>"
                                data-kategori="<?= $data['nama_kategori']; ?>"
                                data-logtime="<?= $data["log_time"]; ?>" >
                                <td><?= $index++; ?></td>
                                <td><?= $data['event_type']; ?> </td>
                                <td><?= $data['nama_event']; ?> </td>
                                <td><?= $data['kuota']?></td>
                                <td><?= $data['jumlah_peserta']?></td>
                                <td><?= $data['nama_kategori']; ?> </td>
                                <td><?= $data['log_time']; ?> </td>
                                
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


<?php include 'modalRiwayatEvent.php'; ?>

<!-- /content -->

<?php include '.includes/footer.php'; ?>

<script>
document.addEventListener('DOMContentLoaded', (event_riwayat) => {
    var eventRiwayatModal = document.getElementById('eventRiwayatModal');
    eventRiwayatModal.addEventListener('show.bs.modal', function (event_riwayat) {
        var button = event_riwayat.relatedTarget;

        var eventType = button.getAttribute('data-eventtype');
        var namaEvent = button.getAttribute('data-namaevent');
        var penyelenggara = button.getAttribute('data-penyelenggara');
        var tglMulai = button.getAttribute('data-tglmulai');
        var tglSelesai = button.getAttribute('data-tglselesai');
        var lokasi = button.getAttribute('data-lokasi');
        var keterangan = button.getAttribute('data-keterangan');
        var kuota = button.getAttribute('data-kuota');
        var jumlahPeserta = button.getAttribute('data-jumlahPeserta');
        var kategori = button.getAttribute('data-kategori');
        var logTime = button.getAttribute('data-logtime');

        var modalEventType = eventRiwayatModal.querySelector('#modalEventType');
        var modalNamaEvent = eventRiwayatModal.querySelector('#modalNamaEvent');
        var modalPenyelenggara = eventRiwayatModal.querySelector('#modalPenyelenggara');
        var modalTglMulai = eventRiwayatModal.querySelector('#modalTglMulai');
        var modalTglSelesai = eventRiwayatModal.querySelector('#modalTglSelesai');
        var modalLokasi = eventRiwayatModal.querySelector('#modalLokasi');
        var modalKeterangan = eventRiwayatModal.querySelector('#modalKeterangan');
        var modalKuota = eventRiwayatModal.querySelector('#modalKuota');
        var modalJumlahPeserta = eventRiwayatModal.querySelector('#modalJumlahPeserta');
        var modalKategori = eventRiwayatModal.querySelector('#modalKategori');
        var modalLogTime = eventRiwayatModal.querySelector('#modalLogTime');
        

        modalEventType.value = eventType;
        modalNamaEvent.value = namaEvent;
        modalPenyelenggara.value = penyelenggara;
        modalTglMulai.value = tglMulai;
        modalTglSelesai.value = tglSelesai;
        modalLokasi.value = lokasi;
        modalKeterangan.value = keterangan;
        modalKuota.value = kuota;
        modalJumlahPeserta.value = jumlahPeserta;
        modalKategori.value = kategori;
        modalLogTime.value = logTime;
    });
});
</script>


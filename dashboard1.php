<?php


include 'config.php';
include '.includes/header1.php';

$title = "Event";
include '.includes/toast_messages.php';
?>

<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Dashboard</h4>
    <div class="card">
        <!-- hoverable table rows -->
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4>Semua Event</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive text-nowrap">
                    <table id="datatable" class="table table-hover table-striped table-secondary">
                        <thead class="table-success">
                        <tr class="text-center">
                                <th width="50px">#</th>
                                <th>Nama Event</th>
                                <th>Penyelenggara</th>
                                <th>Kategori</th>
                                
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            <!-- query untuk membaca data dari table database -->
                            <?php
                            $index=1;
                            $query = "SELECT event.nama_event,event.id_event,event.penyelenggara, event.tgl_mulai, event.tgl_selesai, event.lokasi, event.keterangan, event.kuota, event.jumlah_peserta, kategori_event.nama_kategori                           
                            FROM event  
                            INNER JOIN kategori_event ON event.id_kategori = kategori_event.id_kategori ";
                            $exec = mysqli_query($conn,$query);

                            if (!$exec) {
                                die("Query failed: " . mysqli_error($conn));
                            }
                            
                            while($data = mysqli_fetch_assoc($exec)) :
                            ?>
                            <tr data-bs-toggle="modal" data-bs-target="#eventModal"
                                data-idevent="<?= $data['id_event']; ?>"
                                data-namaevent="<?= $data['nama_event']; ?>"
                                data-penyelenggara="<?= $data['penyelenggara']; ?>"
                                data-tglmulai="<?= $data['tgl_mulai']; ?>"
                                data-tglselesai="<?= $data['tgl_selesai']; ?>"
                                data-lokasi="<?= $data['lokasi']; ?>"
                                data-keterangan="<?= $data['keterangan']; ?>"
                                data-kuota="<?= $data['kuota']; ?>"
                                data-jumlahPeserta="<?= $data['jumlah_peserta']; ?>"
                                data-kategori="<?= $data['nama_kategori']; ?>">
                                <td><?= $index++; ?></td>
                                <td><?= $data['nama_event']; ?> </td>
                                <td><?= $data['penyelenggara']; ?> </td>
                                <td><?= $data['nama_kategori']; ?> </td>
                                
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


<!-- Include Modal -->
<?php include 'event_modal1.php'; ?>

<!-- /content -->

<?php include '.includes/footer.php'; ?>

<script>
document.addEventListener('DOMContentLoaded', (event) => {
    var eventModal = document.getElementById('eventModal');
    eventModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget;

        var idEvent = button.getAttribute('data-idevent');
        var namaEvent = button.getAttribute('data-namaevent');
        var penyelenggara = button.getAttribute('data-penyelenggara');
        var tglMulai = button.getAttribute('data-tglmulai');
        var tglSelesai = button.getAttribute('data-tglselesai');
        var lokasi = button.getAttribute('data-lokasi');
        var keterangan = button.getAttribute('data-keterangan');
        var kuota = button.getAttribute('data-kuota');
        var jumlahPeserta = button.getAttribute('data-jumlahPeserta');
        var kategori = button.getAttribute('data-kategori');

        var modalNamaEvent = eventModal.querySelector('#modalNamaEvent');
        var modalPenyelenggara = eventModal.querySelector('#modalPenyelenggara');
        var modalTglMulai = eventModal.querySelector('#modalTglMulai');
        var modalTglSelesai = eventModal.querySelector('#modalTglSelesai');
        var modalLokasi = eventModal.querySelector('#modalLokasi');
        var modalKeterangan = eventModal.querySelector('#modalKeterangan');
        var modalKuota = eventModal.querySelector('#modalKuota');
        var modalJumlahPeserta = eventModal.querySelector('#modalJumlahPeserta');
        var modalKategori = eventModal.querySelector('#modalKategori');
        

        modalNamaEvent.value = namaEvent;
        modalPenyelenggara.value = penyelenggara;
        modalTglMulai.value = tglMulai;
        modalTglSelesai.value = tglSelesai;
        modalLokasi.value = lokasi;
        modalKeterangan.value = keterangan;
        modalKuota.value = kuota;
        modalJumlahPeserta.value = jumlahPeserta;
        modalKategori.value = kategori;

    });
});
</script>

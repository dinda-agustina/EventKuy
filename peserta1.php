<?php
include 'config.php';
include '.includes/header1.php';

$title = "Peserta";
include '.includes/toast_messages.php';
?>

<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class=" text-muted fw-light">Dashboard/</span>Peserta</h4>
    <div class="card">
        <!-- hoverable table rows -->
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4>Data Peserta Event</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive text-nowrap">
                    <table id="datatable" class="table table-hover">
                        <thead class="table-primary">
                            <tr class="text-center">
                                <th width="50px">#</th>
                                <th>Nama Peserta</th>
                                <th>Email</th>
                                <th>Event</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            <!-- query untuk membaca data dari table database -->
                            <?php
                            $index=1;
                            $query = "SELECT peserta.id_peserta, peserta.nama_lengkap, peserta.email, peserta.jk, peserta.usia, peserta.alamat, event.nama_event, users.name as user_name 
                            FROM peserta 
                            INNER JOIN users ON peserta.user_id = users.user_id 
                            LEFT JOIN event ON peserta.id_event = event.id_event ";
                            $exec = mysqli_query($conn,$query);

                            if (!$exec) {
                                die("Query failed: " . mysqli_error($conn));
                            }
                            
                            while($peserta = mysqli_fetch_assoc($exec)) :
                            ?>

                            <tr data-bs-toggle="modal" data-bs-target="#pesertaModal"
                                data-idpeserta="<?= $peserta['id_peserta']; ?>"
                                data-namalengkap="<?= $peserta['nama_lengkap']; ?>"
                                data-email="<?= $peserta['email']; ?>"
                                data-jk="<?= $peserta['jk']; ?>"
                                data-usia="<?= $peserta['usia']; ?>"
                                data-alamat="<?= $peserta['alamat']; ?>"
                                data-namaevent="<?= $peserta['nama_event']; ?>"
                                data-username="<?= $peserta['user_name']; ?>">
                                <td><?= $index++; ?></td>
                                <td><?= $peserta['nama_lengkap']; ?> </td>
                                <td><?= $peserta['email']; ?> </td>
                                <td><?= $peserta['nama_event']; ?> </td> 
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
<?php include 'peserta_modal1.php'; ?>

<!-- /content -->

<?php include '.includes/footer.php'; ?>

<script>
document.addEventListener('DOMContentLoaded', (peserta) => {
    var pesertaModal = document.getElementById('pesertaModal');
    pesertaModal.addEventListener('show.bs.modal', function (peserta) {
        var button = peserta.relatedTarget;

        var namaLengkap = button.getAttribute('data-namalengkap');
        var email = button.getAttribute('data-email');
        var jk = button.getAttribute('data-jk');
        var usia = button.getAttribute('data-usia');
        var alamat = button.getAttribute('data-alamat');
        var namaEvent = button.getAttribute('data-namaevent');
        var userName = button.getAttribute('data-username');

        var modalNamaLengkap = pesertaModal.querySelector('#modalNamaLengkap');
        var modalEmail = pesertaModal.querySelector('#modalEmail');
        var modalJk = pesertaModal.querySelector('#modalJk');
        var modalUsia = pesertaModal.querySelector('#modalUsia');
        var modalAlamat = pesertaModal.querySelector('#modalAlamat');
        var modalNamaEvent = pesertaModal.querySelector('#modalNamaEvent');
        var modalUserName = pesertaModal.querySelector('#modalUserName');

        modalNamaLengkap.value = namaLengkap;
        modalEmail.value = email;
        modalJk.value = jk;
        modalUsia.value = usia;
        modalAlamat.value = alamat;
        modalNamaEvent.value = namaEvent;
        modalUserName.value = userName;

    });
});
</script>


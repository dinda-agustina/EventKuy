<?php 
ob_start();
include 'config.php';
include '.includes/header.php';

$title = "Data";
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
<div class="container-xxl flex-grow-1 container-p-y ">
    <h4 class="fw-bold py-3 mb-4"><span class=" text-muted fw-light">Dashboard/</span>Kategori</h4>
    <!-- hoverable table rows -->
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4>Data Kategori</h4>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addCategoryModal">Tambah Kategori</button>
        </div>
        <div class="card-body">
            <div class="table-responsive text-nowrap">
                <table id="datatable" class="table table-hover">
                    <thead class="table-warning">
                        <tr class="text-center">
                            <th width="50px">#</th>
                            <th >Nama</th>
                            <th width="150px">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        <!-- query untuk membaca data dari table database(webspp) -->
                        <?php
                        $index=1;
                        $query="SELECT * FROM kategori_event";
                        $exec = mysqli_query($conn,$query);
                        while($kategori=mysqli_fetch_assoc($exec)):
                        ?>
                        <tr>
                            <td><?= $index++; ?></td>
                            <td><?= $kategori['nama_kategori'] ?></td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a href="#editCategoryModal" id="<?= $kategori['id_kategori']; ?>" data-toggle="modal" class="view_data dropdown-item"><i class="bx bx-edit-alt me-2"></i>Edit</a>
                                        <a href="proses_kategori.php?id_kategori=<?=$kategori['id_kategori']?>" class="dropdown-item" onclick="return confirm('Apakah Yakin Ingin Menghapus Data?')"><i class="bx bx-trash me-2"></i>Delete</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- / hoverable table rows -->
</div>

<?php include '.includes/footer.php'; ?>
<!-- modal tambah kategori -->
<div class="modal fade" id="addCategoryModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1">Tambah Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="proses_kategori.php" method="POST">
                    <div>
                        <label for="namaKategori" class="form-label">Nama Kategori</label>
                        <input type="text" class="form-control" name="nama_kategori"/>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- modal update kategori  -->
<div class="modal fade" id="editCategoryModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLable1">Update Data Kategori</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="datakategori">
                <!-- form edit data kategori dipisah ke dalam file view.php -->
            </div>
        </div>
    </div>
</div>
<script>
    $('.view_data').click(function(){
        let kategoriID = $(this).attr('id');
        $.ajax({
            url: 'view.php',
            method: 'POST',
            data: {id_kategori:kategoriID},
            success:function(data){
                $('#datakategori').html(data)
                $('#editCategoryModal').modal('show');
            }
        })
    })
</script>
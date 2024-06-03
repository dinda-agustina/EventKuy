<?php include 'config.php';

if (isset($_POST['id_kategori'])){
    $id_kategori = $_POST['id_kategori'];
    $exec = mysqli_query($conn,"SELECT * FROM kategori_event WHERE id_kategori ='$id_kategori' ");
    $kategori = mysqli_fetch_assoc($exec);
    ?>
    <form action="proses_kategori.php" method="POST">
        <div class="form-group">
            <input type="hidden" class="form-control" name="id_kategori" value="<?=$kategori['id_kategori'] ?>">
        </div>
        <div class="form-group">
            <label>Nama Kategori</label>
            <input type="text" class="form-control" name="nama_kategori" value="<?=$kategori['nama_kategori'] ?>">
        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            <button type="Submit" name="update" class="btn btn-warning">Update</button>
        </div>
    </form>

<?php  
}
?>
<?php
ob_start();
include 'config.php';
include '.includes/header.php';

$title = "Kategori";
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
                <h4>Riwayat Kategori</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive text-nowrap">
                    <table id="datatable" class="table table-hover">
                        <thead class="table-info">
                            <tr class="text-center">
                                <th width="50px">#</th>
                                <th>Kejadian</th>
                                <th>Perubahan</th>
                                <th>Pada</th>
                                
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            <!-- query untuk membaca data dari table database -->
                            <?php
                            $index=1;
                            $query = "SELECT * FROM kategori_log ";
                            $exec = mysqli_query($conn,$query);

                            if (!$exec) {
                                die("Query failed: " . mysqli_error($conn));
                            }
                            
                            while($kategori = mysqli_fetch_assoc($exec)) :
                            ?>

                            <tr >
                                <td><?= $index++; ?></td>
                                <td><?= $kategori['event_type']; ?> </td>
                                <td><?= $kategori['nama_kategori']; ?> </td>
                                <td><?= $kategori['created_at']; ?> </td>
                                
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



<!-- /content -->

<?php include '.includes/footer.php'; ?>


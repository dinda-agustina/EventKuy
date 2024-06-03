<?php
ob_start();
include 'config.php';
include '.includes/header.php';
include '.includes/toast_message1.php';

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
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Dashboard</span> Backup&Restore</h4>
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h3>Backup and Restore Database</h3>
        </div>
        <div class="card-body">
            <!-- Form untuk backup database -->
            <form action="backup.php" method="post">
                <div class="mb-3">
                    <label for="backupFileName" class="form-label">Backup File Name</label>
                    <input type="text" class="form-control" id="backupFileName" name="backup_file_name" required>
                </div>
                <button type="submit" class="btn rounded-pill btn-danger">Backup Database</button>
            </form>

            <br><br>

            <!-- Form untuk restore database -->
            <form action="restore.php" method="post" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="formFile" class="form-label">Upload Restore File</label>
                    <input class="form-control" type="file" id="formFile" name="backup_file" accept=".sql" required>
                </div>
                <button type="submit" class="btn rounded-pill btn-success">Restore Database</button>
            </form>
        </div>
    </div>
</div>

<?php
include '.includes/footer.php';
?>

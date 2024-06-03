<!-- Bootstrap toast for Backup Success -->
<div id="toastBackup" class="bs-toast toast fade bg-success position-absolute m-3 end-0" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="toast-header">
        <i class="bx bx-check-circle me-2"></i>
        <strong class="me-auto">Notification</strong>
        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
    <div class="toast-body">
        Backup berhasil!
    </div>
</div>

<!-- Bootstrap toast for Restore Success -->
<div id="toastRestore" class="bs-toast toast fade bg-success position-absolute m-3 end-0" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="toast-header">
        <i class="bx bx-check-circle me-2"></i>
        <strong class="me-auto">Notification</strong>
        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
    <div class="toast-body">
        Restore berhasil!
    </div>
</div>

<!-- Include Bootstrap JS for toast functionality -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Show the backup toast if backup was successful
    var urlParams = new URLSearchParams(window.location.search);
    if (urlParams.has('status')) {
        var status = urlParams.get('status');
        if (status === 'backup_success') {
            var toastBackup = new bootstrap.Toast(document.getElementById('toastBackup'));
            toastBackup.show();
        } else if (status === 'restore_success') {
            var toastRestore = new bootstrap.Toast(document.getElementById('toastRestore'));
            toastRestore.show();
        }
    }
});
</script>

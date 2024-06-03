<!-- peserta_modal.php -->
<div class="modal fade" id="pesertaModal" tabindex="-1" aria-labelledby="pesertaModalLabel" aria-hidden="true">
    <div class="modal-dialog "> <!-- Hapus kelas modal-lg untuk ukuran modal default -->
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="pesertaModalLabel"><strong>Detail Peserta</strong></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row g-2">
                    <div class="col mb-3">
                        <label for="modalNamaLengkap" class="modal-label"><strong>Nama Peserta</strong></label><br>
                        <input type="text" class="form-control-plaintext" readonly id="modalNamaLengkap" value="" />
                    </div>
                    <div class="col mb-3">
                        <label for="modalEmail" class="modal-label"><strong>Email</strong></label><br>
                        <input type="text" class="form-control-plaintext" readonly id="modalEmail" value="" />
                    </div>
                </div>
                <div class="row g-2">
                    <div class="col mb-3">
                        <label for="modalJk" class="modal-label"><strong>Jenis Kelamin</strong></label><br>
                        <input type="text" class="form-control-plaintext" readonly id="modalJk" value="" />
                    </div>
                    <div class="col mb-3">
                        <label for="modalUsia" class="modal-label"><strong>Usia</strong></label><br>
                        <input type="text" class="form-control-plaintext" readonly id="modalUsia" value="" />
                    </div>
                </div>
                <div class="mb-3">
                    <label for="modalAlamat" class="modal-label"><strong>Alamat</strong></label><br>
                    <textarea class="form-control-plaintext" readonly id="modalAlamat"></textarea>
                </div>
                <div class="row g-2">
                    <div class="col mb-3">
                        <label for="modalNamaEvent" class="modal-label"><strong>Nama Event</strong></label><br>
                        <input class="form-control-plaintext" readonly id="modalNamaEvent" value="" />
                    </div>
                    <div class="col mb-3">
                        <label for="modalUserName" class="modal-label"><strong>Username</strong></label><br>
                        <input type="text" class="form-control-plaintext" readonly id="modalUserName" value="" />
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn rounded-pill btn-warning">
                    <a href="#" id="editPeserta" class="text-decoration-none text-dark">Edit</a>
                </button>
                <button type="button" class="btn rounded-pill btn-danger">
                    <a href="#" id="deletePeserta" class="text-decoration-none text-dark">Delete</a>
                </button>
            </div>
        </div>
    </div>
</div>

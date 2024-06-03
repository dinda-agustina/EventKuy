<!-- modal_event.php -->
<div class="modal fade" id="eventRiwayatModal" tabindex="-1" aria-labelledby="eventRiwayatModalLabel" aria-hidden="true">
    <div class="modal-dialog"> <!-- Hapus kelas modal-lg untuk ukuran modal default -->
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="eventRiwayatModalLabel"><strong>Detail Event</strong></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <div class="row g-2">
                    <div class="col mb-3">
                        <label for="modalEventType" class="modal-label"><strong>Kejadian</strong></label><br>
                        <input type="text" class="form-control-plaintext" readonly id="modalEventType" value="" />
                    </div>
                    <div class="col mb-3">
                        <label for="modalLogTime" class="modal-label"><strong>Pada</strong></label><br>
                        <input type="text" class="form-control-plaintext" readonly id="modalLogTime" value="" />
                    </div>
                </div>
            <div class="row g-2">
                    <div class="col mb-3">
                        <label for="modalNamaEvent" class="modal-label"><strong>Nama Event</strong></label><br>
                        <input type="text" class="form-control-plaintext" readonly id="modalNamaEvent" value="" />
                    </div>
                    <div class="col mb-3">
                        <label for="modalPenyelenggara" class="modal-label"><strong>Penyelenggara</strong></label><br>
                        <input type="text" class="form-control-plaintext" readonly id="modalPenyelenggara" value="" />
                    </div>
                </div>
                <div class="row g-2">
                    <div class="col mb-3">
                        <label for="modalTglMulai" class="modal-label"><strong>Tanggal Mulai</strong></label><br>
                        <input type="text" class="form-control-plaintext" readonly id="modalTglMulai" value="" />
                    </div>
                    <div class="col mb-3">
                        <label for="modalTglSelesai" class="modal-label"><strong>Tanggal Selesai</strong></label><br>
                        <input type="text" class="form-control-plaintext" readonly id="modalTglSelesai" value="" />
                    </div>
                </div>
                <div class="row g-2">
                    <div class="col mb-3">
                        <label for="modalKuota" class="modal-label"><strong>Kuota</strong></label><br>
                        <input type="text" class="form-control-plaintext" readonly id="modalKuota" value="" />
                    </div>
                    <div class="col mb-3">
                        <label for="modalJumlahPeserta" class="modal-label"><strong>Jumlah Peserta</strong></label><br>
                        <input type="text" class="form-control-plaintext" readonly id="modalJumlahPeserta" value="" />
                    </div>
                </div>
                <div class="mb-3">
                    <label for="modalLokasi" class="modal-label"><strong>Lokasi</strong></label><br>
                    <textarea class="form-control-plaintext" readonly id="modalLokasi"></textarea>
                </div>
                <div class="mb-3">
                    <label for="modalKeterangan" class="modal-label"><strong>Keterangan</strong></label><br>
                    <textarea class="form-control-plaintext" readonly id="modalKeterangan"></textarea>
                </div>
                <div class="mb-3">
                    <label for="modalKategori" class="modal-label"><strong>Kategori</strong></label><br>
                    <input type="text" class="form-control-plaintext" readonly id="modalKategori" value="" />
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn rounded-pill btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

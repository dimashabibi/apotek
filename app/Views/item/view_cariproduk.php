    <!-- DataTables -->
    <link rel="stylesheet" href="<?= base_url('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css'); ?>">
    <script src="<?= base_url('assets/plugins/datatables/jquery.dataTables.min.js'); ?>"></script>
    <script src="<?= base_url('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js'); ?>"></script>
    <script src="<?= base_url('assets/plugins/datatables-responsive/js/dataTables.responsive.min.js'); ?>"></script>
    <script src="<?= base_url('assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js'); ?>"></script>

    <div class="modal fade" id="modalObat" tabindex="-1" role="dialog" aria-labelledby="modalObatCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalObatCenterTitle">data obat</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="keywordbarcode" id="keywordbarcode" value="<?= $keyword; ?>">
                    <table id="dataobat" class="table table-bordered table-striped dataTable dtr-inline collapsed" width="100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kode Rak</th>
                                <th>Barcode Obat</th>
                                <th>Nama Obat</th>
                                <th>Kategori</th>
                                <th>Satuan</th>
                                <th>Stok</th>
                                <th>Harga Jual</th>
                                <th>#</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function() {
            var table = $('#dataobat').DataTable({
                "processing": true,
                "serverSide": true,
                "order": [],
                "ajax": {
                    "url": "<?= site_url('listDataObat') ?>",
                    "type": "POST",
                    "data": {
                        keywordbarcode: $('#keywordbarcode').val()
                    }
                },
                "columnDefs": [{
                    "targets": [0],
                    "orderable": false,
                }, ],
            });
        });

        function pilihitem(koderak, barcode, namaobat, kategori, satuan, hargajual) {
            $('#kode_rak').val(koderak);
            $('#barcode_obat').val(barcode);
            $('#nama_obat').val(namaobat);
            $('#nama_kategori').val(kategori);
            $('#nama_satuan').val(satuan);
            $('#harga_jual').val(hargajual);
            $('#modalObat').modal('hide');
            $('#modalObat').on('hidden.bs.modal', function(event) {
                $('#barcode_obat').prop('disabled', true);
            });
            $('#qty').focus();
            $('.modal-backdrop').remove();
        }
    </script>
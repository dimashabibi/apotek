<?= $this->extend('layout/template') ?>

<?= $this->section('content_header') ?>
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-capitalize">Halaman Hutang</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#" class="text-capitalize">Hutang</a></li>
                    <li class="breadcrumb-item active text-capitalize">Daftar Hutang</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col-lg-6">
        <!-- small card -->
        <div class="small-box bg-info">
            <div class="inner">
                <h3><?= "Rp" . " " .   number_format($grand_total_hutang); ?></h3>

                <p>Total hutang yang perlu dibayar</p>
            </div>
            <div class="icon">
                <i class="fas fa-shopping-cart"></i>
            </div>

        </div>
    </div>
</div>
<div class="row d-flex justify-content-center">
    <div class="col-12">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title text-capitalize">Input Hutang Baru</h3>
            </div>
            <form class="form-horizontal formHutang" method="post" action="<?= site_url('tambah_hutang'); ?>">
                <input type="hidden" name="paid_at" value="0">
                <?= csrf_field(); ?>
                <div class="card-body">
                    <div class="form-group row justify-content-center">
                        <label for="id_hutang" class="col-sm-2 col-form-label">Nomor Hutang</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control text-bold <?= (session()->get('errors')['id_hutang'] ?? false) ? 'is-invalid' : ' ' ?>" id="id_hutang" name="id_hutang" value="<?= $no_hutang; ?>" readonly>
                            <?php if (session()->get('errors')['id_hutang'] ?? false): ?>
                                <div class="invalid-feedback">
                                    <?= session()->get('errors')['id_hutang']; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php date_default_timezone_set('Asia/Jakarta'); ?>
                    <div class="form-group row justify-content-center">
                        <label for="tanggal" class="col-sm-2 col-form-label">Tanggal</label>
                        <div class=" input-group date col-sm-8" id="reservationdatetime" data-target-input="nearest">
                            <input type="text" name="tanggal" class="form-control datetimepicker-input <?= (session()->get('errors')['tanggal'] ?? false) ? 'is-invalid' : ' ' ?>" data-target="#reservationdatetime" value="<?= old('tanggal'); ?>" autocomplete="off" />
                            <div class="input-group-append" data-target="#reservationdatetime" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                            <?php if (session()->get('errors')['tanggal'] ?? false): ?>
                                <div class="invalid-feedback">
                                    <?= session()->get('errors')['tanggal']; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="form-group row justify-content-center">
                        <label for="nama_distributor" class="col-sm-2 col-form-label">Nama Distributor</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control <?= (session()->get('errors')['nama_distributor'] ?? false) ? 'is-invalid' : ' ' ?>" id=" nama_distributor" name="nama_distributor" value="<?= old('nama_distributor'); ?>" autocomplete="off">
                            <?php if (session()->get('errors')['nama_distributor'] ?? false): ?>
                                <div class="invalid-feedback">
                                    <?= session()->get('errors')['nama_distributor']; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="form-group row justify-content-center">
                        <label for="total_hutang" class="col-sm-2 col-form-label">Jumlah Hutang</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control <?= (session()->get('errors')['total_hutang'] ?? false) ? 'is-invalid' : ' ' ?>" id="total_hutang" name="total_hutang" autocomplete="off">
                            <?php if (session()->get('errors')['total_hutang'] ?? false): ?>
                                <div class="invalid-feedback">
                                    <?= session()->get('errors')['total_hutang']; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-center">
                    <button type="submit" class="btn btn-info">Simpan</button>
                </div>
            </form>
        </div>

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Daftar Hutang</h3>
            </div>
            <div class="card-body">
                <table id="debtTable" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nomor Hutang</th>
                            <th>Tanggal Hutang</th>
                            <th>Tanggal Bayar</th>
                            <th>Nama Distributor</th>
                            <th>Jumlah Hutang</th>
                            <th>Sisa Hutang</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1;
                        foreach ($hutang as $row): ?>
                            <tr>
                                <td><?= $i++; ?></td>
                                <td><?= $row['id_hutang']; ?></td>
                                <td><?= $row['tanggal']; ?></td>
                                <td><?= $row['paid_at']; ?></td>
                                <td><?= $row['nama_distributor']; ?></td>
                                <td>Rp <?= number_format($row['total_hutang'], 2); ?></td>
                                <td>Rp <?= number_format($row['sisa_hutang'], 2); ?></td>
                                <td>
                                    <?php if ($row['is_paid']): ?>
                                        <span class="badge badge-success">Lunas</span>
                                    <?php else: ?>
                                        <span class="badge badge-danger">Belum Lunas</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if (!$row['is_paid']): ?>
                                        <button onclick="editHutang('<?= $row['id_hutang']; ?>')"
                                            class="btn btn-primary btn-sm">
                                            <i class="fas fa-money-bill"></i> Cicil
                                        </button>
                                        <button onclick="markAsPaid('<?= $row['id_hutang']; ?>')"
                                            class="btn btn-success btn-sm">
                                            <i class="fas fa-check"></i> Bayar
                                        </button>
                                    <?php endif; ?>
                                    <button onclick="hapusHutang('<?= $row['id_hutang']; ?>', '<?= $row['nama_distributor']; ?>')"
                                        class="btn btn-danger btn-sm">
                                        <i class="fas fa-trash"></i> Hapus
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="viewmodal" style="display: none;"></div>
</div>


<form id="deleteForm" method="post" style="display:none;">
    <?= csrf_field() ?>
    <input type="hidden" id="delete_id" name="id">
</form>
<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script src="<?= base_url('assets/plugins/autoNumeric.js') ?>"></script>
<script>
    $(function() {
        $('#reservationdatetime').datetimepicker({
            icons: {
                time: 'far fa-clock'
            },
            format: 'YYYY-MM-DD HH:mm:ss' // Format untuk Y-m-d H:i:s
        });

        $('#total_hutang').autoNumeric('init', {
            aSep: ',',
            aDec: '.',
            mDec: '0'
        });

        $("#debtTable").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print"]
        }).buttons().container().appendTo('#debtTable_wrapper .col-md-6:eq(0)');

        $('.formHutang').validate({
            rules: {
                tgl_pembelian: {
                    required: true,
                },
                id_supplier: {
                    required: true
                },
                no_faktur: {
                    required: true
                },
            },
            messages: {
                tgl_pembelian: {
                    required: "Tanggal belum diinput"
                },
                id_supplier: {
                    required: "Supplier belum dipilih"
                },
                no_faktur: {
                    required: "No Faktur Belum diinput",
                },
            },
            errorElement: 'span',
            errorPlacement: function(error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function(element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            }
        });
    });

    function markAsPaid(id_hutang) {
        Swal.fire({
            title: "Bayar Hutang?",
            html: "Yakin ingin menandai hutang ini sebagai <strong>Lunas</strong>?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Ya, Bayar!",
            cancelButtonText: "Tidak",
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "post",
                    url: "<?= site_url('/hutang/markAsPaid'); ?>",
                    data: {
                        id: id_hutang,
                        <?= csrf_token() ?>: "<?= csrf_hash() ?>" // Kirimkan CSRF token
                    },
                    dataType: "json",
                    success: function(response) {
                        if (response.success === 'berhasil') {
                            Swal.fire('Berhasil', 'Hutang berhasil ditandai sebagai lunas.', 'success')
                                .then(() => window.location.reload());
                        } else {
                            Swal.fire('Gagal', response.message || 'Terjadi kesalahan.', 'error');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                        Swal.fire('Error', 'Terjadi kesalahan pada server.', 'error');
                    }
                });
            }
        });
    }


    function hapusHutang(id, nama_distributor) {
        Swal.fire({
            title: "Hapus Hutang?",
            html: `Yakin ingin menghapus hutang dari <strong>${nama_distributor}</strong>?`,
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Ya, Hapus!",
            cancelButtonText: "Tidak",
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "post",
                    url: "<?= site_url('/hutang/delete'); ?>",
                    data: {
                        id: id
                    },
                    dataType: "json",
                    success: function(response) {
                        if (response.success == 'berhasil') {
                            Swal.fire({
                                title: "Berhasil!",
                                text: "Hutang berhasil dihapus.",
                                icon: "success"
                            }).then(() => {
                                location.reload();
                            });
                        } else {
                            Swal.fire({
                                title: "Gagal!",
                                text: "Hutang gagal dihapus.",
                                icon: "error"
                            });
                        }
                    },
                    error: function() {
                        Swal.fire({
                            title: "Error!",
                            text: "Terjadi kesalahan dalam menghapus hutang.",
                            icon: "error"
                        });
                    }
                });
            }
        });
    }

    function editHutang($id) {
        $.ajax({
            type: "get",
            url: "<?= site_url('editHutang/'); ?>" + $id,
            success: function(response) {
                if (response.data) {
                    $('.viewmodal').html(response.data).show();
                    $('#modalformedit').on('shown.bs.modal', function(event) {
                        $('#jumlah_cicil').focus();
                    });
                    $('#modalformedit').modal('show');
                }
            },
            error: function(xhr, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });
    }
</script>
<?= $this->endSection() ?>
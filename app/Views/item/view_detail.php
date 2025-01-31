  <!-- SweetAlert2 -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <link rel="stylesheet" href="<?= base_url('assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css'); ?>">
  <table class="table table-hover text-nowrap table-bordered table-striped">
      <thead class="table ">
          <tr class="text-center">
              <th class="text-capitalize">No</th>
              <th class="text-capitalize">kode rak</th>
              <th class="text-capitalize">Barcode</th>
              <th class="text-capitalize" style="width: 550px;">Nama obat</th>
              <th class="text-capitalize">satuan</th>
              <th class="text-capitalize">Harga Jual</th>
              <th class="text-uppercase">qty</th>
              <th class="text-capitalize">sub total</th>
              <th class="text-capitalize">#</th>
          </tr>
      </thead>
      <tbody>
          <?php $i = 1; ?>
          <?php foreach ($datadetail as $d) : ?>
              <tr>
                  <td><?= $i++; ?></td>
                  <td><?= $d['kode_rak']; ?></td>
                  <td><?= $d['barcode_obat']; ?></td>
                  <td style="width: 550px;"><?= $d['nama_obat']; ?></td>
                  <td class="text-center"><?= $d['nama_satuan']; ?></td>
                  <td class="text-right"><strong><?= number_format($d['harga_jual'], 0, ",", "."); ?></strong></td>
                  <td class="text-center text-danger text-bold"><?= number_format($d['qty']); ?></td>
                  <td><strong><?= number_format($d['sub_total'], 0, ",", "."); ?></strong></td>
                  <td class="text-center">
                      <button type="button" class="btn btn-sm btn-danger" onclick="hapusitem('<?= $d['id']; ?>','<?= $d['nama_obat']; ?>') ">
                          <i class="fas fa-trash-alt"></i>
                      </button>
                  </td>
              </tr>
          <?php endforeach; ?>
      </tbody>
  </table>

  <script>
      function hapusitem(id, nama_obat) {
          Swal.fire({
              title: "Hapus item?",
              html: `Yakin Ingin menghapus <strong>${nama_obat}</strong>?`,
              icon: "warning",
              showCancelButton: true,
              confirmButtonColor: "#3085d6",
              cancelButtonColor: "#d33",
              confirmButtonText: "Ya, Hapus !",
              cancelButtonText: "Tidak",
          }).then((result) => {
              if (result.isConfirmed) {
                  $.ajax({
                      type: "post",
                      url: "<?= site_url('/hapusItem'); ?>",
                      data: {
                          id: id
                      },
                      dataType: "json",
                      success: function(response) {
                          if (response.success == 'berhasil') {
                              dataDetailtransaksi();
                              Kosong();

                          }

                      }
                  });
              }
          });

      }
  </script>
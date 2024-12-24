  <!-- SweetAlert2 -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <link rel="stylesheet" href="<?= base_url('assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css'); ?>">
  <script src="<?= base_url('assets/plugins/sweetalert2/sweetalert2.min.js'); ?>"></script>

  <div class="modalEdit" style="display: none;"></div>

  <table class="table table-bordered">
      <thead class="table table-bordered table-striped">
          <tr class="text-center">
              <th class="text-capitalize">No</th>
              <th class="text-capitalize">kode rak</th>
              <th class="text-capitalize">Barcode</th>
              <th class="text-capitalize">Nama obat</th>
              <th class="text-capitalize">Kategori</th>
              <th class="text-capitalize">satuan</th>
              <th class="text-capitalize">Harga Pokok</th>
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
                  <td><?= $d['nama_obat']; ?></td>
                  <td><?= $d['nama_kategori']; ?></td>
                  <td class="text-center"><?= $d['nama_satuan']; ?></td>
                  <td class="text-right"><strong><?= number_format($d['harga_pokok'], 0, ",", "."); ?></strong></td>
                  <td class="text-center text-danger text-bold"><?= number_format($d['qty']); ?></td>
                  <td><strong><?= number_format($d['sub_total'], 0, ",", "."); ?></strong></td>
                  <td class="text-center">
                      <button type="button" class="btn btn-sm btn-danger" onclick="hapusitem('<?= $d['id']; ?>','<?= $d['nama_obat']; ?>')" title="Hapus item">
                          <i class="fas fa-trash-alt"></i>
                      </button>
                  </td>
              </tr>
          <?php endforeach; ?>
      </tbody>
  </table>


  <script>
      $(document).ready(function() {
          $('.editItem').click(function(e) {
              e.preventDefault();
              edititem();
          });
      });

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
                      url: "<?= site_url('/hapusItemBeli'); ?>",
                      data: {
                          id: id
                      },
                      dataType: "json",
                      success: function(response) {
                          if (response.success == 'berhasil') {
                              dataDetailPembelian();
                          }
                      }
                  });
              }
          });
      }
  </script>
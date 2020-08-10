<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<!-- General JS Scripts -->
<script src="<?php echo base_url(); ?>assets/modules/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>assets/modules/popper.js"></script>
<script src="<?php echo base_url(); ?>assets/modules/tooltip.js"></script>
<script src="<?php echo base_url(); ?>assets/modules/bootstrap/js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>assets/modules/nicescroll/jquery.nicescroll.min.js"></script>
<script src="<?php echo base_url(); ?>assets/modules/moment.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/stisla.js"></script>

<!-- JS Libraies -->
<script src="<?php echo base_url(); ?>assets/modules/bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script>
<script src="<?php echo base_url(); ?>assets/modules/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js"></script>
<script src="<?php echo base_url(); ?>assets/modules/select2/dist/js/select2.full.min.js"></script>
<script src="<?php echo base_url(); ?>assets/modules/jquery-selectric/jquery.selectric.min.js"></script>
<script src="<?php echo base_url(); ?>assets/modules/datatables/datatables.min.js"></script>
<script src="<?php echo base_url(); ?>assets/modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js"></script>
<script src="<?php echo base_url(); ?>assets/modules/datatables/Select-1.2.4/js/dataTables.select.min.js"></script>

<!-- Page Specific JS File -->
<script src="<?php echo base_url(); ?>assets/js/page/forms-advanced-forms.js"></script>
<script src="<?php echo base_url(); ?>assets/js/page/modules-datatables.js"></script>


<!-- Template JS File -->
<script src="<?php echo base_url(); ?>assets/js/scripts.js"></script>
<script src="<?php echo base_url(); ?>assets/js/custom.js"></script>

<script>
  $(document).ready(function() {
    $('#example').dataTable({
      "bPaginate": true,
      "bLengthChange": false,
      "bFilter": true,
      "bInfo": false,
      "bAutoWidth": false
    });
  });
</script>

<script>
  $(document).ready(function() {
    $('#laporan').DataTable({
      dom: 'Bfrtip',
      buttons: ['copy', 'csv', 'excel', 'pdf']
    });
  });
</script>

<script>
  $(document).ready(function() {
    $("#pedagang").change(function() {
      let pedagang = $("#pedagang").val();
      $.ajax({
        method: "GET",
        url: "<?= base_url('admin/setoran/search') ?>",
        data: {
          id_pedagang: pedagang
        },
        success: function(data) {
          let j = JSON.parse(data);
          const tempat = j['pedagang'][0].nama_tempat;
          const result = tempat.substring(0, 1);
          const kios = j['harga'][0].kios;
          const los = j['harga'][0].los;
          if (result == 'K') {
            jumlah = kios;
          } else {
            jumlah = los;
          }

          console.log(result);
          $('#alamat').val(j['pedagang'][0].alamat);
          $('#tempat').val(j['pedagang'][0].nama_tempat);
          $('#jumlah').val(jumlah);
        },
        error: function(data) {
          alert('Error');
        }
      })
    })
  });
</script>

</body>

</html>
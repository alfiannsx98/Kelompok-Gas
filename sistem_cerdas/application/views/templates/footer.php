<footer class="main-footer">
    <strong>
        &copy;
        <script>
            document.write(new Date().getFullYear())
        </script>
        <a class="align-center" href="#">
            Kelompok 1 - Powered By. ADMIN-LTE
        </a>
</footer>

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="<?= base_url(); ?>assets/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?= base_url(); ?>assets/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="<?= base_url(); ?>assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- Select2 -->
<script src="<?= base_url(); ?>assets/plugins/select2/js/select2.full.min.js"></script>
<!-- ChartJS -->
<script src="<?= base_url(); ?>assets/plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="<?= base_url(); ?>assets/plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="<?= base_url(); ?>assets/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="<?= base_url(); ?>assets/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="<?= base_url(); ?>assets/plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="<?= base_url(); ?>assets/plugins/moment/moment.min.js"></script>
<script src="<?= base_url(); ?>assets/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="<?= base_url(); ?>assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="<?= base_url(); ?>assets/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="<?= base_url(); ?>assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="<?= base_url(); ?>assets/dist/js/adminlte.js"></script>

<!-- DataTables -->
<script src="<?= base_url(); ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url(); ?>assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url(); ?>assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?= base_url(); ?>assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<!-- Akhir DataTables -->

<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="<?= base_url(); ?>assets/dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?= base_url(); ?>assets/dist/js/demo.js"></script>


<!-- page script -->
<script>
    $(function() {
        $("#example1").DataTable({
            "responsive": true,
            "autoWidth": false,
        });
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
        $('#tableOpt').DataTable({
            "responsive": true,
            "autoWidth": false
        });
        $('#tableGejala').DataTable({
            "responsive": true,
            "autoWidth": false,
        });
    });
</script>
<script>
    $('.custom-file-input').on('change', function() {
        let fileName = $(this).val().split('\\').pop();
        $(this).next('.custom-file-label').addClass("selected").html(fileName);
    });


    $('.form-check-input').on('click', function() {
        const menuId = $(this).data('menu');
        const roleId = $(this).data('role');

        $.ajax({
            url: "<?= base_url('admin/changeaccess'); ?>",
            type: 'post',
            data: {
                menuId: menuId,
                roleId: roleId
            },
            success: function() {
                document.location.href = "<?= base_url('admin/roleaccess/'); ?>" + roleId;
            }
        });
    });
</script>

<!-- JavaScript untuk Obat -->
<script>
    $('#example1 tbody').on('click', '.ubah_obat', function() {
        // Mengambil data
        let kode_obat = $(this).data("kode");

        // Mengambil modal
        let modal_ubah = $('#ubahModal');

        // Menjalankan ajax
        $.ajax({
            url: "http://localhost/kelompok-gas/sistem_cerdas/obat/retrieve",
            data: {
                kode_obat: "OB" + kode_obat
            },
            method: "post",
            dataType: "json",
            success: function(data) {
                modal_ubah.find('#kd_obt_ubah').val(data.kode_obat.substring(2));
                modal_ubah.find('#nama_bahan_ubah').val(data.nama_bahan_aktif);
                modal_ubah.find('#nama_dagang_ubah').val(data.nama_dagang);
            }
        });

    });

    $('#example1 tbody').on('click', '.hapus_obat', function() {
        // Mengambil data
        let kode_obat = $(this).data("kode");

        // Mengambil modal
        let modal_hapus = $('#hapusModal');

        // Menemukan tombol hapus
        let tombol_hapus = modal_hapus.find('#hapus_obat');

        // Mengisi meta data pada tombol hapus
        tombol_hapus.attr("data-kode", kode_obat);

    });

    $('#hapus_obat').on('click', function() {

        // Mengambil kode obat
        let kode_obat = 'OB' + $(this).attr('data-kode');

        // Menjalankan ajax
        $.ajax({
            url: "http://localhost/kelompok-gas/sistem_cerdas/obat/hapus",
            data: {
                kode_obat: kode_obat
            },
            method: "post",
            success: function() {
                window.location.href = "http://localhost/kelompok-gas/sistem_cerdas/obat/";
            }
        });

    });
</script>

<!-- JavaScript untuk Gejala -->
<script>
    $('#example1 tbody').on('click', '.ubah_gejala', function() {
        // Mengambil data
        let kode_gejala = $(this).data("kode");

        // Mengambil modal
        let modal_ubah = $('#ubahModal');

        // Menjalankan ajax
        $.ajax({
            url: "http://localhost/kelompok-gas/sistem_cerdas/gejala/retrieve",
            data: {
                kode_gejala: "GJ" + kode_gejala
            },
            method: "post",
            dataType: "json",
            success: function(data) {
                modal_ubah.find('#kd_gjl_ubah').val(data.kode_gejala.substring(2));
                modal_ubah.find('#gejala_ubah').val(data.gejala);
            }
        });

    });

    $('#example1 tbody').on('click', '.hapus_gejala', function() {
        // Mengambil data
        let kode_gejala = $(this).data("kode");

        // Mengambil modal
        let modal_hapus = $('#hapusModal');

        // Menemukan tombol hapus
        let tombol_hapus = modal_hapus.find('#hapus_gejala');

        // Mengisi meta data pada tombol hapus
        tombol_hapus.attr("data-kode", kode_gejala);

    });

    $('#hapus_gejala').on('click', function() {

        // Mengambil kode gejala
        let kode_gejala = 'GJ' + $(this).attr('data-kode');

        // Menjalankan ajax
        $.ajax({
            url: "http://localhost/kelompok-gas/sistem_cerdas/gejala/hapus",
            data: {
                kode_gejala: kode_gejala
            },
            method: "post",
            success: function() {
                window.location.href = "http://localhost/kelompok-gas/sistem_cerdas/gejala/";
            }
        });

    });
</script>

<!-- JavaScript untuk tabel aturan -->
<script>
    $('#example1 tbody').on('click', '.info_aturan', function() {

        // mengambil kode opt untuk rule
        var kodeOpt = $(this).data('jenis') + $(this).data('kode');

        // mengambil modal
        var modalInfo = $('#infoModal');

        // menjalankan ajax
        $.ajax({
            url: "http://localhost/kelompok-gas/sistem_cerdas/siscer/retrieve_rule",
            data: {
                kode_opt: kodeOpt
            },
            method: "post",
            dataType: "json",
            success: function(result) {
                modalInfo.find('#nama_opt').val(result.nama_opt);
                modalInfo.find('#nama_opt_inggris').val(result.nama_inggris);
                $('#list_gejala_opt').empty();
                for (var i = 0; i < result.gejala.length; i++) {
                    // Membuat elemen html
                    var li = document.createElement("li");
                    // Mengisi text elemen html
                    li.innerText = result.gejala[i];
                    // append elemen html ke parent
                    $('#list_gejala_opt').append(li);
                }
            }
        });

    });

    $('#example1 tbody').on('click', '.hapus_aturan', function() {

        // Mengambil kode
        var kodeOpt = $(this).data('jenis') + $(this).data('kode');

        // Memasang kode opt kedalam form
        $('#formHapusRule').find('#kode_opt').val(kodeOpt);

    });

    $('#example1 tbody').on('click', '.hapus_aturan_keputusan', function() {

        // Mengambil kode
        var kodeOpt = $(this).data('jenis') + $(this).data('kode');

        // Memasang kode opt kedalam form
        $('#formHapusRule').find('#kode_gejala').val(kodeOpt);

    });
</script>

<!-- JavaScript untuk tabel opt dalam modal -->
<script>
    $('#tableOpt tbody').on('click', '.tambah_opt', function() {

        //  mengambil form assign rule
        var formRule = $('#formAssignRule');

        // Mengisi form
        formRule.find('#opt_rule').val($(this).data("placeholder"));
        formRule.find('#kode_opt_rule').val($(this).data("jenis") + $(this).data("kode"));

        //  menutup modal
        $('#modalOpt').modal('hide');

    });
</script>

<!-- JavaScript untuk penambahan gejala kedalam opt -->
<script>
    $('#tableGejala tbody').on('click', '.tambah_gejala', function() {

        // Mengambil form assign rule
        var formRule = $('#formAssignRule');

        // Membuat elemen html
        var option = document.createElement("option");
        var optionValue = $(this).data("jenis") + $(this).data("kode");
        var optionText = $(this).data("placeholder");

        option.text = optionText;
        option.value = optionValue;
        option.setAttribute('selected', true);
        option.classList.add("remove_gejala");

        formRule.find('#gejala_opt').append(option);

        //  menutup modal
        $('#modalGejala').modal('hide');

    });

    $('#gejala_opt').select2({
        dropdownParent: $('#tambahModal .modal-body')
    });
</script>

<!-- JavaScript untuk penambahan obat kedalam opt -->
<script>
    $('#obat_opt').select2({
        dropdownParent: $('#tambahModal .modal-body')
    });

    $('#tableObat tbody').on('click', '.tambah_obat', function() {

        // Mengambil form assign rule
        var formRule = $('#formAssignRule');

        // Membuat elemen html
        var option = document.createElement("option");
        var optionValue = $(this).data("jenis") + $(this).data("kode");
        var optionText = $(this).data("placeholder");

        option.text = optionText;
        option.value = optionValue;
        option.setAttribute('selected', true);
        option.classList.add("remove_obat");

        formRule.find('#obat_opt').append(option);

        //  menutup modal
        $('#modalObat').modal('hide');

    });

    $('#example1 tbody').on('click', '.hapus_assign_obat', function() {

        // Mengambil kode
        var kodeOpt = $(this).data('jenis') + $(this).data('kode');

        // Memasang kode opt kedalam form
        $('#formHapusAssignObat').find('#kode_obat').val(kodeOpt);

    });
</script>

</body>

</html>
<!-- Content Wrapper Start -->
<div class="content-wrapper">
    <!-- Content Header (Start) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h3><?= $title; ?></h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="">Home</a></li>
                        <li class="breadcrumb-item">Organisme Pengganggu Tanaman</li>
                    </ol>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-12">
                    <button class="btn-sm btn-success p-2" data-target="#tambahModal" data-toggle="modal">
                        <i class="fas fa-fw fa-sm fa-plus"></i> Tambah Opt
                    </button>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-12">
                    <?php
                    if (validation_errors() == true) :
                    ?>
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <ul>
                                <?= validation_errors("<li><strong>", "</strong></li>"); ?>
                            </ul>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <?php
                    endif;
                    ?>
                    <?php
                    if ($this->session->flashdata('error_message')) :
                    ?>
                        <?php
                        if ($this->session->flashdata('error_message')['error_status'] == true) :
                        ?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong><?= $this->session->flashdata('error_message')['message']; ?></strong>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        <?php
                        else :
                        ?>
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong><?= $this->session->flashdata('error_message')['message']; ?></strong>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        <?php
                        endif;
                        ?>
                    <?php
                    endif;
                    ?>
                </div>
            </div>
        </div>
    </div>
    <!-- Content Header (End) -->
    <!-- Main Content (Start) -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <!-- Card (Start) -->
                    <div class="card">
                        <!-- Card Header (Start) -->
                        <div class="card-header">
                            <h2 class="card-title">Tabel Obat untuk Penyakit Tanaman Padi</h2>
                        </div>
                        <!-- Card Header (End) -->
                        <!-- Card Body (Start) -->
                        <div class="card-body">
                            <!-- Data Table (Start) -->
                            <table id="example1" class="table table-bordered table-striped">
                                <!-- Thead (Start) -->
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Nama OPT</th>
                                        <th>Nama Inggris</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <!-- Thead (End) -->
                                <!-- Tbody (Start) -->
                                <tbody>
                                    <?php
                                    $i = 1;
                                    foreach ($opt as $det_opt) :
                                    ?>
                                        <tr>
                                            <td><?= $i; ?></td>
                                            <td><?= $det_opt['nama_opt']; ?></td>
                                            <td><?= $det_opt['nama_inggris']; ?></td>
                                            <td class="d-flex justify-content-around">
                                                <button class="btn btn-sm btn-warning" id="edit" data-kode="<?= $det_opt['kode_opt']; ?>"">
                                                    <i class=" fas fa-fw fa-edit text-white"></i>
                                                </button>
                                                <button class="btn btn-sm btn-danger" data-kode="<?= $det_opt['kode_opt']; ?>" id="hapus" data-toggle="modal" data-target="#hapusModal">
                                                    <i class="fas fa-fw fa-trash-alt text-white"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    <?php
                                        $i++;
                                    endforeach;
                                    ?>
                                </tbody>
                                <!-- Tbody (End) -->
                            </table>
                            <!-- Data Table (End) -->
                        </div>
                        <!-- Card Body (End) -->
                    </div>
                    <!-- Card (End) -->
                </div>
            </div>
        </div>
    </div>
    <!-- Main Content (End) -->
</div>
<!-- Content Wrapper End -->

<!-- Modal Tambah Obat (Start) -->
<div class="modal fade" id="tambahModal">
    <!-- Modal Dialog (Start) -->
    <div class="modal-dialog">
        <!-- Modal Content (Start) -->
        <div class="modal-content">
            <!-- Modal Header (Start) -->
            <div class="modal-header">
                <h4 class="modal-title">Tambah Opt</h4>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!-- Modal Header (End) -->
            <!-- Modal Body (Start) -->
            <div class="modal-body">
                <form action="<?= base_url('opt/insert'); ?>" method="post">
                    <!-- Input Group (Start) -->
                    <div class="form-group">
                        <label for="nama_opt">Nama OPT</label>
                        <input type="text" name="nama_opt" id="nama_opt" class="form-control" placeholder="Isi Nama OPT disini">
                    </div>
                    <!-- Input Group (End) -->
                    <!-- Input Group (Start) -->
                    <div class="form-group">
                        <label for="nama_inggris">Nama Inggris</label>
                        <input type="text" name="nama_inggris" id="nama_inggris" class="form-control" placeholder="Isi Istilah Inggris untuk OPT disini">
                    </div>
                    <!-- Input Group (End) -->
                    <div class="row">
                        <div class="form-group col-3">
                            <input type="radio" name="kategori" id="" value="hama">
                            <label for="">Hama</label>
                        </div>
                        <div class="form-group col-3">
                            <input type="radio" name="kategori" id="" value="penyakit">
                            <label for="">Penyakit</label>
                        </div>
                        <div class="form-group col-3">
                            <input type="radio" name="kategori" id="" value="hara">
                            <label for="">Hara</label>
                        </div>
                    </div>
            </div>
            <!-- Modal Body (End) -->
            <!-- Modal Footer (Start) -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                </form>
            </div>
            <!-- Modal Footer (End) -->
        </div>
        <!-- Modal Content (End) -->
    </div>
    <!-- Modal Dialog (End) -->
</div>
<!-- Modal Tambah Obat (End) -->

<!-- Modal Ubah Obat (Start) -->
<div class="modal fade" id="ubahModal">
    <!-- Modal Dialog (Start) -->
    <div class="modal-dialog">
        <!-- Modal Content (Start) -->
        <div class="modal-content">
            <!-- Modal Header (Start) -->
            <div class="modal-header">
                <h4 class="modal-title">Ubah Opt</h4>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!-- Modal Header (End) -->
            <!-- Modal Body (Start) -->
            <div class="modal-body">
                <form action="<?= base_url('opt/ubah'); ?>" method="post">
                    <input type="hidden" name="kd_opt_ubah" id="kd_opt_ubah">
                    <!-- Input Group (Start) -->
                    <div class="form-group">
                        <label for="nama_opt">Nama OPT</label>
                        <input type="text" name="nama_opt_ubah" id="nama_opt_ubah" class="form-control" placeholder="">
                    </div>
                    <!-- Input Group (End) -->
                    <!-- Input Group (Start) -->
                    <div class="form-group">
                        <label for="nama_inggris">Nama Inggris</label>
                        <input type="text" name="nama_inggris_ubah" id="nama_inggris_ubah" class="form-control" placeholder="">
                    </div>
                    <!-- Input Group (End) -->
            </div>
            <!-- Modal Body (End) -->
            <!-- Modal Footer (Start) -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                </form>
            </div>
            <!-- Modal Footer (End) -->
        </div>
        <!-- Modal Content (End) -->
    </div>
    <!-- Modal Dialog (End) -->
</div>
<!-- Modal Ubah Obat (End) -->

<!-- Modal Hapus (Start) -->
<div class="modal fade" id="hapusModal">
    <!-- Modal Dialog (Start) -->
    <div class="modal-dialog modal-sm">
        <!-- Modal Content (Start) -->
        <div class="modal-content">
            <!-- Modal Header (Start) -->
            <div class="modal-header">
                <h4 class="modal-title">Hapus Opt</h4>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!-- Modal Header (End) -->
            <!-- Modal Body (Start) -->
            <div class="modal-body">
                <form action="<?= base_url('opt/hapus') ?>" method="post">
                    <input type="hidden" name="kode_hapus" id="kode_hapus">
                    <p>Apakah anda yakin akan menghapus data ini ?</p>
            </div>
            <!-- Modal Body (End) -->
            <!-- Modal Footer (Start) -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary btn-sm" id="hapus_opt">Hapus</button>
                </form>
            </div>
            <!-- Modal Footer (End) -->
        </div>
        <!-- Modal Content (End) -->
    </div>
    <!-- Modal Dialog (End) -->
</div>
<!-- Modal Hapus (End) -->

<script>
    $(document).ready(function() {
        $('#example1 tbody').on('click', '#hapus', function() {
            // Mengambil data
            let kode = $(this).data('kode');
            $('#kode_hapus').val(kode);
        });
        $('#example1 tbody ').on('click', '#edit', function() {
            $('#ubahModal').modal('show');
            var id = $(this).data('kode');
            console.log(id);
            $.ajax({
                url: "<?= base_url('opt') ?>/retrieve",
                dataType: "JSON",
                data: {
                    id: id
                },
                success: function(data) {
                    console.log(data);
                    $('#kd_opt_ubah').val(data['kode_opt']);
                    $('#nama_opt_ubah').val(data['nama_opt']);
                    $('#nama_inggris_ubah').val(data['nama_inggris']);

                }
            });
        })
    });
</script>
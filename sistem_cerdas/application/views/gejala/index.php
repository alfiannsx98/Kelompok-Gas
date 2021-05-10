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
                        <li class="breadcrumb-item">Gejala Penyakit</li>
                    </ol>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-12">
                    <button class="btn-sm btn-success p-2" data-target="#tambahModal" data-toggle="modal">
                        <i class="fas fa-fw fa-sm fa-plus"></i> Tambah Gejala
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
                            <h2 class="card-title">Tabel Gejala Penyakit Tanaman Padi</h2>
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
                                        <th>Gejala</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <!-- Thead (End) -->
                                <!-- Tbody (Start) -->
                                <tbody>
                                    <?php
                                    $i = 1;
                                    foreach ($gejala as $det_gejala) :
                                    ?>
                                        <tr>
                                            <td><?= $i; ?></td>
                                            <td><?= $det_gejala['gejala']; ?></td>
                                            <td class="d-flex justify-content-around">
                                                <?php
                                                $enc_kode_gejala = substr($det_gejala['kode_gejala'], 2);
                                                ?>
                                                <button class="btn btn-sm btn-warning ubah_gejala" data-kode="<?= $enc_kode_gejala; ?>" data-toggle="modal" data-target="#ubahModal">
                                                    <i class="fas fa-fw fa-edit text-white"></i>
                                                </button>
                                                <button class="btn btn-sm btn-danger hapus_gejala" data-kode="<?= $enc_kode_gejala; ?>" data-toggle="modal" data-target="#hapusModal">
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

<!-- Modal Tambah Gejala (Start) -->
<div class="modal fade" id="tambahModal">
    <!-- Modal Dialog (Start) -->
    <div class="modal-dialog">
        <!-- Modal Content (Start) -->
        <div class="modal-content">
            <!-- Modal Header (Start) -->
            <div class="modal-header">
                <h4 class="modal-title">Tambah Gejala</h4>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!-- Modal Header (End) -->
            <!-- Modal Body (Start) -->
            <div class="modal-body">
                <form action="<?= base_url('gejala/insert'); ?>" method="post">
                    <!-- Input Group (Start) -->
                    <div class="form-group">
                        <label for="gejala">Gejala Penyakit</label>
                        <textarea name="gejala" id="gejala" class="form-control" placeholder="Batang Terbakar" cols="30" rows="10"></textarea>
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
<!-- Modal Tambah Gejala (End) -->

<!-- Modal Ubah Gejala (Start) -->
<div class="modal fade" id="ubahModal">
    <!-- Modal Dialog (Start) -->
    <div class="modal-dialog">
        <!-- Modal Content (Start) -->
        <div class="modal-content">
            <!-- Modal Header (Start) -->
            <div class="modal-header">
                <h4 class="modal-title">Ubah Gejala</h4>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!-- Modal Header (End) -->
            <!-- Modal Body (Start) -->
            <div class="modal-body">
                <form action="<?= base_url('gejala/ubah'); ?>" method="post">
                    <input type="hidden" name="kd_gjl_ubah" id="kd_gjl_ubah" value="">
                    <!-- Input Group (Start) -->
                    <div class="form-group">
                        <label for="gejala">Gejala Penyakit</label>
                        <textarea name="gejala_ubah" id="gejala_ubah" class="form-control" placeholder="Batang Terbakar" cols="30" rows="10"></textarea>
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
<!-- Modal Ubah Gejala (End) -->

<!-- Modal Hapus (Start) -->
<div class="modal fade" id="hapusModal">
    <!-- Modal Dialog (Start) -->
    <div class="modal-dialog modal-sm">
        <!-- Modal Content (Start) -->
        <div class="modal-content">
            <!-- Modal Header (Start) -->
            <div class="modal-header">
                <h4 class="modal-title">Hapus Gejala</h4>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!-- Modal Header (End) -->
            <!-- Modal Body (Start) -->
            <div class="modal-body">
                <p>Apakah anda yakin akan menghapus data ini ?</p>
            </div>
            <!-- Modal Body (End) -->
            <!-- Modal Footer (Start) -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary btn-sm" id="hapus_gejala">Hapus</button>
            </div>
            <!-- Modal Footer (End) -->
        </div>
        <!-- Modal Content (End) -->
    </div>
    <!-- Modal Dialog (End) -->
</div>
<!-- Modal Hapus (End) -->
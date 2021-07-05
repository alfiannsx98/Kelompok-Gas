<!-- Content Wrapper Start -->
<div class="content-wrapper">
    <!-- Content Header Start -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h3><?= $title; ?></h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="">Home</a></li>
                        <li class="breadcrumb-item">Tabel Aturan</li>
                        <li class="breadcrumb-item"><?= $opt[0]['nama_opt']; ?></li>
                    </ol>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-12">
                    <button class="btn-sm btn-success p-2" data-target="#tambahModal" data-toggle="modal">
                        <i class="fas fa-fw fa-sm fa-plus"></i> Tambah Aturan
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
    <!-- Content Header End -->
    <!-- Main Content (Start) -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <!-- Card (Start) -->
                    <div class="card">
                        <!-- Card Header (Start) -->
                        <div class="card-header">
                            <h2 class="card-title">Tabel Aturan</h2>
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
                                        <th>Nama Gejala</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <!-- Thead (End) -->
                                <!-- Tbody (Start) -->
                                <tbody>
                                    <?php
                                    $i = 1;
                                    foreach ($gejala as $det_gejala) :
                                        foreach ($det_gejala as $det_inti_gejala) :
                                    ?>
                                            <tr>
                                                <td><?= $i; ?></td>
                                                <td><?= $det_inti_gejala['gejala']; ?></td>
                                                <td class="d-flex justify-content-around">
                                                    <button class="btn btn-sm btn-danger hapus_aturan_keputusan" data-jenis="<?= substr($det_inti_gejala['kode_gejala'], 0, 2); ?>" data-kode="<?= substr($det_inti_gejala['kode_gejala'], 2); ?>" data-toggle="modal" data-target="#hapusModal">
                                                        <i class="fas fa-fw fa-trash-alt text-white"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                    <?php
                                            $i++;
                                        endforeach;
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

<!-- Modal Tambah Aturan (Start) -->
<div class="modal fade" id="tambahModal" role="dialog">
    <!-- Modal Dialog (Start) -->
    <div class="modal-dialog">
        <!-- Modal Content (Start) -->
        <div class="modal-content">
            <!-- Modal Header (Start) -->
            <div class="modal-header">
                <h4 class="modal-title">Tambah Aturan</h4>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!-- Modal Header (End) -->
            <!-- Modal Body (Start) -->
            <div class="modal-body">
                <form action="<?= base_url('siscer/insert_rule_opt'); ?>" method="post" id="formAssignRule">
                    <input type="hidden" name="kode_opt" id="kode_opt_rule" value="<?= $opt[0]['kode_opt']; ?>">
                    <!-- Input Group (Start) -->
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label>Gejala OPT</label>
                                <br>
                                <button type="button" class="btn btn-success btn-md btn_tambah_gejala" data-target="#modalGejala" data-toggle="modal">
                                    <i class="fas fa-fw fa-plus text-white"></i> Tambah Gejala
                                </button>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="gejala_opt[]">Daftar Gejala</label>
                                <br>
                                <select name="gejala_opt[]" id="gejala_opt" multiple="multiple" class="form-control">
                                </select>
                            </div>
                        </div>
                    </div>
                    <!-- Input Group (End) -->
            </div>
            <!-- Modal Body (End) -->
            <!-- Modal Footer (Start) -->
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Tambah Aturan</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                </form>
            </div>
            <!-- Modal Footer (End) -->
        </div>
        <!-- Modal Content (End) -->
    </div>
    <!-- Modal Dialog (End) -->
</div>
<!-- Modal Tambah Aturan (End) -->

<!-- Modal Gejala (Start) -->
<div class="modal fade" id="modalGejala" role="dialog">
    <!-- Modal Dialog (Start) -->
    <div class="modal-dialog modal-lg">
        <!-- Modal Content (Start) -->
        <div class="modal-content">
            <!-- Modal Header (Start) -->
            <div class="modal-header">
                <h4 class="modal-title">Gejala Organisme Penyerang Tanaman</h4>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!-- Modal Header (End) -->
            <!-- Modal Body (Start) -->
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <!-- Card (Start) -->
                        <div class="card">
                            <!-- Card Header (Start) -->
                            <div class="card-header">
                                <h4 class="card-title">
                                    Tabel Gejala Organisme Penyerang Tanaman
                                </h4>
                            </div>
                            <!-- Card Header (End) -->
                            <!-- Card Body (Start) -->
                            <div class="card-body">
                                <!-- Data Table (Start) -->
                                <table id="tableGejala" class="table table-bordered table-striped">
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
                                        foreach ($gejala_tabel as $det_gejala) :
                                            $kode_gejala = substr($det_gejala['kode_gejala'], 0, 2);
                                        ?>
                                            <tr>
                                                <td><?= $i; ?></td>
                                                <td><?= $det_gejala['gejala']; ?></td>
                                                <td class="d-flex justify-content-around">
                                                    <?php
                                                    $enc_kode_gejala = substr($det_gejala['kode_gejala'], 2);
                                                    ?>
                                                    <button class="btn btn-sm btn-success tambah_gejala" data-kode="<?= $enc_kode_gejala; ?>" data-placeholder="<?= $det_gejala["gejala"]; ?>" data-jenis="<?= $kode_gejala; ?>">
                                                        <i class="fas fa-fw fa-plus text-white"></i>
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
            <!-- Modal Body (End) -->
        </div>
        <!-- Modal Content (End) -->
    </div>
    <!-- Modal Dialog (End) -->
</div>
<!-- Modal Gejala (End) -->


<!-- Modal Hapus (Start) -->
<div class="modal fade" id="hapusModal">
    <!-- Modal Dialog (Start) -->
    <div class="modal-dialog modal-sm">
        <!-- Modal Content (Start) -->
        <div class="modal-content">
            <!-- Modal Header (Start) -->
            <div class="modal-header">
                <h4 class="modal-title">Hapus Aturan</h4>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!-- Modal Header (End) -->
            <!-- Modal Body (Start) -->
            <div class="modal-body">
                <form action="<?= base_url('siscer/delete_rule_opt') ?>" method="post" id="formHapusRule">
                    <input type="hidden" name="kode_opt" id="kode_opt" value="<?= $opt[0]['kode_opt']; ?>">
                    <input type="hidden" name="kode_gejala" id="kode_gejala">
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
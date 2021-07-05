<!-- Content Wrapper -->
<div class="content-wrapper">
    <!-- Content Header -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h3><?= $title; ?></h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="">Home</a></li>
                        <li class="breadcrumb-item">Sistem Cerdas</li>
                    </ol>
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
    <!-- Main Content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <!-- Card -->
                    <div class="card col-6 mx-auto">
                        <!-- Card Header -->
                        <div class="card-header">
                            <div class="row">
                                <div class="col">
                                    <h4 class="card-title">
                                        Hasil Inferensi
                                    </h4>
                                </div>
                                <div class="col">
                                    <a href="<?= base_url('siscer'); ?>" class="btn bt-sm btn-primary float-right">Kembali</a>
                                </div>
                            </div>
                        </div>
                        <!-- Card Header (End) -->
                        <!-- Card Body -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <label for="nama_penyakit">Nama Penyakit</label>
                                    <input type="text" name="nama_penyakit" id="nama_penyakit" class="form-control" value="<?= $hasil_proses['nama_opt']; ?>" readonly>
                                </div>
                                <div class="col">
                                    <label for="nama_penyakit_inggris">Nama Penyakit (Bahasa Inggris)</label>
                                    <input type="text" name="nama_penyakit_inggris" id="nama_penyakit_inggris" class="form-control" value="<?= $hasil_proses['nama_inggris']; ?>" readonly>
                                </div>
                            </div>
                        </div>
                        <!-- Card Body (End) -->
                    </div>
                    <!-- Card End -->
                </div>
            </div>
        </div>
    </div>
    <!-- Main Content End -->
</div>
<!-- Content Wrapper End -->
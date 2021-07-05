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
                            <h4 class="card-title">
                                Daftar Gejala
                            </h4>
                        </div>
                        <!-- Card Header (End) -->
                        <!-- Card Body -->
                        <div class="card-body overflow-auto" style="height: 600px;">
                            <form action="<?= base_url('siscer/proses'); ?>" method="post" class="my-2">
                                <?php
                                foreach ($gejala as $dGejala) :
                                ?>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <input type="checkbox" aria-label="Checkbox for following text input" value="<?= $dGejala['kode_gejala']; ?>" name="gejala[]">
                                            </div>
                                        </div>
                                        <input type="text" class="form-control" aria-label="Text input with checkbox" value="<?= $dGejala['gejala']; ?>" readonly>
                                    </div>
                                <?php
                                endforeach;
                                ?>
                                <button type="submit" class="btn btn-lg btn-primary w-100">Submit</button>
                            </form>
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
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><?= $title; ?></h1>
                </div>
                <!-- <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">DataTables</li>
            </ol>
            </div> -->
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"><?= $title ?> Table <button data-toggle="modal" data-target="#newroleModal" class="btn btn-just-nama btn-round btn-success">Add Data <i class="fa fa-plus"></i></button></h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <?= $this->session->flashdata('message'); ?>
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>About</th>
                                    <th>Role</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($list_user as $index => $users) :
                                ?>
                                    <tr>
                                        <td><?= $index + 1; ?></td>
                                        <td><?= $users['nama']; ?></td>
                                        <td><?= $users['email']; ?></td>
                                        <td><?= $users['about']; ?></td>
                                        <td><?php if ($users['role_id'] == '1') {
                                                echo 'admin';
                                            } elseif ($users['role_id'] == '2') {
                                                echo 'operator';
                                            } ?>
                                        </td>
                                        <td><?php if ($users['is_active'] == '0') {
                                            ?>
                                                <span class="badge badge-danger">Non Aktif</span>
                                            <?php
                                            } elseif ($users['is_active'] == '1') {
                                            ?>
                                                <span class="badge badge-success">Aktif</span>
                                            <?php
                                            } ?>
                                        </td>
                                        <td>
                                            <div class="text-right">
                                                <button class="btn btn-info btn-xs btn-round" id="edit" data-id="<?= $users['id_user']; ?>">Edit</button>
                                                <button class="btn btn-secondary btn-xs btn-round" id="hapus" data-kode="<?= $users['id_user']; ?>" data-toggle="modal" data-target="#hapusModal">Hapus</button>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>About</th>
                                    <th>Role</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->


<!-- Akhir Pembatas -->

<!--MODAL DIALOG UNTUK CREATE DATA!-->
<div class="modal fade" id="newroleModal" tabindex="-1" role="dialog" aria-labelledby="newroleModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newroleModal">Create New Data</h5>
                </button>
            </div>
            <form action="<?= base_url('users/simpan'); ?>" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Gambar</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="gambar" name="gambar">
                            <label class="custom-file-label" for="inputGroupFile01">Pilih Gambar</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="">Nama</label>
                        <input type="text" class="form-control" name="nama" placeholder="Masukkan nama">
                    </div>
                    <div class="form-group">
                        <label for="">Email</label>
                        <input type="email" class="form-control" name="email" placeholder="Masukkan email">
                    </div>
                    <div class="form-group">
                        <label for="">Password</label>
                        <input type="password" class="form-control" name="password" placeholder="Masukkan password">
                    </div>
                    <div class="form-group">
                        <label for="">About</label>
                        <input type="text" class="form-control" name="about" placeholder="Masukkan Deskripsi user">
                    </div>
                    <div class="row">
                        <div class="form-group col-6">
                            <label for="">Role</label>
                            <select name="role" class="form-control">
                                <option value="">-- Pilih Role--</option>
                                <option value="1">Admin</option>
                                <option value="2">Operator</option>
                            </select>
                        </div>
                        <div class="form-group col-6">
                            <label for="">Status</label>
                            <select name="status" class="form-control">
                                <option value="">--Pilih Status--</option>
                                <option value="1">Aktif</option>
                                <option value=>Non Aktif</option>
                            </select>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-success">Simpan Data</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!--MODAL DIALOG UNTUK Update DATA!-->
<div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="newroleModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newroleModal">Update Data</h5>
                </button>
            </div>
            <form action="<?= base_url('users/update'); ?>" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="hidden" name="id_user" id="id_user">
                        <label for="">Gambar</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="gambar" name="gambar">
                            <label class="custom-file-label" for="inputGroupFile01">Pilih Gambar</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="">Nama</label>
                        <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan nama">
                    </div>
                    <div class="form-group">
                        <label for="">Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Masukkan email">
                    </div>
                    <div class="form-group">
                        <label for="">Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan password">
                    </div>
                    <div class="form-group">
                        <label for="">About</label>
                        <input type="text" class="form-control" id="about" name="about" placeholder="Masukkan Deskripsi user">
                    </div>
                    <div class="row">
                        <div class="form-group col-6">
                            <label for="">Role</label>
                            <select name="role" id="role" class="form-control">
                                <option value="">-- Pilih Role--</option>
                                <option value="1">Admin</option>
                                <option value="2">Operator</option>
                            </select>
                        </div>
                        <div class="form-group col-6">
                            <label for="">Status</label>
                            <select name="status" id="status" class="form-control">
                                <option value="">--Pilih Status--</option>
                                <option value="1">Aktif</option>
                                <option value="0">Non Aktif</option>
                            </select>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-success">Simpan Data</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal Hapus (Start) -->
<div class="modal fade" id="hapusModal">
    <!-- Modal Dialog (Start) -->
    <div class="modal-dialog modal-sm">
        <!-- Modal Content (Start) -->
        <div class="modal-content">
            <!-- Modal Header (Start) -->
            <div class="modal-header">
                <h4 class="modal-title">Hapus User</h4>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!-- Modal Header (End) -->
            <!-- Modal Body (Start) -->
            <form action="<?= base_url('users/hapus') ?>" method="post">
                <div class="modal-body">
                    <p>Apakah anda yakin untuk menghapus data ini ?</p>
                    <input type="hidden" name="id_hapus" id="id_hapus">
                </div>
                <!-- Modal Body (End) -->
                <!-- Modal Footer (Start) -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary btn-sm">Hapus</button>
                </div>
            </form>
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
            $('#id_hapus').val(kode);
        });
        $('#example1 tbody ').on('click', '#edit', function() {
            $('#updateModal').modal('show');
            var id = $(this).data('id');
            console.log(id);
            $.ajax({
                url: "<?= base_url('users') ?>/getuser",
                dataType: "JSON",
                data: {
                    id: id
                },
                success: function(data) {
                    $('#id_user').val(data['id_user']);
                    $('#nama').val(data['nama']);
                    $('#email').val(data['email']);
                    $('#about').val(data['about']);
                    $('#role').val(data['role_id']);
                    $('#status').val(data['is_active']);
                }
            });
        })
    });
</script>
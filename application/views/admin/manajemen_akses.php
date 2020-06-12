<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Manajemen Akses</h1>
    <div class="row">
        <div class="col-lg-6">
            <?=form_error('menu','<div class="alert alert-danger text-center" role="alert">','</div>');?>
            <?=$this->session->flashdata('message');?>
            <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#rolebaru">Tambah Role Baru</a>
            <!-- Awal tabel -->
            <table class="table table2 table-hover">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action Menu</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i=1;?>
                    <?php foreach($status_user as $s):?>
                    <tr>
                        <th scope="row"><?=$i;?></th>
                        <td><?=$s['status'];?></td>
                        <td>
                            <a data-target="#editrole" data-toggle="modal" href="" class="badge badge-success">
                                Edit</a>
                            <a data-target="#modal_hapus" data-toggle="modal" href=""
                                class="badge badge-danger">Hapus</a>
                            <a href="<?=base_url('admin/edit_akses/').$s['id'];?>" class="badge badge-secondary">Edit
                                Akses</a>
                        </td>
                    </tr>
                    <?php $i++; endforeach;?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="rolebaru" tabindex="-1" role="dialog" aria-labelledby="rolebaruTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="rolebaruTitle">Tambah Role Baru</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?=base_url('admin/tambah_role');?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" id="newrole" name="newrole"
                            placeholder="Masukan Nama Role Baru">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- ============ MODAL HAPUS BARANG =============== -->
<div class="modal fade" id="modal_hapus" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="myModalLabel">Hapus Role</h3>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
            </div>
            <form class="form-horizontal" method="post" action="<?=base_url('admin/hapus_akses')?>">
                <div class="modal-body">
                    <p>Anda yakin mau menghapus <b><?= $s['status'];?></b></p>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="id_status" value="<?= $s['id'];?>">
                    <button class="btn" data-dismiss="modal" aria-hidden="true">Tutup</button>
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!--END MODAL HAPUS BARANG-->
<!-- Modal Edit -->
<div class="modal fade" id="editrole" tabindex="-1" role="dialog" aria-labelledby="editroleTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editroleTitle">Edit Role</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?=base_url('admin/edit_nama_role');?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="hidden" name="id_status" value="<?=$s['id'];?>">
                        <input type="text" class="form-control" id="newstatusname" name="newstatusname"
                            placeholder="<?=$s['status'];?>">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

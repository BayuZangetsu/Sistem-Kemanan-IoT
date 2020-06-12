<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Manajemen Menu</h1>
    <div class="row">
        <div class="col-lg-6">
            <?=form_error('menu','<div class="alert alert-danger text-center" role="alert">','</div>');?>
            <?=$this->session->flashdata('message');?>
            <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#menubaru">Tambah Menu Baru</a>
            <table class="table table2 table-hover">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Menu</th>
                        <th scope="col">Action Menu</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i=1;?>
                    <?php foreach($menu as $m):?>
                    <tr>
                        <th scope="row"><?=$i;?></th>
                        <td><?=$m['menu'];?></td>
                        <td>
                            <a href="" class="badge badge-success">Edit Menu</a>
                            <a href="" class="badge badge-danger">Hapus Menu</a>
                        </td>
                    </tr>
                    <?php $i++; endforeach;?>
                </tbody>
            </table>
        </div>
        <div class="col-lg-6">
            <div class="card border-left-danger">
                <div class="card mt-3">
                    <h5 class="text-uppercase text-center text-danger"><strong>perhatian !</strong></h5>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="menubaru" tabindex="-1" role="dialog" aria-labelledby="menubaruTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="menubaruTitle">Tambah Menu Baru</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?=base_url('menu');?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" id="newmenu" name="newmenu"
                            placeholder="Masukan Nama Menu Baru">
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

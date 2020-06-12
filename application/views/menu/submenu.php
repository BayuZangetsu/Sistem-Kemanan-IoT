<link rel="stylesheet" href="<?base_url('assets/');?>css/datatables.css">
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Manajemen Menu</h1>
    <div class="row">
        <div class="col">
            <?php if(validation_errors()):?>
            <div class="alert alert-danger text-center" role="alert"><?=validation_errors();?></div>
            <?php endif;?>
            <?=$this->session->flashdata('message','<div class="alert alert-success text-center" role="alert">','</div>');?>
            <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#submenubaru">Tambah Sub Menu
                Baru</a>
            <table class="table table2 table-striped table-bordered">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <!-- judul -->
                        <th scope="col">Nama Submenu</th>
                        <!--menu id  -->
                        <th scope="col">Bagian Dari</th>
                        <!-- url -->
                        <th scope="col">Url Halaman</th>
                        <!-- icon -->
                        <th scope="col">Icon</th>
                        <!-- active -->
                        <th scope="col">Status</th>
                        <!-- aksi -->
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i=1;?>
                    <?php foreach($menu as $m):?>
                    <tr>
                        <th scope="row"><?=$i;?></th>
                        <td><?=$m['judul'];?></td>
                        <td><?=$m['menu'];?></td>
                        <td><?=$m['url'];?></td>
                        <td>
                            <i class="<?=$m['icon'];?>">
                            </i>
                        </td>
                        <?php if($m['is_active']==1):?>
                        <!-- <td><?=$m['is_active'];?></td> -->
                        <td style="color:white"><a class="badge badge-primary">Aktif</a></td>
                        <?php else :?>
                        <td style="color:red"><a class="badge badge-secondary">Nonaktif</a></td>
                        <?php endif;?>
                        <td>
                            <a href="" class="badge badge-success">Edit Menu</a>
                            <a href="" class="badge badge-danger">Hapus Menu</a>
                        </td>
                    </tr>
                    <?php $i++; endforeach;?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="submenubaru" tabindex="-1" role="dialog" aria-labelledby="submenubaruTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="submenubaruTitle">Tambah Sub Menu Baru</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?=base_url('menu/submenu');?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" id="title" name="title"
                            placeholder="Masukan Nama Submenu Baru">
                    </div>
                    <div class="form-group">
                        <select name="menu_id" id="menu_id" class="form-control">
                            <option value="">Pilih Menu</option>
                            <?php foreach($jenisMenu as $jm): ?>
                            <option value="<?=$jm['id'];?>"><?=$jm['menu'];?></option>
                            <?php endforeach;?>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="urlsub" name="urlsub"
                            placeholder="Masukan url untuk submenu">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="iconsub" name="iconsub"
                            placeholder="Masukan icon untuk submenu (fontawesom.com)">
                    </div>
                    <div class="form-group">
                        <div class="form-check">
                            <input type="checkbox" value="1" name="is_active" class="form-check-input" id="is_active">
                            <label for="is_active" class="form-check-label">Is active ?</label>
                        </div>
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

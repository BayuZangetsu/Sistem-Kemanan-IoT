<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Manajemen Akses Menu</h1>
    <h5>Status Yang Akan Di Edit : <b><?=$status['status'];?></b></h5>
    <div class="row">
        <div class="col-lg-6">
            <?=form_error('menu','<div class="alert alert-danger text-center" role="alert">','</div>');?>
            <?=$this->session->flashdata('message');?>
            <!-- Awal tabel -->
            <table class="table table2 table-hover">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Menu</th>
                        <th scope="col">Akses</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i=1;?>
                    <?php foreach($menu as $s):?>
                    <tr>
                        <th scope="row"><?=$i;?></th>
                        <td><?=$s['menu'];?></td>
                        <td>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input cekinput"
                                    <?=cek_akses($status['id'] , $s['id']);?> data-status="<?=$status['id'];?>"
                                    data-menu="<?=$s['id'];?>">
                            </div>
                        </td>
                    </tr>
                    <?php $i++; endforeach;?>
                </tbody>
            </table>
        </div>
    </div>
</div>

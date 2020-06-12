$(document).ready(function() {
    $('.form-check-input').on('click', function() {
        const menuId = $(this).data('menu');
        const statusId = $(this).data('status');
        $.ajax({
            url: "<?=base_url('admin/ubah_akses');?>",
            type: 'post',
            data: {
                menuId: menuId,
                statusId: statusId
            },
            success: function() {
                document.location.href = "<?=base_url('admin/edit_akses/');?>" + statusId;
            }
        });
    });
    $(document).on('click', '.editbtn', function() {
        var id_user = $(this).attr("id");
        $.ajax({
            url: "<?=base_url('admin/edit_akun');?>",
            method: 'POST',
            data: {
                id: id_user
            },
            dataType: 'JSON',
            success: function(data) {
                $('#formnama').val(data.nama);
                $('#formalamat').val(data.alamat);
                $('body').append(data);
                $('#editprofile').modal('show');
            }
        });
    });
});

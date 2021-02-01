var QuanlyUserFeeship_ajax = {
    init: function () {
        QuanlyUserFeeship_ajax.registerEvent();
    },
    registerEvent: function () {
    	
    },
    resetFormFee: function(){
    	$('#CreateAndEditFee').modal('show');
        $('.modal-title').text('Thêm mới');   
        $('#hiddenidfee').val('0');
        $('#id').prop('selectedIndex',0);
        $('#f_u_status').prop('selectedIndex',0);
        $('#fee_matp_user').prop('selectedIndex',0);
        $('#fee_matp_user').prop('selectedIndex',0);
        $('#fee_maquanhuyen_user').prop('selectedIndex',0);
        $('#f_u_address_user').val('');
    },
    getDataFee: function (url) {
        $('#CreateAndEditFee').modal('show');
        $('.modal-title').text('Sửa dữ liệu');
        $.ajax({
            url: url,
            type: 'GET',
            dataType: 'json',
            success: function (response) {
                console.log(response.datas);
                var data = response.datas;
                $('#id').val(data.f_u_user_id);
                $('#f_u_address_user').val(data.f_u_address);
                $('#f_u_status').val(data.f_u_status);
                $('#fee_matp_user').val(data.Feeship.fee_matp);
                $('#fee_maquanhuyen_user').val(data.Feeship.fee_maquanhuyen);
                $('#fee_maxaphuong_user').val(data.Feeship.fee_maxaphuong);
                $('#hiddenid').val(data.id);
            },
            error: function (err) {
                alert('Khong thuc hien duoc');
            }
        });
    },
}
QuanlyUserFeeship_ajax.init();
var Quanlyfeeship_ajax = {
    init: function () {
        Quanlyfeeship_ajax.registerEvent();
    },
    registerEvent: function () {
        $('.js_add_item').off('click').on('click', function (event){
            event.preventDefault();
            $('#CreateAndEdit').modal('show');
            $('.modal-title').text('Thêm mới');
            Quanlyfeeship_ajax.resetForm();
        });
        $('.styling-edit').off('click').on('click', function (event) {
            event.preventDefault();
            $('#CreateAndEdit').modal('show');
            $('.modal-title').text('Sửa dữ liệu');
             let url = $(this).attr('href');
            Quanlyfeeship_ajax.getData(url);
           
            
        });
        $('.styling-delete').off('click').on('click', function (event) {
            event.preventDefault();
            let url = $(this).attr('href');
            var cf = confirm('Bạn chắc chắn muốn xóa không?');
            if (cf) {
                Quanlyfeeship_ajax.deleteData(url);
            }
        });
        $('.pagination a').off('click').on('click',function(event){
            event.preventDefault();
            $('.pagination li').removeClass('active');
            $(this).parent('li').addClass('active');
            var myurl = $(this).attr('href');
            var name_search = $('#name_search').val();
            var id = $('#categoryselect').val();
            var page =$(this).attr('href').split('page=')[1];
            Quanlyfeeship_ajax.pagin(page,id,name_search);

        });
        $('#btnSave').on('submit', function (event) {
            event.preventDefault();
            // var data = $('#js_send_data')[0];
            Quanlyfeeship_ajax.saveData($(this)[0]);
        });
        $('.change_status').off('click').on('click',function(event){
            event.preventDefault();
            let url = $(this).attr('href');
            let status = $(this).data('id');
            var cf = confirm('Bạn chắc chắn muốn thay đổi trạng thái không?');
            if (cf) {
                Quanlyfeeship_ajax.change_status(url,status);
            }
            
        });
    },
    loadData: function (id) {
        // var search = $('#txtNameS').val();
        $.ajax({
            url: '/admin/feeship/load-data',
            type: 'GET',
            dataType: 'html',
            data: { 
                id:id,             
            },
            success: function (data) {
                // console.log(data);
                $('#reder_data').html(data);
                Quanlyfeeship_ajax.registerEvent();
                
            }
        });
    },
    pagin:function(page,id) {
        $.ajax({
            type: "GET",
            url: '/admin/feeship/load-data?page='+ page,
            dataType: 'html',
            data: { 
                id:id,              
            },
        })
        .success(function(data) {
           $('#reder_data').html(data);
                Quanlyfeeship_ajax.registerEvent(); 
        });
        
    },
    resetForm: function () {
        $('#fee_id').val('');
        $('#fee_matp').prop('selectedIndex',0);
        $('#fee_maquanhuyen').prop('selectedIndex',0);
        $('#fee_maxaphuong').prop('selectedIndex',0);
        $('#fee_ship').val('');
    },
    saveData: function (form_data) {
        var formData = new FormData(form_data);
            // for (var key of formData.entries()) {
            //     console.log(key[0] + ', ' + key[1]);
            // }
            $.ajax({
            url: '/admin/feeship/save',
            type: 'POST',
            datatype: 'json',
            data: formData,
            contentType : false,
            processData : false,
            cache : false,
            success: function (response) {
                if (response.success) {
                    $('#CreateAndEdit').modal('hide');
                    Quanlyfeeship_ajax.loadData(null);
                }
                else {
                    alert(response.ms);
                }
            },
            error: function (err) {
                var errors = JSON.parse(err.responseText);
                if(errors.errors.fee_matp != '') {
                    $('.errorfee_matp').toggleClass('show');
                    $('.errorfee_matp').text(errors.errors.fee_matp);
                } 
                if(errors.errors.fee_maquanhuyen != '') {
                    $('.errorfee_maquanhuyen').toggleClass('show');
                    $('.errorfee_maquanhuyen').text(errors.errors.fee_maquanhuyen);
                } 
                if(errors.errors.fee_maxaphuong != '') {
                    $('.errorfee_maxaphuong').toggleClass('show');
                    $('.errorfee_maxaphuong').text(errors.errors.fee_maxaphuong);
                } 
                if(errors.errors.fee_ship != '') {
                    $('.errorfee_ship').toggleClass('show');
                    $('.errorfee_ship').text(errors.errors.fee_ship);
                }  
            }
        });
    },
    getData: function (url) {
        $.ajax({
            url: url,
            type: 'GET',
            dataType: 'json',
            success: function (response) {
                // console.log(response.datas);
                var data = response.datas;
                $('#fee_ship').val(data.fee_ship);
                $('#fee_maxaphuong').val(data.fee_maxaphuong);
                $('#fee_maquanhuyen').val(data.fee_maquanhuyen);
                $('#fee_matp').val(data.fee_matp);
                $('#fee_id').val(data.fee_id);
            },
            error: function (err) {
                alert('Khong thuc hien duoc');
            }
        });
    },
    deleteData: function(url) {
        $.ajax({
            url: url,
            type: 'GET',
            dataType: 'json',
            success: function (response) {
                if (response.success) {
                    Quanlyfeeship_ajax.loadData(null,null);
                }
                else {
                    alert(response.ms);
                }
            },
            error: function (err) {
                alert('Khong thuc hien duoc');
            }
        });
    },
    change_status: function(url,status) {
        $.ajax({
            url: url,
            type: 'GET',
            dataType: 'json',
            data:{
                status:status
            },
            success: function (response) {
                if (response.success) {
                    Quanlyfeeship_ajax.loadData(null,null);
                }
                else {
                    alert(response.ms);
                }
            },
            error: function (err) {
                alert('Khong thuc hien duoc');
            }
        });
    }
}
Quanlyfeeship_ajax.init();
var Quanlyprovider_ajax = {
    init: function () {
        Quanlyprovider_ajax.registerEvent();
    },
    registerEvent: function () {
    	$('#name_search').off('keypress').on('keypress', function (e) {
            if (e.which == 13) {
            	var name_search = $(this).val();
                Quanlyprovider_ajax.loadData(name_search);
            }
        });
        $('#btnSearchSS').off('click').on('click', function (event) {
        	event.preventDefault();
            var name_search = $('#name_search').val();
            Quanlyprovider_ajax.loadData(name_search);
        });
        $('.js_add_item').off('click').on('click', function (event){
        	event.preventDefault();
        	$('#CreateAndEdit').modal('show');
            $('.modal-title').text('Thêm mới');
        	Quanlyprovider_ajax.resetForm();
        });
        $('.styling-edit').off('click').on('click', function (event) {
            event.preventDefault();
            $('#CreateAndEdit').modal('show');
            $('.modal-title').text('Sửa dữ liệu');
             let url = $(this).attr('href');
            Quanlyprovider_ajax.getData(url);
           
            
        });
        $('.styling-delete').off('click').on('click', function (event) {
            event.preventDefault();
            let url = $(this).attr('href');
            var cf = confirm('Bạn chắc chắn muốn xóa không?');
            if (cf) {
                Quanlyprovider_ajax.deleteData(url);
            }
        });
        $('.pagination a').off('click').on('click',function(event){
            event.preventDefault();
            $('.pagination li').removeClass('active');
            $(this).parent('li').addClass('active');
            var myurl = $(this).attr('href');
            var name_search = $('#name_search').val();
            var page =$(this).attr('href').split('page=')[1];
            console.log(page);
            Quanlyprovider_ajax.pagin(page,name_search);

        });
        $('#btnSave').on('submit', function (event) {
            event.preventDefault();
            // var data = $('#js_send_data')[0];
            Quanlyprovider_ajax.saveData($(this)[0]);
        });
        $('.change_status').off('click').on('click',function(event){
            event.preventDefault();
            let url = $(this).attr('href');
            let status = $(this).data('id');
            var cf = confirm('Bạn chắc chắn muốn thay đổi trạng thái không?');
            if (cf) {
                Quanlyprovider_ajax.change_status(url,status);
            }
            
        });
    },
    loadData: function (name_search) {
        // var search = $('#txtNameS').val();
        $.ajax({
            url: '/admin/provider/load-data',
            type: 'GET',
            dataType: 'html',
            data: {            
                name_search: name_search  
            },
            success: function (data) {
                // console.log(data);
                $('#reder_data').html(data);
                Quanlyprovider_ajax.registerEvent();
                
            }
        });
    },
    pagin:function(page,name_search) {
        $.ajax({
           type: "GET",
           url: '/admin/provider/load-data?page='+ page,
           dataType: 'html',
           data: {            
                name_search: name_search  
            },
        })
        .success(function(data) {
           $('#reder_data').html(data);
                Quanlyprovider_ajax.registerEvent(); 
        });
        
    },
    resetForm: function () {
        $('#provider_id').val('');
        $('#provider_name').val('');
        $('#provider_address').val('');
        $('#provider_email').val('');
        $('#provider_status').prop('selectedIndex',0);
        $('#provider_phone').val('');
    },
    saveData: function (form_data) {
        var formData = new FormData(form_data);
            // for (var key of formData.entries()) {
            //     console.log(key[0] + ', ' + key[1]);
            // }
            $.ajax({
            url: '/admin/provider/save',
            type: 'POST',
            datatype: 'json',
            data: formData,
            contentType : false,
            processData : false,
            cache : false,
            success: function (response) {
                if (response.success) {
                    $('#CreateAndEdit').modal('hide');
                    Quanlyprovider_ajax.loadData(null);
                }
                else {
                    alert(response.ms);
                }
            },
            error: function (err) {
                var errors = JSON.parse(err.responseText);
                if(errors.errors.provider_name != '') {
                    $('.errorprovider_name').toggleClass('show');
                    $('.errorprovider_name').text(errors.errors.provider_name);
                } 
                if(errors.errors.provider_address != '') {
                    $('.errorprovider_address').toggleClass('show');
                    $('.errorprovider_address').text(errors.errors.provider_address);
                } 
                if(errors.errors.provider_email != '') {
                    $('.errorprovider_email').toggleClass('show');
                    $('.errorprovider_email').text(errors.errors.provider_email);
                } 
                if(errors.errors.provider_phone != '') {
                    $('.errorprovider_phone').toggleClass('show');
                    $('.errorprovider_phone').text(errors.errors.provider_phone);
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
                $('#provider_name').val(data.provider_name);
                $('#provider_address').val(data.provider_address);
                $('#provider_email').val(data.provider_email);
                $('#provider_phone').val(data.provider_phone);
                $('#provider_status').val(data.provider_status);
                $('#provider_id').val(data.provider_id);
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
                    Quanlyprovider_ajax.loadData(null);
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
                    Quanlyprovider_ajax.loadData(null);
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
Quanlyprovider_ajax.init();
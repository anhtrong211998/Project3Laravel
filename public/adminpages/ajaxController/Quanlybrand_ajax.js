var Quanlybrand_ajax = {
    init: function () {
        Quanlybrand_ajax.registerEvent();
    },
    registerEvent: function () {
    	$('#name_search').off('keypress').on('keypress', function (e) {
            if (e.which == 13) {
            	var name_search = $(this).val();
                Quanlybrand_ajax.loadData(name_search);
            }
        });
        $('#btnSearchSS').off('click').on('click', function (event) {
        	event.preventDefault();
            var name_search = $('#name_search').val();
            Quanlybrand_ajax.loadData(name_search);
        });
        $('.js_add_item').off('click').on('click', function (event){
        	event.preventDefault();
        	$('#CreateAndEdit').modal('show');
            $('.modal-title').text('Thêm mới');
        	Quanlybrand_ajax.resetForm();
        });
        $('.styling-edit').off('click').on('click', function (event) {
            event.preventDefault();
            $('#CreateAndEdit').modal('show');
            $('.modal-title').text('Sửa dữ liệu');
             let url = $(this).attr('href');
            Quanlybrand_ajax.getData(url);
           
            
        });
        $('.styling-delete').off('click').on('click', function (event) {
            event.preventDefault();
            let url = $(this).attr('href');
            var cf = confirm('Bạn chắc chắn muốn xóa không?');
            if (cf) {
                Quanlybrand_ajax.deleteData(url);
            }
        });
        $('.pagination a').off('click').on('click',function(event){
            event.preventDefault();
            $('.pagination li').removeClass('active');
            $(this).parent('li').addClass('active');
            var myurl = $(this).attr('href');
            var name_search = $('#name_search').val();
            var page =$(this).attr('href').split('page=')[1];
            Quanlybrand_ajax.pagin(page,name_search);

        });
        $('#btnSave').on('submit', function (event) {
            event.preventDefault();
            // var data = $('#js_send_data')[0];
            Quanlybrand_ajax.saveData($(this)[0]);
        });
        // $("#categoryselect").change(function(){
        //     var id = $(this).val();
        //     var name_search = $('#name_search').val();
        //     Quanlybrand_ajax.loadData(name_search);
        // });
        $('.change_status').off('click').on('click',function(event){
            event.preventDefault();
            let url = $(this).attr('href');
            let status = $(this).data('id');
            var cf = confirm('Bạn chắc chắn muốn thay đổi trạng thái không?');
            if (cf) {
                Quanlybrand_ajax.change_status(url,status);
            }
            
        });
    },
    loadData: function (name_search) {
        // var search = $('#txtNameS').val();
        $.ajax({
            url: '/admin/brand/load-data',
            type: 'GET',
            dataType: 'html',
            data: {            
                name_search: name_search  
            },
            success: function (data) {
                // console.log(data);
                $('#reder_data').html(data);
                Quanlybrand_ajax.registerEvent();
                
            }
        });
    },
    pagin:function(page,name_search) {
        $.ajax({
           type: "GET",
           url: '/admin/brand/load-data?page='+ page,
           dataType: 'html',
           data: {            
                name_search: name_search  
            },
        })
        .success(function(data) {
           $('#reder_data').html(data);
                Quanlybrand_ajax.registerEvent(); 
        });
        
    },
    resetForm: function () {
        $('#brand_id').val('');
        $('#brand_name').val('');
        $('#brand_status').prop('selectedIndex',0);
    },
    saveData: function (form_data) {
        var formData = new FormData(form_data);
            // for (var key of formData.entries()) {
            //     console.log(key[0] + ', ' + key[1]);
            // }
            $.ajax({
            url: '/admin/brand/save',
            type: 'POST',
            datatype: 'json',
            data: formData,
            contentType : false,
            processData : false,
            cache : false,
            success: function (response) {
                if (response.success) {
                    $('#CreateAndEdit').modal('hide');
                    Quanlybrand_ajax.loadData(null);
                }
                else {
                    alert(response.ms);
                }
            },
            error: function (err) {
                var errors = JSON.parse(err.responseText);
                if(errors.errors.brand_name != '') {
                    $('.errorbrand_name').toggleClass('show');
                    $('.errorbrand_name').text(errors.errors.brand_name);
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
                $('#brand_name').val(data.brand_name);
                $('#brand_status').val(data.brand_status);
                $('#brand_id').val(data.brand_id);
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
                    Quanlybrand_ajax.loadData(null);
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
                    Quanlybrand_ajax.loadData(null);
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
Quanlybrand_ajax.init();
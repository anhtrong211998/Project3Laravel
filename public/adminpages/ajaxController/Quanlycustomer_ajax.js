var Quanlycustomer_ajax = {
    init: function () {
        Quanlycustomer_ajax.registerEvent();
    },
    registerEvent: function () {
    	$('#name_search').off('keypress').on('keypress', function (e) {
            if (e.which == 13) {
            	var name_search = $(this).val();
                Quanlycustomer_ajax.loadData(name_search);
            }
        });
        $('#btnSearchSS').off('click').on('click', function (event) {
        	event.preventDefault();
            var name_search = $('#name_search').val();
            Quanlycustomer_ajax.loadData(name_search);
        });
        $('.js_add_item').off('click').on('click', function (event){
        	event.preventDefault();
        	$('#CreateAndEdit').modal('show');
            $('.modal-title').text('Thêm mới');
        	Quanlycustomer_ajax.resetForm();
        });
        $('.styling-edit').off('click').on('click', function (event) {
            event.preventDefault();
            $('#CreateAndEdit').modal('show');
            $('.modal-title').text('Sửa dữ liệu');
             let url = $(this).attr('href');
            Quanlycustomer_ajax.getData(url);
           
            
        });
        $('.styling-delete').off('click').on('click', function (event) {
            event.preventDefault();
            let url = $(this).attr('href');
            var cf = confirm('Bạn chắc chắn muốn xóa không?');
            if (cf) {
                Quanlycustomer_ajax.deleteData(url);
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
            Quanlycustomer_ajax.pagin(page,name_search);

        });
        $('#btnSave').on('submit', function (event) {
            event.preventDefault();
            // var data = $('#js_send_data')[0];
            Quanlycustomer_ajax.saveData(this);
        });
    },
    loadData: function (name_search) {
        // var search = $('#txtNameS').val();
        $.ajax({
            url: '/admin/customer/load-data',
            type: 'GET',
            dataType: 'html',
            data: {            
                name_search: name_search  
            },
            success: function (data) {
                // console.log(data);
                $('#reder_data').html(data);
                Quanlycustomer_ajax.registerEvent();
                
            }
        });
    },
    pagin:function(page,name_search) {
        $.ajax({
           	type: "GET",
           	url: '/admin/customer/load-data?page='+ page,
           	dataType: 'html',
           	data: {            
                name_search: name_search  
            },
        })
        .success(function(data) {
           	$('#reder_data').html(data);
            Quanlycustomer_ajax.registerEvent(); 
        });
        
    },
    resetForm: function () {
        $('#customer_id').val('');
        $('#customer_name').val('');
        $('#customer_email').val('');
        $('#customer_phone').val('');
        $('#customer_address').val('');
    },
    saveData: function (form_data) {
        var formData = new FormData(form_data);
            // for (var key of formData.entries()) {
            //     console.log(key[0] + ', ' + key[1]);
            // }
            $.ajax({
            url: '/admin/customer/save',
            type: 'POST',
            datatype: 'json',
            data: formData,
            contentType : false,
            processData : false,
            cache : false,
            success: function (response) {
                if (response.success) {
                    $('#CreateAndEdit').modal('hide');
                    Quanlycustomer_ajax.loadData(null);
                }
                else {
                    alert(response.ms);
                }
            },
            error: function (err) {
                var errors = JSON.parse(err.responseText);
                if(errors.errors.customer_name != '') {
                    $('.errorcustomer_name').toggleClass('show');
                    $('.errorcustomer_name').text(errors.errors.customer_name);
                } 
                if(errors.errors.customer_email != '') {
                    $('.errorcustomer_email').toggleClass('show');
                    $('.errorcustomer_email').text(errors.errors.customer_email);
                } 
                if(errors.errors.customer_phone != '') {
                    $('.errorcustomer_phone').toggleClass('show');
                    $('.errorcustomer_phone').text(errors.errors.customer_phone);
                } 
                if(errors.errors.customer_address != '') {
                    $('.errorcustomer_address').toggleClass('show');
                    $('.errorcustomer_address').text(errors.errors.customer_address);
                } 
                // Quanlycustomer_ajax.registerEvent(); 
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
                $('#customer_name').val(data.customer_name);
                $('#customer_email').val(data.customer_email);
                $('#customer_phone').val(data.customer_phone);
                $('#customer_address').val(data.customer_address);
                $('#customer_id').val(data.customer_id);
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
                    Quanlycustomer_ajax.loadData(null);
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
Quanlycustomer_ajax.init();
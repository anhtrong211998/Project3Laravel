var Quanlycoupon_ajax = {
    init: function () {
        Quanlycoupon_ajax.registerEvent();
    },
    registerEvent: function () {
    	$('#name_search').off('keypress').on('keypress', function (e) {
            if (e.which == 13) {
            	var name_search = $(this).val();
                Quanlycoupon_ajax.loadData(name_search);
            }
        });
        $('#btnSearchSS').off('click').on('click', function (event) {
        	event.preventDefault();
            var name_search = $('#name_search').val();
            Quanlycoupon_ajax.loadData(name_search);
        });
        $('.js_add_item').off('click').on('click', function (event){
        	event.preventDefault();
        	$('#CreateAndEdit').modal('show');
            $('.modal-title').text('Thêm mới');
        	Quanlycoupon_ajax.resetForm();
        });
        $('.styling-edit').off('click').on('click', function (event) {
            event.preventDefault();
            $('#CreateAndEdit').modal('show');
            $('.modal-title').text('Sửa dữ liệu');
             let url = $(this).attr('href');
            Quanlycoupon_ajax.getData(url);
           
            
        });
        $('.styling-delete').off('click').on('click', function (event) {
            event.preventDefault();
            let url = $(this).attr('href');
            var cf = confirm('Bạn chắc chắn muốn xóa không?');
            if (cf) {
                Quanlycoupon_ajax.deleteData(url);
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
            Quanlycoupon_ajax.pagin(page,name_search);

        });
        $('#btnSave').on('submit', function (event) {
            event.preventDefault();
            // var data = $('#js_send_data')[0];
            Quanlycoupon_ajax.saveData($(this)[0]);
        });
    },
    loadData: function (name_search) {
        // var search = $('#txtNameS').val();
        $.ajax({
            url: '/admin/coupon/load-data',
            type: 'GET',
            dataType: 'html',
            data: {            
                name_search: name_search  
            },
            success: function (data) {
                // console.log(data);
                $('#reder_data').html(data);
                Quanlycoupon_ajax.registerEvent();
                
            }
        });
    },
    pagin:function(page,name_search) {
        $.ajax({
           	type: "GET",
           	url: '/admin/coupon/load-data?page='+ page,
           	dataType: 'html',
           	data: {            
                name_search: name_search  
            },
        })
        .success(function(data) {
           	$('#reder_data').html(data);
            Quanlycoupon_ajax.registerEvent(); 
        });
        
    },
    resetForm: function () {
        $('#coupon_id').val('');
        $('#coupon_name').val('');
        $('#coupon_code').val('');
        $('#coupon_time').val('');
        $('#coupon_condition').prop('selectedIndex',0);
        $('#coupon_number').val('');
    },
    saveData: function (form_data) {
        var formData = new FormData(form_data);
            // for (var key of formData.entries()) {
            //     console.log(key[0] + ', ' + key[1]);
            // }
            $.ajax({
            url: '/admin/coupon/save',
            type: 'POST',
            datatype: 'json',
            data: formData,
            contentType : false,
            processData : false,
            cache : false,
            success: function (response) {
                if (response.success) {
                    $('#CreateAndEdit').modal('hide');
                    Quanlycoupon_ajax.loadData(null);
                }
                else {
                    alert(response.ms);
                }
            },
            error: function (err) {
                var errors = JSON.parse(err.responseText);
                if(errors.errors.coupon_name != '') {
                    $('.errorcoupon_name').toggleClass('show');
                    $('.errorcoupon_name').text(errors.errors.coupon_name);
                } 
                if(errors.errors.coupon_time != '') {
                    $('.errorcoupon_time').toggleClass('show');
                    $('.errorcoupon_time').text(errors.errors.coupon_time);
                } 
                if(errors.errors.coupon_code != '') {
                    $('.errorcoupon_code').toggleClass('show');
                    $('.errorcoupon_code').text(errors.errors.coupon_code);
                }
                if(errors.errors.coupon_condition != '') {
                    $('.errorcoupon_condition').toggleClass('show');
                    $('.errorcoupon_condition').text(errors.errors.coupon_condition);
                } 
                if(errors.errors.coupon_number != '') {
                    $('.errorcoupon_number').toggleClass('show');
                    $('.errorcoupon_number').text(errors.errors.coupon_number);
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
                $('#coupon_name').val(data.coupon_name);
                $('#coupon_code').val(data.coupon_code);
                $('#coupon_time').val(data.coupon_time);
                $('#coupon_condition').val(data.coupon_condition);
                $('#coupon_number').val(data.coupon_number);
                $('#coupon_id').val(data.coupon_id);
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
                    Quanlycoupon_ajax.loadData(null);
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
Quanlycoupon_ajax.init();
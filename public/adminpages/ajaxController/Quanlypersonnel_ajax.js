var Quanlypersonnel_ajax = {
    init: function () {
        Quanlypersonnel_ajax.registerEvent();
    },
    registerEvent: function () {
    	$('#name_search').off('keypress').on('keypress', function (e) {
            if (e.which == 13) {
            	var name_search = $(this).val();
                Quanlypersonnel_ajax.loadData(name_search);
            }
        });
        $('#btnSearchSS').off('click').on('click', function (event) {
        	event.preventDefault();
            var name_search = $('#name_search').val();
            Quanlypersonnel_ajax.loadData(name_search);
        });
        $('.js_add_item').off('click').on('click', function (event){
        	event.preventDefault();
        	$('#CreateAndEdit').modal('show');
            $('.modal-title').text('Thêm mới');
        	Quanlypersonnel_ajax.resetForm();
        });
        $('.styling-edit').off('click').on('click', function (event) {
            event.preventDefault();
            $('#CreateAndEdit').modal('show');
            $('.modal-title').text('Sửa dữ liệu');
             let url = $(this).attr('href');
            Quanlypersonnel_ajax.getData(url);
           
            
        });
        $('.styling-delete').off('click').on('click', function (event) {
            event.preventDefault();
            let url = $(this).attr('href');
            var cf = confirm('Bạn chắc chắn muốn xóa không?');
            if (cf) {
                Quanlypersonnel_ajax.deleteData(url);
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
            Quanlypersonnel_ajax.pagin(page,name_search);

        });
        $('#btnSave').on('submit', function (event) {
            event.preventDefault();
            // var data = $('#js_send_data')[0];
            Quanlypersonnel_ajax.saveData($(this)[0]);
        });
    },
    loadData: function (name_search) {
        // var search = $('#txtNameS').val();
        $.ajax({
            url: '/admin/personnel/load-data',
            type: 'GET',
            dataType: 'html',
            data: {            
                name_search: name_search  
            },
            success: function (data) {
                // console.log(data);
                $('#reder_data').html(data);
                Quanlypersonnel_ajax.registerEvent();
                
            }
        });
    },
    pagin:function(page,name_search) {
        $.ajax({
           	type: "GET",
           	url: '/admin/personnel/load-data?page='+ page,
           	dataType: 'html',
           	data: {            
                name_search: name_search  
            },
        })
        .success(function(data) {
           	$('#reder_data').html(data);
            Quanlypersonnel_ajax.registerEvent(); 
        });
        
    },
    resetForm: function () {
        $('#personnel_id').val('');
        $('#personnel_name').val('');
        $('#personnel_email').val('');
        $('#personnel_phone').val('');
        $('#personnel_position').val('');
        $('#personnel_birth').val('');
        $('#personnel_sex').prop('selectedIndex',0);
        $('#personnel_address').val('');
    },
    saveData: function (form_data) {
        // var formData = new FormData(form_data);
            // for (var key of formData.entries()) {
            //     console.log(key[0] + ', ' + key[1]);
            // }
            $.ajax({
            url: '/admin/personnel/save',
            type: 'POST',
            datatype: 'json',
            data: new FormData(form_data),
            // data: formData,
            contentType : false,
            processData : false,
            cache : false,
            success: function (response) {
                if (response.success) {
                    $('#CreateAndEdit').modal('hide');
                    Quanlypersonnel_ajax.loadData(null);
                }
                else {
                    alert(response.ms);
                }
            },
            error: function (err) {
                var errors = JSON.parse(err.responseText);
                if(errors.errors.personnel_name != '') {
                    $('.errorpersonnel_name').toggleClass('show');
                    $('.errorpersonnel_name').text(errors.errors.personnel_name);
                } 
                if(errors.errors.personnel_email != '') {
                    $('.errorpersonnel_email').toggleClass('show');
                    $('.errorpersonnel_email').text(errors.errors.personnel_email);
                } 
                if(errors.errors.personnel_phone != '') {
                    $('.errorpersonnel_phone').toggleClass('show');
                    $('.errorpersonnel_phone').text(errors.errors.personnel_phone);
                }
                if(errors.errors.personnel_position != '') {
                    $('.errorpersonnel_position').toggleClass('show');
                    $('.errorpersonnel_position').text(errors.errors.personnel_position);
                } 
                if(errors.errors.personnel_birth != '') {
                    $('.errorpersonnel_birth').toggleClass('show');
                    $('.errorpersonnel_birth').text(errors.errors.personnel_birth);
                } 
                if(errors.errors.personnel_address != '') {
                    $('.errorpersonnel_address').toggleClass('show');
                    $('.errorpersonnel_address').text(errors.errors.personnel_address);
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
                $('#personnel_id').val(data.personnel_id);
                $('#personnel_name').val(data.personnel_name);
                $('#personnel_email').val(data.personnel_email);
                $('#personnel_phone').val(data.personnel_phone);
                $('#personnel_position').val(data.personnel_position);
                $('#personnel_birth').val(data.personnel_birth);
                $('#personnel_sex').val(data.personnel_sex);
                $('#personnel_address').val(data.personnel_address);
                
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
                    Quanlypersonnel_ajax.loadData(null);
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
Quanlypersonnel_ajax.init();
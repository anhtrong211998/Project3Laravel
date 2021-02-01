var Quanlyaccount_ajax = {
    init: function () {
        Quanlyaccount_ajax.registerEvent();
    },
    registerEvent: function () {
    	$('#name_search').off('keypress').on('keypress', function (e) {
            if (e.which == 13) {
            	var name_search = $(this).val();
                Quanlyaccount_ajax.loadData(name_search);
            }
        });
        $('#btnSearchSS').off('click').on('click', function (event) {
        	event.preventDefault();
            var name_search = $('#name_search').val();
            Quanlyaccount_ajax.loadData(name_search);
        });
        $('.js_add_item').off('click').on('click', function (event){
        	event.preventDefault();
        	$('#CreateAndEdit').modal('show');
            $('.modal-title').text('Thêm mới');
        	Quanlyaccount_ajax.resetForm();
        });
        $('.styling-edit').off('click').on('click', function (event) {
            event.preventDefault();
            $('#CreateAndEdit').modal('show');
            $('.modal-title').text('Sửa dữ liệu');
             let url = $(this).attr('href');
            Quanlyaccount_ajax.getData(url);
           
            
        });
        $('.styling-delete').off('click').on('click', function (event) {
            event.preventDefault();
            let url = $(this).attr('href');
            var cf = confirm('Bạn chắc chắn muốn xóa không?');
            if (cf) {
                Quanlyaccount_ajax.deleteData(url);
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
            Quanlyaccount_ajax.pagin(page,name_search);

        });
        $('#btnSave').on('submit', function (event) {
            event.preventDefault();
            // var data = $('#js_send_data')[0];
            Quanlyaccount_ajax.saveData($(this)[0]);
        });
    },
    loadData: function (name_search) {
        // var search = $('#txtNameS').val();
        $.ajax({
            url: '/admin/account/load-data',
            type: 'GET',
            dataType: 'html',
            data: {            
                name_search: name_search  
            },
            success: function (data) {
                // console.log(data);
                $('#reder_data').html(data);
                Quanlyaccount_ajax.registerEvent();
                
            }
        });
    },
    pagin:function(page,name_search) {
        $.ajax({
           	type: "GET",
           	url: '/admin/account/load-data?page='+ page,
           	dataType: 'html',
           	data: {            
                name_search: name_search  
            },
        })
        .success(function(data) {
           	$('#reder_data').html(data);
            Quanlyaccount_ajax.registerEvent(); 
        });
        
    },
    resetForm: function () {
        $('#id').val('');
        $('#email').val('');
        $('#password').val('');
        $('#role').prop('selectedIndex',0);
        $('#active').prop('selectedIndex',0);
    },
    saveData: function (form_data) {
        var formData = new FormData(form_data);
            // for (var key of formData.entries()) {
            //     console.log(key[0] + ', ' + key[1]);
            // }
            $.ajax({
            url: '/admin/account/save',
            type: 'POST',
            datatype: 'json',
            data: formData,
            contentType : false,
            processData : false,
            cache : false,
            success: function (response) {
                if (response.success) {
                    $('#CreateAndEdit').modal('hide');
                    Quanlyaccount_ajax.loadData(null);
                }
                else {
                    alert(response.ms);
                }
            },
            error: function (err) {
                alert('Không thực hiện được');
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
                $('#active').val(data.active);
                $('#password').val(data.password);
                $('#role').val(data.role);
                $('#email').val(data.email);
                $('#id').val(data.id);
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
                    Quanlyaccount_ajax.loadData(null);
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
Quanlyaccount_ajax.init();
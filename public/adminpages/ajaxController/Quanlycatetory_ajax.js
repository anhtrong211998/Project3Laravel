var Quanlycatetory_ajax = {
    init: function () {
        Quanlycatetory_ajax.registerEvent();
    },
    registerEvent: function () {
    	$('#name_search').off('keypress').on('keypress', function (e) {
            if (e.which == 13) {
            	var name_search = $(this).val();
                var id = $('#categoryselect').val();
                Quanlycatetory_ajax.loadData(id,name_search);
            }
        });
        $('#btnSearchSS').off('click').on('click', function (event) {
        	event.preventDefault();
            var name_search = $('#name_search').val();
            var id = $('#categoryselect').val();
            Quanlycatetory_ajax.loadData(id,name_search);
        });
        $('.js_add_item').off('click').on('click', function (event){
        	event.preventDefault();
        	$('#CreateAndEdit').modal('show');
            $('.modal-title').text('Thêm mới');
        	Quanlycatetory_ajax.resetForm();
        });
        $('.styling-edit').off('click').on('click', function (event) {
            event.preventDefault();
            $('#CreateAndEdit').modal('show');
            $('.modal-title').text('Sửa dữ liệu');
             let url = $(this).attr('href');
            Quanlycatetory_ajax.getData(url);
           
            
        });
        $('.styling-delete').off('click').on('click', function (event) {
            event.preventDefault();
            let url = $(this).attr('href');
            var cf = confirm('Bạn chắc chắn muốn xóa không?');
            if (cf) {
                Quanlycatetory_ajax.deleteData(url);
            }
        });
        $('.pagination a').off('click').on('click',function(event){
            event.preventDefault();
            $('.pagination li').removeClass('active');
            $(this).parent('li').addClass('active');
            var myurl = $(this).attr('href');
            var id = $('#categoryselect').val();
            var name_search = $('#name_search').val();
            var page =$(this).attr('href').split('page=')[1];
            Quanlycatetory_ajax.pagin(page,id,name_search);

        });
        $('#btnSave').on('submit', function (event) {
            event.preventDefault();
            // var data = $('#js_send_data')[0];
            Quanlycatetory_ajax.saveData($(this)[0]);
        });
        $("#categoryselect").change(function(){
            var id = $(this).val();
            var name_search = $('#name_search').val();
            Quanlycatetory_ajax.loadData(id,name_search);
        });
        $('.change_status').off('click').on('click',function(event){
            event.preventDefault();
            let url = $(this).attr('href');
            let status = $(this).data('id');
            var cf = confirm('Bạn chắc chắn muốn thay đổi trạng thái không?');
            if (cf) {
                Quanlycatetory_ajax.change_status(url,status);
            }
            
        });
    },
    loadData: function (id,name_search) {
        // var search = $('#txtNameS').val();
        $.ajax({
            url: '/admin/catetory/load-data',
            type: 'GET',
            dataType: 'html',
            data: { 
                id:id,             
                name_search: name_search  
            },
            success: function (data) {
                // console.log(data);
                $('#reder_data').html(data);
                Quanlycatetory_ajax.registerEvent();
                
            }
        });
    },
    pagin:function(page,id,name_search) {
        $.ajax({
           	type: "GET",
           	url: '/admin/catetory/load-data?page='+ page,
           	dataType: 'html',
            data: { 
                id:id,             
                name_search: name_search  
            },
        })
        .success(function(data) {
           $('#reder_data').html(data);
                Quanlycatetory_ajax.registerEvent(); 
        });
        
    },
    resetForm: function () {
        $('#hiddenid').val('0');
        $('#catetory_status').prop('selectedIndex',0);
        $('#category_catetory_id').prop('selectedIndex',0);
        $('#catetory_desc').val('');
    },
    saveData: function (form_data) {
        var formData = new FormData(form_data);
            // for (var key of formData.entries()) {
            //     console.log(key[0] + ', ' + key[1]);
            // }
            $.ajax({
            url: '/admin/catetory/save',
            type: 'POST',
            datatype: 'json',
            data: formData,
            contentType : false,
            processData : false,
            cache : false,
            success: function (response) {
                if (response.success) {
                    $('#CreateAndEdit').modal('hide');
                    Quanlycatetory_ajax.loadData(null,null);
                }
                else {
                    alert(response.ms);
                }
            },
            error: function (err) {
                var errors = JSON.parse(err.responseText);
                if(errors.errors.catetory_name != '') {
                    $('.errorname').toggleClass('show');
                    $('.errorname').text(errors.errors.catetory_name);
                } 
                if(errors.errors.catetory_desc != '') {
                    $('.errordesc').toggleClass('show');
                    $('.errordesc').text(errors.errors.catetory_desc);
                }
                if(errors.errors.category_catetory_id != ''){
                	$('.errorcate').toggleClass('show');
                    $('.errorcate').text(errors.errors.category_catetory_id);
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
                $('#catetory_name').val(data.catetory_name);
                $('#catetory_desc').val(data.catetory_desc);
                $('#catetory_status').val(data.catetory_status);
                $('#category_catetory_id').val(data.category_catetory_id);
                $('#catetory_id').val(data.catetory_id);
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
                    Quanlycatetory_ajax.loadData(null,null);
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
                    Quanlycatetory_ajax.loadData(null,null);
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
Quanlycatetory_ajax.init();
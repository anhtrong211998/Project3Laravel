var QuanlyBannerController = {
    init: function () {
        QuanlyBannerController.registerEvent();
    },
    registerEvent: function () {
    	$('#name_search').off('keypress').on('keypress', function (e) {
            if (e.which == 13) {
            	var name_search = $(this).val();
                var id = $('#categoryselect').val();
                QuanlyBannerController.loadData(id,name_search);
            }
        });
        $('#btnSearchSS').off('click').on('click', function (event) {
        	event.preventDefault();
            var name_search = $('#name_search').val();
            var id = $('#categoryselect').val();
            QuanlyBannerController.loadData(id,name_search);
        });
        $('.js_add_item').off('click').on('click', function (event){
        	event.preventDefault();
        	$('#CreateAndEdit').modal('show');
            $('.modal-title').text('Thêm mới');
        	QuanlyBannerController.resetForm();
        });
        $('.styling-edit').off('click').on('click', function (event) {
            event.preventDefault();
            $('#CreateAndEdit').modal('show');
            $('.modal-title').text('Sửa dữ liệu');
             let url = $(this).attr('href');
            QuanlyBannerController.getData(url);
           
            
        });
        $('.styling-delete').off('click').on('click', function (event) {
            event.preventDefault();
            let url = $(this).attr('href');
            var cf = confirm('Bạn chắc chắn muốn xóa không?');
            if (cf) {
                QuanlyBannerController.deleteData(url);
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
            QuanlyBannerController.pagin(page,id,name_search);

        });
        $('#btnSave').on('submit', function (event) {
            event.preventDefault();
            // var data = $('#js_send_data')[0];
            QuanlyBannerController.saveData($(this)[0]);
        });
        $('.change_status').off('click').on('click',function(event){
            event.preventDefault();
            let url = $(this).attr('href');
            let status = $(this).data('id');
            var cf = confirm('Bạn chắc chắn muốn thay đổi trạng thái không?');
            if (cf) {
                QuanlyBannerController.change_status(url,status);
            }
            
        });
    },
    loadData: function (id,name_search) {
        // var search = $('#txtNameS').val();
        $.ajax({
            url: '/admin/banner/load-data',
            type: 'GET',
            dataType: 'html',
            data: { 
                id:id,             
                name_search: name_search  
            },
            success: function (data) {
                // console.log(data);
                $('#reder_data').html(data);
                QuanlyBannerController.registerEvent();
                
            }
        });
    },
    pagin:function(page,id,name_search) {
        $.ajax({
           type: "GET",
           url: '/admin/banner/load-data?page='+ page,
           dataType: 'html',
            data: { 
                id:id,             
                name_search: name_search  
            },
        })
        .success(function(data) {
           $('#reder_data').html(data);
                QuanlyBannerController.registerEvent(); 
        });
        
    },
    resetForm: function () {
        $('#hiddenid').val('0');
        $('#banner_status').prop('selectedIndex',0);
        $('#category_banner_id').prop('selectedIndex',0);
        $('#banner_desc').val('');
    },
    saveData: function (form_data) {
        var formData = new FormData(form_data);
            // for (var key of formData.entries()) {
            //     console.log(key[0] + ', ' + key[1]);
            // }
            $.ajax({
            url: '/admin/banner/save',
            type: 'POST',
            // datatype: 'json',
            data: formData,
            contentType : false,
            processData : false,
            cache : false,
            success: function (response) {
                if (response.success) {
                    $('#CreateAndEdit').modal('hide');
                    QuanlyBannerController.loadData(null,null);
                }
                else {
                    alert(response.ms);
                }
            },
            error: function (err) {
                alert(err);
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
                $('#banner_desc').val(data.banner_desc);
                $('#banner_status').val(data.banner_status);
                $('#category_banner_id').val(data.category_banner_id);
                $('#hiddenid').val(data.banner_id);
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
                    QuanlyBannerController.loadData(null,null);
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
                    QuanlyBannerController.loadData(null,null);
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
QuanlyBannerController.init();
var Quanlyproduct_ajax = {
    init: function () {
        Quanlyproduct_ajax.registerEvent();
    },
    registerEvent: function () {
    	$('#name_search').off('keypress').on('keypress', function (e) {
            if (e.which == 13) {
            	var name_search = $(this).val();
            	console.log(name_search);
                var id = $('#catetory_id').val();
                console.log(id);
                Quanlyproduct_ajax.loadData(id,name_search);
            }
        });
        $('#btnSearchSS').off('click').on('click', function (event) {
        	event.preventDefault();
            var name_search = $('#name_search').val();
            var id = $('#catetory_id').val();
            Quanlyproduct_ajax.loadData(id,name_search);
        });
        $('.styling-delete').off('click').on('click', function (event) {
            event.preventDefault();
            let url = $(this).attr('href');
            var cf = confirm('Bạn chắc chắn muốn xóa không?');
            if (cf) {
                Quanlyproduct_ajax.deleteData(url);
            }
        });
        $('.pagination a').off('click').on('click',function(event){
            event.preventDefault();
            $('.pagination li').removeClass('active');
            $(this).parent('li').addClass('active');
            var myurl = $(this).attr('href');
            var name_search = $('#name_search').val();
            var id = $('#catetory_id').val();
            var page =$(this).attr('href').split('page=')[1];
            Quanlyproduct_ajax.pagin(page,id,name_search);

        });
        $('.change_status').off('click').on('click',function(event){
            event.preventDefault();
            let url = $(this).attr('href');
            let status = $(this).data('id');
            var cf = confirm('Bạn chắc chắn muốn thay đổi trạng thái không?');
            if (cf) {
                Quanlyproduct_ajax.change_status(url,status);
            }
            
        });
    },
    loadData: function (id,name_search) {
        // var search = $('#txtNameS').val();
        $.ajax({
            url: '/admin/product/load-data',
            type: 'GET',
            dataType: 'html',
            data: { 
                id:id,             
                name_search: name_search  
            },
            success: function (data) {
                // console.log(data);
                $('#reder_data').empty();
                $('#reder_data').html(data);
                Quanlyproduct_ajax.registerEvent();
                
            }
        });
    },
    pagin:function(page,id,name_search) {
        $.ajax({
           type: "GET",
           url: '/admin/product/load-data?page='+ page,
           dataType: 'html',
            data: { 
                id:id,             
                name_search: name_search  
            },
        })
        .success(function(data) {
           $('#reder_data').html(data);
                Quanlyproduct_ajax.registerEvent(); 
        });
        
    },
    deleteData: function(url) {
        $.ajax({
            url: url,
            type: 'GET',
            dataType: 'json',
            success: function (response) {
                if (response.success) {
                    Quanlyproduct_ajax.loadData(null,null);
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
                    Quanlyproduct_ajax.loadData(null,null);
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
Quanlyproduct_ajax.init();
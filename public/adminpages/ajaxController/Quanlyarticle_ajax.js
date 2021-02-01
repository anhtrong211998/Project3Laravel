var QuanlyarticleController = {
    init: function () {
        QuanlyarticleController.registerEvent();
    },
    registerEvent: function () {
    	$('#name_search').off('keypress').on('keypress', function (e) {
            if (e.which == 13) {
            	var name_search = $(this).val();
                QuanlyarticleController.loadData(name_search);
            }
        });
        $('#btnSearchSS').off('click').on('click', function (event) {
        	event.preventDefault();
            var name_search = $('#name_search').val();
            QuanlyarticleController.loadData(name_search);
        });
        $('.styling-delete').off('click').on('click', function (event) {
            event.preventDefault();
            let url = $(this).attr('href');
            var cf = confirm('Bạn chắc chắn muốn xóa không?');
            if (cf) {
                QuanlyarticleController.deleteData(url);
            }
        });
        $('.pagination a').off('click').on('click',function(event){
            event.preventDefault();
            $('.pagination li').removeClass('active');
            $(this).parent('li').addClass('active');
            var myurl = $(this).attr('href');
            var name_search = $('#name_search').val();
            var page =$(this).attr('href').split('page=')[1];
            QuanlyarticleController.pagin(page,name_search);

        });
        $('.change_status').off('click').on('click',function(event){
            event.preventDefault();
            let url = $(this).attr('href');
            let status = $(this).data('id');
            var cf = confirm('Bạn chắc chắn muốn thay đổi trạng thái không?');
            if (cf) {
                QuanlyarticleController.change_status(url,status);
            }
            
        });
    },
    loadData: function (name_search) {
        // var search = $('#txtNameS').val();
        $.ajax({
            url: '/admin/article/load-data',
            type: 'GET',
            dataType: 'html',
            data: {              
                name_search: name_search,
            },
            success: function (data) {
                $('#reder_data').html(data);
                QuanlyarticleController.registerEvent();
            }
        });
    },
    pagin:function(page,name_search) {
        $.ajax({
            type: "GET",
            url: '/admin/article/load-data?page='+ page,
            dataType: 'html',
            data: {              
                name_search: name_search,
            },
        })
        .success(function(data) {
           $('#reder_data').html(data);
                QuanlyarticleController.registerEvent(); 
        });
        
    },
    resetForm: function () {
        $('#hidID').val('0');
        $('#fee_matp').prop('selectedIndex',0);
        $('#fee_maquanhuyen').prop('selectedIndex',0);
        $('#fee_maxaphuong').prop('selectedIndex',0);
        $('#fee_ship').val('');
    },
    deleteData: function(url) {
        $.ajax({
            // url: '/admin/feeship/delete/'+fee_id,
            url:url,
            // data: {
            //     fee_id: fee_id
            // },
            type: 'GET',
            dataType: 'json',
            success: function (response) {
                if (response.success) {
                    QuanlyarticleController.loadData(null);
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
                    QuanlyarticleController.loadData(null);
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
QuanlyarticleController.init();
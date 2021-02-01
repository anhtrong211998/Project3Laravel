var Quanlyorder_ajax = {
    init: function () {
        Quanlyorder_ajax.registerEvent();
    },
    registerEvent: function () {
    	$('#name_search').off('keypress').on('keypress', function (e) {
            if (e.which == 13) {
            	var name_search = $(this).val();
            	var status = $('.order_status').data('id');
            	console.log(status);
                Quanlyorder_ajax.loadData(status,name_search);
            }
        });
        $('#btnSearchSS').off('click').on('click', function (event) {
        	event.preventDefault();
            var name_search = $('#name_search').val();
            var status = $('.order_status').data('id');
           	console.log(status);
            Quanlyorder_ajax.loadData(status,name_search);
        });
        $('.js_add_item').off('click').on('click', function (event){
        	event.preventDefault();
        	
        	Quanlyorder_ajax.resetForm();
        });
        $('.styling-edit').off('click').on('click', function (event) {
            event.preventDefault();
            let url = $(this).attr('href');
            Quanlyorder_ajax.getData(url);
        });
        $('.styling-delete').off('click').on('click', function (event) {
            event.preventDefault();
            let url = $(this).attr('href');
            var cf = confirm('Bạn chắc chắn muốn xóa không?');
            if (cf) {
                Quanlyorder_ajax.deleteData(url);
            }
        });
        $('.pagination a').off('click').on('click',function(event){
            event.preventDefault();
            $('.pagination li').removeClass('active');
            $(this).parent('li').addClass('active');
            var myurl = $(this).attr('href');
            var name_search = $('#name_search').val();
            var status = $('.order_status').data('id');
            var page =$(this).attr('href').split('page=')[1];
            Quanlyorder_ajax.pagin(page,status,name_search);

        });
        $('#btnSave').on('submit', function (event) {
            event.preventDefault();
            Quanlyorder_ajax.saveData($(this)[0]);
        });
        $('#submit-form-unique').off('click').on('click',function(){
            event.preventDefault();
            var id = $('#hiddenid').val();
            var form_data=$(this).parent().parent().parent()[0];
            Quanlyorder_ajax.update(id,form_data);
             // var formData = new FormData(data);
            // // for (var key of formData.entries()) {
            // //     console.log(key[0] + ', ' + key[1]);
            // // }
            // console.log(data);
            // for (var key of formData.entries()) {
            //     console.log(key[0] + ', ' + key[1]);
            // }
        });
        $('#order_status').change(function(event){
            event.preventDefault();
            // let url = $(this).attr('href');
            // let status = $(this).data('id');
            var status = $(this).val();
            var id = $('.show_order_id')[0].innerText;
            var cf = confirm('Bạn chắc chắn muốn thay đổi trạng thái không?');
            if (cf) {
                Quanlyorder_ajax.change_status(status,id);
            }
            
        });
        ///////////////////////////////////////////
        //for user feeship
        $('.view_order').off('click').on('click',function(event){
            event.preventDefault();
            // let url = $(this).attr('href');
            let id =$(this).data('id');
            Quanlyorder_ajax.getOrderDetail(id,null);
        });
        $('.edit_feeship_user').off('click').on('click',function(event){
            event.preventDefault();
            let url = $(this).attr('href');
            // let id =$(this).data('id');
            Quanlyorder_ajax.getDataFee(url);
        });
        $('#insert_user_fee').off('click').on('click',function(event){
            event.preventDefault();
            // let url = $(this).attr('href');
            // let id =$(this).data('id');
            Quanlyorder_ajax.resetFormFee();
        });
        $('#btnSaveFee').off('submit').on('submit',function(event){
            event.preventDefault();
             $(this).find(':input').prop('disabled', false);
            Quanlyorder_ajax.saveDataFeeUser($(this)[0]);
        });
        // $('#search_name').off('keyup').on('keyup', function () {
        //     var optionsList =$('#modal-table-search tbody tr');
        //     console.log(optionsList.length);
        //     for (i = 0; i < optionsList.length; i++) {
        //         var td = optionsList[i].getElementsByTagName("td")[2];
        //         var txtValue = td.textContent || td.innerText;
        //         if (txtValue.toUpperCase().indexOf($(this).val().toUpperCase()) > -1){
        //           optionsList[i].style.display = "";
        //         } else {
        //           optionsList[i].style.display = "none";
        //         }
        //     }
        // });

        $('#submit-search').on('submit', function (event) {
            // if (e.which == 13) {
                event.preventDefault();
                // var search_name = $(this).val();
                // var id = $('#user_id').val();
                Quanlyorder_ajax.search($(this)[0]);
            // }
        });
        $('.change_status_fee').off('click').on('click',function(event){
            event.preventDefault();
            let url = $(this).attr('href');
            let status = $(this).data('id');
            console.log(status);
            var cf = confirm('Bạn chắc chắn muốn thay đổi trạng thái không?');
            if (cf) {
                Quanlyorder_ajax.change_status_fee(url,status);
            }
            
        });
    },
    search: function(form_data){
        var formData = new FormData(form_data);
            $.ajax({
            url: '/admin/order/search',
            type: 'POST',
            datatype: 'json',
            data: formData,
            contentType : false,
            processData : false,
            cache : false,
            success: function (data) {
                $('#show_user_fee').modal('show');
                $('#render_feeship_user').html(data);
                Quanlyorder_ajax.registerEvent();
            }
        });
    },
    loadData: function (status,name_search) {
        // var search = $('#txtNameS').val();
        $.ajax({
            url: '/admin/order/load-data',
            type: 'GET',
            dataType: 'html',
            data: {
            	status:status,            
                name_search: name_search,  
            },
            success: function (data) {
                // console.log(data);
                $('#reder_data').html(data);
                Quanlyorder_ajax.registerEvent();
            }
        });
    },
    pagin:function(page,status,name_search) {
        $.ajax({
           type: "GET",
           url: '/admin/order/load-data?page='+ page,
           dataType: 'html',
            data: {
                status:status,            
                name_search: name_search,  
            },
        })
        .success(function(data) {
           $('#reder_data').html(data);
                Quanlyorder_ajax.registerEvent(); 
        });
        
    },
    resetForm: function () {
        $('#CreateAndEdit').modal('show');
        $('.modal-title').text('Thêm mới');
        $('.user_fee').show();
        $('#submit-form').show();
        $('#submit-form-unique').hide();
        $('#update_status').hide();    
        $('#hiddenid').val('0');
        $('#name').val('');
        $('#phone').val('');
        $('#email').val('');
        $('#active').prop('selectedIndex',0);
        $('#fee_matp').prop('selectedIndex',0);
        $('#fee_maquanhuyen').prop('selectedIndex',0);
        $('#fee_maxaphuong').prop('selectedIndex',0);
        $('#f_u_address').val('');
    },
    saveData: function (form_data) {
        var formData = new FormData(form_data);
            $.ajax({
            url: '/admin/user/save',
            type: 'POST',
            datatype: 'json',
            data: formData,
            contentType : false,
            processData : false,
            cache : false,
            success: function (response) {
                if (response.success) {
                    $('#CreateAndEdit').modal('hide');
                    Quanlyorder_ajax.loadData(null);
                }
                else {
                    alert(response.ms);
                }
            },
            error: function (err) {
                var errors = JSON.parse(err.responseText);
                if(errors.errors.name != '') {
                    $('.errorname').toggleClass('show');
                    $('.errorname').text(errors.errors.name);
                } 
                if(errors.errors.email != '') {
                    $('.erroremail').toggleClass('show');
                    $('.erroremail').text(errors.errors.email);
                } 
                if(errors.errors.phone != '') {
                    $('.errorphone').toggleClass('show');
                    $('.errorphone').text(errors.errors.phone);
                } 
                if(errors.errors.password != '') {
                    $('.errorpassword').toggleClass('show');
                    $('.errorpassword').text(errors.errors.password);
                } 
                if(errors.errors.f_u_address != '') {
                    $('.errorf_u_address').toggleClass('show');
                    $('.errorf_u_address').text(errors.errors.f_u_address);
                } 
                if(errors.errors.fee_matp != '') {
                    $('.errorfee_matp').toggleClass('show');
                    $('.errorfee_matp').text(errors.errors.fee_matp);
                } 
                if(errors.errors.fee_maquanhuyen != '') {
                    $('.errorfee_maquanhuyen').toggleClass('show');
                    $('.errorfee_maquanhuyen').text(errors.errors.fee_maquanhuyen);
                } 
                if(errors.errors.fee_maxaphuong != '') {
                    $('.errorfee_maxaphuong').toggleClass('show');
                    $('.errorfee_maxaphuong').text(errors.errors.fee_maxaphuong);
                } 
            }
        });
    },
    update: function (id,form_data) {
        var formData = new FormData(form_data);
        $.ajax({
            url: '/admin/user/update/'+id,
            type: 'POST',
            datatype: 'json',
            data : formData,
            contentType : false,
            processData : false,
            cache : false,
            success: function (response) {
                // console.log(response);
                if (response.success) {
                    $('#CreateAndEdit').modal('hide');
                    Quanlyorder_ajax.loadData(null);
                }
                else {
                    alert(response.ms);
                }
            },
            error: function (err) {
                var errors = JSON.parse(err.responseText);
                if(errors.errors.name != '') {
                    $('.errorname').toggleClass('show');
                    $('.errorname').text(errors.errors.name);
                } 
                if(errors.errors.email != '') {
                    $('.erroremail').toggleClass('show');
                    $('.erroremail').text(errors.errors.email);
                } 
                if(errors.errors.phone != '') {
                    $('.errorphone').toggleClass('show');
                    $('.errorphone').text(errors.errors.phone);
                } 
                if(errors.errors.password != '') {
                    $('.errorpassword').toggleClass('show');
                    $('.errorpassword').text(errors.errors.password);
                }  
            }
        });
    },
    getData: function (url) {
        $('#CreateAndEdit').modal('show');
        $('#submit-form').hide();
        $('#submit-form-unique').show();
        $('.modal-title').text('Sửa dữ liệu');
        $.ajax({
            url: url,
            type: 'GET',
            dataType: 'json',
            success: function (response) {
                // console.log(response.datas);
                $('.user_fee').hide();
                $('#update_status').show();
                var data = response.datas;
                $('#name').val(data.name);
                $('#phone').val(data.phone);
                $('#email').val(data.email);
                $('#password').val(data.password);
                $('#re-password').val(data.password)
                $('#hiddenid').val(data.id);
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
                    Quanlyorder_ajax.loadData(null);
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
    change_status: function(status,id) {
        $.ajax({
            url: '/admin/order/change-status/'+id,
            type: 'GET',
            dataType: 'json',
            data:{
                status:status
            },
            success: function (response) {
                if (response.success) {
                    $('#show_order_detail').modal('hide');
                    Quanlyorder_ajax.loadData(response.status,null);
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
    ///for user feeship
    /////////////
    getOrderDetail: function(id,search_name){
        $.ajax({
            url: '/admin/orderdetail/view-order/'+id,
            type: 'GET',
            dataType: 'html',
            data: {             
                search_name: search_name  
            },
            success: function (data) {
                $('#show_order_detail').modal('show');
                $('#render_order_detail').html(data);
                Quanlyorder_ajax.registerEvent();
            }
        });
    },
    resetFormFee: function(){
        $('#show_user_fee').modal('hide');
        $('#CreateAndEditFee').modal('show');
        $('.modal-title').text('Thêm mới');   
        $('#hiddenidfee').val('0');
        var id = $('#user_id').val();
        console.log(id);
        $('#id').val(id);
        $('#id').attr("disabled", "disabled");
        $('#f_u_status').prop('selectedIndex',0);
        $('#fee_matp_user').prop('selectedIndex',0);
        $('#fee_maxaphuong_user').prop('selectedIndex',0);
        $('#fee_maquanhuyen_user').prop('selectedIndex',0);
        $('#f_u_address_user').val('');
    },
    getDataFee: function (url) {
        
        $.ajax({
            url: url,
            type: 'GET',
            dataType: 'json',
            success: function (response) {
                $('#show_user_fee').modal('hide');
                $('#CreateAndEditFee').modal('show');
                $('.modal-title').text('Sửa dữ liệu');
                console.log(response.datas);
                var data = response.datas;
                $('#id').val(data.f_u_user_id);
                $('#id').attr("disabled", "disabled");
                $('#f_u_address_user').val(data.f_u_address);
                $('#f_u_status').val(data.f_u_status);
                $('#fee_matp_user').val(response.feeship.fee_matp);
                $('#fee_maquanhuyen_user').val(response.feeship.fee_maquanhuyen);
                $('#fee_maxaphuong_user').val(response.feeship.fee_maxaphuong);
                $('#hiddenidfee').val(data.f_u_id);
            },
            error: function (err) {
                alert('Khong thuc hien duoc');
            }
        });
    },
    saveDataFeeUser: function (form_data) {
        var formData = new FormData(form_data);
            $.ajax({
            url: '/admin/user_fee/save',
            type: 'POST',
            datatype: 'json',
            data: formData,
            contentType : false,
            processData : false,
            cache : false,
            success: function (response) {
                if (response.success) {
                    $('#CreateAndEditFee').modal('hide');
                    $('#show_user_fee').modal('show');
                    Quanlyorder_ajax.getUserFee(response.id,null);
                }
                else {
                    alert(response.ms);
                }
            },
            error: function (err) {
                alert('không thành công');
            }
        });
    },
    change_status_fee: function(url,status) {
        $.ajax({
            url: url,
            type: 'GET',
            // dataType: 'json',
            data:{
                status:status
            },
            success: function (response) {
                // console.log(response);
                if (response.success) {
                    // $('#show_user_fee').modal('hide');
                    Quanlyorder_ajax.getUserFee(response.id,null);
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

}
Quanlyorder_ajax.init();
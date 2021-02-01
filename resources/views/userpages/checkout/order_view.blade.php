@extends('userpages.layout.app')
@section('body')
<section class="main-container col1-layout">
    <div class="main container">
        <div class="col-main">
            <div class="row">
                <div class="product-view wow">
                    <!-- middle section -->
                    <div class="product-collateral">
                        <div class=" wow">
                            <ul id="product-detail-tab" class="nav nav-tabs product-tabs">
                                <li class="active" style="width: 20%;text-align: center;"> 
                                       <a href="#product_tabs_comment" data-toggle="tab">Chưa xác nhận</a> 
                                </li>
                                <li style="width: 20%;text-align: center;"> 
                                    <a href="#reviews_tabs" data-toggle="tab">Đã xác nhận</a> 
                                </li>
                                <li style="width: 20%;text-align: center;"> 
                                       <a href="#product_tabs_comment1" data-toggle="tab">Đang giao</a> 
                                </li>
                                <li style="width: 20%;text-align: center;"> 
                                    <a href="#reviews_tabs1" data-toggle="tab">Đã nhận</a> 
                                </li>
                                <li style="width: 20%;text-align: center;"> 
                                    <a href="#reviews_tabs2" data-toggle="tab">Đã hủy</a> 
                                </li>
                            </ul>
                            <div id="productTabContent" class="tab-content">
                                <div class="tab-pane fade in active" id="product_tabs_comment">
                                  	<div class="std">
                                  		@if(count($orders)>0)
                                  		@foreach($orders as $order)
                                  		@if($order->order_status == 1)
                                    	<h4 class="modal-title">Đơn hàng <b style="font-size: 12px;">#</b><b class="show_order_id" style="font-size: 12px;">#</b>{{$order->order_id}} <a href="#" class="pull-right"><i class="icon-remove" style="font-size: 11px;"></i></a></h4>
                                    	
                                    	
	                                    <table class="table table-striped">
	                                      	<thead>
	                                          	<tr>
	                                            	<th>#</th>
	                                            	<th>Tên sản phẩm</th>
	                                            	<th>Hình ảnh</th>
	                                            	<th>Giá</th>
	                                            	<th>Số lượng</th>
	                                            	<th>Thành tiền</th>
	                                          	</tr>
	                                        </thead>
	                                        <tbody>
	                                        	@foreach($order->Order_detail as $detail)
	                                          	<tr>
	                                            	<td>{{$detail->order_detail_id}}</td>
	                                            	<td style="padding-top: 22px;">
	                                              	{{$detail->order_detail_product_name}}
	                                            	</td>
	                                            	<td><img src="/adminpages/images/{{$detail->order_detail_image}}" alt="" style="width: 70px;height: 60px;"></td>
	                                            	<td style="padding-top: 22px;">
	                                             	 {{number_format($detail->order_detail_product_price).' '.'(đ)'}}
	                                            	</td>
	                                            	<td style="padding-top: 22px;"><input maxlength="12" class="input-text edit-qty form-control" title="Qty" size="4" value="{{$detail->order_detail_product_quanty}}" data-id="4" type="number" id="change-qty_4" style="height: 28px;padding: 0 12px;margin-top: -6px;width: 30%;"></td>
	                                            	<td style="padding-top: 22px;">{{number_format($detail->order_detail_total_price).' '.'(đ)'}}</td>
	                                          	</tr>
	                                          	@endforeach
	                                        </tbody>
	                                    </table>
	                                    
	                                    @endif
	                                    @endforeach
										@else
	                                    <h4 class="modal-title" style="text-align: center;color: red;">Không có sản phẩm nào</h4>
	                                    @endif
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="reviews_tabs">
                                    <div class="box-collateral box-reviews" id="customer-reviews">
                                        @if(count($orders)>0)
                                  		@foreach($orders as $order)
                                  		@if($order->order_status == 2)
                                    	<h4 class="modal-title">Đơn hàng <b style="font-size: 12px;">#</b><b class="show_order_id" style="font-size: 12px;">#</b>{{$order->order_id}} <a href="#" class="pull-right"><i class="icon-remove" style="font-size: 11px;"></i></a></h4>
                                    	
                                    	
	                                    <table class="table table-striped">
	                                      	<thead>
	                                          	<tr>
	                                            	<th>#</th>
	                                            	<th>Tên sản phẩm</th>
	                                            	<th>Hình ảnh</th>
	                                            	<th>Giá</th>
	                                            	<th>Số lượng</th>
	                                            	<th>Thành tiền</th>
	                                          	</tr>
	                                        </thead>
	                                        <tbody>
	                                        	@foreach($order->Order_detail as $detail)
	                                          	<tr>
	                                            	<td>{{$detail->order_detail_id}}</td>
	                                            	<td style="padding-top: 22px;">
	                                              	{{$detail->order_detail_product_name}}
	                                            	</td>
	                                            	<td><img src="/adminpages/images/{{$detail->order_detail_image}}" alt="" style="width: 70px;height: 60px;"></td>
	                                            	<td style="padding-top: 22px;">
	                                             	 {{number_format($detail->order_detail_product_price).' '.'(đ)'}}
	                                            	</td>
	                                            	<td style="padding-top: 22px;"><input maxlength="12" class="input-text edit-qty form-control" title="Qty" size="4" value="{{$detail->order_detail_product_quanty}}" data-id="4" type="number" id="change-qty_4" style="height: 28px;padding: 0 12px;margin-top: -6px;width: 30%;"></td>
	                                            	<td style="padding-top: 22px;">{{number_format($detail->order_detail_total_price).' '.'(đ)'}}</td>
	                                          	</tr>
	                                          	@endforeach
	                                        </tbody>
	                                    </table>
	                                    
	                                    @endif
	                                    @endforeach
										@else
	                                    <h4 class="modal-title" style="text-align: center;color: red;">Không có sản phẩm nào</h4>
	                                    @endif
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="product_tabs_comment1">
                                  	<div class="std">
                                  		@if(count($orders)>0)
                                  		@foreach($orders as $order)
                                  		@if($order->order_status == 3)
                                    	<h4 class="modal-title">Đơn hàng <b style="font-size: 12px;">#</b><b class="show_order_id" style="font-size: 12px;">#</b>{{$order->order_id}} <a href="#" class="pull-right"><i class="icon-remove" style="font-size: 11px;"></i></a></h4>
                                    	
                                    	
	                                    <table class="table table-striped">
	                                      	<thead>
	                                          	<tr>
	                                            	<th>#</th>
	                                            	<th>Tên sản phẩm</th>
	                                            	<th>Hình ảnh</th>
	                                            	<th>Giá</th>
	                                            	<th>Số lượng</th>
	                                            	<th>Thành tiền</th>
	                                          	</tr>
	                                        </thead>
	                                        <tbody>
	                                        	@foreach($order->Order_detail as $detail)
	                                          	<tr>
	                                            	<td>{{$detail->order_detail_id}}</td>
	                                            	<td style="padding-top: 22px;">
	                                              	{{$detail->order_detail_product_name}}
	                                            	</td>
	                                            	<td><img src="/adminpages/images/{{$detail->order_detail_image}}" alt="" style="width: 70px;height: 60px;"></td>
	                                            	<td style="padding-top: 22px;">
	                                             	 {{number_format($detail->order_detail_product_price).' '.'(đ)'}}
	                                            	</td>
	                                            	<td style="padding-top: 22px;"><input maxlength="12" class="input-text edit-qty form-control" title="Qty" size="4" value="{{$detail->order_detail_product_quanty}}" data-id="4" type="number" id="change-qty_4" style="height: 28px;padding: 0 12px;margin-top: -6px;width: 30%;"></td>
	                                            	<td style="padding-top: 22px;">{{number_format($detail->order_detail_total_price).' '.'(đ)'}}</td>
	                                          	</tr>
	                                          	@endforeach
	                                        </tbody>
	                                    </table>
	                                    
	                                    @endif
	                                    @endforeach
										@else
	                                    <h4 class="modal-title" style="text-align: center;color: red;">Không có sản phẩm nào</h4>
	                                    @endif
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="reviews_tabs1">
                                    <div class="box-collateral box-reviews" id="customer-reviews">
                                        @if(count($orders)>0)
                                  		@foreach($orders as $order)
                                  		@if($order->order_status == 4)
                                    	<h4 class="modal-title">Đơn hàng <b style="font-size: 12px;">#</b><b class="show_order_id" style="font-size: 12px;">#</b>{{$order->order_id}} <a href="#" class="pull-right"><i class="icon-remove" style="font-size: 11px;"></i></a></h4>
                                    	
                                    	
	                                    <table class="table table-striped">
	                                      	<thead>
	                                          	<tr>
	                                            	<th>#</th>
	                                            	<th>Tên sản phẩm</th>
	                                            	<th>Hình ảnh</th>
	                                            	<th>Giá</th>
	                                            	<th>Số lượng</th>
	                                            	<th>Thành tiền</th>
	                                          	</tr>
	                                        </thead>
	                                        <tbody>
	                                        	@foreach($order->Order_detail as $detail)
	                                          	<tr>
	                                            	<td>{{$detail->order_detail_id}}</td>
	                                            	<td style="padding-top: 22px;">
	                                              	{{$detail->order_detail_product_name}}
	                                            	</td>
	                                            	<td><img src="/adminpages/images/{{$detail->order_detail_image}}" alt="" style="width: 70px;height: 60px;"></td>
	                                            	<td style="padding-top: 22px;">
	                                             	 {{number_format($detail->order_detail_product_price).' '.'(đ)'}}
	                                            	</td>
	                                            	<td style="padding-top: 22px;"><input maxlength="12" class="input-text edit-qty form-control" title="Qty" size="4" value="{{$detail->order_detail_product_quanty}}" data-id="4" type="number" id="change-qty_4" style="height: 28px;padding: 0 12px;margin-top: -6px;width: 30%;"></td>
	                                            	<td style="padding-top: 22px;">{{number_format($detail->order_detail_total_price).' '.'(đ)'}}</td>
	                                          	</tr>
	                                          	@endforeach
	                                        </tbody>
	                                    </table>
	                                    
	                                    @endif
	                                    @endforeach
										@else
	                                    <h4 class="modal-title" style="text-align: center;color: red;">Không có sản phẩm nào</h4>
	                                    @endif
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="reviews_tabs2">
                                    <div class="box-collateral box-reviews" id="customer-reviews">
                                        @if(count($orders)>0)
                                  		@foreach($orders as $order)
                                  		@if($order->order_status == 5)
                                    	<h4 class="modal-title">Đơn hàng <b style="font-size: 12px;">#</b><b class="show_order_id" style="font-size: 12px;">#</b>{{$order->order_id}} <a href="#" class="pull-right"><i class="icon-remove" style="font-size: 11px;"></i></a></h4>
                                    	
                                    	
	                                    <table class="table table-striped">
	                                      	<thead>
	                                          	<tr>
	                                            	<th>#</th>
	                                            	<th>Tên sản phẩm</th>
	                                            	<th>Hình ảnh</th>
	                                            	<th>Giá</th>
	                                            	<th>Số lượng</th>
	                                            	<th>Thành tiền</th>
	                                          	</tr>
	                                        </thead>
	                                        <tbody>
	                                        	@foreach($order->Order_detail as $detail)
	                                          	<tr>
	                                            	<td>{{$detail->order_detail_id}}</td>
	                                            	<td style="padding-top: 22px;">
	                                              	{{$detail->order_detail_product_name}}
	                                            	</td>
	                                            	<td><img src="/adminpages/images/{{$detail->order_detail_image}}" alt="" style="width: 70px;height: 60px;"></td>
	                                            	<td style="padding-top: 22px;">
	                                             	 {{number_format($detail->order_detail_product_price).' '.'(đ)'}}
	                                            	</td>
	                                            	<td style="padding-top: 22px;"><input maxlength="12" class="input-text edit-qty form-control" title="Qty" size="4" value="{{$detail->order_detail_product_quanty}}" data-id="4" type="number" id="change-qty_4" style="height: 28px;padding: 0 12px;margin-top: -6px;width: 30%;"></td>
	                                            	<td style="padding-top: 22px;">{{number_format($detail->order_detail_total_price).' '.'(đ)'}}</td>
	                                          	</tr>
	                                          	@endforeach
	                                        </tbody>
	                                    </table>
	                                    
	                                    @endif
	                                    @endforeach
										@else
	                                    <h4 class="modal-title" style="text-align: center;color: red;">Không có sản phẩm nào</h4>
	                                    @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
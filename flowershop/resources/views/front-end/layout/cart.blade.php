@extends('front-end.layout.index')
@section('content')
<!--End JavaScript -->
<!-- Breadcrumb Section Begin -->
<div class="breacrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-text product-more">
                        <a href="{{route('home')}}"><i class="fa fa-home"></i> Trang chủ</a>
                        <span>Giỏ hàng</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Section Begin -->

    <!-- Shopping Cart Section Begin -->
    <section class="shopping-cart spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="cart-table">
                        <table>
                            <thead>
                                <tr>
                                    <th>{{__('image')}}</th>
                                    <th class="p-name">{{__('name_product')}}</th>
                                    <th>{{__('price')}}</th>
                                    <th>{{__('quantity')}}</th>
                                    <th>{{__('total')}}</th>
                                    <th>{{__('delete')}}</th>
                                </tr>
                            </thead>
                            @if(Session::has('cart'))
                            <tbody>
                            @foreach($product_cart as $product)
                                <tr>
                                    <td class="cart-pic first-row"><img src="{{$product['item']['image']}}" alt="{{$product['item']['name']}}"></td>
                                    <td class="cart-title first-row">
                                        <h5>{{$product['item']['name']}}</h5>
                                    </td>
                                    <td class="p-price first-row">@if($product['item']['promotion_price']==0) {{number_format($product['item']['unit_price'])}} đồng @else {{number_format($product['item']['promotion_price'])}} VNĐ @endif</td>
                                    <td class="qua-col first-row">
                                        <div class="quantity">
                                            <div class="pro-qty">
                                                <input class="form-control text-center"  value="{{$product['qty']}}" >
                                                <a href="{{route('capnhatgiohang',$product['item']['id'])}}" class="update-item-cart" data-id={{ $product['item']['id'] }}><i style="padding-left:10px;" class="fa fa-refresh"></i></a>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="total-price first-row">{{number_format($product['price'])}} VNĐ</td>
                                    <td class="close-td first-row"><a href="{{route('deletecart',$product['item']['id'])}}"><i class="ti-close"></i></a></td>
                                </tr>
                            @endforeach
                            </tbody>
                            @endif
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="cart-buttons">
                                <a href="{{route('home')}}" class="primary-btn continue-shop">{{__('keep_shopping')}}</a>
                                <a href="#" class="primary-btn up-cart">{{__('update_cart')}}</a>
                            </div>
                        </div>
                        <div class="col-lg-4 offset-lg-4">
                            <div class="proceed-checkout">
                                <ul>
                                    <li class="subtotal">{{__('subtotal')}} <span>@if(Session::has('cart')){{number_format(Session('cart')->totalPrice)}} VNĐ @else 0 VNĐ @endif</span></li>
                                    <li class="cart-total">{{__('total')}} <span>@if(Session::has('cart')){{number_format(Session('cart')->totalPrice)}} VNĐ @else 0 VNĐ @endif</span></li>
                                </ul>
                                @if(Session::has('cart'))
                                <a href="{{route('checkout')}}" class="proceed-btn">{{__('proceed_to_check_out')}}</a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Shopping Cart Section End -->
    <!--JavaScript -->
    <script type="text/javascript" src="client_asset/assets/dest/js/jquery.min.js"></script>
    <script type="text/javascript">
        $(function(){
            $(".update-item-cart").click(function(event){
                event.preventDefault();
                let $this = $(this);
                let url = $this.attr('href');
                let qty = $this.prev().val();
                if(url){
                    $.ajax({
                        url: url,
                        data: {qty:qty}
                    }).done(function(results){
                        window.location.reload();
                    });
                        
                }
            })
        });
    </script>
@endsection
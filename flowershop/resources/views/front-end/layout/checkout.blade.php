@extends('front-end.layout.index')
@section('content')
<!-- Breadcrumb Section Begin -->
<div class="breacrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-text product-more">
                        <a href="{{route('home')}}"><i class="fa fa-home"></i> {{__('home')}}</a>
                        <span>{{__('checkout')}}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Section Begin -->
    <!-- Shopping Cart Section Begin -->
    <section class="checkout-section spad">
        <div class="container">
        @if(Session::has('thongbao'))
			<div class="alert alert-success">{{Session::get('thongbao')}}</div>
		@endif
            <div class="checkout-content">
                @if(Session::get('coupon'))
                <form action="unset-coupon">
                    <input style="color:red"  type="submit" name="check_coupon" value="{{__('delete_coupon')}}" />
                </form>
                @else
                <form action="check-coupon" method="POST">
                    <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                    <input style="float:left" list="coupon" type="text" name="coupon" placeholder="{{__('enter_discount_code')}}">
                    @if(Auth::check())
                    <datalist id="coupon">
                        @foreach($coupon_user as $key => $cou)
                        <option>{{$cou->code}}</option>
                        @endforeach
                    </datalist>
                    @endif
                    <input style="color:#6db340" type="submit" name="check_coupon" value="{{__('apply')}}" />
                </form>
                @endif
            </div>
            <form action="{{route('checkout')}}" method="post" class="checkout-form">
            <input type="hidden" name="_token" value="{{csrf_token()}}">
                <div class="row">
                    <div class="col-lg-6">
                        <h4>{{__('biiling_details')}}</h4>
                        <div class="row">
                            @if(Auth::check())
                            <div class="col-lg-6">
                            <input type="hidden" id="user_code" name="user_code" placeholder="Mã người dùng" value="{{Auth::user()->user_code}}">
                            </div>
                            @endif
                            <div class="col-lg-12">
                                <label for="name">{{__('full_name')}}<span style="color:red">*</span></label>
                                <input type="text" value="@if(Auth::check()){{Auth::user()->name}}@endif" id="name" name="name" placeholder="{{__('your_name')}}" required>
                            </div>
                            <div class="col-lg-12">
                            <label for="name">{{__('gender')}}<span style="color:red">*</span></label>
                                <input type="text" list="select-gender" id="gender" name="gender" placeholder="{{__('select_gender')}}" required>
                                <datalist id="select-gender">
                                    <option>{{__('male')}}</option>
                                    <option>{{__('female')}}</option>
                                    <option>{{__('other')}}</option>
                                </datalist>
                            </div>
                            <div class="col-lg-12">
                                <label for="email">{{__('email')}}<span style="color:red">*</span></label>
                                <input type="email" id="email" name="email" value="@if(Auth::check()){{Auth::user()->email}}@endif" required placeholder="expample@gmail.com">
                            </div>
                            <div class="col-lg-12">
                                <label for="address">{{__('address')}}<span style="color:red">*</span></label>
                                </br>

                                <select style="height:45px; border: 2px solid #ebebeb;" class="col-lg-5 choose city" name="city" id="city" required>
                                    <option value="">{{__('select_province/city')}}</option>
                                @foreach($provincial as $key => $t)
                                    <option value="{{$t->matp}}">{{$t->name}}</option>
                                @endforeach
                                </select>

                                <select style="height:45px; border: 2px solid #ebebeb;" class="col-lg-6 province choose" id="province" name="province" required>
                                    <option value="">{{__('select_district')}}</option>
                                </select>
                                </br>
                                </br>
                                <select style="height:45px; border: 2px solid #ebebeb;" class="col-lg-5 wards" id="wards" name="wards">
                                    <option value="">{{__('select_commune/ward/town')}}</option>
                                </select>
                                <input class="col-lg-6" type="text" id="address" name="address_streets" placeholder="{{__('address_street')}}" required>
                            </div>
                            <div class="col-lg-12">
                                <label for="phone">{{__('phone_number')}}<span style="color:red">*</span></label>
                                <input type="text" id="phone" name="phone" placeholder="{{__('phone')}}" required>
                            </div>
                            <div class="col-lg-12">
                                <label for="notes">{{__('note')}}</label>
                                <input id="notes" name="notes"></input>
                            </div>
                            <div class="col-lg-12">
                                <div class="create-item">
                                    <label for="acc-create">
                                    {{__('create_an_account')}}
                                        <input type="checkbox" id="acc-create">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="place-order">
                            <h4>{{__('your_order')}}</h4>
                            <div class="order-total">
                                <ul class="order-table">
                                @if(Session::has('cart'))
                                    <li>{{__('product')}} <span>{{__('total')}}</span></li>
                                    @foreach($product_cart as $cart)
                                    <li class="fw-normal">{{$cart['item']['name']}} x {{__('quantity')}}:{{$cart['qty']}} <span>{{__('price')}}: {{number_format($cart['price'])}} VNĐ</span></li>
                                    @endforeach
                                    <li class="total-price">{{__('total')}} <span>@if(Session::has('cart')){{number_format($totalPrice)}} VNĐ@else 0 @endif VNĐ</span></li>
                                    @if(Session::get('coupon'))
											@foreach(Session::get('coupon') as $key =>$cou)
												@if($cou['condition']==1)
													<input type="hidden" class="input-radio" name="number" value="{{$cou['number']}}%" checked="checked"><li class="total-price"> {{__('code_coupon')}}: <span>{{$cou['number']}}%</span></li>
													<li class="total-price">
														@php
															$total_coupon=($totalPrice*$cou['number'])/100;
															echo ''.__('amount_of_reduction').':<span>'.number_format($total_coupon,0,',','.').'VNĐ</span>';
                                                            $total = $totalPrice-$total_coupon;
														@endphp
													</li>
													<input type="hidden" class="input-radio" name="total_coupon" value="{{$totalPrice-$total_coupon,0,',','.'}}" checked="checked"><li class="total-price">{{__('total_discount')}}:<span>{{number_format($total,0,',','.')}} đồng</span></li>
													@elseif($cou['condition']==2)
														<input type="hidden" class="input-radio" name="number" value="{{$cou['number'],0,',','.'}} đ" checked="checked"><li class="total-price"> {{__('code_coupon')}}:<span> {{number_format($cou['number'],0,',','.')}} đồng</span></li>
														@php
															$total=$totalPrice - $cou['number'];
														@endphp
													<input type="hidden" class="input-radio" name="total_coupon" value="{{$total,0,',','.'}}" checked="checked"><li class="total-price">{{__('total_discount')}}: <span>{{number_format($total,0,',','.')}}VNĐ</span></li>
												@endif
											@endforeach
										@endif
								@endif
                                </ul>
                                <div class="payment-check">
                                    <div class="pc-item">
                                        <label for="pc-ship">
                                        {{__('ship')}}
                                            <input type="checkbox" id="pc-ship" name="ship" value="Miễn phí vận chuyển" checked=true>
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                    <div class="pc-item">
                                        <label for="pc-check">
                                            {{__('COD')}}
                                            <input type="checkbox" id="pc-check" value="COD" name="payment_method" >
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                    @if(Session::has('cart'))
                                    <div class="pc-item">
                                        <label for="pc-paypal">
                                            {{__('master_card')}}
                                            <input type="checkbox" id="pc-paypal" name="payment_method">
                                            <span class="checkmark"></span>
                                            @if(Session::get('coupon'))
                                                @php
                                                    $vnd_to_usd = $total/23083;
                                                @endphp
                                            @else
                                                @php
                                                    $vnd_to_usd = $totalPrice/23083;
                                                @endphp
                                            @endif

                                            <div id="paypal-button"></div>
                                            <input type="hidden" id="vnd_to_usd" value="{{round($vnd_to_usd,2)}}">
                                        </label>
                                    </div>
                                    @else
                                    <div class="pc-item">
                                        <label for="pc-paypal">
                                            {{__('master_card')}}
                                            <input type="checkbox" id="pc-paypal" name="payment_method">
                                            <span class="checkmark"></span>

                                        </label>
                                    </div>
                                    @endif
                                </div>
                                <div class="order-btn">
                                    <button type="submit" class="site-btn place-btn">{{__('place_order')}}</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
    <!-- Shopping Cart Section End -->
    <!--PayPal -->
    <script src="https://www.paypalobjects.com/api/checkout.js"></script>
    <script>
        var usd = document.getElementById("vnd_to_usd").value;
        paypal.Button.render({
        // Configure environment
        env: 'sandbox',
        client: {
            sandbox: 'AVU14xwHwehWC7B48DDqOWC_-NZ8OjlHjCoikTJ5X_90yR1M0cjM4efhTmYQmN_LsF_r03osAjK5uLug',
            production: 'demo_production_client_id'
        },
        // Customize button (optional)
            locale: 'en_US',
            style: {
            size: 'small',
            color: 'gold',
            shape: 'pill',
        },

        // Enable Pay Now checkout flow (optional)
        commit: true,

        // Set up a payment
        payment: function(data, actions) {
            return actions.payment.create({
                transactions: [{
                    amount: {
                        total: `${usd}`,
                        currency: 'USD'
                    }
                }]
            });
        },
        // Execute the payment
        onAuthorize: function(data, actions) {
        return actions.payment.execute().then(function() {
            // Show a confirmation message to the buyer
            window.alert('Cảm ơn bạn đã mua hàng tại Wendy FLowers!');
        });
        }
    }, '#paypal-button');
    </script>
    <script src="client_asset/assets/dest/js/jquery-3.3.1.min.js"></script>
    <script>
        // the selector will match all input controls of type :checkbox
        // and attach a click event handler
        $("input:checkbox").on('click', function() {
        // in the handler, 'this' refers to the box clicked on
        var $box = $(this);
        if ($box.is(":checked")) {
            // the name of the box is retrieved using the .attr() method
            // as it is assumed and expected to be immutable
            var group = "input:checkbox[name='payment_method']";
            // the checked state of the group/box on the other hand will change
            // and the current value is retrieved using .prop() method
            $(group).prop("checked", false);
            $box.prop("checked", true);
        } else {
            $box.prop("checked", false);
        }
        });
    </script>
    <script>
            $(document).ready(function(){
                $('.choose').on('change',function(){
                var action = $(this).attr('id');
                var ma_id = $(this).val();
                var _token = $('input[name="_token"]').val();
                var result = '';

                if(action=='city'){
                    result = 'province';
                }else{
                    result = 'wards';
                }
                $.ajax({
                    type:'POST',
                    url : '{{url('/select-delivery')}}',
                    data:{action:action,ma_id:ma_id,_token:_token},
                    success:function(data){
                    $('#'+result).html(data);
                    }
                });
            });
        });
    </script>

@endsection

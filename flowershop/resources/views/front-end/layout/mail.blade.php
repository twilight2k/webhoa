<div class="form-mail" style="text-align:center">
<h1>Đặt hàng thành công</h1>
<p>Xin chào:{{$c_name}}</p>
<p>Mã đơn hàng của bạn là: DH-FL-{{$c_ma}}-COL</p>
<p>Ngày đặt hàng:{{$c_dateorder}}</p>
<h4>Chi tiết đơn hàng:</h4>
<center>
<div class="bg-logo">
    <img src="client_asset/assets/dest/img/logowds.png" alt="">
</div>
<table style="position: relative;" border="1" cellspacing="0" cellpadding="10" width="400">
    <thead>
        <tr style="background: #FFA500">
            <th>Tên Sản Phẩm</th>
            <th>Số lượng</th>
            <th>Giá</th>
            <th>Ghi chú</th>
        </tr>
    </thead>
    <tbody>
    @foreach($items as $cart)
        <tr>
            <td>{{$cart['item']['name']}}</td>
            <td>{{$cart['qty']}}</td>
            <td>{{number_format($cart['price'])}} đồng</td>
            <td>{{$c_notes}}</td>
        </tr>
    @endforeach
    <tr>
        <td colspan="3"><b>Tổng tiền:</b></td>
        <td colspan="1"><b class="text-red">{{number_format($c_total)}} đồng</b></td>
    </tr>
    @if($c_coupon)
    <tr>
        <td colspan="3"><b>Mã giảm giá:</b></td>
        <td colspan="1"><b class="text-red">{{$c_coupon}}</b></td>
    </tr>
    <tr>
        <td colspan="3"><b>Tổng tiền sau giảm giá:</b></td>
        <td colspan="1"><b class="text-red">{{number_format($c_total_coupon)}} đồng</b></td>
    </tr>
    @endif
    </tbody>
</table>
</center>
<p>Chúng tôi đã tiếp nhận đơn hàng của bạn.</p>
<h2>Cảm ơn bạn đã lựa chọn Wendy Shop.</h2>
<p>Hãy theo giỏi <a href="https://www.facebook.com/fanpage.flowershop/?view_public_for=116852196884890">Fanpage</a> của nhóm để nhận thêm nhiều ưu đãi đãi.</p>

</div>

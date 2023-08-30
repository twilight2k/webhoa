<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Address_Provincial;
use App\Models\Address_District;
use App\Models\Address_Wards;
use Carbon\Carbon;
use App\Models\Slide;
use App\Models\SaleOfProduct;
use App\Models\Bill;
use App\Models\BillDetail;
use App\Models\Cart;
use App\Models\Comment;
use App\Models\Contact;
use App\Models\Coupon;
use App\Models\Customer;
use App\Models\News;
use App\Models\Product;
use App\Models\Image_Product;
use App\Models\ProductType;
use App\Models\HolidaysOfYear;
use App\Models\ProductAndHoliday;
use App\Models\Shop;
use App\Models\Color;
use App\Models\User;
use App\Models\Level;
use App\Models\BlogType;
use App\Models\Blog;
use App\Models\Comments_Surrendered;
use Illuminate\Support\Facades\DB;
use Auth;
use Hash;
use Session;
use Mail;
use Srmklive\PayPal\Services\ExpressCheckout;
use Illuminate\Support\Str;
use App\MachineLearning\ProductSimilarity;
use App\MachineLearning\Similarity;
use App\Events\ContactSubmited;
use App\Events\CustomerSubmited;
use Pusher\Pusher;

class PageController extends Controller
{
    public function getHome(Request $req)
    {
        //SEO
        $meta_desc="Shop hoa tươi uy tín và giá cạnh tranh. Đặt hoa online, giao nhanh chóng. FlowerShop chuyên hoa chúc mừng, hoa khai trương, hoa chia buồn, lan hồ điệp";
        $meta_keywords="hoa dep cho su kien, hoa đẹp cho sự kiện FlowerShop, shop hoa, hoa tươi, giao hoa, hoa chúc mừng, hoa khai trương, hoa chia buồn, lan hồ điệp";
        $meta_title="Wendy Flowers - Đồng hành cùng khách hàng. Điện hoa chất lượng hàng đầu Việt Nam";
        $url_canonical=$req->url('front-end.layout.home');
        //
        $slides = Slide::where('status',0)->get();
        $new_product = Product::where('new',1)->where('status',0)->orderBy('id', 'desc')->paginate();
        $sanpham_khuyenmai=Product::where('promotion_price','<>',0)->where('status',0)->orderBy('id', 'desc')->paginate();
        $sanpham_banchay = Product::where('status',0)->orderBy('purchases','DESC')->paginate();
        $binhluan_hangdau=Comments_Surrendered::paginate(6);
        $blog = Blog::where('status',0)->orderby('id','desc')->paginate(3);
        $today = Carbon::now('Asia/Ho_Chi_Minh');
        $sale = SaleOfProduct::where('status',0)->where('date_start','<=',$today)->where('date_end','>=',$today)->orderby('id','desc')->paginate(1);

        return view('front-end.layout.home',compact('today','sale','blog','binhluan_hangdau','slides','new_product','sanpham_khuyenmai','sanpham_banchay','meta_desc','meta_keywords','meta_title','url_canonical'));
    }
    public function getLogin(Request $req)
    {
        $meta_desc="Shop hoa tươi uy tín và giá cạnh tranh. Đặt hoa online, giao miễn phí 2 giờ. FlowerShop chuyên hoa chúc mừng, hoa khai trương, hoa chia buồn, lan hồ điệp";
        $meta_keywords="hoa dep cho su kien, hoa đẹp cho sự kiện FlowerShop, shop hoa, hoa tươi, giao hoa, hoa chúc mừng, hoa khai trương, hoa chia buồn, lan hồ điệp";
        $meta_title="Đăng nhập - Wendy Flowers - Đồng hành cùng khách hàng. Điện hoa chất lượng hàng đầu Việt Nam";
        $url_canonical=$req->url('front-end.layout.login');

        return view('front-end.layout.login',compact('meta_desc','meta_keywords','meta_title','url_canonical'));
    }
    public function postLogin(Request $req){
        $this->validate($req,
        [
            'email'=>'required|email',
            'password'=>'required|min:6|max:32'
        ],
        [
            'email.required'=>'Vui lòng nhập email',
            'email.email'=>'Email không đúng định dạng',
            'password.required'=>'Vui lòng nhập mật khẩu',
            'password.min'=>'Mật khẩu ít nhất 6 kí tự',
            'password.max'=>'Mật khẩu không quá 32 ký tự',
        ]
        );
        $credentials = array('email'=>$req->email,'password'=>$req->password,'status'=>0);
        if(Auth::attempt($credentials)){
            return redirect()->route('home');

        }else{
            return redirect()->back()->with(['flag'=>'danger','message'=>'Đăng nhập không thành công']);
        }
    }
    public function getRegister(Request $req){
        $meta_desc="Shop hoa tươi uy tín và giá cạnh tranh. Đặt hoa online, giao miễn phí 2 giờ. FlowerShop chuyên hoa chúc mừng, hoa khai trương, hoa chia buồn, lan hồ điệp";
        $meta_keywords="hoa dep cho su kien, hoa đẹp cho sự kiện FlowerShop, shop hoa, hoa tươi, giao hoa, hoa chúc mừng, hoa khai trương, hoa chia buồn, lan hồ điệp";
        $meta_title="Đăng ký - Wendy Flowers - Đồng hành cùng khách hàng. Điện hoa chất lượng hàng đầu Việt Nam";
        $url_canonical=$req->url('front-end.layout.register');
        return view('front-end.layout.register',compact('meta_desc','meta_keywords','meta_title','url_canonical'));
    }
    public function postRegister(Request $req){
        $this->validate($req,
            [   'email'=>'required|email|unique:users,email',
                'password'=>'required|min:6|max:20',
                'name'=>'required',
                're_password'=>'required|same:password'
            ],
            [
                'email.required'=>'Vui lòng nhập email',
                'email.email'=>'Không đúng định dạng email',
                'email.unique'=>'Email đã có người sử dụng',
                'name.required'=>'Bạn chưa nhập họ tên',
                'password.required'=>'Vui lòng nhập mật khẩu',
                're_password.same'=>'Mật khẩu không giống nhau',
                'password.min'=>'Mật khẩu ít nhất 6 kí tự'
            ]);
        $user = new User();
        $user ->user_code = rand();
        $user -> name=$req->name;
        $user -> email = $req -> email;
        $user -> password = Hash::make($req->password);
        $user -> phone=$req->phone;
        $user -> address=$req->address;
        $user -> save();
        return redirect()->back()->with('thanhcong','Đã tạo tài khoản thành công');
    }
    public function postLogout(){
        Auth::logout();
        return redirect()->route('home');
    }

    public function getCategory(Request $req,$type)
    {
        $url = $req->segment(2);
        $sp_theoloai = Product::where('id_type',$type)->where('status',0)->orderby('id','desc')->paginate(9);
        if(isset($_GET['minamount']) && $_GET['maxamount'])
        {
            $min_price = $_GET['minamount'];
            $max_price = $_GET['maxamount'];
            $sp_theoloai = Product::where('id_type',$type)->where('status',0)->whereBetween('unit_price',[$min_price,$max_price])->paginate(9);
        }
        if($req->feature)
        {
            $color = $req->feature;
            $sp_theoloai = Product::where('id_type',$type)->where('feature',$color)->where('status',0)->paginate(9);
        }
        $loai=ProductType::all();
        $loai_sp = ProductType::where('id',$type)->first();
        $loai_meta = ProductType::where('id',$type)->get();
        $shop = Shop::all();
        $color = Color::all();
        $shop_products = Product::where('id_shop',$type)->get();
        foreach($loai_meta as $sp)
        {
            $meta_desc=$sp->description;
            $meta_keywords=$sp->keyword;
            $meta_title=$sp->name;
            $url_canonical=$req->url('front-end.layout.category'.$type);
        }
        return view('front-end.layout.category',compact('url','color','shop_products','shop','loai','sp_theoloai','loai_sp','meta_desc','meta_title','meta_keywords','url_canonical'));
    }
    public function holiday(Request $req, $type)
    {
        $url = $req->segment(2);
        $holiday_type=HolidaysOfYear::all();
        $holiday = HolidaysOfYear::where('id',$type)->first();
        $loai_meta = HolidaysOfYear::where('id',$type)->get();
        $product_holiday = ProductAndHoliday::where('id_holiday',$type)->paginate(9);
        foreach($loai_meta as $sp)
        {
            $meta_desc=$sp->description;
            $meta_keywords=$sp->keyword;
            $meta_title=$sp->name;
            $url_canonical=$req->url('front-end.layout.holiday'.$type);
        }
        return view('front-end.layout.holiday',compact('product_holiday','url','holiday_type','holiday','meta_desc','meta_title','meta_keywords','url_canonical'));
    }
    public function getShop(Request $req,$type)
    {
        $url = $req->segment(2);
        $sp_theoloai = Product::where('id_shop',$type)->where('status',0)->orderby('id','desc')->paginate(9);
        if(isset($_GET['minamount']) && $_GET['maxamount'])
        {
            $min_price = $_GET['minamount'];
            $max_price = $_GET['maxamount'];
            $sp_theoloai = Product::where('id_shop',$type)->where('status',0)->whereBetween('unit_price',[$min_price,$max_price])->paginate(9);
        }
        if($req->feature)
        {
            $color = $req->feature;
            $sp_theoloai = Product::where('id_shop',$type)->where('feature',$color)->where('status',0)->paginate(9);
        }
        $loai = Shop::all();
        $loai_sp = Shop::where('id',$type)->first();
        $loai_meta = Shop::where('id',$type)->get();
        $color = Color::all();
        foreach($loai_meta as $sp)
        {
            $meta_desc=$sp->description;
            $meta_keywords=$sp->keyword;
            $meta_title=$sp->name;
            $url_canonical=$req->url('front-end.layout.shop'.$type);
        }
        return view('front-end.layout.shop',compact('url','color','loai','sp_theoloai','loai_sp','meta_desc','meta_title','meta_keywords','url_canonical'));
    }
    public function quickView(Request $request)
    {
        $product_id = $request->product_id;
        $product = Product::find($product_id);
        $gallery = Image_Product::where('id_product',$product_id)->get();
        $output['product_gallery']= "" ;
        foreach($gallery as $gal)
        {
            $output['product_gallery'] ='<div class="pt"><img  src="'.$gal->image.'"></div>';
        }
        $output['product_name'] = $product->name;
        $output['product_shop'] = '<span>'.__('shop').'</span>: '.$product->product_shop->name.'';
        $output['product_category'] = ''.$product->product_type->name.'';
        $output['product_desc'] = $product->description;
        $output['product_code'] = ''.__('code').': '.$product->code_product.'';
        if($product->promotion_price==0)
        {
            $output['product_price'] = '<h4>'.number_format($product->unit_price).' VNĐ</h4>';
        }
        else{
            $output['product_price'] = '<h4>'.number_format($product->promotion_price).' VNĐ <span>'.number_format($product->unit_price).' VNĐ</span></h4>';
        }
        $output['product_star'] = ''.__('rating').': '.$product->star.' sao';
        $output['product_image'] = '<img src="'.$product->image.'">';
        $output['product_image_active'] = '<div class="pt active"><img src="'.$product->image.'"></div>';
        $output['product_add'] = '<a href="'.route('addtocart',$product->id).'" class="primary-btn pd-cart">'.__('add_cart').'</a>';
        $output['product_color'] = '<div class="cc-item"><i style="color:'.$product->product_color->code.'" class="fa fa-tint"></i>  '.$product->product_color->name.'</div>';
        echo json_encode($output);
    }
    public function getProductDetails(Request $req, $id)
    {
        $image = Image_Product::where('id_product',$id)->get();
        $comment=Comment::where('id_product',$id)->get();
        $sanpham=Product::where('id',$req->id)->first();
        $user=User::where('id',$req->id)->first();
        $sp_tuongtu=Product::where('id_type',$sanpham->id_type)->paginate(4);
        $sanpham_khuyenmai=Product::where('promotion_price','<>',0)->paginate(4);
        $new_product = Product::where('new',1)->paginate(4);
        $sanpham_meta=Product::where('id',$req->id)->get();
        foreach($sanpham_meta as $sp)
        {
            $meta_desc=$sp->description;
            $meta_keywords=$sp->name;
            $meta_title=$sp->name;
            $url_canonical=$req->url('front-end.layout.productdetails'.$id);
        }
        //Đánh giá ngôi sao//
        $rating=Comment::where('id_product',$id)->avg('star');
        $rating=round($rating);
        //
        //Lượt mua//
        $purchases=BillDetail::where('id_product',$id)->sum('quantity');
        //

        //Lượt xem
        $product=Product::where('id',$req->id)->first();
        $product->product_views=$product->product_views + 1;
        $product->star= $rating;
        $product->purchases = $purchases;
        $product->save();

        //Machine Learning
        $products        = json_decode(file_get_contents(storage_path('data/products-data.json')));
        $selectedId      = intval($req->id ?? '1');
        $selectedProduct = $products[0];

        $selectedProducts = array_filter($products, function ($product) use ($selectedId) { return $product->id === $selectedId; });
        if (count($selectedProducts)) {
            $selectedProduct = $selectedProducts[array_keys($selectedProducts)[0]];
        }

        $productSimilarity = new ProductSimilarity($products);
        $similarityMatrix  = $productSimilarity->calculateSimilarityMatrix();
        $products          = $productSimilarity->getProductsSortedBySimularity($selectedId, $similarityMatrix);
        //

        return view('front-end.layout.productdetails',compact('image','similarityMatrix','productSimilarity','selectedProducts','selectedProduct','products','selectedId','sanpham_meta','rating','product','sanpham','sp_tuongtu','sanpham_khuyenmai','new_product','comment','user','meta_desc','meta_title','meta_keywords','url_canonical'));
    }

    public function getAddtoCart(Request $req,$id)
    {
            $product=Product::find($id);
            $oldCar=Session('cart')?Session::get('cart'):null;
            $cart=new Cart($oldCar);
            $cart->add($product,$id);
            $req->session()->put('cart',$cart);
            return redirect()->back();
    }
    public function getDelItemCart($id){
        $SsCart =Session::has('cart')?Session::get('cart'):null;
        $cart=new Cart($SsCart);
        $cart->removeItem($id);
        if(count($cart->items)>0){
            Session::put('cart', $cart);
        }else{
            Session::forget('cart');
        }
        return redirect()->back();
    }
    public function getCheckout(Request $req){
        $meta_desc="Shop hoa tươi uy tín và giá cạnh tranh. Đặt hoa online, giao miễn phí 2 giờ. FlowerShop chuyên hoa chúc mừng, hoa khai trương, hoa chia buồn, lan hồ điệp";
        $meta_keywords="hoa dep cho su kien, hoa đẹp cho sự kiện FlowerShop, shop hoa, hoa tươi, giao hoa, hoa chúc mừng, hoa khai trương, hoa chia buồn, lan hồ điệp";
        $meta_title="Đặt hàng - Wendy Flowers - Đồng hành cùng khách hàng. Điện hoa chất lượng hàng đầu Việt Nam";
        $url_canonical=$req->url('front-end.layout.checkout');
        $coupon_user = Coupon::where('coupon_user',1)->where('status',0)->get();
        $provincial = Address_Provincial::orderby('matp','ASC')->get();
        return view('front-end.layout.checkout',compact('provincial','coupon_user','meta_desc','meta_title','meta_keywords','url_canonical'));
    }
    public function select_delivery(Request $request){
    	$data = $request->all();
    	if($data['action']){
    		$output = '';
    		if($data['action']=="city"){
    			$select_province = Address_District::where('matp',$data['ma_id'])->orderby('maqh','ASC')->get();
    				$output.='<option>---Chọn Quận/Huyện---</option>';
    			foreach($select_province as $key => $province){
    				$output.='<option value="'.$province->maqh.'">'.$province->name.'</option>';
    			}

    		}else{

    			$select_wards = Address_Wards::where('maqh',$data['ma_id'])->orderby('xaid','ASC')->get();
    			$output.='<option>---Chọn Xã/Phường/Thị trấn---</option>';
    			foreach($select_wards as $key => $ward){
    				$output.='<option value="'.$ward->xaid.'">'.$ward->name.'</option>';
    			}
    		}
    		echo $output;
    	}

    }
    public function postCheckout(Request $req){
        $cart=Session::get('cart');

        $customer = new Customer;
        $customer->user_code=$req->user_code;
        $customer->name = $req->name;
        $customer->gender = $req->gender;
        $customer->email = $req->email;
        $customer->address_provicial = $req->city;
        $customer->address_district = $req->province;
        $customer->address_wards = $req->wards;
        $customer->address_streets = $req->address_streets;
        $customer->phone_number = $req->phone;
        $customer->note = $req->notes;
        $customer->token=$req->_token;

        if($req->total_coupon)
        {
            $customer->total=$req->total_coupon;
        }else{
            $customer->total=$cart->totalPrice;
        }

        $customer->save();


        $bill=new Bill;
        $bill->id_customer = $customer->id;
        $bill->date_order = date('Y-m-d');
        $bill->total = $cart->totalPrice;
        $bill->ship=$req->ship;
        $bill->code = $req->number;
        $bill->total_coupon=$req->total_coupon;
        $bill->payment = $req->payment_method;
        $bill->note = $req->notes;
        $bill->save();

        foreach ($cart->items as $key => $value) {
            $bill_detail=new BillDetail;
            $bill_detail->id_bill = $bill->id;
            $bill_detail->id_product = $key;
            $bill_detail->quantity = $value['qty'];
            $bill_detail->unit_price=$value['price']/$value['qty'];
            $bill_detail->save();
        }

        // Mail::send('front-end.layout.mail',[
        //     'customer'=>$customer,
        //     'c_name'=>$customer->name,
        //     'c_ma'=>$customer->token,
        //     'c_dateorder'=>$bill->date_order,
        //     'items'=>$cart->items,
        //     'c_total'=> $bill->total,
        //     'c_coupon'=>$bill->code,
        //     'c_total_coupon'=>$bill->total_coupon,
        //     'c_notes'=>$bill->note,


        // ],function($mesage) use($customer)
        // {
        //     $mesage->from('luckyluke9102000@gmail.com','Flower Shop');
        //     $mesage->to($customer->email,$customer->name);
        //     $mesage->subject('Đặt hàng thành công');
        // });

        Session::forget('coupon');
        Session::forget('cart');
        //Notification Customer
        event(new CustomerSubmited($customer));

        return redirect()->back()->with('thongbao','Bạn đã đặt hàng thành công.');
    }
    public function check_coupon(Request $req)
    {
        $today = Carbon::now('Asia/Ho_Chi_Minh');
        $data = $req->all();
        $coupon = Coupon::where('code',$data['coupon'])->where('status',0)->where('date_start','<=',$today)->where('date_end','>=',$today)->where('time','>',0)->first();
        if($coupon){
            $count_coupon = $coupon->count();
            if($count_coupon > 0 ){
                $coupon_session= Session::get('coupon');
                if($coupon_session == true){
                    $is_avaiable = 0;
                    if($is_avaiable == 0){
                        $cou[]=array(
                            'code'=>$coupon->code,
                            'condition'=>$coupon->condition,
                            'number'=>$coupon->number,
                        );
                        Session::put('coupon',$cou);
                    }
                }
                else
                {
                    $cou[]=array(
                        'code'=>$coupon->code,
                        'condition'=>$coupon->condition,
                        'number'=>$coupon->number,
                    );
                    Session::put('coupon',$cou);
                }
                $coupon->time = $coupon->time - 1;
                $coupon->save();
                Session::save();
                return redirect('checkout')->with('thongbao','Mã giảm giá đã được áp dụng');
            }
        }else{
            return redirect('checkout')->with('thongbao','Mã không đúng hoặc đã hết hạn');
        }
    }
    public function unset_coupon()
    {
        $coupon=Session::get('coupon');
        if($coupon==true){
            Session::forget('coupon');
            return redirect()->back()->with('thongbao',''.__('delete_coupon_success').'');
        }
    }
    public function getCart(Request $req)
    {
        $meta_desc="Shop hoa tươi uy tín và giá cạnh tranh. Đặt hoa online, giao miễn phí 2 giờ. Wendy Flowers chuyên hoa chúc mừng, hoa khai trương, hoa chia buồn, lan hồ điệp";
        $meta_keywords="hoa dep cho su kien, hoa đẹp cho sự kiện Wendy Flowers, shop hoa, hoa tươi, giao hoa, hoa chúc mừng, hoa khai trương, hoa chia buồn, lan hồ điệp";
        $meta_title="Giỏ hàng - Wendy Flowers - Đồng hành cùng khách hàng. Điện hoa chất lượng hàng đầu Việt Nam";
        $url_canonical=$req->url('front-end.layout.cart');
        $SsCart=Session::get('cart');
        $cart = new Cart($SsCart);
        return view('front-end.layout.cart',compact('meta_desc','meta_keywords','meta_title','url_canonical'))->with(['cart','product_cart'=>$cart->items,'totalPrice'=>$cart->totalPrice,'totalQty'=>$cart->totalQty]);;
    }
    public function cartItemUpdate(Request $request,$id)
    {
        $product = Product::find($id);
        $oldCar=Session('cart')?Session::get('cart'):null;
        $cart = new Cart($oldCar);
        $quantity=$request->qty;
        $cart->addItem($product,$id,$quantity);
        $request->session()->put('cart',$cart);
        return redirect()->back();
    }
    public function cartUpdate(Request $request, $id) {
        if($request->ajax()){
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $quantity = $request->qty;
        $product = Product::find($id);
        $cart->updateItem($product, $id, $quantity);
        Session::put('cart', $cart);
        }
    }
    public function getSearch(Request $req)
    {

        $meta_desc="Shop hoa tươi uy tín và giá cạnh tranh. Đặt hoa online, giao miễn phí 2 giờ. Wendy Flowers chuyên hoa chúc mừng, hoa khai trương, hoa chia buồn, lan hồ điệp";
        $meta_keywords="hoa dep cho su kien, hoa đẹp cho sự kiện Wendy Flowers, shop hoa, hoa tươi, giao hoa, hoa chúc mừng, hoa khai trương, hoa chia buồn, lan hồ điệp";
        $meta_title="Tìm kiếm - Wendy Flowers - Đồng hành cùng khách hàng. Điện hoa chất lượng hàng đầu Việt Nam";
        $url_canonical=$req->url('client.layout.search');
        $product = Product::where('name','like','%'.$req->key.'%')
                            ->orWhere('unit_price',$req->key)
                            // ->orWhere('shop','like','%'.$req->key.'%')
                            ->orWhere('description','like','%'.$req->key.'%')
                            ->paginate(9);
        return view('front-end.layout.search',compact('req','product','meta_desc','meta_keywords','meta_title','url_canonical'));
    }
    public function postComment($id,Request $req)
    {
        $id_product=$id;
        $comment=new Comment;
        $comment->id_product=$id_product;
        $comment->id_user = Auth::user()->id;
        $comment->star=$req->star;
        $comment->NoiDung=$req->NoiDung;
        $comment->save();

        return redirect()->back()->with('thongbao','Bình luận thành công');

    }
    public function getProfileUser(Request $req)
    {
        $meta_desc="Shop hoa tươi uy tín và giá cạnh tranh. Đặt hoa online, giao miễn phí 2 giờ. Wendy Flowers chuyên hoa chúc mừng, hoa khai trương, hoa chia buồn, lan hồ điệp";
        $meta_keywords="hoa dep cho su kien, hoa đẹp cho sự kiện Wendy Flowers, shop hoa, hoa tươi, giao hoa, hoa chúc mừng, hoa khai trương, hoa chia buồn, lan hồ điệp";
        $meta_title="Hồ sơ - Người dùng - Wendy Flowers - Đồng hành cùng khách hàng. Điện hoa chất lượng hàng đầu Việt Nam";
        $url_canonical=$req->url('front-end.layout.profile');
        $tong_dt=DB::table('customer')
                ->where('user_code',Auth::user()->user_code)
                ->sum('total');
        $total_tt=User::where('user_code',Auth::user()->user_code)->first();
        $total_tt->total=$tong_dt;
        $total_tt->save();
        $coupon_user = Coupon::where('coupon_user',1)->get();

        return view('front-end.layout.profile',compact('coupon_user','meta_desc','meta_keywords','meta_title','url_canonical'));
    }
    public function postProfileUser(Request $req,$id)
    {
        $meta_desc="Shop hoa tươi uy tín và giá cạnh tranh. Đặt hoa online, giao miễn phí 2 giờ. Wendy Flowers chuyên hoa chúc mừng, hoa khai trương, hoa chia buồn, lan hồ điệp";
        $meta_keywords="hoa dep cho su kien, hoa đẹp cho sự kiện Wendy Flowers, shop hoa, hoa tươi, giao hoa, hoa chúc mừng, hoa khai trương, hoa chia buồn, lan hồ điệp";
        $meta_title="Hồ sơ - Người dùng - Wendy Flowers - Đồng hành cùng khách hàng. Điện hoa chất lượng hàng đầu Việt Nam";
        $url_canonical=$req->url('front-end.layout.profile');
        $user = User::find($id);
        $user->name=$req->name;
        $user->address=$req->address;
        $user->phone=$req->phone;
        if($req->hasFile('image'))
        {
            $file=$req->file('image');
            $extension = $file->getClientOriginalExtension();
                if($extension != 'jpg' && $extension != 'png' && $extension != 'jpeg'&& $extension != 'PNG')
                {
                    return redirect('profile-user/')->with('thongbao','Bạn chỉ được nhập file có đuôi jpg, png, jpeg');
                }
                $image=$file->getClientOriginalName();
                $image=Str::random(4)."_".$image;
                while(file_exists("client_asset/image/slide".$image))
                {
                    $image=Str::random(4)."_".$image;
                }
                $file->move("client_asset/image/slide",$image);
                $user->image=$image;
        }
        $user->save();
        return redirect('profile-user/')->with('thongbao','Cập nhật thành công');
    }
    public function getProfileCoupon(Request $req)
    {
        $meta_desc="Shop hoa tươi uy tín và giá cạnh tranh. Đặt hoa online, giao miễn phí 2 giờ. Wendy Flowers chuyên hoa chúc mừng, hoa khai trương, hoa chia buồn, lan hồ điệp";
        $meta_keywords="ma giam gia,hoa dep cho su kien, hoa đẹp cho sự kiện Wendy Flowers, shop hoa, hoa tươi, giao hoa, hoa chúc mừng, hoa khai trương, hoa chia buồn, lan hồ điệp";
        $meta_title="Mã giảm giá - Wendy Flowers - Đồng hành cùng khách hàng. Điện hoa chất lượng hàng đầu Việt Nam";
        $url_canonical=$req->url('front-end.layout.coupon');
        $tong_dt=DB::table('customer')
                ->where('user_code',Auth::user()->user_code)
                ->sum('total');
        $total_tt=User::where('user_code',Auth::user()->user_code)->first();
        $total_tt->total=$tong_dt;
        $total_tt->save();
        $coupon_user = Coupon::where('coupon_user',1)->where('status',0)->get();
        return view('front-end.layout.coupon',compact('coupon_user','meta_desc','meta_keywords','meta_title','url_canonical'));
    }
    public function getPurchaseHistory(Request $req)
    {
        $meta_desc="Shop hoa tươi uy tín và giá cạnh tranh. Đặt hoa online, giao miễn phí 2 giờ. Wendy Flowers chuyên hoa chúc mừng, hoa khai trương, hoa chia buồn, lan hồ điệp";
        $meta_keywords="hoa dep cho su kien, hoa đẹp cho sự kiện Wendy Flowers, shop hoa, hoa tươi, giao hoa, hoa chúc mừng, hoa khai trương, hoa chia buồn, lan hồ điệp";
        $meta_title="Lịch sử mua hàng - Wendy Flowers - Đồng hành cùng khách hàng. Điện hoa chất lượng hàng đầu Việt Nam";
        $url_canonical=$req->url('front-end.layout.purchase_history');
        $coupon_user = Coupon::where('coupon_user',1)->get();
        $this->data['title'] = 'Lịch sử mua hàng';
        $customers = DB::table('customer')
                    ->orderBy('id', 'desc')
                    ->get();
        $this->data['customers'] = $customers;

        if($req->date_form && $req->date_to)
        {
            $customers = DB::table('customer')
            ->orderBy('id', 'desc')
            ->whereBetween('created_at',[$req->date_form,$req->date_to])
            ->get();
            $this->data['customers'] = $customers;
        }
        return view('front-end.layout.purchase_history', $this->data,compact('coupon_user','meta_desc','meta_keywords','meta_title','url_canonical'));
    }
    public function getContact( Request $req)
    {
        $meta_desc="Shop hoa tươi uy tín và giá cạnh tranh. Đặt hoa online, giao miễn phí 2 giờ. Wendy Flowers chuyên hoa chúc mừng, hoa khai trương, hoa chia buồn, lan hồ điệp";
        $meta_keywords="lien he qua website Wendy Flowers,hoa dep cho su kien, hoa đẹp cho sự kiện Wendy Flowers, shop hoa, hoa tươi, giao hoa, hoa chúc mừng, hoa khai trương, hoa chia buồn, lan hồ điệp";
        $meta_title="Liên hệ - Wendy Flowers - Đồng hành cùng khách hàng. Điện hoa chất lượng hàng đầu Việt Nam";
        $url_canonical=$req->url('front-end.layout.contact');
        return view('front-end.layout.contact',compact('meta_desc','meta_keywords','meta_title','url_canonical'));
    }
    public function postContact(Request $req)
    {
        $contact = new Contact;
        $contact->name = $req->name;
        $contact->email = $req->email;
        $contact->description = $req->description;
        $contact->save();
        event(new ContactSubmited($contact));
        return redirect()->back()->with('thongbao','Gửi phản hồi thành công');
    }
    public function getBlog(Request $req)
    {
        $meta_desc="Shop hoa tươi uy tín và giá cạnh tranh. Đặt hoa online, giao miễn phí 2 giờ. Wendy Flowers chuyên hoa chúc mừng, hoa khai trương, hoa chia buồn, lan hồ điệp";
        $meta_keywords="Dien dan website Wendy Flowers,bai viet hay tren Wendy Flowers,hoa dep cho su kien, hoa đẹp cho sự kiện Wendy Flowers, shop hoa, hoa tươi, giao hoa, hoa chúc mừng, hoa khai trương, hoa chia buồn, lan hồ điệp";
        $meta_title="Diễn đàn - Wendy Flowers - Đồng hành cùng khách hàng. Điện hoa chất lượng hàng đầu Việt Nam";
        $url_canonical=$req->url('front-end.layout.blog');

        $blog_type = BlogType::where('status',0)->get();
        $blog_nearest = Blog::where('status',0)->paginate(4);
        $blog = Blog::where('status',0)->paginate(9);
        return view('front-end.layout.blog',compact('blog_nearest','blog','blog_type','meta_desc','meta_keywords','meta_title','url_canonical'));
    }
    public function getBlogDetails(Request $req, $id)
    {
        $blog_details = Blog::where('id',$req->id)->where('status',0)->first();
        $blog_type = BlogType::where('status',0)->get();
        $blog_nearest = Blog::where('status',0)->paginate(4);
        $blog_next = Blog::where('status',0)->where('id','>',$req->id)->paginate(1);
        $blog_previous = Blog::where('status',0)->where('id','<',$req->id)->paginate(1);
        $blog_meta = Blog::where('id',$req->id)->get();
        foreach($blog_meta as $sp)
        {
            $meta_desc=$sp->description;
            $meta_keywords=$sp->name;
            $meta_title=$sp->name;
            $url_canonical=$req->url('front-end.layout.blog_details'.$id);
        }
        return view('front-end.layout.blog_details',compact('blog_previous','blog_next','blog_nearest','blog_type','blog_meta','blog_details','meta_desc','meta_title','meta_keywords','url_canonical'));
    }
    public function getLanguage(Request $request,$language)
    {
        if($language){
            Session::put('language',$language);
        }
        return redirect()->back();
    }
}

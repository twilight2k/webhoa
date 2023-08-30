<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
use App\Models\Shop;
use App\Models\Color;
use App\Models\User;
use App\Models\Level;
use App\Models\Comments_Surrendered;
use Illuminate\Support\Facades\DB;
use Auth;
use Hash;
use Session;
use Mail;
use File;
use Srmklive\PayPal\Services\ExpressCheckout;
use App\Exports\ProductExport;
use App\Imports\ProductImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Str;
use App\Events\ProductUpdated;

class AdminController extends Controller
{
    public function getHome()
    {
        $re_product = Product::where('status', 0)->get();
        $re_contact = Contact::get();
        $re_user = User::where('status', 0)->where('id_levels', 3)->get();
        $total = Customer::where('status', 3)->sum('total');
        $total_rev1 = Customer::whereMonth('created_at', date('1'))->where('status', 3)->sum('total');
        $total_rev2 = Customer::whereMonth('created_at', date('2'))->where('status', 3)->sum('total');
        $total_rev3 = Customer::whereMonth('created_at', date('3'))->where('status', 3)->sum('total');
        $total_rev4 = Customer::whereMonth('created_at', date('4'))->where('status', 3)->sum('total');
        $total_rev5 = Customer::whereMonth('created_at', date('5'))->where('status', 3)->sum('total');
        $total_rev6 = Customer::whereMonth('created_at', date('6'))->where('status', 3)->sum('total');
        $total_rev7 = Customer::whereMonth('created_at', date('7'))->where('status', 3)->sum('total');
        $total_rev8 = Customer::whereMonth('created_at', date('8'))->where('status', 3)->sum('total');
        $total_rev9 = Customer::whereMonth('created_at', date('9'))->where('status', 3)->sum('total');
        $total_rev10 = Customer::whereMonth('created_at', date('10'))->where('status', 3)->sum('total');
        $total_rev11 = Customer::whereMonth('created_at', date('11'))->where('status', 3)->sum('total');
        $total_rev12 = Customer::whereMonth('created_at', date('12'))->where('status', 3)->sum('total');

        return view('back-end.layout.home')->with(compact('total_rev1', 'total_rev2', 'total_rev3', 'total_rev4', 'total_rev5', 'total_rev6', 'total_rev7', 'total_rev8', 'total_rev9', 'total_rev10', 'total_rev11', 'total_rev12', 'total', 're_product', 're_contact', 're_user'));
    }
    public function getAdminLogin()
    {
        return view('back-end.layout.login');
    }
    public function postdangnhapAdmin(Request $req)
    {
        $this->validate(
            $req,
            [
                'email' => 'required',
                'password' => 'required|min:3|max:32',

            ],
            [
                'email.required' => 'Bạn chưa nhập email',
                'password.min' => 'Mật khẩu phải có nhiều hơn 3 ký tự',
                'password.max' => 'Mật khẩu phải có ít hơn 32 ký tự',
            ]
        );
        if (Auth::attempt(['email' => $req->email, 'password' => $req->password])) {
            return redirect('admin/home/');
        } else {
            return redirect('admin/login')->with('thongbao', 'Đăng nhập không thành công');
        }
    }
    public function getAdminLogout()
    {
        Auth::logout();
        return view('back-end.layout.login');
    }
    public function getUser()
    {
        $user = User::all();
        return view('back-end.layout.users', compact('user'));
    }
    public function postAddUser(Request $req)
    {
        $this->validate(
            $req,
            [
                'name' => 'required|min:3',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|min:3|max:32',
                're_password' => 'required|same:password',
            ],
            [
                'name.required' => 'Bạn chưa nhập tên người dùng',
                'name.min' => 'Tên người dùng phải từ 3 ký tự trở lên',
                'email.required' => 'Bạn chưa nhập email',
                'email.email' => 'Bạn chưa nhập đúng định dạng email',
                'email.unique' => 'Email đã tồn tại',
                'password.min' => 'Mật khẩu phải có nhiều hơn 3 ký tự',
                'password.max' => 'Mật khẩu phải có ít hơn 32 ký tự',
                're_password.required' => 'Bạn chưa nhập lại password',
                're_password.same' => 'Mật khẩu nhập lại chưa khớp',

            ]
        );
        $user = new User;
        $user->user_code = rand();
        $user->name = $req->name;
        $user->email = $req->email;
        $user->password = bcrypt($req->password);
        $user->id_levels = $req->id_levels;
        $user->save();
        return redirect('admin/user/list-user')->with('thongbao', 'Đã tạo tài khoản người dùng thành công');
    }
    public function getEditUser($id)
    {
        $user = User::find($id);
        return view('back-end.layout.edit_user', compact('user'));
    }
    public function postEditUser(Request $req, $id)
    {
        $this->validate(
            $req,
            [
                'name' => 'required|min:3',
            ],
            [
                'name.required' => 'Bạn chưa nhập tên người dùng',
                'name.min' => 'Tên người dùng phải từ 3 ký tự trở lên',
            ]
        );
        $user = User::find($id);
        $user->status = $req->status;
        $user->name = $req->name;
        $user->id_levels = $req->id_levels;

        if ($req->changePassword == "on") {
            $this->validate(
                $req,
                [
                    'password' => 'required|min:3|max:32',
                    're_password' => 'required|same:password',
                ],
                [
                    'password.min' => 'Mật khẩu phải có nhiều hơn 3 ký tự',
                    'password.max' => 'Mật khẩu phải có ít hơn 32 ký tự',
                    're_password.required' => 'Bạn chưa nhập lại password',
                    're_password.same' => 'Mật khẩu nhập lại chưa khớp',
                ]
            );
            $user->password = bcrypt($req->password);
        }
        $user->save();
        return redirect('admin/user/edit/' . $id)->with('thongbao', 'Sửa tài khoản người dùng thành công');
    }
    public function postDeleteUser($id)
    {
        $user = User::find($id);
        $comment = Comment::where('id_user', $id); //Tìm các comment của user
        $comment->delete(); //Xóa các comment của user
        $user->delete(); //Xóa user
        return redirect('admin/user/list-user')->with('thongbao', 'Đã xóa tài khoản người dùng thành công');
    }
    public function doUpdateAccessRole($id, Request $request)
    {
        $place_id = $request->get('id');
        $Role = User::findOrFail($id);
        $Role->user_access_role_id_fk = $id_role;
        $Role->update($request->all());
        return 'success';
    }
    public function getCategory()
    {
        $product_type = ProductType::all();
        return view('back-end.layout.category', compact('product_type'));
    }
    public function postAddCategory(Request $req)
    {
        $this->validate(
            $req,
            [
                'name' => 'required|min:3|max:100',
                'description' => 'required'
            ],
            [
                'name.required' => 'Bạn chưa nhập tên thể loại',
                'name.min' => 'Tên thể loại phải có độ dài từ 3 - 100 ký tự',
                'name.max' => 'Tên thể loại phải có độ dài từ 3 - 100 ký tự',
            ]
        );
        $product_type = new ProductType();
        $product_type->name = $req->name;
        $product_type->description = $req->description;
        $product_type->save();
        return redirect('admin/category/list-category')->with('thongbao', 'Thêm thể loại thành công');
    }
    public function postDeleteCategory($id)
    {
        $product_type = ProductType::find($id);
        $product_type->delete();
        return redirect('admin/category/list-category')->with('thongbao', 'Xóa thể loại thành công');
    }
    public function getEditCategory($id)
    {
        $product_type = ProductType::find($id);
        return view('back-end.layout.edit_category', compact('product_type'));
    }
    public function postEditCategory(Request $req, $id)
    {
        $product_type = ProductType::find($id);
        $this->validate(
            $req,
            [
                'name' => 'required|min:3|max:100',
                'description' => 'required',
            ],
            [
                'name.required' => 'Bạn chưa nhập tên thể loại',
                'name.unique' => 'Tên thể loại bị trùng',
                'name.min' => 'Tên thể loại phải có độ dài từ 3 - 100 ký tự',
                'name.max' => 'Tên thể loại phải có độ dài từ 3 - 100 ký tự',

            ]
        );
        $product_type->status = $req->status;
        $product_type->name = $req->name;
        $product_type->description = $req->description;
        $product_type->save();

        return redirect('admin/category/edit/' . $id)->with('thongbao', 'Sửa thể loại thành công');
    }
    public function getProduct()
    {
        $product = Product::orderby('id', 'desc')->get();
        $product_type = ProductType::all();
        $shop = Shop::all();
        return view('back-end.layout.product', compact('product', 'product_type', 'shop'));
    }
    public function getAddProduct()
    {
        $shop = Shop::where('status', 0)->get();
        $product_type  = ProductType::where('status', 0)->get();
        $color = Color::get();
        return view('back-end.layout.add_product', compact('color', 'shop', 'product_type'));
    }
    public function getAddProducts()
    {
        return view('back-end.layout.add_products_excel');
    }
    public function postAddProduct(Request $req)
    {
        $this->validate(
            $req,
            [
                'name' => 'required|min:3|max:100',
                'description' => 'required',
                'id_type' => 'required',
                'unit_price' => 'required',
                'image' => 'required',
                // 'unit' => 'required',
                'new' => 'required',
                'image' => 'required'
            ],
            [
                'name.required' => 'Bạn chưa nhập tên thể loại',
                'name.min' => 'Tên thể loại phải có độ dài từ 3 - 100 ký tự',
                'name.max' => 'Tên thể loại phải có độ dài từ 3 - 100 ký tự',
                'image.required'=> 'Bạn chưa thêm ảnh sản phẩm',
                'id_type.required' => 'Bạn chưa chọn danh mục thể loại',
                'unit_price.required' => 'Bạn cần thêm giá sản phẩm'
            ]
        );
        $product = new Product();
        $product->code_product = $req->code_product;
        $product->name = $req->name;
        $product->feature = $req->feature;
        $product->description = $req->description;
        $product->id_shop = $req->id_shop;
        $product->id_type = $req->id_type;
        $product->unit_price = $req->unit_price;
        if ($req->promotion_price) {
            $product->promotion_price = $req->promotion_price;
        }
        // $product->image = $req->image;

        if ($req->hasFile('image')) {
            $file = $req->image;
            // Lấy tên file
            $fileName = $file->getClientOriginalName();
            // Lấy đuôi file
            echo $file->getClientOriginalExtension();
            // Lấy kích thước file
            echo $file->getSize();
            $path = $file->move('public/shop_images', $file->getClientOriginalName());
            $imagePath = 'public/shop_images/' . $fileName;
            $product->image = $imagePath;
        }

        $product->unit = $req->unit;
        $product->new = $req->new;
        $product->save();
        $product_id = $product->id;
        if ($req->image_dk_1) {
            $product = new Image_Product;
            $product->id_product = $product_id;
            $product->image = $req->image_dk_1;
            $product->save();
        }
        if ($req->image_dk_2) {
            $product = new Image_Product;
            $product->id_product = $product_id;
            $product->image = $req->image_dk_2;
            $product->save();
        }
        $data = Product::all();
        $products = $data->toJson();
        File::put(storage_path('data/products-data.json'), $products);

        //notification
        event(new ProductUpdated($product));
        return redirect('admin/product/add')->with('thongbao', 'Thêm sản phẩm thành công');
    }
    public function getEditProduct($id)
    {
        $comment = Comment::where('id_product', $id)->get();
        $product_type = ProductType::all();
        $shop = Shop::all();
        $color = Color::all();
        $product = Product::find($id);
        $pr_image = Image_Product::where('id_product', $id)->get();
        return view('back-end.layout.edit_product', compact('color', 'pr_image', 'product_type', 'product', 'comment', 'shop'));
    }
    public function postEditProduct(Request $req, $id)
    {
        $this->validate(
            $req,
            [
                'name' => 'required|min:3|max:100',
                'description' => 'required',
                'id_type' => 'required',
                // 'unit_price' => 'required',
                // 'promotion_price' => 'required',
                // 'unit' => 'required',
                // 'new' => 'required'

            ],
            [
                'name.required' => 'Bạn chưa nhập tên thể loại',
                'name.min' => 'Tên thể loại phải có độ dài từ 3 - 100 ký tự',
                'name.max' => 'Tên thể loại phải có độ dài từ 3 - 100 ký tự',
                'image.required' => 'Bạn chưa chọn ảnh',
                'image.image' => 'Tệp tải lên không phải là hình ảnh',
                'image.mimes' => 'Chỉ hỗ trợ các định dạng hình ảnh: jpeg, png, jpg, gif',
            ]
        );
        $product = Product::find($id);
        $product->status = $req->status;
        $product->code_product = $req->code_product;
        $product->name = $req->name;
        $product->feature = $req->feature;
        $product->description = $req->description;
        $product->id_shop = $req->id_shop;
        $product->id_type = $req->id_type;
        $product->unit_price = $req->unit_price;
        $product->promotion_price = $req->promotion_price;
        $product->unit = $req->unit;
        $product->new = $req->new;
        $product->image = $req-> image;


        if ($req->hasFile('image')) {
            $file = $req->image;
            // Lấy tên file
            $fileName = $file->getClientOriginalName();
            // Lấy đuôi file
            echo $file->getClientOriginalExtension();
            // Lấy kích thước file
            echo $file->getSize();
            $path = $file->move('public/shop_images', $file->getClientOriginalName());
            $imagePath = 'public/shop_images/' . $fileName;
            $product ->image = $imagePath;
        }


        $product->save();
        // if ($req->image) {

        //     $product->image = $req->image;
        // }
        // if ($req->image_dk_1) {
        //     $product = Image_Product::where('id_product', $id)->find($id);
        //     $product->image = $req->image_dk_1;
        //     $product->save();
        // }
        // if ($req->image_dk_2) {
        //     if (isset($req->image_dk_2)) {
        //         $product = new Image_Product;
        //         $product->id_product = $id;
        //         $product->image = $req->image_dk_2;
        //         $product->save();
        //     } else {
        //         $product = Image_Product::where('id_product', $id)->find($id);
        //         $product->image = $req->image_dk_2;
        //         $product->save();
        //     }
        // }
        $data = Product::all();
        $products = $data->toJson();
        File::put(storage_path('data/products-data.json'), $products);
        return redirect('admin/product/edit/' . $id)->with('thongbao', 'Sửa thành công');
    }
    public function postDeleteProduct($id)
    {
        $comment = Comment::where('id_product', $id);
        $comment->delete();
        $product = Product::find($id);
        $image_dk = Image_Product::where('id_product', $id)->delete();
        $destinationPath = $product->image;
        $product->delete();
        if (file_exists($destinationPath)) {
            unlink($destinationPath);
        }
        $data = Product::all();
        $products = $data->toJson();
        File::put(storage_path('data/products-data.json'), $products);
        return redirect('admin/product/list-product')->with('thongbao', 'Xóa sản phẩm thành công');
    }
    //Import and Export file Excel
    public function importExportView()
    {
        return view('import');
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function export()
    {
        return Excel::download(new ProductExport, 'products-flowershopdalat.xlsx');
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function import()
    {
        Excel::import(new ProductImport, request()->file('file'));

        return redirect('admin/product/adds')->with('thongbao', 'Thêm file sản phẩm thành công');
    }
    /////
    public function getupdatefile()
    {
        return view('back-end.layout.update_file');
    }

    public function getCoupon()
    {
        $coupon = Coupon::all();
        // $coupon = Coupon::orderby('id','DESC')->get();
        $today = Carbon::now('Asia/Ho_Chi_Minh');
        return view('back-end.layout.coupon')->with(compact('coupon', 'today'));
    }
    public function postAddCoupon(Request $req)
    {
        $data = $req->all();
        $coupon = new Coupon;
        $coupon->date_start = $data['date_start'];
        $coupon->date_end = $data['date_end'];
        $coupon->name = $data['name'];
        $coupon->code = $data['code'];
        $coupon->time = $data['time'];
        $coupon->condition = $data['condition'];
        $coupon->number = $data['number'];
        $coupon->save();

        return redirect('admin/coupon/list-coupon')->with('thongbao', 'Thêm mã giảm giá thành công');
    }
    public function postDeleteCoupon($id)
    {
        $coupon = Coupon::find($id);
        $coupon->delete();
        return redirect('admin/coupon/list-coupon')->with('thongbao', 'Xóa mã giảm giá thành công');
    }
    public function getEditCoupon($id)
    {
        $coupon = Coupon::find($id);
        return view('back-end.layout.edit_coupon')->with(compact('coupon'));
    }
    public function postEditCoupon(Request $req, $id)
    {
        $coupon = Coupon::find($id);
        $this->validate(
            $req,
            [
                'name' => 'required|min:3|max:100',
                'code' => 'required',
            ],
            [
                'name.required' => 'Bạn chưa nhập tên thể loại',
                'name.unique' => 'Tên thể loại bị trùng',
                'name.min' => 'Tên thể loại phải có độ dài từ 3 - 100 ký tự',
                'name.max' => 'Tên thể loại phải có độ dài từ 3 - 100 ký tự',

            ]
        );
        $coupon->status = $req->status;
        $coupon->name = $req->name;
        $coupon->code = $req->code;
        $coupon->date_start = $req->date_start;
        $coupon->date_end = $req->date_end;
        $coupon->time = $req->time;
        $coupon->condition = $req->condition;
        $coupon->number = $req->number;
        $coupon->save();

        return redirect('admin/coupon/edit/' . $id)->with('thongbao', 'Sửa mã giảm giá thành công');
    }
    public function getEvent()
    {
        $event = Slide::get();
        return view('back-end.layout.event')->with(compact('event'));
    }
    public function getAddEvent()
    {
        return view('back-end.layout.add_event');
    }
    public function postAddEvent(Request $req)
    {
        $this->validate(
            $req,
            [
                'link' => 'required',
                'image' => 'required',
            ],
            [
                'link.required' => 'Bạn chưa nhập đường dẫn truy cập',
                'image.required' => 'Bạn chưa nhập hình ảnh',
            ]
        );
        $event = new Slide;
        $event->name = $req->name;
        $event->NoiDung = $req->NoiDung;
        $event->condition = $req->condition;
        $event->number = $req->number;
        $event->image = $req->image;
        if ($req->has('link')) {
            $event->link = $req->link;
        }
        $event->save();
        return redirect('admin/event/add')->with('thongbao', 'Thêm sự kiện thành công');
    }
    public function getEditEvent($id)
    {
        $event = Slide::find($id);
        return view('back-end.layout.edit_event')->with(compact('event'));
    }
    public function postEditEvent(Request $req, $id)
    {
        $this->validate(
            $req,
            [
                'link' => 'required',
            ],
            [
                'link.required' => 'Bạn chưa nhập đường dẫn truy cập',
            ]
        );
        $event = Slide::find($id);
        $event->status = $req->status;
        $event->name = $req->name;
        $event->NoiDung = $req->NoiDung;
        $event->condition = $req->condition;
        $event->number = $req->number;

        if ($req->image) {
            $event->image = $req->image;
        }
        $event->save();
        return redirect('admin/event/edit/' . $id)->with('thongbao', 'Sửa sự kiện thành công');
    }
    public function postDeleteEvent($id)
    {
        $event = Slide::find($id);
        $destinationPath = $event->image;
        if (file_exists($destinationPath)) {
            unlink($destinationPath);
        }
        $event->delete();
        return redirect('admin/event/list-event/')->with('thongbao', 'Xóa sự kiện thành công');
    }
    public function getSaleOF()
    {
        $sale = SaleOfProduct::where('status', 0)->get();
        $today = Carbon::now('Asia/Ho_Chi_Minh');
        return view('back-end.layout.sale_of')->with(compact('sale', 'today'));
    }
    public function getAddSale()
    {
        $product = Product::where('status', 0)->where('promotion_price', '<>', 0)->get();
        return view('back-end.layout.add_sale_of', compact('product'));
    }
    public function postAddSale(Request $req)
    {
        $this->validate(
            $req,
            [
                'description' => 'required',
                'date_end' => 'required',
                'date_start' => 'required',
            ],
            [
                'description.required' => 'Bạn chưa nhập mô tả cho sự kiện',
                'date_start.required' => 'Bạn chưa nhập ngày tháng bắt đầu cho sự kiện',
                'date_end.required' => 'Bạn chưa nhập ngày tháng kết thúc cho sự kiện',
            ]
        );
        $sale = new SaleOfProduct;
        $sale->id_product = $req->id_product;
        $sale->description = $req->description;
        $sale->date_start = $req->date_start;
        $sale->date_end = $req->date_end;
        $sale->save();
        return redirect('admin/sale/add')->with('thongbao', 'Thêm sự kiện giảm giá thành công');
    }
    public function getEditSale($id)
    {
        $sale = SaleOfProduct::find($id);
        $product = Product::where('status', 0)->where('promotion_price', '<>', 0)->get();
        return view('back-end.layout.edit_sale')->with(compact('sale', 'product'));
    }
    public function postEditSale(Request $req, $id)
    {
        $this->validate(
            $req,
            [
                'description' => 'required',
                'date_end' => 'required',
                'date_start' => 'required',
            ],
            [
                'description.required' => 'Bạn chưa nhập mô tả cho sự kiện',
                'date_start.required' => 'Bạn chưa nhập ngày tháng bắt đầu cho sự kiện',
                'date_end.required' => 'Bạn chưa nhập ngày tháng kết thúc cho sự kiện',
            ]
        );
        $sale = SaleOfProduct::find($id);
        $sale->id_product = $req->id_product;
        $sale->description = $req->description;
        $sale->date_start = $req->date_start;
        $sale->date_end = $req->date_end;
        $sale->save();
        return redirect('admin/sale/edit/' . $id)->with('thongbao', 'Sửa sự kiện giảm giá thành công');
    }
    public function postDeleteSale($id)
    {
        $sale = SaleOfProduct::find($id);
        $sale->delete();
        return redirect('admin/sale/sale-of/')->with('thongbao', 'Xóa sự kiện giảm giá thành công');
    }
    public function getShop()
    {
        $shop_type = Shop::all();
        return view('back-end.layout.shop', compact('shop_type'));
    }
    public function getAddShop()
    {
        return view('back-end.layout.add_shop');
    }
    public function postAddShop(Request $req)
    {
        $this->validate($req, [
            'name' => 'required|min:3|max:100',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif', // Validate the uploaded image
            'description' => 'required',
        ], [
            'name.required' => 'Bạn chưa nhập tên thể loại',
            'name.min' => 'Tên thể loại phải có độ dài từ 3 - 100 ký tự',
            'name.max' => 'Tên thể loại phải có độ dài từ 3 - 100 ký tự',
            'image.required' => 'Bạn chưa chọn ảnh',
            'image.image' => 'Tệp tải lên không phải là hình ảnh',
            'image.mimes' => 'Chỉ hỗ trợ các định dạng hình ảnh: jpeg, png, jpg, gif',
        ]);

        $shop = new Shop();
        $shop->name = $req->name;
        $shop->description = $req->description;

        // if ($req->hasFile('image')) {
        //     $imagePath = $req->file('image')->store('shop_images', 'public');
        //     $shop->image = $imagePath;
        // }

        if ($req->hasFile('image')) {
            $file = $req->image;
            // Lấy tên file
            $fileName = $file->getClientOriginalName();
            // Lấy đuôi file
            echo $file->getClientOriginalExtension();
            // Lấy kích thước file
            echo $file->getSize();
            $path = $file->move('public/shop_images', $file->getClientOriginalName());
            $imagePath = 'public/shop_images/' . $fileName;
            $shop->image = $imagePath;
        }

        $shop->save();

        return redirect('admin/shop/add')->with('thongbao', 'Thêm cửa hàng thành công');
    }

    public function postDeleteShop($id)
    {
        $shop_type = Shop::find($id);
        $product = Product::where('id_shop', $id)->get(); //Tìm các sản phẩm của shop

        foreach ($product as $item) {
            DB::table('comment')->where('id_product', $item->id)->delete();
            DB::table('images_product')->where('id_product', $item->id)->delete();
            DB::table('sale_of_product')->where('id_product', $item->id)->delete();
            DB::table('fk_holiday_product')->where('id_product', $item->id)->delete();

            $item->delete();
        }


        $destinationPathShop = $shop_type->image;
        if (file_exists($destinationPathShop)) {
            unlink($destinationPathShop);
        }

        $shop_type->delete();
        return redirect('admin/shop/list-shop')->with('thongbao', 'Xóa cửa hàng thành công');
    }
    public function getEditShop($id)
    {
        $shop_type = Shop::find($id);
        return view('back-end.layout.edit_shop', compact('shop_type'));
    }
    public function postEditShop(Request $req, $id)
    {
        $shop_type = Shop::find($id);
        $this->validate(
            $req,
            [
                'name' => 'required|min:3|max:100',
                'description' => 'required',
            ],
            [
                'name.required' => 'Bạn chưa nhập tên thể loại',
                'name.unique' => 'Tên thể loại bị trùng',
                'name.min' => 'Tên thể loại phải có độ dài từ 3 - 100 ký tự',
                'name.max' => 'Tên thể loại phải có độ dài từ 3 - 100 ký tự',

            ]
        );
        $shop_type->status = $req->status;
        $shop_type->name = $req->name;
        if ($req->hasFile('image')) {
            $file = $req->image;
            // Lấy tên file
            $fileName = $file->getClientOriginalName();
            // Lấy đuôi file
            echo $file->getClientOriginalExtension();
            // Lấy kích thước file
            echo $file->getSize();
            $path = $file->move('public/shop_images', $file->getClientOriginalName());
            $imagePath = 'public/shop_images/' . $fileName;
            $shop_type->image = $imagePath;
        }
        $shop_type->description = $req->description;
        $shop_type->save();

        return redirect('admin/shop/edit/' . $id)->with('thongbao', 'Sửa cửa hàng thành công');
    }
    public function getContact()
    {
        $contact = Contact::where('status', 0)->get();
        $contact_xl = Contact::where('status', 1)->get();
        return view('back-end.layout.contact', compact('contact', 'contact_xl'));
    }
    public function postDeleteContact($id)
    {
        $contact = Contact::find($id);
        $contact->delete();
        return redirect('admin/contact/list-contact')->with('thongbao', 'Xóa phản hồi thành công');
    }
    public function getEditContact($id)
    {
        $contact = Contact::find($id);
        return view('back-end.layout.edit_contact', compact('contact'));
    }
    public function postEditContact(Request $req, $id)
    {
        $contact = Contact::find($id);
        $contact->status = $req->status;
        $contact->save();

        return redirect('admin/contact/edit/' . $id)->with('thongbao', 'Xử lý phản hồi thành công');
    }
    public function getBill(Request $req)
    {
        $customers = Customer::orderBy('id', 'desc')->where('status', '=', 0)->get();

        $bills = Bill::orderBy('id', 'desc')->get();

        if ($req->date_form && $req->date_to) {
            $customers = Customer::orderBy('id', 'desc')->whereBetween('created_at', [$req->date_form, $req->date_to])->get();
            // $this->data['customers'] = $customers;
        }
        return view('back-end.layout.bill.bill', compact('customers', 'bills'));
    }
    public function getBillFinish(Request $req)
    {
        $customers = Customer::orderBy('id', 'desc')->where('status', '=', 3)->get();

        $bills = Bill::orderBy('id', 'desc')->get();

        if ($req->date_form && $req->date_to) {
            $customers = Customer::orderBy('id', 'desc')->whereBetween('created_at', [$req->date_form, $req->date_to])->get();
            // $this->data['customers'] = $customers;
        }
        return view('back-end.layout.bill.bill_finish', compact('customers', 'bills'));
    }
    public function getBill1(Request $req)
    {
        $customers = Customer::orderBy('id', 'desc')->where('status', '=', 1)->get();

        $bills = Bill::orderBy('id', 'desc')->get();

        if ($req->date_form && $req->date_to) {
            $customers = Customer::orderBy('id', 'desc')->whereBetween('created_at', [$req->date_form, $req->date_to])->get();
            // $this->data['customers'] = $customers;
        }
        return view('back-end.layout.bill.bill_1', compact('customers', 'bills'));
    }
    public function getBill2(Request $req)
    {
        $customers = Customer::orderBy('id', 'desc')->where('status', '=', 2)->get();

        $bills = Bill::orderBy('id', 'desc')->get();

        if ($req->date_form && $req->date_to) {
            $customers = Customer::orderBy('id', 'desc')->whereBetween('created_at', [$req->date_form, $req->date_to])->get();
            // $this->data['customers'] = $customers;
        }
        return view('back-end.layout.bill.bill_2', compact('customers', 'bills'));
    }
    public function getEditBill($id)
    {
        $customerInfo = Customer::join('bills', 'customer.id', '=', 'bills.id_customer')
            ->select('customer.*', 'bills.id as bill_id', 'bills.total as total', 'bills.note as note', 'bills.ship as ship', 'bills.code as code', 'bills.total_coupon as total_coupon')
            ->where('customer.id', '=', $id)
            ->first();

        $billInfo = Bill::join('bill_detail', 'bills.id', '=', 'bill_detail.id_bill')
            ->leftjoin('product', 'bill_detail.id_product', '=', 'product.id')
            ->where('bills.id_customer', '=', $id)
            ->select('bills.*', 'bill_detail.*', 'product.name as product_name')
            ->get();

        return view('back-end.layout.bill.bill_details', compact('customerInfo', 'billInfo'));
    }
    public function postEditBill(Request $request, $id)
    {
        $cus = Customer::find($id);
        $cus->status = $request->input('status');
        $cus->save();
        return redirect('admin/bill/edit/' . $id)->with('thongbao', 'Cập nhật trạng thái đơn hàng thành công');
    }
    // public function postDeleteBill($id)
    // {
    //     $bill_details = BillDetail::where('id_bill', $id);
    //     $bill_details->delete();
    //     $bill = Bill::where('id_customer', $id);
    //     $bill->delete();
    //     $cus = Customer::find($id);
    //     $cus->delete();
    //     return redirect('admin/bill/list-bill/')->with('thongbao', 'Xóa hóa đơn thành công');
    // }

    public function postDeleteBill($id)
    {
        DB::beginTransaction();
        try {
            $customer = Customer::findOrFail($id);
            $bills = Bill::where('id_customer', $id)->get();
            foreach ($bills as $bill) {
                BillDetail::where('id_bill', $bill->id)->delete();
            }
            Bill::where('id_customer', $id)->delete();
            $customer->delete();
            DB::commit();

            return redirect('admin/bill/list-bill/')->with('thongbao', 'Xóa hóa đơn thành công');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect('admin/bill/list-bill/')->with('thongbao', 'Có lỗi xảy ra khi xóa hóa đơn');
        }
    }
}

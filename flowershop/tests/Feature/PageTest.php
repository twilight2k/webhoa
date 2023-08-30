<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
class PageTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $response = $this->get('login');

        $response->assertStatus(200);
        $response->assertViewIs('front-end.layout.login')->assertSee('login');
    }
    public function testUserCanViewRegister()
    {
        $response = $this->get('/register');

        $response->assertStatus(200);
        $response->assertViewIs('front-end.layout.register')->assertSee('register');
    }
    public function testCheckOutView()
    {
        $response = $this->get('/checkout');

        $response->assertStatus(200);
        $response->assertViewIs('front-end.layout.checkout')->assertSee('checkout');
    }
    public function testCartView()
    {
        $response = $this->get('/cart');

        $response->assertStatus(200);
        $response->assertViewIs('front-end.layout.cart')->assertSee('cart');
    }
    public function testHomeView()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertViewIs('front-end.layout.home')->assertSee('/');
    }
    public function testCategoryView()
    {
        $response = $this->get('/category/1');

        $response->assertStatus(200);
        $response->assertViewIs('front-end.layout.category')->assertSee('/category');
    }
    public function testProductDetailsView()
    {
        $response = $this->get('/productdetails/1');

        $response->assertStatus(200);
        $response->assertViewIs('front-end.layout.productdetails')->assertSee('/productdetails');
    }
    public function testShopView()
    {
        $response = $this->get('/shop/1');

        $response->assertStatus(200);
        $response->assertViewIs('front-end.layout.shop')->assertSee('/shop');
    }
    public function testCanRegister()
    {
        factory(User::class)->create();
        $response = $this->post('/front-end/layout/register');

        $this->assertCount(14,User::all()); // 8 = tổng số tài khoản tồn tại trong database + 1
    }
    public function testLoginPost(){

        $response = $this->call('POST', '/login', [
            'email' => '1714218@dlu.edu.vn',
            'password' => '01663911874loc',
            '_token' => csrf_token()
        ]);
        $this->assertEquals(302, $response->getStatusCode());
    }
}

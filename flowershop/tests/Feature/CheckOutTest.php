<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Bill;
use App\Models\BillDetail;
use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;
class CheckOutTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testCheckOutView()
    {
        $response = $this->get('/checkout');

        $response->assertStatus(200);
        $response->assertViewIs('front-end.layout.checkout')->assertSee('checkout');
    }
    public function testCheckOutFunction()
    {
        factory(Bill::class)->create();
        factory(BillDetail::class)->create();
        factory(Customer::class)->create();
        $response = $this->post('/front-end/layout/register');

        $this->assertCount(214, Bill::all());
    }
}

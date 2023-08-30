<?php

namespace Database\Factories;

use App\Models\Bill;
use App\Models\BillDetail;
use App\Models\Customer;

use Illuminate\Database\Eloquent\Factories\CheckOutFactory;
use Faker\Generator as Faker;
use Illuminate\Support\Str;


$factory->define(Bill::class, function (Faker $faker) {
    return [
        'id_customer' =>100,
        'date_order' => date('Y-m-d'),
        'total' => '1111111',
        'payment'=>'COD',
        'status'=> 0,
    ];
});
$factory->define(BillDetail::class, function (Faker $faker) {
    return [
        'id_bill' => 1,
        'id_product' => 1,
        'quantity' => 1,
        'unit_price'=>690000,
    ];
});
$factory->define(Customer::class, function (Faker $faker) {
    return [
        'user_code'=>'1111111',
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'gender'=>'Nam',
        'address'=>$faker->address,
        'phone_number'=>'0865450411',

        'token' => Str::random(10),
    ];
});

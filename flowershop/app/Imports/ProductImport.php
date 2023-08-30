<?php

namespace App\Imports;

use App\Models\Product;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;


class ProductImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Product([
            'code_product'=>$row[0],
            'name'=> $row[1],
            'id_type'=> $row[2], 
            'id_shop'=> $row[3], 
            'description' => $row[4],
            'feature'=>$row[5],
            'unit_price'=>$row[6],
            'promotion_price'=>$row[7],
            'image'=>$row[8],
            'unit'=>$row[9]
        ]);
    }
}

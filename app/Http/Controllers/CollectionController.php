<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Collection;

class CollectionController extends Controller
{
    public function les1()
    {
        $orders = [[
            'id' => 1,
            'user_id' => 1,
            'number' => '13908080808',
            'status' => 0,
            'fee' => 10,
            'discount' => 44,
            'order_products' => [
                ['order_id' => 1, 'product_id' => 1, 'param' => '6寸', 'price' => 555.00, 'product' => ['id' => 1, 'name' => '蛋糕名称', 'images' => []]],
                ['order_id' => 1, 'product_id' => 1, 'param' => '7寸', 'price' => 333.00, 'product' => ['id' => 1, 'name' => '蛋糕名称', 'images' => []]],
            ],
        ]];

        /*$a = collect($orders)->map(function ($order){
            return $order['order_products'];
        })->flatten(1)->map(function ($order){
            return $order['price'];
        })->sum();*/
        /* $a = collect($orders)->flatMap(function ($order){
             return $order['order_products'];
         })->pluck('price')->sum();*/
        $a = collect($orders)->pluck('order_products.*.price')->flatten(1)->sum();
        dd($a);

        /*  $price = 0;

          foreach( $orders as $order ){
              foreach( $order['order_products'] as $order_product ){
                  $price += $order_product['price'];
              }
          }
          dd( $price );*/
    }

    public function les2()
    {
        $data = [
            'A_A_1',
            'A_b_2',
            'A_c_3',
            'A_4',
            'a5',
        ];

        $a = collect($data)->map(function ($item) {
            /*if (strrpos($item,'_')===false){
                return $item;
            }
            $pos = strrpos($item, '_');
            return mb_substr($item, $pos+1);*/

            return collect(explode('_',$item))->last();
        })->toArray();
        dd($a);

    }

    public function les3()
    {

    }
}

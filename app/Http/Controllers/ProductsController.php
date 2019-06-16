<?php

namespace App\Http\Controllers;

use App\OrderProduct;
use App\Product;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function index() {
        $products = Product::with(['vendor' => function($q) {
                $q->select(['id', 'name']);
            }])
            ->select(['id', 'name', 'price', 'vendor_id'])
            ->orderBy('name', 'asc')
            ->paginate(25);


        $data['productsPage'] = 1;
        $data['products'] = $products;
        $data['title'] = 'Список продуктов';

        return view('welcome', $data);
    }

    public function changePrice(Request $request){
        $req = $request->all();
        $product = Product::where('id', $req['id'])->first();
        $orderProducts = OrderProduct::where('product_id', $req['id'])->get();

        $product->price = $req['price'];
        $isProductSave = $product->save();
        $isOrderProductsSave = [];
        foreach ($orderProducts as $orderProduct) {
            $orderProduct->price = $req['price'];
            $isOrderProductsSave[] = $orderProduct->save();
        }
        $isOrderProductsSave = array_unique($isOrderProductsSave);
        if($isProductSave && count($isOrderProductsSave) === 1 && $isOrderProductsSave[0]) {
            return [
                'result' => 'Прайс успешно обновлен',
                'id' => $req['id']
            ];
        }
        return [
            'result' => 'Что то пошло не так',
            'id' => $req['id']
        ];
    }
}

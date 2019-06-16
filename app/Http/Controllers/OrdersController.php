<?php

namespace App\Http\Controllers;

use App\Order;
use App\Partner;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;

class OrdersController extends Controller
{
    public function index() {
        $order = Order::with(['orderProduct' => function($q) {
                $q->getSelect();
            }])
            ->with('product')
            ->with(['partner' => function($q){
                $q->select('id', 'name');
            }])
            ->paginate(10);
        $data['orders'] = $order;
        $data['ordersListPage'] = 1;
        $data['title'] = 'Список Заказов';
        return view('welcome', $data);
    }

    public function getOrderPage(Request $request, $id) {
        $order = Order::where('id', $id)
            ->with('partner')
            ->with(['orderProduct' => function($q) {
                $q->with('product')->getSelect($q);
            }])
            ->first();
        $partners = Partner::select('id', 'name')->get();

        $data['partners'] = $partners;
        $data['order'] = $order;
        $data['orderPage'] = 1;
        $data['title'] = 'Редактирование заказа';
        return view('welcome', $data);
    }

    public function saveOrder(Request $request) {
        $req = $request->all();
        $order = Order::where('id', $req['id'])->first();
        $email = false;
        if($order->status != $req['status']) {
            $email = true;
        }
        $order->status = (int)$req['status'];
        $order->client_email = $req['email_client'];
        $order->partner_id = (int)$req['partner'];

        $isOrderSave = $order->save();
        $res = $isOrderSave ? 'Успешно обновлен заказ' : 'Что то пошло не так';

        if($isOrderSave && $email) {
            $eData = Order::where('id', $req['id'])
                ->with('partner')
                ->with(['product' => function($q) {
                    $q->with('vendor');
                }])->with('orderProduct')->first();
            $products = [];
            $emails[] = $eData->partner->email;
            foreach ($eData->product as $product) {
                $products[] = $product->name;
                $emails[] = $product->vendor->email;
            }
            $emails = array_unique($emails);
            $cost = $eData->orderProducr->sum('price');
            $id = $eData->id;
            Mail::to($emails)->send(new SendMail($products, $cost, $id));
        }

        return redirect('/order/' . $order->id)->with('status', $res);
    }

    public function indexNewOrdersList() {
        $date = Carbon::now();
        $currentDate = $date->format('Y-m-d H:i:s');
        $addDay = $date->addHours(24)->format('Y-m-d H:i:s');
        $today = Carbon::today()->format('Y-m-d H:i:s');;
        $tomorrow = Carbon::tomorrow()->format('Y-m-d H:i:s');;
        $orders['expired'] = Order::with(['orderProduct' => function($q) {
            $q->getSelect();
        }])
            ->with('product')
            ->with(['partner' => function($q){
                $q->select('id', 'name');
            }])
            ->limit(50)
            ->where('status', 10)
            ->where('delivery_dt', '<', $currentDate)
            ->orderBy('delivery_dt', 'desc')
            ->get();

        $orders['current'] = Order::with(['orderProduct' => function($q) {
            $q->getSelect();
        }])
            ->with('product')
            ->with(['partner' => function($q){
                $q->select('id', 'name');
            }])
            ->limit(50)
            ->where('status', 10)
            ->whereBetween('delivery_dt', [$currentDate, $addDay])
            ->orderBy('delivery_dt', 'asc')
            ->get();

        $orders['new'] = Order::with(['orderProduct' => function($q) {
            $q->getSelect();
        }])
            ->with('product')
            ->with(['partner' => function($q){
                $q->select('id', 'name');
            }])
            ->limit(50)
            ->where('status', 0)
            ->where('delivery_dt', '>', $currentDate)
            ->orderBy('delivery_dt', 'asc')
            ->get();

        $orders['completed'] = Order::with(['orderProduct' => function($q) {
            $q->getSelect();
        }])
            ->with('product')
            ->with(['partner' => function($q){
                $q->select('id', 'name');
            }])
            ->limit(50)
            ->where('status', 20)
            ->whereBetween('delivery_dt', [$today, $tomorrow])
            ->orderBy('delivery_dt', 'desc')
            ->get();

        $data['orders'] = $orders;
        $data['newOrdersListPage'] = 1;
        $data['title'] = 'Доп список заказов';
        return view('welcome', $data);
    }
}

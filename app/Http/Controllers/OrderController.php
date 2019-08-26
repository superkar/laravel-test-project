<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $conditions = [
            'expired' => [
                ['delivery_dt', '>', date('Y-m-d H:i:s')],
                ['status', '=', 10]
            ],
            'current' => [
                ['delivery_dt', '>', date('Y-m-d H:i:s')],
                ['delivery_dt', '<=', date('Y-m-d H:i:s', strtotime('+1 day'))],
                ['status', '=', 10]
            ],
            'new' => [
                ['status', '=', 0],
                ['delivery_dt', '>', date('Y-m-d H:i:s')]
            ],
            'ready' => [
                ['delivery_dt', '>=', date('Y-m-d 00:00:00')],
                ['delivery_dt', '<=', date('Y-m-d 23:59:59')],
                ['status', '=', 20]
            ]
        ];

        $expired = Order::where($conditions['expired'])->orderBy('delivery_dt', 'DESC')
        ->paginate(50);
            
        $current = Order::where($conditions['current'])->orderBy('delivery_dt', 'ASC')
        ->paginate(50);
            
        $new = Order::where($conditions['new'])->orderBy('delivery_dt', 'ASC')
        ->paginate(50);
            
        $ready = Order::where($conditions['ready'])->orderBy('delivery_dt', 'DESC')
        ->paginate(50);

        return view('orders', [
            'expired' => $expired, 
            'current' => $current, 
            'new' => $new, 
            'ready' => $ready, 
            'type' => app()->request->get('type', 'expired')
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $order = Order::findOrFail($id);
        return view('order', ['order' => $order]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $validated = $request->validate([
            'client_email' => 'required|email',
            'partner_id' => 'required',
            'status' => 'required',
        ]);
        
        $order = Order::findOrFail($id);
        $old_status = $order->status;
        $order->update($validated);
        
        
        // send emails on completed orders
        if($order->status == 20 && $old_status != $order->status) 
        {
            $to = ['"' . $order->partner->name . '" <' . $order->partner->email . '>'];
            $message = "Состав заказа: \r\n";
            foreach($order->products as $product) 
            {
                $to[] = '"' . $product->product->vendor->name . '" <' . $product->product->vendor->email . '>';
                $message .= $product->product->name . " (" . $product->quantity . " шт.) \r\n";
            }
            $message .= "\r\n" . "Стоимость: " . $order->getPrice() . " руб. \r\n";
            $subject = 'Заказ №' . $order->id . ' завершен';
            mail(implode(', ', $to), $subject, $message);
        }
        
        $request->session()->flash('success', "Изменения сохранены успешно!");
        return redirect('/orders/' . $id . '/edit');
    }
}

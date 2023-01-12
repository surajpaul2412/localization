<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderStatus;
use Auth;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::whereUserId(Auth::user()->id)->orderBy('created_at','DESC')->get();
        return view('customer.order.index', compact('orders'));
    }

    /**
     * Display a listing Details of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function bookings() {   
        return view('customer.order.booking');   
    } 

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function cancelBooking($id)
    {
        $order = Order::whereId($id)->whereUserId(Auth::user()->id)->first();
        $order->update(['order_status'=>'Cancelled']);

        $orderStatus = OrderStatus::whereOrderId($id)->first();
        $orderStatusdata['order_id'] = $order->id;
        $orderStatusdata['comment'] = "Cancelled By Customer";
        $orderStatusdata['order_status'] = "Cancelled";
        $orderStatus->create($orderStatusdata);
        return redirect('customer/my-booking')->with('success','Order Cancelled successfully.');
    }
}

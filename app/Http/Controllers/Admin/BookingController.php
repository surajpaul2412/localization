<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderStatus;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bookings = Order::latest()->get();
        return view('admin.bookings.index', compact('bookings'));
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
        $booking = Order::findOrFail($id);
        return view('admin.bookings.show', compact('booking'));
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
        $this->validate($request, [
            'order_comment' => 'required',
            'order_status' => 'required'
        ]);

        $order = Order::findOrFail($id);
        $order->update(['order_status'=>$request->order_status]);

        $orderStatus = OrderStatus::whereOrderId($id)->first();
        $orderStatusdata['order_id'] = $order->id;
        $orderStatusdata['comment'] = $request->order_comment;
        $orderStatusdata['order_status'] = $request->order_status;
        $orderStatus->create($orderStatusdata);

        if ($orderStatus){
            $mailDetails['title'] = 'Order update from GetBeds';
            if ($orderStatusdata['order_status'] == 'Confirmed'){
                $mailDetails['body'] = 'Your order has been confirmed.';
                \Mail::to($order->user->email)->send(new \App\Mail\ConfirmedMail($mailDetails));
            } elseif($orderStatusdata['order_status'] == 'Completed'){
                $mailDetails['body'] = 'Your order has been Completed.';
                \Mail::to($order->user->email)->send(new \App\Mail\ConfirmedMail($mailDetails));
            } elseif($orderStatusdata['order_status'] == 'Cancelled By Admin') {
                $mailDetails['body'] = 'Your order has been Cancelled.';
                \Mail::to($order->user->email)->send(new \App\Mail\ConfirmedMail($mailDetails));
            }
        }
        return redirect('admin/bookings')->with('success','Order status updated successfully.');
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
}

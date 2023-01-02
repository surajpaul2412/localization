<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Razorpay\Api\Api;
use Session;
use Exception;
use App\Models\Package;
use App\Models\User;
use App\Models\City;
use App\Models\Category;
use App\Models\Newsletter;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderStatus;
use App\Models\UserAddress;
use App\Models\Razorpay;
use Auth;
use Hash;
use DB;

class RazorpayPaymentController extends Controller
{
    public function __construct()
    {
        $razorpay = Razorpay::findOrFail(1);
        $this->key = $razorpay['key'];
        $this->secret_key = $razorpay['secret_key'];
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function index()
    {
        return view('razorpayView');
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function store(Request $request)
    {
        $input = $request->all();
  
        $api = new Api($this->key, $this->secret_key);
  
        $payment = $api->payment->fetch($input['razorpay_payment_id']);
  
        if(count($input)  && !empty($input['razorpay_payment_id'])) {
            try {
                $response = $api->payment->fetch($input['razorpay_payment_id'])->capture(array('amount'=>$payment['amount']));
                if (Auth::user()) {
                    $cartItems = Cart::whereUserId(Auth::user()->id)->get();
                    if ($request->radio_address) {
                        foreach ($cartItems as $key => $item) {
                            $orderData['order_no'] = 'ORD'.rand(1,100000);
                            $orderData['user_id'] = Auth::user()->id;
                            $orderData['package_id'] = $item->package_id;
                            $orderData['user_address_id'] = $request->radio_address;
                            $orderData['date'] = $item->date;
                            $orderData['adult_qty'] = $item->qty_adult;
                            $orderData['child_qty'] = $item->qty_child;
                            $orderData['infant_qty'] = $item->qty_infant;
                            $orderData['price'] = Cart::itemPrice($item);
                            $orderData['tax'] = $request->tax??0;
                            $orderData['order_status'] = 'In Progress';
                            $orderData['razorpay_payment_id'] = $response->id;
                            $order = Order::create($orderData);

                            $orderStatusData['order_id'] = $order->id;
                            $orderStatusData['comment'] = 'Order Placed';
                            $orderStatusData['order_status'] = 'In Progress';
                            $orderStatus = OrderStatus::create($orderStatusData);
                        }
                    } else {
                        $request->validate([
                            'name' => 'required|string|min:2|max:255',
                            'email' => 'required|email',
                            'mobile' => 'required|string',
                            'country' => 'required|string|min:3',
                            'city' => 'required|string|min:3',
                            'pincode' => 'required|string',
                            'address' => 'required|string|min:3'
                        ]);

                        $addressData['user_id'] = Auth::user()->id;
                        $addressData['default'] = 0;
                        $addressData['name'] = $request->name;
                        $addressData['email'] = $request->email;
                        $addressData['mobile'] = $request->mobile;
                        $addressData['country'] = $request->country;
                        $addressData['city'] = $request->city;
                        $addressData['pincode'] = $request->pincode;
                        $addressData['address'] = $request->address;
                        $userAddress = UserAddress::create($addressData);

                        foreach ($cartItems as $key => $item) {
                            $orderData['order_no'] = 'ORD'.rand(1,100000);
                            $orderData['user_id'] = Auth::user()->id;
                            $orderData['package_id'] = $item->package_id;
                            $orderData['user_address_id'] = $userAddress->id;
                            $orderData['date'] = $item->date;
                            $orderData['adult_qty'] = $item->qty_adult;
                            $orderData['child_qty'] = $item->qty_child;
                            $orderData['infant_qty'] = $item->qty_infant;
                            $orderData['price'] = Cart::itemPrice($item);
                            $orderData['tax'] = $request->tax??0;
                            $orderData['order_status'] = 'In Progress';
                            $orderData['razorpay_payment_id'] = $response->id;
                            $order = Order::create($orderData);

                            $orderStatusData['order_id'] = $order->id;
                            $orderStatusData['comment'] = 'Order Placed';
                            $orderStatusData['order_status'] = 'In Progress';
                            $orderStatus = OrderStatus::create($orderStatusData);
                        }
                    }
                    $email = Auth::user()->email;
                } else {
                    $request->validate([
                        'name' => 'required|string|min:2|max:255',
                        'email' => 'required|email',
                        'mobile' => 'required|string',
                        'name' => 'required|string|min:3',
                        'country' => 'required|string|min:3',
                        'city' => 'required|string|min:3',
                        'pincode' => 'required|string',
                        'address' => 'required|string|min:3'
                    ]);

                    // user existance check
                    $emailCheck = User::whereEmail($request->email)->count();
                    $mobileCheck = User::whereMobile($request->mobile)->count();
                    if($emailCheck != 0){
                        return redirect()->route('checkout')->with('failure','Email is already registered. Try login');
                    }elseif($mobileCheck != 0){
                        return redirect()->route('checkout')->with('failure','Mobile is already registered. Try login');
                    }else{
                        $userData['name'] = $request->name;
                        $userData['email'] = $request->email;
                        $userData['mobile'] = $request->mobile;
                        $userData['password'] = Hash::make('test1234');
                        $user = User::create($userData);

                        $addressData['user_id'] = $user->id;
                        $addressData['default'] = 0;
                        $addressData['name'] = $request->name;
                        $addressData['email'] = $request->email;
                        $addressData['mobile'] = $request->mobile;
                        $addressData['country'] = $request->country;
                        $addressData['city'] = $request->city;
                        $addressData['pincode'] = $request->pincode;
                        $addressData['address'] = $request->address;
                        $userAddress = UserAddress::create($addressData);
                    }

                    $cartItems = Cart::whereUserId(session()->getId())->get();
                    foreach ($cartItems as $key => $item) {
                        $orderData['order_no'] = 'ORD'.rand(1,100000);
                        $orderData['user_id'] = $user->id;
                        $orderData['package_id'] = $item->package_id;
                        $orderData['user_address_id'] = $userAddress->id;
                        $orderData['date'] = $item->date;
                        $orderData['adult_qty'] = $item->qty_adult;
                        $orderData['child_qty'] = $item->qty_child;
                        $orderData['infant_qty'] = $item->qty_infant;
                        $orderData['price'] = Cart::itemPrice($item);
                        $orderData['tax'] = $request->tax??0;
                        $orderData['order_status'] = 'In Progress';
                        $orderData['razorpay_payment_id'] = $response->id;
                        $order = Order::create($orderData);

                        $orderStatusData['order_id'] = $order->id;
                        $orderStatusData['comment'] = 'Order Placed';
                        $orderStatusData['order_status'] = 'In Progress';
                        $orderStatus = OrderStatus::create($orderStatusData);
                    }
                    $email = $request->email;
                }
                $cartItems->each->delete();
            } catch (Exception $e) {
                return redirect()->route('checkout')->with('failure',$e->getMessage());
            }
        }

        // email confirmation 
        // email template here
        return redirect()->route('success')->with('success','Order Successfull.');
    }
}

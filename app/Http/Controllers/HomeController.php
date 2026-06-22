<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SalesOrder;
use App\Models\UserPoint;
use App\Models\UserPointTotal;
use App\Models\PointTransaction;
use App\Models\CustomerRequirement;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
// dd(CustomerRequirement::where('customer_id', auth()->id())->where('status', 'active')->whereDate('deadline', '>', Carbon::today())->first());
        $requirement = CustomerRequirement::where('customer_id', auth()->id())
    ->where('status', 'active')
    ->whereDate('deadline', '>=', Carbon::today())
    ->first();

    if($requirement) {
        return view('account.orders')->with('requirement', $requirement);

    }

    return redirect()->route('shop.index')->with('error', __('You have no active requirement. Please create a new requirement to proceed with shopping.'));
    }

    // public function orders(){
    //     $sales_orders = SalesOrder::where('user_id', auth()->user()->id)->latest()->orderBy('daily_order_number','desc')->paginate(5);

    //     $total_points = UserPointTotal::where('user_id', auth()->user()->id)->first();
    //     return view('account.orders')->with(['sales_orders' => $sales_orders, 'total_points' => $total_points]);
    // }

    // public function coupons(){
    //     $pt = PointTransaction::where('user_id', auth()->user()->id)->latest()->paginate(10);
    //     return view('account.coupon');
    // }

    // public function viewOrder($slug){
    //     $order = SalesOrder::where('slug', $slug)->where('user_id', auth()->user()->id)->first();
    //     if($order){
    //         return view('templates.orderconfirmation')->with('order', $order);
    //     } 

    //     return abort(404);

    // }

    public function checkout()
    {
       $requirement = CustomerRequirement::where('customer_id', auth()->id())
    ->where('status', 'active')
    ->whereDate('deadline', '>=', Carbon::today())
    ->first();
    if($requirement){
        return redirect()->route('myaccount')
            ->with('error', __('You cannot proceed to checkout until your current request has expired or been canceled.'));
    }
        // fileters active and expire date
        
        return view('shop.checkout');
    }

    public function deleteRequest($id){
        $requirement = CustomerRequirement::where('customer_id', auth()->id())->where('id', $id)->first();
        if($requirement){
            $requirement->status = 'canceled';
            $requirement->save();
            return redirect()->route('myaccount')->with('success', __('Your request has been canceled successfully.'));
        }

        return redirect()->route('myaccount')->with('error', __('Request not found or you do not have permission to cancel this request.'));
    }
}

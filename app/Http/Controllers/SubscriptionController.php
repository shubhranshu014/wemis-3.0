<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subscription;
class SubscriptionController extends Controller
{
    public function index()
    {
        $subscriptions = Subscription::where('mfg_id',auth("manufacturer")->user()->id)->get();
        return view("backend.subscription.index")->with(compact("subscriptions"));
    }

    public function store(Request $request)
    {
        try {
            $subscription = new Subscription();
            $subscription->mfg_id = auth("manufacturer")->user()->id;
            $subscription->packageType = $request['packageType'];
            $subscription->packageName = $request['packageName'];
            $subscription->billingCycle = $request['billingCycle'];
            $subscription->description = $request['description'];
            $subscription->price = $request['price'];
            $subscription->isRenewal = $request['renewalcheckbox'];
            $subscription->save();
            return redirect()->back()->with('success','Subscription created successfully!');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }
}

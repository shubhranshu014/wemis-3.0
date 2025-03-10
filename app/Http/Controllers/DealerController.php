<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Distributor;
use App\Models\Dealer;
class DealerController extends Controller
{
    public function index()
    {
        $distributor = Distributor::where("manuf_id", auth('manufacturer')->user()->id)->get();
        $dealer = [];
        foreach ($distributor as $key => $value) {
            $dealer = Dealer::with('distributor')->where('distributor_id', $distributor[$key]->id)->get();
        }
        return view("backend.dealer.index")->with(compact('distributor','dealer'));
    }

    public function store(Request $request)
    {

        $dealer = new Dealer();
        $dealer->distributor_id = $request['distributer'];
        $dealer->business_name = $request['business_name'];
        $dealer->name = $request['name'];
        $dealer->email = $request['email'];
        $dealer->password = $request['mobile'];
        $dealer->passwordText = $request['mobile'];
        $dealer->gender = $request['gender'];
        $dealer->mobile = $request['mobile'];
        $dealer->dob = $request['date_of_birth'];
        $dealer->is_map_device_edit = $request['is_map_device_edit'];
        $dealer->pan_number = $request['pan_number'];
        $dealer->occupation = $request['occupation'];
        $dealer->advance_payment = $request['advance_payment'];
        $dealer->language_known = implode(',', $request['language_known']);
        $dealer->country = $request['country'];
        $dealer->state = $request['state'];
        $dealer->rto_devision = $request['rto_devision'];
        $dealer->district = $request['district'];
        $dealer->pincode = $request['pincode'];
        $dealer->area = $request['area'];
        $dealer->address = $request['address'];
        $dealer->save();
        return redirect()->back()->with('success', 'Dealer Created Succesfully!');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Distributor;
use App\Models\Dealer;
use App\Models\Technician;
class TechnicianController extends Controller
{
    public function index(){
        $distributor = Distributor::where("manuf_id", auth('manufacturer')->user()->id)->get();
        $dealer = [];
        foreach ($distributor as $key => $value) {
            $dealer = Dealer::with('distributor')->where('distributor_id', $distributor[$key]->id)->get();
        }

        $technician = [];
        foreach ($dealer as $key => $value) {
            $technician = Technician::where('dealer_id',$dealer[$key]->id)->get();
        }
        return view("backend.technician.index")->with(compact('distributor','technician'));
    }

    public function store(Request $request){
        // dd($request->all());
       $technician = new Technician();
       $technician->dealer_id = $request->input('dealer');
       $technician->name = $request->input('name');
       $technician->gender = $request->input('gender');
       $technician->email = $request->input('email');
       $technician->mobile = $request->input('mobile_no');
       $technician->aadhar = $request->input('aadhar');
       $technician->dob = $request->input('dob');
       $technician->qualification = $request->input('qulification');
       $technician->save();
       return redirect()->back()->with('success','Technician Added Successfully!');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ManufacturerRequest;
use App\Services\ManufacturerService;
class ManufacturerController extends Controller
{
    public function __construct(private ManufacturerService $manufacturerService){

    }
    public function index(){
        $mfg = $this->manufacturerService->index();
        return view("backend.manufacturer.index")->with(compact("mfg"));
    }

    public function store(ManufacturerRequest $request){
     try {
       $this->manufacturerService->store(request: $request);
       return redirect()->back()->with('success', 'Manufacturer Created Successfully!');
     } catch (\Exception $e) {
        // Log the error and return an error message
        \Log::error('Error storing Manuafacturer: ' . $e->getMessage());
        return redirect()->back()->with('error', 'An error occurred while creating the manufacturer type.');
    }
    }

    public function dashboard(){

        return view('backend.manufacturer.dashboard');
    }
}

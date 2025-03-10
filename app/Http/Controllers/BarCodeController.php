<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ManufacturerElement;
use App\Models\BarCode;
use App\Models\Sim;
use Carbon\Carbon;
use App\Models\AllocatedBarCode;
class BarCodeController extends Controller
{
    public function index(){
        $element = ManufacturerElement::with('element')->where('mfg_id', auth('manufacturer')->user()->id)->get();
        // dd(auth('manufacturer')->user()->id);
        $currentTime = Carbon::now()->setTimezone('Asia/Kolkata');
        $batchNo = $currentTime->format('YmdHis');
        $barCode = BarCode::with('manufacturer','element','elementType','modelNo','partNo')->where('mfg_id', auth('manufacturer')->user()->id)->get();
        return view("backend.barcode.index")->with(compact('element','currentTime','batchNo','barCode'));
    }

    public function store(Request $request){
        // dd($request->all());
        $simNo = $request['simNo'];
        $iccidNo = $request['iccidNo'];
        $validity = $request['validity'];
        $operator = $request['operator'];
       
        $barcode = new Barcode;
        $barcode->mfg_id = auth('manufacturer')->user()->id;
        $barcode->element_id = $request['element'];
        $barcode->type_id = $request['element_type'];
        $barcode->model_id = $request['model_no'];
        $barcode->part_id = $request['device_part_no'];
        $barcode->tac_id = $request['tacNo'];
        $barcode->cop_id = $request['copNo'];
        $barcode->testingAgency = $request['testingAgency'];
        $barcode->serialNumber = $request['serialNo'];
        $barcode->barcodeNo = $request['barcodeNo'];
        $barcode->IMEINO = $request['barcodeNo'];
        $barcode->BatchNo = $request['batchNo'];
        $barcode->save();
        $barcodeId = $barcode->id;

        // unset($data['_token'], $data['element'], $data['element_type'], $data['model_no'], $data['device_part_no'], $data['voltage'], $data['batchNo'], $data['BarCodeCreationType'], $data['barcodeNo'], $data['is_renew'], $data['UniqueID']);
        // // dd($data);
        // foreach ($data as $key => $value) {
        //     $customValue = new BracodeCustomValue;
        //     $customValue->barcode_id = $barcode->id;
        //     $customValue->customFieldId = $key;
        //     $customValue->value = $value;
        //     $customValue->save();
        // }
        if ($simNo != null) {
            foreach ($simNo as $key => $value) {
                $sim = new Sim;
                $sim->barcode_id = $barcodeId;
                $sim->simNo = $simNo[$key];
                $sim->ICCIDNo = $iccidNo[$key];
                $sim->validity = $validity[$key];
                $sim->operator = $operator[$key];
                $sim->save();
            }
        }



        return redirect()->back()->with("success", "Barcode Created!");
  
    }

    public function allocate(){
        $element = ManufacturerElement::with('element')->where('mfg_id',auth('manufacturer')->user()->id)->get();
        return view("backend.barcode.allocate")->with(compact('element'));
    }

    public function storeAllocate(Request $request){
        //dd($request->all());
        $barcode = $request['allocated_barcodes'];
        try {
          foreach ($barcode as  $value) {
            echo $value;
            $allocate = new AllocatedBarCode();
            $allocate->distributor_id = $request['distributor'];
            $allocate->dealer_id = $request['dealer'];
            $allocate->barcode_id = $value;
            $allocate->save();
            $bar = BarCode::find($value);
            $bar->status = '1';
            $bar->save();
          }
          return redirect()->back()->with('success','Bar Code Allocated Successfully!');
        } catch (\Throwable $th) {
            //throw $th
            return redirect()->back()->with('error', $th->getMessage());
        }
    }
}

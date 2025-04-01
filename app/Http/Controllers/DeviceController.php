<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subscription;
use App\Models\MapDevice;
use App\Models\Distributor;
use App\Models\Dealer;
use App\Models\MapDeviceDetails;
use App\Models\BarCode;
class DeviceController extends Controller
{
    public function map(Request $request)
    {
        $subscriptions = Subscription::where("mfg_id", auth('manufacturer')->user()->id)->get();
        $distributors = Distributor::where('manuf_id', auth('manufacturer')->user()->id)->get();

        $mapDevices = [];  // Initialize an array to hold all map devices

        // Iterate over distributors
        foreach ($distributors as $distributor) {
            // Get dealers for the current distributor
            $dealers = Dealer::where('distributor_id', $distributor->id)->get();

            // Iterate over dealers
            foreach ($dealers as $dealer) {
                // Get map devices for the current dealer and merge them into the $mapDevices array
                $mapDevices = array_merge($mapDevices, MapDeviceDetails::with('barcodes','dealer')->where('dealer_id', $dealer->id)->get()->all());
            }
        }

        // You can use dd($mapDevices) to dump the result, which is now a flat array
// dd($mapDevices);

        return view('backend.device.map')->with(compact('subscriptions', 'mapDevices'));

    }


    public function store(Request $request)
    {
        // dd($request->all());
        try {
            $mapDevice = new MapDevice();
            $mapDevice->customer_name = $request['customerName'];
            $mapDevice->customer_email = $request['customerEmail'];
            $mapDevice->password = $request['customerMobile'];
            $mapDevice->passwordText = $request['customerMobile'];
            $mapDevice->customer_mobile = $request['customerMobile'];
            $mapDevice->save();
            $deviceDetails = new MapDeviceDetails();
            $deviceDetails->mapDevice_id = $mapDevice->id;
            $deviceDetails->dealer_id = $request['dealer'];
            $deviceDetails->package_id = $request['subscriptionpackage'];
            $deviceDetails->device_type = $request['deviceType'];
            $deviceDetails->device_seriel_no = $request['deviceNo'];
            $deviceDetails->vehicle_birth = $request['vehicleBirth'];
            $deviceDetails->vehicle_registration_number = $request['regNumber'];
            $deviceDetails->date = $request['regdate'];
            $deviceDetails->vehicle_chassis_no = $request['chassisNumber'];
            $deviceDetails->vehicle_engine_no = $request['engineNumber'];
            $deviceDetails->vehicle_type = $request['vehicleType'];
            $deviceDetails->vehicle_make_model = $request['vaiclemodel'];
            $deviceDetails->vehicle_model_year = $request['vaimodelyear'];
            $deviceDetails->vehicle_insurance_renew_date = $request['vaicleinsurance'];
            $deviceDetails->vehicle_pollution_renew_date = $request['pollutiondate'];
            $deviceDetails->customer_gst_no = $request['customergstin'];
            $deviceDetails->customer_state = $request['state'];
            $deviceDetails->customer_district = $request['coustomerDistrict'];
            $deviceDetails->customer_arear = $request['coustomerArea'];
            $deviceDetails->customer_pincode = $request['coustomerPincode'];
            $deviceDetails->customer_address = $request['coustomeraddress'];
            $deviceDetails->customer_rto_division = $request['rtoname'];
            $deviceDetails->customer_aadhaar = $request['customeraadhar'];
            $deviceDetails->customer_pan = $request['customerpanno'];
            $deviceDetails->technician_id = $request['technician'];
            $deviceDetails->invoice_no = $request['InvoiceNo'];
            $deviceDetails->vehicle_km_reading = $request['VehicleKMReading'];
            $deviceDetails->driver_license_no = $request['DriverLicenseNo'];
            $deviceDetails->mapped_date = $request['MappedDate'];
            $deviceDetails->no_of_panic_buttons = $request['NoOfPanicButtons'];
            if ($request['vehicleimg'] != null) {
                $vehicleimgfilePath = $request->file('vehicleimg')->store('uploads', 'public');
                $deviceDetails->vehicle = $vehicleimgfilePath;
            }
            if ($request['vehiclerc'] != null) {
                $vehiclercfilePath = $request->file('vehiclerc')->store('uploads', 'public');
                $deviceDetails->rc = $vehiclercfilePath;
            }

            if ($request['vaicledeviceimg'] != null) {
                $vaicledeviceimgfilePath = $request->file('vaicledeviceimg')->store('uploads', 'public');
                $deviceDetails->device = $vaicledeviceimgfilePath;
            }

            if ($request['pancardimg'] != null) {
                $pancardimgfilePath = $request->file('pancardimg')->store('uploads', 'public');
                $deviceDetails->pan = $pancardimgfilePath;
            }

            if ($request['aadharcardimg'] != null) {
                $aadhaarfilePath = $request->file('aadharcardimg')->store('uploads', 'public');
                $deviceDetails->aadhaar = $aadhaarfilePath;
            }
            if ($request['invoiceimg'] != null) {
                $invoiceimgfilePath = $request->file('invoiceimg')->store('uploads', 'public');
                $deviceDetails->invoice = $invoiceimgfilePath;
            }
            if ($request['signatureimg'] != null) {
                $signatureimgfilePath = $request->file('signatureimg')->store('uploads', 'public');
                $deviceDetails->signature = $signatureimgfilePath;
            }
            if ($request['panicbuttonimg'] != null) {
                $panicbuttonimgfilePath = $request->file('panicbuttonimg')->store('uploads', 'public');
                $deviceDetails->panic_button = $panicbuttonimgfilePath;
            }
            $deviceDetails->save();
            $barcode =  BarCode::find($request['deviceNo']);
            $barcode->status = '2';
            $barcode->save();
            return redirect()->back()->with('success', 'Device Mapped successfully!');
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('error', $th->getMessage());
        }

    }
}

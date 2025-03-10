<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subscription;
use App\Models\MapDevice;
use App\Models\Distributor;
use App\Models\Dealer;
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
                $mapDevices = array_merge($mapDevices, MapDevice::with('barcodes','dealer')->where('dealer_id', $dealer->id)->get()->all());
            }
        }

        // You can use dd($mapDevices) to dump the result, which is now a flat array
// dd($mapDevices);

        return view('backend.device.map')->with(compact('subscriptions', 'mapDevices'));

    }


    public function store(Request $request)
    {
        try {
            $mapDevice = new MapDevice();
            $mapDevice->dealer_id = $request['dealer'];
            $mapDevice->device_type = $request['deviceType'];
            $mapDevice->device_seriel_no = $request['deviceNo'];
            $mapDevice->vehicle_birth = $request['vehicleBirth'];
            $mapDevice->vehicle_registration_number = $request['regNumber'];
            $mapDevice->vehicle_date = $request['regdate'];
            $mapDevice->vehicle_chassis_no = $request['chassisNumber'];
            $mapDevice->vehicle_engine_no = $request['engineNumber'];
            $mapDevice->vehicle_type = $request['vehicleType'];
            $mapDevice->vehicle_make_model = $request['vaiclemodel'];
            $mapDevice->vehicle_model_year = $request['vaimodelyear'];
            $mapDevice->vehicle_insurance_renew_date = $request['vaicleinsurance'];
            $mapDevice->vehicle_pollution_renew_date = $request['pollutiondate'];
            $mapDevice->customer_name = $request['customerName'];
            $mapDevice->customer_email = $request['customerEmail'];
            $mapDevice->password = $request['customerMobile'];
            $mapDevice->passwordText = $request['customerMobile'];
            $mapDevice->customer_mobile = $request['customerMobile'];
            $mapDevice->customer_gst_no = $request['customergstin'];
            $mapDevice->customer_state = $request['coustomerState'];
            $mapDevice->customer_district = $request['coustomerDistrict'];
            $mapDevice->customer_arear = $request['coustomerArea'];
            $mapDevice->customer_pincode = $request['coustomerpincode'];
            $mapDevice->customer_address = $request['coustomeraddress'];
            $mapDevice->customer_rto_division = $request['rtoname'];
            $mapDevice->customer_aadhaar = $request['customeraadhar'];
            $mapDevice->customer_pan = $request['customerpanno'];
            $mapDevice->technician_id = $request['techniciaId'];
            $mapDevice->invoice_no = $request['InvoiceNo'];
            $mapDevice->vehicle_km_reading = $request['VehicleKMReading'];
            $mapDevice->driver_license_no = $request['DriverLicenseNo'];
            $mapDevice->mapped_date = $request['MappedDate'];
            $mapDevice->no_of_panic_buttons = $request['NoOfPanicButtons'];
            if ($request['vehicleimg'] != null) {
                $vehicleimgfilePath = $request->file('vehicleimg')->store('uploads', 'public');
                $mapDevice->vehicle = $vehicleimgfilePath;
            }
            if ($request['vehiclerc'] != null) {
                $vehiclercfilePath = $request->file('vehiclerc')->store('uploads', 'public');
                $mapDevice->rc = $vehiclercfilePath;
            }

            if ($request['vaicledeviceimg'] != null) {
                $vaicledeviceimgfilePath = $request->file('vaicledeviceimg')->store('uploads', 'public');
                $mapDevice->device = $vaicledeviceimgfilePath;
            }

            if ($request['pancardimg'] != null) {
                $pancardimgfilePath = $request->file('pancardimg')->store('uploads', 'public');
                $mapDevice->pan = $pancardimgfilePath;
            }

            if ($request['aadharcardimg'] != null) {
                $aadhaarfilePath = $request->file('aadharcardimg')->store('uploads', 'public');
                $mapDevice->aadhaar = $aadhaarfilePath;
            }
            if ($request['invoiceimg'] != null) {
                $invoiceimgfilePath = $request->file('invoiceimg')->store('uploads', 'public');
                $mapDevice->invoice = $invoiceimgfilePath;
            }
            if ($request['signatureimg'] != null) {
                $signatureimgfilePath = $request->file('signatureimg')->store('uploads', 'public');
                $mapDevice->signature = $signatureimgfilePath;
            }
            if ($request['panicbuttonimg'] != null) {
                $panicbuttonimgfilePath = $request->file('panicbuttonimg')->store('uploads', 'public');
                $mapDevice->panic_button = $panicbuttonimgfilePath;
            }
            $mapDevice->save();
            return redirect()->back()->with('success', 'Device Mapped successfully!');
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('error', $th->getMessage());
        }

    }
}

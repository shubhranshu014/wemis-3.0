<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\LoginController;

Route::get('/vehical-list', function (Request $request) {
   return response()->json(auth('api')->user()->vehicle_registration_number);
})->middleware('auth:sanctum');

Route::post('/vehical-map/{vehicalNo}', function ($vehicalNo) {
    // Fetch the first record from the GpsData model where 'data' contains the vehicle number
    $data = App\Models\GpsData::where('data', 'LIKE', '%' . $vehicalNo . '%')->first();

    // Check if data exists
    if (!$data) {
        return response()->json(['message' => 'Data not found for the provided vehicle number'], 404);
    }

    // Regular expression to match the latitude and longitude values
    $latitudePattern = '/(-?\d+\.\d{6})\,N/';  // Latitude: a number with 6 decimal places followed by a comma and N
    $longitudePattern = '/(-?\d+\.\d{6})\,E/'; // Longitude: a number with 6 decimal places followed by a comma and E

    // Use preg_match to extract the latitude and longitude from the 'data' column
    preg_match($latitudePattern, $data->data, $latitudeMatches);
    preg_match($longitudePattern, $data->data, $longitudeMatches);

    // Initialize response data
    // $response = [
    //     'data' => $data,
    // ];

    // Check if latitude match was found
    if (isset($latitudeMatches[1])) {
        $response['latitude'] = $latitudeMatches[1];
    } else {
        $response['latitude'] = 'Latitude not found';
    }

    // Check if longitude match was found
    if (isset($longitudeMatches[1])) {
        $response['longitude'] = $longitudeMatches[1];
    } else {
        $response['longitude'] = 'Longitude not found';
    }

    // Return the response as JSON with the data, latitude, and longitude
    return response()->json($response);
})->middleware('auth:sanctum');


Route::get('/test', function (Request $request) {
    return 'Hello world!';
});
Route::post('/login', [LoginController::class,'login']);

@extends('layouts.manufacturer')
@section('content')
    <div class="row align-items-center" style="background-color: #260950;"> <!-- Use align-items-center here -->
        <div class="col-md-4">
            <h4 class="card-title text-white px-2 py-3 mb-0">Manage Map Device</h4>
            <!-- Remove the margin bottom -->
        </div>
        <div class="col-md-8">
            <div class="d-flex justify-content-md-end justify-content-sm-center pe-2">
                <button type="button" class="btn btn-sm btn-theme border-white" data-bs-toggle="modal"
                    data-bs-target="#mapDevice" style="white-space: nowrap;">
                    Map Device
                </button>
            </div>
        </div>
    </div>
    @if (Session::has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong> {{ Session::get('success') }}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if (Session::has('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong> {{ Session::get('error') }}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <h5 class="p-2"><em>Its Shows the maped devices list</em></h5>
    <div class="d-flex flex-row-reverse">
        <div class="p-2"><a href="" class="btn btn-theme" data-bs-toggle="modal" data-bs-target="#exampleModal">Edit</a>
        </div>
        <div class="p-2"><a href="" class="btn btn-theme" data-bs-toggle="modal"
                data-bs-target="#certificates">Certificates</a></div>
        <div class="p-2"><a href="" class="btn btn-theme" data-bs-toggle="modal"
                data-bs-target="#exampleModal">Documents</a></div>
    </div>

    <div class="row my-2">
        <div class="col-md-12">
            <table class="table table-striped dataTable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Info</th>
                        <th>Device no</th>
                        <th>Sim Details</th>
                        <th>State/Division</th>
                        <th>Vehicle Detail</th>
                        <th>Distributor Name(Mobile)</th>
                        <th>Dealer(Technician)</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($mapDevices as $item)
                                    <tr>
                                        <td>
                                            {{-- <div class="form-check"> --}}
                                                <!-- Checkbox inside table cell with proper class -->
                                                <input class="" type="checkbox" value="{{ $item->id }}"
                                                    id="flexCheckDefault-{{ $loop->index }}" onchange="handleCheckboxSelection(this)">
                                                {{--
                                            </div> --}}
                                        </td>
                                        <td><a href="" class="btn" style="background-color: #260950;color:#fff">Info</a></td>
                                        <td>{{ $item->barcodes->pluck('serialNumber')->first() }}</td>
                                        <td>
                                            @php
                                                $sim = App\Models\Sim::where('barcode_id', $item->device_seriel_no)->get();
                                            @endphp
                                            @foreach ($sim as $simdata)
                                                {{ $simdata->simNo }}
                                            @endforeach
                                            {{-- {{$item->device_seriel_no}} --}}
                                        </td>
                                        <td>{{$item->customer_state  ?? 'N/A'}} / {{$item->customer_arear ?? 'N/A'}}</td>
                                        <td>{{ $item->vehicle_registration_number }}</td>
                                        <td>{{ $item->dealer->pluck('business_name')->first() }} |
                                            <small>{{ $item->dealer->pluck('mobile')->first() }}</small>
                                        </td>
                                        <td>{{$item->dealer->pluck('business_name')->first()}}</td>
                                    </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>


    {{-- modal map device --}}
    <div class="modal fade" id="mapDevice" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">
                        Map Device
                    </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('map.device.store') }}" method="post" enctype="multipart/form-data">
                        <!-- RFC Header -->
                        @csrf
                        <div class="border border-secondary rounded m-3">
                            <div class="bg-light p-2 border rounded-top">
                                <h5 class="text-center mb-0">RFC Info</h5>
                            </div>

                            <!-- Form Body -->
                            <div class="border rounded p-3">
                                <div class="row">
                                    <!-- Country Dropdown -->
                                    <div class="form-group col-md-3">
                                        <label for="country">Country<span class="badge text-danger">*</span></label>
                                        <select name="country" class="form-select form-select-sm country">
                                            <option disabled @selected(true)>Choose Country
                                            </option>
                                            <option value="china" @selected(old('country') == 'china')>China
                                            </option>
                                            <option value="india" @selected(old('country') == 'india')>India
                                            </option>
                                        </select>
                                    </div>

                                    <!-- State Dropdown -->
                                    <div class="form-group col-md-3">
                                        <label for="state">State</label> <span class="badge text-danger">*</span>
                                        <select class="form-select form-select-sm state" name="state" id=""></select>
                                    </div>

                                    <!-- Distributor Dropdown -->
                                    <div class="form-group col-md-3">
                                        <label for="distributor">Distributor</label><span class="badge text-danger">*</span>
                                        <Select class="form-select form-select-sm distributor" name="distributor">
                                            <option value="">Select Distributor</option>
                                        </Select>
                                    </div>

                                    <!-- Dealer Dropdown -->
                                    <div class="form-group col-md-3">
                                        <label for="dealer">Dealer </label><span class="badge text-danger">*</span>
                                        <Select class="form-select form-select-sm dealer" name="dealer">
                                            <option value="">Select Dealer</option>
                                        </Select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="border border-secondary rounded m-3">
                            <!-- Device Info Header -->
                            <div class="bg-light p-2 border rounded-top">
                                <h5 class="text-center mb-0">Device Info</h5>
                            </div>

                            <!-- Form Body -->
                            <div class="border rounded p-2">
                                <div class="row">
                                    <!-- Device Type Dropdown -->
                                    <div class="form-group col-md-4">
                                        <label for="deviceType">Device Type </label><span class="text-danger badge">*</span>
                                        <select id="deviceType" name="deviceType" class="form-select form-select-sm">
                                            <option>Select Device Type</option>
                                            <option value="New">New</option>
                                            <option value="Renewal">Renewal</option>
                                            <!-- Add more device types here if needed -->
                                        </select>
                                    </div>

                                    <!-- Device No Dropdown -->
                                    <div class="form-group col-md-4">
                                        <label for="deviceNo">Device No</label><span class="text-danger badge">*</span>
                                        <select name="deviceNo" class="form-select form-select-sm deviceno">
                                            <option>Select Device Number</option>
                                            <!-- Add more device numbers here if needed -->
                                        </select>
                                    </div>

                                    <!-- Voltage Input (disabled) -->
                                    <div class="form-group col-md-4">
                                        <label for="voltage">Voltage</label>
                                        <input type="text" class="form-control form-control-sm voltage" name="voltage"
                                            placeholder="" readonly>
                                    </div>

                                    <!-- Element Type Input (disabled) -->
                                    <div class="form-group col-md-4">
                                        <label for="elementType">Element Type</label>
                                        <input type="text" class="form-control form-control-sm element_type"
                                            id="elementType" name="elementType" placeholder="" readonly>
                                    </div>

                                    <!-- Batch No Input (disabled) -->
                                    <div class="form-group col-md-4">
                                        <label for="batchNo">Batch No.</label>
                                        <input type="text" class="form-control form-control-sm batch_no" id="batchNo"
                                            name="batchNo" placeholder="" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="border border-secondary rounded m-3">
                            <!-- Form Header -->
                            <div class="bg-light p-2 border rounded-top  simInfo">
                                <h5 class=" text-center mb-0">SIM Info</h5>
                            </div>
                        </div>

                        <div class="border border-secondary rounded m-3">
                            <div class="bg-light p-2 border rounded-top">
                                <h5 class="text-center mb-0">
                                    Vehicle Info
                                </h5>
                            </div>
                            <div class="border rounded p-3">
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label for="vehicleBirth">Vehicle Birth<span
                                                class="text-danger badge">*</span></label>
                                        <select id="vehicleBirth" name="vehicleBirth" class="form-select form-select-sm">
                                            <option selected value="Old">Old</option>
                                            <option value="New">New</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4" id="vaicleregNumber">
                                        <label for="regNumber">Registration No.<span
                                                class="text-danger badge">*</span></label>
                                        <input type="text" class="form-control form-control-sm" id="regNumber"
                                            name="regNumber" placeholder="Enter Registration Number">
                                    </div>
                                    <div class="form-group col-md-4" id="vaicledate">
                                        <label for="date">Date<span class="text-danger badge">*</span></label>
                                        <input type="date" class="form-control form-control-sm" id="date" name="regdate">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="chassisNumber">Chassis Number<span
                                                class="text-danger badge">*</span></label>
                                        <input type="text" class="form-control form-control-sm" id="chassisNumber"
                                            name="chassisNumber" placeholder="Enter Chassis Number">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="engineNumber">Engine Number<span
                                                class="text-danger badge">*</span></label>
                                        <input type="text" class="form-control form-control-sm" id="engineNumber"
                                            name="engineNumber" placeholder="Enter Engine Number">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="vehicleType">Vehicle Type<span
                                                class="text-danger badge">*</span></label>
                                        <select id="vehicleType" name="vehicleType" class="form-control form-control-sm">
                                            <option selected>Choose Vehicle Type</option>
                                            <option value="AUTO">AUTO</option>
                                            <option value="BUS">BUS</option>
                                            <option value="JCB">JCB</option>
                                            <option value="MAXI CAB">MAXI CAB</option>
                                            <option value="OIL TANK">OIL TANK</option>
                                            <option value="PICKUP">PICKUP</option>
                                            <option value="SCHOOL BUS">SCHOOL BUS</option>
                                            <option value="TANK TRUCK">TANK TRUCK</option>
                                            <option value="TAXI">TAXI</option>
                                            <option value="TEMPO">TEMPO</option>
                                            <option value="TRACTOR">TRACTOR</option>
                                            <option value="TRAILER TRUCK">TRAILER TRUCK</option>
                                            <option value="TRAVILER">TRAVILER</option>
                                            <option value="TRUCK">TRUCK</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="makeModel">Make & Model<span class="text-danger badge">*</span></label>
                                        <input type="text" class="form-control form-control-sm" id="vaiModel"
                                            name="vaiclemodel" placeholder="Enter Make & Model">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="modelYear">Model Year<span class="text-danger badge">*</span></label>
                                        <input type="text" class="form-control" id="modelYear" name="vaimodelyear"
                                            placeholder="Enter Model Year">
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="insurance">Insu. Renew date</label>
                                        <input type="date" class="form-control" id="insurance" name="vaicleinsurance">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="panicButton">Pollution Renew date</label>
                                        <input type="date" class="form-control" id="panicButton" name="pollutiondate">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="border border-secondary rounded m-3">
                            <div class="bg-light p-3 border rounded-top">
                                <h5 class="text-center mb-0">Customer Info</h5>
                            </div>
                            <div class="border rounded p-3">
                                <div class="row">
                                    <!-- Customer Name -->
                                    <div class="form-group col-md-4">
                                        <label for="customerName">Name</label>
                                        <input type="text" class="form-control" id="customerName" name="customerName"
                                            placeholder="Enter Name">
                                    </div>

                                    <!-- Customer Email -->
                                    <div class="form-group col-md-4">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control" id="email" name="customerEmail"
                                            placeholder="Enter Email">
                                    </div>

                                    <!-- Customer Mobile -->
                                    <div class="form-group col-md-4">
                                        <label for="mobile">Mobile</label>
                                        <input type="text" class="form-control" id="mobile" name="customerMobile"
                                            placeholder="Enter Mobile">
                                    </div>

                                    <!-- GSTIN Number -->
                                    <div class="form-group col-md-4">
                                        <label for="gstin">GSTIN Number</label>
                                        <input type="text" class="form-control" id="gstin" name="customergstin"
                                            placeholder="Enter GSTIN">
                                    </div>



                                    <!-- Country -->
                                    <div class="form-group col-md-6">
                                        <label for="country">Country<span class="badge text-danger">*</span></label>
                                        <select name="country" class="form-select form-select-sm customer-country">
                                            <option disabled @selected(true)>Choose Country
                                            </option>
                                            <option value="china" @selected(old('country') == 'china')>China
                                            </option>
                                            <option value="india" @selected(old('country') == 'india')>India
                                            </option>
                                        </select>
                                    </div>

                                    <!-- State Dropdown -->
                                    <div class="form-group col-md-6">
                                        <label for="state">State</label> <span class="badge text-danger">*</span>
                                        <select class="form-select form-select-sm customer-state" name="state"
                                            id=""></select>
                                    </div>


                                    <!-- District -->
                                    <div class="col-md-4 form-group">
                                        <label for="district">District <span class="text-danger">*</span></label>
                                        <select name="coustomerDistrict"
                                            class="form-select form-select-sm customer-district">
                                            <option value="" hidden>Select District</option>
                                        </select>
                                    </div>

                                    <!-- Area -->
                                    {{-- <div class="col-md-4 form-group">
                                        <label for="area">Area <span class="text-danger">*</span></label>
                                        <select name="coustomerArea" id="area" class="form-select">
                                            <option value="" hidden>Select Area</option>
                                        </select>
                                    </div> --}}
                                    <!-- Pin Code -->
                                    <div class="col-md-4 form-group">
                                        <label for="pincode">Pin Code <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control form-control-sm" name="coustomerPincode"
                                            id="pincode">
                                    </div>

                                    <!-- Address -->
                                    <div class="col-md-4 form-group">
                                        <label for="address">Address <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control form-control-sm" id="address"
                                            name="coustomeraddress" placeholder="Enter Address">
                                    </div>

                                    <!-- RTO Division -->
                                    <div class="col-md-4 form-group">
                                        <label for="rtoDivision">RTO Division <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control form-control-sm" name="coustomerRtoname"
                                            id="rtoname" placeholder="Enter RTO Division">
                                    </div>

                                    <!-- Aadhaar -->
                                    <div class="col-md-4 form-group">
                                        <label for="aadhaar">Aadhaar <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control form-control-sm" id="aadhaar"
                                            name="customeraadhar" placeholder="Enter Aadhaar">
                                    </div>

                                    <!-- PAN Number -->
                                    <div class="col-md-4 form-group">
                                        <label for="panNo">Pan No <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control form-control-sm" id="panNo"
                                            name="customerpanno" placeholder="Enter PAN No">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="border border-secondary rounded m-3">
                            <div class="bg-light p-2 border rounded-top">
                                <h5 class="text-center mb-0">Packages</h5>
                            </div>
                            <div class="border rounded p-3">
                                <div class="row justify-content-center">
                                    @foreach ($subscriptions as $item)
                                        <div class="col-md-3 mb-2 Packages">
                                            <div class=" text-center shadow-sm h-100 select-subscription" data-id=""
                                                style="width: 100%; cursor: pointer;">
                                                <!-- Added cursor:pointer for click indication -->
                                                <div class="card-body">
                                                    <div class="d-flex justify-content-between">
                                                        <h5 class="card-title fw-bold">{{ $item->packageName }}</h5>
                                                        <span class="packageId" hidden>{{ $item->id }}</span>
                                                        <div class="d-flex align-items-center">
                                                            <i class="bi bi-clock me-1"></i>
                                                            <span></span>
                                                        </div>
                                                    </div>
                                                    <h5 class="mt-2"><i class="fa-solid fa-indian-rupee-sign"></i>
                                                        {{ $item->price }}</h5>
                                                    <p class="text-muted">{{ $item->billingCycle }}</p>
                                                    {{-- <p class="card-text">{{$item->description}}</p> --}}
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <input type="hidden" name="subscriptionpackage" id="subscriptionpackage">
                            </div>

                        </div>
                        <div class="border border-secondary rounded m-3">
                            <div class="bg-light border rounded-top p-3">
                                <div class="row align-items-center">
                                    <!-- Technician Info Title -->
                                    <div class="col-md-6 text-center">
                                        <h5>Technician Info</h5>
                                    </div>

                                    <!-- Select Technician Dropdown -->
                                    <div class="col-md-3">
                                        <select class="form-select form-select-sm technician" name="technician">
                                            <option selected disabled>Select Technician</option>
                                        </select>
                                    </div>

                                    <!-- Add Technician Button -->
                                    <div class="col-md-3 text-end">
                                        <button type="button" class="btn" data-bs-toggle="modal"
                                            data-bs-target="#addTechnician" style="background-color: #260950;color:#fff">
                                            Add Technician
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="row p-2">
                                <div class="form-group col-md-4">
                                    <label for="firstName" class="form-label">Name <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control form-control-sm" id="technician_name" name="name"
                                        placeholder="First Name" require>
                                </div>
                                {{-- <div class="form-group col-md-4">
                                    <label for="lastName" class="form-label">Last Name <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control form-control-sm" id="lastName"
                                        name="techlastName" placeholder="Last Name" require>
                                </div> --}}
                                <div class="form-group col-md-4">
                                    <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control form-control-sm" id="technician_email"
                                        name="techemail" placeholder="Email">
                                </div>
                                {{-- <div class="form-group col-md-4">
                                    <label for="gender" class="form-label">Gender <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control form-control-sm" id="Gender" name="techgender"
                                        placeholder="Gender">
                                </div> --}}
                                <div class="form-group col-md-4">
                                    <label for="mobile" class="form-label">Mobile <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control form-control-sm" id="technician_mobile"
                                        name="techmobile" placeholder="Mobile">
                                </div>
                                {{-- <div class="form-group col-md-4">
                                    <label for="dob" class="form-label">Date Of Birth</label>
                                    <input type="date" class="form-control form-control-sm" id="dob" name="techdob"
                                        placeholder="Date Of Birth">
                                </div> --}}
                            </div>
                        </div>
                </div>


                <div class="border border-secondary rounded m-3">
                    <div class="bg-light p-2 border rounded-top">
                        <h5 class="text-center mb-0">Installation Detail</h5>
                    </div>
                    <div class="border rounded p-3">
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label for="InvoiceNo" class="form-label">Invoice No<span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control form-control-sm" id="InvoiceNo" name="InvoiceNo">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="Vehicle KM Reading" class="form-label">Vehicle KM
                                    Reading<span class="text-danger">*</span></label>
                                <input type="text" class="form-control form-control-sm" id="VehicleKMReading"
                                    name="VehicleKMReading">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="Driver License No" class="form-label">Driver License
                                    No<span class="text-danger">*</span></label>
                                <input type="text" class="form-control form-control-sm" id="DriverLicenseNo"
                                    name="DriverLicenseNo">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="Mapped Date" class="form-label">Mapped Date<span
                                        class="text-danger">*</span></label>
                                <input type="date" class="form-control form-control-sm" id="MappedDate" name="MappedDate">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="No Of Panic Buttons" class="form-label">No Of Panic
                                    Buttons<span class="text-danger">*</span></label>
                                <input type="text" class="form-control form-control-sm" id="NoOfPanicButtons"
                                    name="NoOfPanicButtons">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="border border-secondary rounded m-3">
                    <div class="bg-light p-2 border rounded-top">
                        <h5 class="text-center mb-0">Vehicle Document (* document)</h5>
                    </div>
                    <div class="border rounded p-3">
                        <p class="text-danger small mb-2 d-inline-block text-center">* File type
                            supported PNG, JPG, JPEG, and
                            PDF
                            only and file size should be up to 6MB.</p>
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label for="vehicle" class="form-label">Vehicle</label>
                                <input type="file" class="form-control form-control-sm" id="vehicle" name="vehicleimg">
                            </div>
                            <div class="col-md-4">
                                <label for="rc" class="form-label">RC</label>
                                <input type="file" class="form-control form-control-sm" id="rc" name="vehiclerc">
                            </div>
                            <div class="col-md-4">
                                <label for="device" class="form-label">Device</label>
                                <input type="file" class="form-control form-control-sm" id="device" name="vaicledeviceimg">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label for="pan" class="form-label">Pan Card</label>
                                <input type="file" class="form-control form-control-sm" id="pan" name="pancardimg">
                            </div>
                            <div class="col-md-4">
                                <label for="aadhaar" class="form-label">Aadhaar Card</label>
                                <input type="file" class="form-control form-control-sm" id="aadhaar" name="aadharcardimg">
                            </div>
                            <div class="col-md-4">
                                <label for="invoice" class="form-label">Invoice</label>
                                <input type="file" class="form-control form-control-sm" id="invoice" name="invoiceimg">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label for="signature" class="form-label">Signature</label>
                                <input type="file" class="form-control form-control-sm" id="signature" name="signatureimg">
                            </div>
                            <div class="col-md-4">
                                <label for="panic" class="form-label">Panic Button with
                                    Sticker</label>
                                <input type="file" class="form-control form-control-sm" id="panic" name="panicbuttonimg">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn" style="background-color: #260950;color:#fff">Submit</button>
                    <button type="reset" class="btn btn-secondary">Cancel</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Certificates -->
    <div class="modal fade" id="certificates" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Certificates</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('download.PDF') }}" method="post">
                        @csrf
                        <div class="mb-2">
                            <select name="type" class="form-select form-select-sm">
                                <option value="customer_copy">Customer Copy</option>
                                <option value="department_copy">Department Copy</option>
                            </select>
                        </div>
                        <input type="text" name="deviceId" id="deviceId" style="display: none">
                        <div class="mb-2">
                            <label for="" class="form-label">Leatter Head</label>
                            <select name="letterHead" class="form-select form-select-sm">
                                <option value="allow">Allow</option>
                                <option value="deny">Deny</option>
                            </select>
                        </div>
                        <div class="mb-2">
                            <label for="" class="form-label">Certificate</label>
                            <select name="certificate" class="form-select form-select-sm">
                                <option value="installation">Installation</option>
                                <option value="warranty">Warranty</option>
                                <option value="fitment">Fitment</option>
                            </select>
                        </div>
                        <div style="text-align: right">
                            <button class="btn" style="background-color: #260950;color:#fff">Download</button>
                        </div>
                    </form>
                </div>
                {{-- <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div> --}}
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function () {
            $('.state').change(function () {
                $('.distributor').empty();
                $('.distributor').append('<option value="null">Select distributer</option>');
                const state = $(this).val();
                //alert(state);
                if (state) {
                    $.ajax({
                        url: `/manufacturer/fetch/distributer/${state}`,
                        type: 'GET',
                        dataType: 'json',
                        success: function (data) {
                            //alert(JSON.stringify(data));
                            data.forEach(distributer => {
                                $(`.distributor`).append(`
            <option value="${distributer.id}">${distributer.business_name}</option>
            `);
                            });
                        }
                    });
                }
            });
        });
    </script>

    <script>
        $(document).ready(function () {
            $('.distributor').change(function () {
                $('.dealer').empty(); // Clear existing options in the dealer dropdown
                $('.dealer').append('<option disabled selected>Select dealer</option>');
                const distributer_id = $(this).val(); // Get the selected distributor ID
                if (distributer_id) { // Ensure a valid distributor ID is selected
                    $.ajax({
                        url: `/manufacturer/fetch/dealer/${distributer_id}`, // API endpoint
                        type: 'GET',
                        dataType: 'json',
                        success: function (data) {
                            // Check if data is an array and populate dealer dropdown
                            if (Array.isArray(data) && data.length > 0) {
                                data.forEach(dealer => {
                                    $('.dealer').append(`
                                <option value="${dealer.id}">${dealer.business_name}</option>
                            `);
                                });
                            } else {
                                alert('No dealers found for the selected distributor.');
                            }
                        },
                        error: function (xhr, status, error) {
                            console.error('AJAX error:', status, error);
                            alert('Failed to fetch dealers. Please try again.');
                        }
                    });
                } else {
                    alert('Please select a valid distributor.');
                }
            });
        });
    </script>

    <script>
        $(document).ready(function () {
            $(".Packages").click(function () {
                // You can also access the package data attributes or other content
                var packageId = $(this).find('.packageId').text();
                var packagePrice = $(this).find('.card-body h5').first().text();

                console.log("Package Id: " + packageId);

                // Optionally, you could set the value in the hidden input field
                $("#subscriptionpackage").val(packageId); // Set package name in hidden input

                // Change the background color of the clicked element
                $(this).css('background-color', 'green');  // Set active color

                // Reset the background color of all other .Packages elements
                $(".Packages").not(this).css('background-color', ''); // Reset others
            });

        });
    </script>
    <script>
        $('.dealer').change(function () {
            const dealer = $(this).val();
            alert(dealer);
            if (dealer) {
                $.ajax({
                    url: `/manufacturer/fetch/device-by-dealer/${dealer}`,
                    type: 'GET',
                    dataType: 'json',
                    success: function (data) {
                        alert(JSON.stringify(data))
                        //Validate response
                        if (Array.isArray(data) && data.length > 0) {
                            // Populate distributors
                            $('.deviceno').empty().append(
                                '<option value="null">Select Device No</option>');
                            data.forEach(device => {
                                $('.deviceno').append(`
                                        <option value="${device.barcode.id}">${device.barcode.IMEINO}</option>
                                    `);
                            });
                        } else {
                            // No distributors found
                            $('.deviceno').empty().append(
                                '<option value="null">No Device Found</option>');
                        }
                    },
                    error: function (xhr, status, error) {
                        // Handle errors
                        $('.deviceno').empty().append(
                            '<option value="null">Error Loading Device</option>');
                        console.error(`Error: ${error}, Status: ${status}`);
                    }
                });
                $.ajax({
                    url: `/manufacturer/fetch/technician/${dealer}`,
                    type: 'GET',
                    dataType: 'json',
                    success: function (data) {
                        alert(JSON.stringify(data));
                        if (Array.isArray(data) && data.length > 0) {
                            // Populate distributors
                            $('.technician').empty().append(
                                '<option value="null">Select Technician No</option>');
                            data.forEach(technician => {
                                $('.technician').append(`
                                        <option value="${technician.id}" name="${technician.name}" email="${technician.email}" mobile="${technician.mobile}">${technician.name}</option>
                                    `);
                            });
                        } else {
                            // No distributors found
                            $('.deviceno').empty().append(
                                '<option value="null">No Device Found</option>');
                        }
                    }
                });


            }
        });
    </script>
    <script>
        $('.technician').change(function () {
            // Get the selected option element
            const selectedOption = $(this).find('option:selected');

            // Get the value of the selected option
            const technician = $(this).val();

            // Get the custom attribute (mobile) of the selected option
            const mobile = selectedOption.attr('mobile');
            const name = selectedOption.attr('name');
            const email = selectedOption.attr('email');

            // Show alerts

            $('#technician_name').val(name);
            $('#technician_mobile').val(mobile);
            $('#technician_email').val(mobile);

        });
    </script>
    <script>
        $('.deviceno').change(function () {
            const deviceNo = $(this).val();
            // alert(deviceNo);
            if (deviceNo) {
                $.ajax({
                    url: `/manufacturer/fetch/simInfoByBarcode/${deviceNo}`,
                    type: 'GET',
                    dataType: 'json',
                    success: function (data) {
                        if (data) {
                            alert(JSON.stringify(data))
                            data.forEach(sim_info => {
                                $('.simInfo').append(
                                    ` 
                                            <div class="row py-2">
                                              <div class="col-md-3">
                                                <label>Sim No.</label>
                                                <input class="form-control form-control-sm" value="${sim_info.simNo}">
                                                </div> 
                                                 <div class="col-md-3">
                                                     <label>ICCID No.</label>
                                                     <input class="form-control form-control-sm" value="${sim_info.ICCIDNo}">
                                                </div> 
                                                 <div class="col-md-3">
                                                     <label>Validity</label>
                                                     <input class="form-control form-control-sm" value="${sim_info.validity}">
                                                </div> 
                                                <div class="col-md-3">
                                                    <label>Operator</label>
                                                    <input class="form-control form-control-sm" value="${sim_info.operator}">
                                                </div>  
                                            </div>
                                            `
                                )
                            });
                            // Example: populate a select dropdown with the returned data
                            // var options = data.options.map(function(option) {
                            //     return `<option value="${option.value}">${option.label}</option>`;
                            // }).join('');
                            // $('.deviceno').html(options);
                        } else {
                            // Handle failure or empty data scenario
                            // $('.deviceno').empty().append(
                            //     '<option value="null">No data available</option>');
                            alert('No data available')
                        }
                    },
                    error: function (xhr, status, error) {
                        // Handle AJAX error
                        console.error('AJAX request failed:', status, error);
                        // $('.deviceno').empty().append(
                        //     '<option value="null">Error fetching data</option>');
                        alert('Error fetching data')
                    }
                });
            } else {
                $('.deviceno').empty().append('<option value="null">Please select a device first</option>');
            }

        });
    </script>

    <script>
        // Define the districts object globally, so both event handlers can access it
        let districts = {
            "Andhra Pradesh": ['Chittoor', 'East Godavari', 'Guntur', 'Krishna', 'Kurnool', 'Nellore', 'Prakasam',
                'Srikakulam'
            ],
            "Maharashtra": ['Mumbai', 'Pune', 'Nagpur', 'Thane', 'Nashik', 'Solapur', 'Satara'],
            "Tamil Nadu": ['Chennai', 'Coimbatore', 'Madurai', 'Salem', 'Trichy', 'Erode'],
            "Odisha": ["Angul", "Balangir", "Balasore", "Bargarh", "Bhadrak", "Boudh", "Cuttack", "Debagarh",
                "Dhenkanal", "Gajapati",
                "Ganjam", "Jagatsinghpur", "Jajpur", "Jharsuguda", "Kalahandi", "Kandhamal", "Kendrapara",
                "Kendujhar", "Khordha",
                "Koraput", "Malkangiri", "Mayurbhanj", "Nabarangpur", "Nayagarh", "Nuapada", "Puri", "Rayagada",
                "Sambalpur",
                "Subarnapur", "Sundargarh"
            ]
        };

        // Handle country selection
        $('.customer-country').on('change', function () {
            $('.customer-state').empty();
            $('.customer-district').empty(); // Clear the district dropdown when country changes
            let value = this.value;

            // Define states for different countries
            let china = ['Beijing'];
            let india = ['Andhra Pradesh', 'Arunachal Pradesh', 'Assam', 'Bihar', 'Chhattisgarh', 'Goa', 'Gujarat',
                'Haryana', 'Himachal Pradesh', 'Jharkhand', 'Karnataka', 'Kerala', 'Maharashtra',
                'Madhya Pradesh', 'Manipur', 'Meghalaya', 'Mizoram', 'Nagaland', 'Odisha', 'Punjab',
                'Rajasthan', 'Sikkim', 'Tamil Nadu', 'Tripura', 'Telangana', 'Uttar Pradesh', 'Uttarakhand',
                'West Bengal', 'Andaman & Nicobar (UT)', 'Chandigarh (UT)',
                'Dadra & Nagar Haveli and Daman & Diu (UT)', 'Delhi [National Capital Territory (NCT)]',
                'Jammu & Kashmir (UT)', 'Ladakh (UT)', 'Lakshadweep (UT)', 'Puducherry (UT)'
            ];

            // Append states to the state dropdown based on the selected country
            switch (value) {
                case "china":
                    for (let state of china) {
                        $('.customer-state').append($('<option>', {
                            value: state,
                            text: state
                        }));
                    }
                    break;
                case "india":
                    for (let state of india) {
                        $('.customer-state').append($('<option>', {
                            value: state,
                            text: state
                        }));
                    }
                    break;
                default:
                    break;
            }
        });

        // Handle state selection to populate districts
        $('.customer-state').on('change', function () {
            $('.customer-district').empty(); // Clear existing districts
            let selectedState = this.value;

            // Check if the selected state has predefined districts
            let districtList = districts[selectedState] || [];

            if (districtList.length > 0) {
                for (let district of districtList) {
                    $('.customer-district').append($('<option>', {
                        value: district,
                        text: district
                    }));
                }
            } else {
                $('.customer-district').append($('<option>', {
                    value: "",
                    text: "No districts available"
                }));
            }
        });
    </script>

    <script>
        function handleCheckboxSelection(checkbox) {
            // Get all checkboxes in the table
            var checkboxes = document.querySelectorAll('.form-check-input');

            // Loop through all checkboxes
            checkboxes.forEach(function (item) {
                // If the current checkbox is not the one being clicked, uncheck it
                if (item !== checkbox) {
                    item.checked = false;
                }
            });

            // Get the value of the selected checkbox
            var selectedValue = checkbox.value;

            // Check if selectedValue is null or empty
            if (!selectedValue) {
                alert("Please select a device first.");
            } else {
                // If a value is selected, proceed with the action
                alert("Selected Device: " + selectedValue);
                $('#deviceId').val(selectedValue); // Assuming you have an element with ID "deviceId"
            }
        }
    </script>
@endsection
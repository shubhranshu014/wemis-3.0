@extends('layouts.manufacturer')
@section('content')
    <div class="row align-items-center mb-3" style="background-color: #260950;">
        <!-- Use align-items-center here -->
        <div class="col-md-4">
            <h4 class="card-title text-white px-2 py-3">Bar Code List</h4>
        </div>
        <div class="col-md-8">
            <div class="d-flex justify-content-md-end justify-content-sm-center pe-2">
                <a href="{{ route('create.admin') }}" class="btn btn-sm btn-theme" data-bs-toggle="modal"
                    data-bs-target="#createModal" style="border: 1px solid #fff;white-space: nowrap;">
                    Bar Code
                </a>
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

    <div class="row align-items-center"> <!-- Use align-items-center here -->
        <div class="col-md-12 text-center py-2">
            <h3><i>Barcode List</i></h3>
            <small>Its Shows the list of bar codes</small>
        </div>

        <div class="table-responsive">
            <table class="table table-striped dataTable">
                <thead>
                    <th>Device Serial No</th>
                    <th>SIM Details </th>
                    <th>ICCID No / SIM Manufacture</th>
                    <th>Type</th>
                    <th>Model No</th>
                    <th>Part No </th>
                    <th>Barcode Type</th>
                    <th>Created At</th>
                    <th>Status</th>

                </thead>
                <tbody>
                    @foreach ($barCode as $item)
                        <tr>
                            <td>
                                <a data-bs-toggle="modal" data-bs-target="#deviceModal{{ $loop->iteration }}"
                                    title="Device Info!">
                                    {{ $item->serialNumber }}
                                    <br>
                                    {{ $item->barcodeNo }}
                                </a>
                            </td>
                            <td>
                                @php
                                    $sim = DB::table('sims')->where('barcode_id', $item->id)->get();
                                @endphp
                                @foreach ($sim as $simdata)
                                    <a data-bs-toggle="modal" data-bs-target="#SimModal{{ $simdata->simNo }}"
                                        style="text-decoration: none" title="Sim Info!">{{ $simdata->simNo }}</a><br>

                                    <!-- Modal -->
                                    <div class="modal fade" id="SimModal{{ $simdata->simNo }}" tabindex="-1"
                                        aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header" style="background-color: #260950;color:#fff">
                                                    <h1 class="modal-title fs-5">
                                                        SIM Info</h1>
                                                    <a class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                        <i class="fa-solid fa-xmark"></i>
                                                    </a>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row mb-3">
                                                        <div class="col-md-6">
                                                            <strong>SIM No.</strong>
                                                            {{ $simdata->simNo }}
                                                        </div>
                                                        <div class="col-md-6">
                                                            <strong>ICCID No.</strong>
                                                            {{ $simdata->ICCIDNo }}
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <div class="col-md-6">
                                                            <strong>Valid Till</strong>
                                                            {{ $simdata->validity }}
                                                        </div>
                                                        <div class="col-md-6">
                                                            <strong>Operator</strong>
                                                            {{ $simdata->operator }}
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <div class="col-md-6">
                                                            <strong>Manufacture</strong>
                                                            {{ $simdata->manufacture }}
                                                        </div>
                                                        <div class="col-md-6">
                                                            <strong>Created At</strong>
                                                            {{ $simdata->created_at }}
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </td>
                            <td>
                                @foreach ($sim as $simdata)
                                    <span style="text-decoration: none">{{ $simdata->ICCIDNo }}</span> /
                                    <span
                                        style="text-decoration: none;color:#260950">{{ $simdata->manufacture }}</span><br>
                                @endforeach
                            </td>
                            <td>{{ $item->elementType->pluck('type')->first() }}</td>
                            <td>{{ $item->modelNo->pluck('model_no')->first() }}</td>
                            <td>{{ $item->partNo->pluck('part_no')->first() }}</td>
                            <td>
                                @if ($item->is_renew == 0)
                                    <em>NEW</em>
                                @else
                                    <em>NOT NEW</em>
                                @endif
                            </td>
                            <td>{{ $item->created_at }}</td>
                            <td>
                                @if ($item->status == 0)
                                    <span class="btn text-white bg-success">ACTIVE</span>
                                @elseif($item->status == 1)
                                    <span class="btn text-white bg-warning">ALLOCATED</span>
                                @else
                                    <span class="btn text-white bg-danger">USED</span>
                                @endif
                            </td>
                        </tr>
                        {{-- Device Details Modal --}}
                        <div class="modal fade" id="deviceModal{{ $loop->iteration }}" tabindex="-1"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Bar Code /
                                            {{ $item->barcodeNo }} / Other info
                                        </h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="card mb-4">
                                            <div class="card-header text-center text-white">
                                                DEVICE DETAIL
                                            </div>
                                            <div class="card-body">
                                                <div class="row mb-3">
                                                    <div class="col-md-12 text-center">
                                                        {{-- <img src="qr-code-placeholder.png"
                                                                                                    alt="QR Code" class="img-fluid"
                                                                                                    style="max-width: 150px;"> --}}
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <strong>Device Sr No:</strong>
                                                                {{ $item->serialNumber }}
                                                            </div>
                                                            <div class="col-md-6">
                                                                <strong>Bar_Code_No:</strong>
                                                                {{ $item->barcodeNo }}
                                                            </div>
                                                            <div class="col-md-6 mt-2">
                                                                <strong>IMEI No:</strong>
                                                                {{ $item->IMEINO }}
                                                            </div>
                                                            <div class="col-md-6 mt-2">
                                                                <strong>Element Type:</strong>
                                                                {{ $item->elementType->pluck('type')->first() }}
                                                            </div>
                                                            <div class="col-md-6 mt-2">
                                                                <strong>Voltage:</strong>
                                                                {{ $item->modelNo->pluck('voltage')->first() }}
                                                            </div>
                                                            <div class="col-md-6 mt-2">
                                                                <strong>Element:</strong>
                                                                {{ $item->element->pluck('name')->first() }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Model Details Section -->
                                        <div class="card mb-4">
                                            <div class="card-header text-center text-white">
                                                MODEL DETAILS
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <strong>Model No:</strong>
                                                        {{ $item->modelNo->pluck('model_no')->first() }}
                                                    </div>
                                                    <div class="col-md-6">
                                                        <strong>Part No:</strong>
                                                        {{ $item->partNo->pluck('part_no')->first() }}
                                                    </div>
                                                    <div class="col-md-6 mt-2">
                                                        <strong>COP:</strong>
                                                        {{-- CC0GT8730 --}}
                                                    </div>
                                                    <div class="col-md-6 mt-2">
                                                        <strong>Cop Valid Till:</strong>
                                                        {{-- 31st Mar 2025
                                                                                                12:00 AM --}}
                                                    </div>
                                                    <div class="col-md-6 mt-2">
                                                        <strong>TAC:</strong>
                                                        {{-- CN8737/CN8737 --}}
                                                    </div>
                                                    <div class="col-md-6 mt-2">
                                                        <strong>Batch No:</strong>
                                                        {{ $item->BatchNo }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Manufacturer Details Section -->
                                        <div class="card mb-4">
                                            <div class="card-header text-center text-white">
                                                MANUFACTURER DETAILS
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <strong>Manufacturer:</strong>
                                                        {{ $item->manufacturer->pluck('businees_name')->first() }}
                                                    </div>
                                                    <div class="col-md-6">
                                                        <strong>Created At:</strong>
                                                        {{ $item->created_at }}
                                                    </div>
                                                    <div class="col-md-6 mt-2">
                                                        <strong>Modified At:</strong>
                                                        {{ $item->updated_at }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Create Bar Code</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('barcode.store') }}" method="post">
                        @csrf
                        <div class="row mb-2">
                            <div class="col-md-6">
                                <label for="" class="form-label">Select Element</label>
                                <select name="element" class="form-select form-select-sm element">
                                    <option selected disabled>Element List:</option>
                                    @foreach ($element as $item)
                                        <option value="{{ $item->id }}">{{ $item->element->pluck('name')->first() }}
                                        </option>
                                    @endforeach

                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="" class="form-label">Select Type</label>
                                <select name="element_type" class="form-select form-select-sm element_type"></select>
                            </div>
                        </div>

                        <div class="row mb-2">
                            <div class="col-md-6">
                                <label for="" class="form-label">Select Model No</label>
                                <select name="model_no" class="form-select form-select-sm model-no">
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="" class="form-label">Enter Device Part No</label>
                                <select name="device_part_no" class="form-select form-select-sm partNo"></select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <label for="">TAC No</label>
                                <select name="tacNo" class="form-select form-select-sm tacNo">

                                </select>
                            </div>
                            <div class="col-md-3">
                                <label for="">COP No</label>
                                <select name="copNo" class="form-select form-select-sm copNo">

                                </select>
                            </div>
                            <div class="col-md-3">
                                <label for="">COP Valid Till</label>
                                <input type="text" name="copValidTill"
                                    class="form-control form-control-sm copValidTill">
                            </div>
                            <div class="col-md-3">
                                <label for="">Testing Agency</label>
                                <select name="testingAgency" class="form-select form-select-sm testingAgency">

                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-3">
                                <label for="voltage" class="form-label">Voltage</label>
                                <select name="voltage" class="form-select form-select-sm voltage">
                                </select>
                            </div>

                            <div class="col-md-3">
                                <label for="batchNo" class="form-label">Batch No</label>
                                <input type="text" name="batchNo" id="batchNo" value="{{ $batchNo }}"
                                    class="form-control form-control-sm">
                            </div>
                            <div class="col-md-3">
                                <label for="BarCodeCreationType" class="form-label">BarCode Creation
                                    Type </label>
                                <select class="form-select form-select-sm" name="BarCodeCreationType"
                                    id="BarCodeCreationType">
                                    <option value="select type">Select Creation Type</option>
                                    <option value="Other">Other</option>
                                    <option value="Import">Import</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label for="" class="form-label">Barcode No</label>
                                <input type="text" class="form-control form-control-sm" name="barcodeNo">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-2">
                                <label class="form-label">Is Renew</label><br>
                                <select name="is_renew" id="" class="form-select form-select-sm">
                                    <option value="1">No</option>
                                    <option value="0">Yes</option>
                                </select>
                            </div>
                            <div class="col-md-3" id="serialNo">
                                <div class="mb-3">
                                    <label for="" class="form-label">Device serial No</label>
                                    <input type="text" name="serialNo" id="serialNo"
                                        class="form-control form-control-sm">
                                </div>
                            </div>
                        </div>
                        <div class="row mb-2" id="simDetails">

                        </div>

                        <button class="btn btn-sm me-2" style="background-color: #260950;color:#fff">Submit</button>
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
        $(document).ready(function() {
            const $element = $('.element');
            $element.on('change', function() {
                const selectedValue = $(this).val();
                var serialNo = serialNo
                const $form = $(this).parents("form"); // Cache the form for reuse
                const $elementType = $form.find(
                    ".element_type"); // Target the dropdown within the same form

                $elementType.empty(); // Clear previous options
                $elementType.append('<option value="">Loading...</option>'); // Temporary loading indicator

                $.ajax({
                    url: `/manufacturer/fetch/element-type/${selectedValue}`,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        $elementType.empty();
                        $elementType.append(
                            '<option value="">Select Element Type</option>');
                        if (data && data.length > 0) {
                            data.forEach(type => {
                                alert(JSON.stringify(type));
                                $elementType.append(
                                    `<option value="${type.id}" simcount="${type.sim_count}">${type.type}</option>`
                                );
                            });
                        } else {
                            $elementType.append(
                                '<option value="">No options available</option>');
                        }
                    },
                    error: function(xhr, status, error) {
                        // console.error('Error:', error); // Log the error for debugging
                        $elementType.empty();
                        $elementType.append('<option value="">Failed to load options</option>');
                    }
                });

            });

            const $element_type = $('.element_type');
            $element_type.on('change', function() {
                const $simCount = $(this).find('option:selected').attr('simcount');
                const $simDetailsContainer = $('#simDetails');
                if ($simCount != null) {
                    for (let index = 1; index <= $simCount; index++) {
                        $simDetailsContainer.append(
                            `   <div class="row my-2">
                                  <h6> <span class="px-2" style="border: 0.1rem solid;">SIM Details ${index}</span></h6>
                                  <div class="col-md-3 ">
                                  <label class="form-label">SIM No</label>
                                    <input type="text" class="form-control form-control-sm" name="simNo[]" placeholder="Enter sim number">
                                  </div>
                                  <div class="col-md-3 ">
                                  <label class="form-label">ICCID No</label>
                                    <input type="text" class="form-control form-control-sm" name="iccidNo[]" placeholder="Enter ICCID number">
                                  </div>
                                  <div class="col-md-3 ">
                                  <label class="form-label">Validity</label>
                                    <input type="date" class="form-control form-control-sm" name="validity[]">
                                  </div>
                                  <div class="col-md-3 ">
                                  <label class="form-label">Operator</label>
                                    <input type="text" class="form-control form-control-sm" name="operator[]" placeholder="Enter operator">
                                  </div>
                                </div>
                            `
                        )

                    }

                } else {
                    $simDetailsContainer.empty();
                }

                const $form = $(this).parents("form"); // Cache the form for reuse
                const $model_no = $form.find(
                    ".model-no"); // Target the dropdown within the same form
                const $customFieldsContainer = $form.find(
                    ".type");
                const $voltage = $form.find(
                    ".voltage");
                $customFieldsContainer.remove();
                $model_no.empty(); // Clear previous options
                $model_no.append('<option value="">Loading...</option>'); // Temporary loading indicator
                $voltage.empty();
                $voltage.append('<option value="">Loading...</option>')
                $.ajax({
                    url: `/manufacturer/fetch/model-no/${$(this).val()}`,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        $model_no.empty(); // Clear loading message
                        $model_no.append(
                            '<option value="">Select Element Type</option>');
                        $voltage.empty(); // Clear loading message
                        $voltage.append(
                            '<option value="">Select Voltage</option>');
                        if (data && data.length > 0) {
                            data.forEach(modelNo => {
                                $model_no.append(
                                    `<option value="${modelNo.id}">${modelNo.model_no}</option>`
                                );
                                $voltage.append(
                                    `<option value="${modelNo.id}">${modelNo.voltage}</option>`
                                );
                            });
                        } else {
                            $model_no.append(
                                '<option value="">No options available</option>');
                            $voltage.append('<option value="">No options available</option>')
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error:', error); // Log the error for debugging
                        $model_no.empty();
                        $model_no.append('<option value="">Failed to load options</option>');
                    }
                });
            })


            const $modelNo = $('.model-no');
            $modelNo.on('change', function() {
                const $form = $(this).parents("form"); // Cache the form for reuse
                const $partNo = $form.find(
                    ".partNo"); // Target the dropdown within the same form
                $partNo.empty(); // Clear previous options
                $partNo.append('<option value="">Loading...</option>'); // Temporary loading indicator

                $.ajax({
                    url: `/manufacturer/fetch/part-no/${$(this).val()}`,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        $partNo.empty(); // Clear loading message
                        if (data && data.length > 0) {
                            $partNo.empty();
                            $partNo.append(
                                '<option value="">Select Part No.</option>');
                            data.forEach(partlNo => {
                                $partNo.append(
                                    `<option value="${partlNo.id}">${partlNo.part_no}</option>`
                                );
                            });
                        } else {
                            $partNo.append(
                                '<option value="">No options available</option>');

                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error:', error); // Log the error for debugging
                        $partNo.empty();
                        $partNo.append('<option value="">Failed to load options</option>');
                    }
                });

            })

            const $partNo = $('.partNo');
            $partNo.on('change', function() {
                const $form = $(this).parents("form"); // Cache the form for reuse
                const $tacNo = $form.find(
                    ".tacNo"); // Target the dropdown within the same form
                $tacNo.empty(); // Clear previous options
                $tacNo.append('<option value="">Loading...</option>'); // Temporary loading indicator    
                $.ajax({
                    url: `/manufacturer/fetch/tac-no/${$(this).val()}`,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        $tacNo.empty(); // Clear loading message
                        if (data && data.length > 0) {
                            $tacNo.empty();
                            $tacNo.append(
                                '<option value="">Select Part No.</option>');
                            data.forEach(tacNo => {
                                $tacNo.append(
                                    `<option value="${tacNo.id}">${tacNo.tacNo}</option>`
                                );
                            });
                        } else {
                            $tacNo.append(
                                '<option value="">No options available</option>');

                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error:', error); // Log the error for debugging
                        $tacNo.empty();
                        $tacNo.append('<option value="">Failed to load options</option>');
                    }
                });
            });


            const $tacNo = $('.tacNo');
            $tacNo.on('change', function() {
                const $form = $(this).parents("form"); // Cache the form for reuse
                const $copNo = $form.find(
                    ".copNo"); // Target the dropdown within the same form
                $copNo.empty(); // Clear previous options
                $copNo.append('<option value="">Loading...</option>'); // Temporary loading indicator    
                $.ajax({
                    url: `/manufacturer/fetch/cop-no/${$(this).val()}`,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        $copNo.empty(); // Clear loading message
                        if (data && data.length > 0) {
                            $copNo.empty();
                            $copNo.append(
                                '<option value="">Select COP No.</option>');
                            data.forEach(copNo => {
                                $copNo.append(
                                    `<option value="${copNo.id}" validity="${copNo.validTill}">${copNo.COPNo}</option>`
                                );
                            });
                        } else {
                            $copNo.append(
                                '<option value="">No options available</option>');

                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error:', error); // Log the error for debugging
                        $copNo.empty();
                        $copNo.append('<option value="">Failed to load options</option>');
                    }
                });
            });


            const $copNo = $('.copNo');
            $copNo.on('change', function() {
                const $form = $(this).parents("form"); // Cache the form for reuse
                const $validityState = $(this).find('option:selected').attr('validity') || '';
                alert($validityState);
                const $copValidTill = $form.find(
                    ".copValidTill"); // Target the dropdown within the same form
                const $testingAgency = $form.find(
                    ".testingAgency"); // Target the dropdown within the same form

                $testingAgency.empty(); // Clear previous options
                $testingAgency.append(
                    '<option value="" disabled>Loading...</option>'); // Temporary loading indicator
                $copValidTill.val($validityState);

                $.ajax({
                    url: `/manufacturer/fetch/testing-agency/${$(this).val()}`,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        $testingAgency.empty(); // Clear loading message
                        if (Array.isArray(data) && data.length > 0) {
                            data.forEach(testingAgency => {
                                $testingAgency.append(
                                    `<option value="${testingAgency.id}">${testingAgency.testingAgency}</option>`
                                );
                            });
                        } else {
                            $testingAgency.append(
                                '<option value="">No options available</option>');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error:', error); // Log the error for debugging
                        $testingAgency.empty();
                        $testingAgency.append(
                            '<option value="">Failed to load options</option>');
                    }
                });
            });


        });
    </script>
@endsection

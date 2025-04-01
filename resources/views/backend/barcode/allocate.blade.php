@extends('layouts.manufacturer')
@section('content')
    <div class="row align-items-center mb-3" style="background-color: #260950;">
        <!-- Use align-items-center here -->
        <div class="col-md-4">
            <h4 class="card-title text-white px-2 py-3">Allocated
                Barcode</h4>
        </div>
        <div class="col-md-8">
            <div class="d-flex justify-content-md-end justify-content-sm-center pe-2">
                <a href="{{ route('create.admin') }}" class="btn btn-sm btn-theme" data-bs-toggle="modal"
                    data-bs-target="#createModal" style="border: 1px solid #fff;white-space: nowrap;">
                    Allocate
                    Barcode
                </a>
            </div>
        </div>
    </div>
    <div class="row text-center my-2">
        <div class="col-md-3">
            <div class="card text-white bg-total mb-3 " style="background-color: #260950">
                <div class="card-body">
                    {{-- <i class="fa-solid fa-barcode"></i> --}}
                    <h5 class="card-title text-white">
                        @php
                            echo App\Models\BarCode::where('mfg_id', auth('manufacturer')->user()->id)->count();
                           @endphp
                    </h5>
                    <p class="card-text text-white">TOTAL DEVICE</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white mb-3" style="background-color: #086c57">
                <div class="card-body">
                    <h5 class="card-title text-white">
                        @php
                            echo App\Models\BarCode::where('mfg_id', auth('manufacturer')->user()->id)->where('status', '0')->count();
                          @endphp
                    </h5>
                    <p class="card-text text-white">AVAILABLE DEVICE</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white mb-3" style="background-color: #e9b517">
                <div class="card-body">
                    <h5 class="card-title text-white">
                        @php
                            echo App\Models\BarCode::where('mfg_id', auth('manufacturer')->user()->id)->where('status', '1')->count();
                          @endphp
                    </h5>
                    <p class="card-text text-white">ALLOCATED DEVICE</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-danger mb-3">
                <div class="card-body">
                    <h5 class="card-title text-white">
                        @php
                        echo  App\Models\BarCode::where('mfg_id',auth('manufacturer')->user()->id)->where('status','2')->count();
                      @endphp
                    </h5>
                    <p class="card-text">INSTALLED DEVICE</p>
                </div>
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
    <em>Its Shows the list of allocated bar codes</em>
    <table class="table dataTable table-striped">
        <thead>
            <tr>
                <th>Serial No</th>
                <th>Distributor Name</th>
                <th>Dealer Name</th>
                <th>Barcode No</th>
                {{-- <th>Net Amount (₹) </th> --}}
                <th>Allocated At</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($allocatedBarcode as $barcode)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $barcode->distributor->pluck('business_name')->first() ?? 'N/A' }}</td>
                    <td>{{ $barcode->dealer->pluck('business_name')->first() ?? 'N/A' }}</td>
                    <td>{{ $barcode->barcode->pluck('barcodeNo')->first() }}</td>
                    {{-- <td>
                    </td> --}}
                    <td>{{ $barcode->created_at }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Modal -->
    <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModal" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="createModal">Allocate Bar Code</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('barcode.allocate.store') }}" method="post">
                        @csrf
                        <div class="row my-2">
                            <div class="col-md-3">
                                <label for="">Country</label>
                                <select name="country" class="form-select form-select-sm country">
                                    <option disabled @selected(true)>Choose Country
                                    </option>
                                    <option value="china" @selected(old('country') == 'china')>
                                        China
                                    </option>
                                    <option value="india" @selected(old('country') == 'india')>
                                        India
                                    </option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label for="" class="form-label">State</label>
                                <select class="form-select form-select-sm state" name="state" id=""></select>
                            </div>
                            <div class="col-md-3">
                                <label for="" class="form-label">Distributor
                                    {{-- <span class="text-danger">*</span> --}}
                                </label>
                                <Select class="form-select form-select-sm distributor" name="distributor">
                                    <option value="">Select Distributor</option>
                                </Select>
                            </div>
                            <div class="col-md-3">
                                <label for="" class="form-label">Dealer

                                </label>
                                <Select class="form-select form-select-sm dealer" name="dealer">
                                    <option disabled selected>Select Dealer</option>

                                </Select>
                            </div>

                            <div class="col-md-3">
                                <label for="" class="form-label">Element<span class="badge text-secondary">*</span></label>
                                <Select class="form-select form-select-sm element" name="element">
                                    <option>Select Element</option>
                                    @foreach ($element as $data)
                                        <option value="{{ $data->id }}">{{ $data->element->pluck('name')->first() }}
                                        </option>
                                    @endforeach
                                </Select>
                            </div>

                            <div class="col-md-3">
                                <label for="" class="form-label">Element Type<span
                                        class="badge text-secondary">*</span></label>
                                <Select class="form-select form-select-sm element_type" name="element_type">
                                    <option value="">Select Element Type</option>

                                </Select>
                            </div>

                            <div class="col-md-3">
                                <label for="" class="form-label">Device Model
                                    Number<span class="badge text-secondary">*</span></label>
                                <select name="model_no" class="form-select form-select-sm model-no">
                                    <option value="">Select Element Type</option>
                                </select>
                            </div>

                            <div class="col-md-3">
                                <label for="" class="form-label">Voltage<span class="badge text-secondary">*</span></label>
                                <Select class="form-select form-select-sm voltage" name="voltage">
                                    <option value="">Select Voltage</option>
                                </Select>
                            </div>

                            <div class="col-md-3">
                                <label for="" class="form-label">Device Part Number<span
                                        class="badge text-secondary">*</span></label>
                                <Select class="form-select form-select-sm partNo" name="DevicePartNumber">
                                    <option value="">Select Part Number</option>
                                </Select>
                            </div>

                            <div class="col-md-3">
                                <label for="" class="form-label">Type<span class="badge text-secondary">*</span></label>
                                <Select class="form-select form-select-sm" name="type" id="type">
                                    <option value="">NEW</option>
                                    <option value="">RENEW</option>
                                </Select>
                            </div>

                            <div class="container mt-5">
                                <div class="row">
                                    <div class="col-md-5">
                                        <label for="available_barcodes" class="form-label">BarCode</label>
                                        <select class="form-select form-select-sm" multiple size="10"
                                            id="available_barcodes">

                                        </select>
                                    </div>

                                    <div class="col-md-2 d-flex flex-column justify-content-center align-items-center">
                                        <button type="button" id="btn-add" class="btn mb-2"
                                            style="background-color:#260950;color:#fff">&rarr;</button>
                                        <button type="button" id="btn-remove" class="btn"
                                            style="background-color:#260950;color:#fff">&larr;</button>
                                    </div>

                                    <div class="col-md-5">
                                        <label for="allocated_barcodes" class="form-label">
                                            Allocated BarCode (<span id="allocated_count">0</span>)
                                        </label>
                                        <select id="allocated_barcodes" class="form-select form-select-sm" multiple
                                            size="10" name="allocated_barcodes[]">
                                            <!-- Allocated barcodes will be dynamically added here -->
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button class="btn my-3 float-end" style="background-color: #260950;color:#fff">Allocate</button>
                    </form>

                </div>
                {{-- <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div> --}}
            </div>
        </div>
    </div>


    <style>
        thead {
            background-color: #260950;
            color: #fff;
        }

        th {
            border-right: 1px solid #fff;
        }
    </style>

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
            const $element = $('.element');
            $element.on('change', function () {
                const selectedValue = $(this).val();
                console.log('Selected Value:', selectedValue); // Log the selected value for debugging
                const $form = $(this).closest('form'); // Cache the form for reuse
                const $elementType = $form.find(
                    ".element_type"); // Target the dropdown within the same form

                $elementType.empty().append(
                    '<option value="">Loading...</option>'); // Temporary loading indicator

                $.ajax({
                    url: `/manufacturer/fetch/element-type/${selectedValue}`,
                    type: 'GET',
                    dataType: 'json',
                    success: function (data) {
                        $elementType.empty().append(
                            '<option value="">Please Select Type</option>'); // Clear options
                        if (data && data.length > 0) {
                            data.forEach(type => {
                                $elementType.append(
                                    `<option value="${type.id}">${type.type}</option>`
                                );
                            });
                            if (data.length === 1) {
                                $elementType.val(data[0].id).trigger('change');
                            }
                        } else {
                            $elementType.append(
                                '<option value="">No options available</option>');
                        }
                    },
                    error: function (xhr, status, error) {
                        console.error('Error:', error); // Log the error for debugging
                        $elementType.empty().append(
                            '<option value="">Failed to load options</option>');
                    }
                });
            });

            const $element_type = $('.element_type');
            $element_type.on('change', function () {
                const $form = $(this).closest('form');
                const $model_no = $form.find(".model-no");
                const $voltage = $form.find(".voltage");

                $model_no.empty().append('<option value="">Loading...</option>');
                $voltage.empty().append('<option value="">Loading...</option>');

                $.ajax({
                    url: `/manufacturer/fetch/model-no/${$(this).val()}`,
                    type: 'GET',
                    dataType: 'json',
                    success: function (data) {
                        if (data && data.length > 0) {
                            $model_no.empty().append(
                                '<option value="">Select Model No</option>');
                            $voltage.empty().append('<option value="">Select Voltage</option>');
                            data.forEach(modelNo => {
                                $model_no.append(
                                    `<option value="${modelNo.id}">${modelNo.model_no}</option>`
                                );
                                $voltage.append(
                                    `<option value="${modelNo.id}">${modelNo.voltage}</option>`
                                );
                            });
                            if (data.length === 1) {
                                $model_no.val(data[0].id).trigger('change');
                            }
                        } else {
                            $model_no.append('<option value="">No options available</option>');
                        }
                    },
                    error: function (xhr, status, error) {
                        console.error('Error:', error); // Log the error for debugging
                        $model_no.empty().append(
                            '<option value="">Failed to load options</option>');
                        $voltage.empty().append(
                            '<option value="">Failed to load options</option>');
                    }
                });
            });

            const $modelNo = $('.model-no');
            $modelNo.on('change', function () {
                const $form = $(this).closest('form');
                const $partNo = $form.find(".partNo");

                $.ajax({
                    url: `/manufacturer/fetch/part-no/${$(this).val()}`,
                    type: 'GET',
                    dataType: 'json',
                    success: function (data) {
                        if (data && data.length > 0) {
                            data.forEach(partNo => {
                                $partNo.append(
                                    `<option value="${partNo.id}">${partNo.part_no}</option>`
                                );
                            });
                            if (data.length === 1) {
                                $partNo.val(data[0].id).trigger('change');
                            }
                        } else {
                            $partNo.append('<option value="">No options available</option>');
                        }
                    },
                    error: function (xhr, status, error) {
                        console.error('Error:', error);
                        $partNo.empty().append(
                            '<option value="">Failed to load options</option>');
                    }
                });
            });

            const $partNo = $('.partNo');
            $partNo.on('change', function () {
                const $form = $(this).closest('form');
                const $available_barcodes = $form.find("#available_barcodes");

                $.ajax({
                    url: `/manufacturer/fetch/barcode/${$(this).val()}`,
                    type: 'GET',
                    dataType: 'json',
                    success: function (response) {
                        $available_barcodes.empty();
                        if (response.barcodes && response.barcodes.length > 0) {
                            response.barcodes.forEach(function (barcode) {
                                const option =
                                    `<option value="${barcode.id}">${barcode.barcodeNo}</option>`;
                                $available_barcodes.append(option);
                            });
                            if (response.barcodes.length === 1) {
                                $available_barcodes.val(response.barcodes[0].id).trigger(
                                    'change');
                            }
                        } else {
                            $available_barcodes.append(
                                '<option disabled>No barcodes available</option>');
                        }
                    },
                    error: function (xhr, status, error) {
                        console.error('Error fetching barcodes:', error);
                    }
                });
            });
        });
    </script>
    <script>
        $(document).ready(function () {
            $('#btn-add').click(function () {
                $('#available_barcodes option:selected').each(function () {
                    const option = $(this);
                    option.remove();
                    $('#allocated_barcodes').append(option);
                });
                updateAllocatedCount();
            });

            $('#btn-remove').click(function () {
                $('#allocated_barcodes option:selected').each(function () {
                    const option = $(this);
                    option.remove();
                    $('#available_barcodes').append(option);
                });
                updateAllocatedCount();
            });

            function updateAllocatedCount() {
                const count = $('#allocated_barcodes option').length;
                $('#allocated_count').text(count);
            }
        });
    </script>
@endsection
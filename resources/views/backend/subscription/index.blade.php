@extends('layouts.manufacturer')
@section('content')
    <div class="row align-items-center mb-3" style="background-color: #260950;">
        <!-- Use align-items-center here -->
        <div class="col-md-4">
            <h4 class="card-title text-white px-2 py-3">Subscriptions List</h4>
        </div>
        <div class="col-md-8">
            <div class="d-flex justify-content-md-end justify-content-sm-center pe-2">
                <a href="" class="btn btn-sm btn-theme" data-bs-toggle="modal" data-bs-target="#createModal">
                    Create Subscription
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
    <div class="row">
        <h5 class="text-capitalize"><em>It shows the list of Subscription and their details</em></h5>
        <div class="col-md-12">
            <table class="table table-bordered dataTable">
                <thead class="text-white" style="background-color: #260950">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Package Type</th>
                        <th scope="col">Package Name</th>
                        <th scope="col">billing Cycle</th>
                        <th scope="col">Description</th>
                        <th scope="col">Price</th>
                        <th scope="col">Renewal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($subscriptions as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->packageType }}</td>
                            <td>{{ $item->packageName }}</td>
                            <td>{{ $item->billingCycle }}</td>
                            <td>{{ $item->description }}</td>
                            <td>{{ $item->price }}</td>
                            <td>
                            @if ( $item->isRenewal == 'on')
                                <span>Yes</span>
                            @else
                            <span>No</span>
                            @endif</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModal" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="createModal">Create Subscription</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ route('subscription.store') }}">
                        @csrf
                        <div class="my-3 mx-3">
                            <div class="row">
                                {{-- <div class="col-md-6">
                                    <label for="" class="form-label">Parent</label>
                                    <input class="form-control" name="parent" value="{{ $data->businees_name }}" readonly>
                                    <input type="hidden" name="parentId" value="{{ $data->id }}">

                                     <Select class="form-select form-select-sm" name="Parentid" id="Parentid">
                                        <option disabled selected>Select Parent</option>
                                        <option value="">Mfg 1</option>
                                        <option value="">Mfg 2</option>

                                    </Select> 
                                </div> --}}
                                <div class="col-md-6">
                                    <label for="" class="form-label">Package Type</label>
                                    <Select class="form-select form-select-sm" name="packageType" id="PackageType">
                                        <option disabled selected>Select Package Type</option>
                                        <option value="TRACKER">TRACKER</option>
                                        <option value="OFFERED">OFFERED</option>
                                    </Select>
                                </div>
                            </div>

                            <div class="row my-3">
                                <div class="col-md-6">
                                    <label for="" class="form-label">Package Name</label>
                                    <input type="text" class="form-control form-control-sm" name="packageName"
                                        id="PackageName">
                                </div>
                                <div class="col-md-6">
                                    <label for="" class="form-label">Billing Cycle</label>
                                    <Select class="form-select form-select-sm" name="billingCycle" id="BillingCycle">
                                        <option value="" hidden>Select Billing Cycle</option>
                                        <option value="3 days">3 days</option>
                                        <option value="7 days">7 days</option>
                                        <option value="30 days">30 days</option>
                                        <option value="60 days">60 days</option>
                                        <option value="90 days">90 days</option>
                                        <option value="120 days">120 days</option>
                                        <option value="150 days">150 days</option>
                                        <option value="180 days">180 days</option>
                                        <option value="210 days">210 days</option>
                                        <option value="240 days">240 days</option>
                                        <option value="270 days">270 days</option>
                                        <option value="300 days">300 days</option>
                                        <option value="330 days">330 days</option>
                                        <option value="365 days">365 days</option>
                                        <option value="730 days">730 days</option>
                                    </Select>
                                </div>
                            </div>
                            <div class="row my-3">
                                <div class="col-md-6">
                                    <label for="" class="form-label">Description</label>
                                    <input type="text" class="form-control form-control-sm" name="description"
                                        id="Description">
                                </div>
                                <div class="col-md-6">
                                    <label for="" class="form-label">Price</label>
                                    <input type="text" class="form-control form-control-sm" name="price"
                                        id="Price">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="form-check-label me-2" for="renewalSwitch">Is Renewal</label>
                                    <div style="margin-top: 0" class="form-check form-switch d-flex align-items-center">
                                        <label style="margin-left: 0px" class="form-check-label">No</label>
                                        <input style="margin-left: 0px" class="form-check-input" type="checkbox"
                                            name="renewalcheckbox" id="renewalSwitch">
                                        <label class="form-check-label">Yes</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn" style="background-color: #260950;color:#fff">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

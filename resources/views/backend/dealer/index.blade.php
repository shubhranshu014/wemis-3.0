@extends('layouts.manufacturer')
@section('content')
    <div class="row align-items-center mb-3" style="background-color: #260950;">
        <!-- Use align-items-center here -->
        <div class="col-md-4">
            <h4 class="card-title text-white px-2 py-3">Dealers List</h4>
        </div>
        <div class="col-md-8">
            <div class="d-flex justify-content-md-end justify-content-sm-center pe-2">
                <a href="{{ route('create.admin') }}" class="btn btn-sm btn-theme" data-bs-toggle="modal"
                    data-bs-target="#createModal">
                    Create Dealer
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
        <h5 class="text-capitalize"><em>It shows the list of Dealers and their details</em></h5>
        <div class="col-md-12">
            <table class="table table-bordered dataTable">
                <thead class="text-white" style="background-color: #260950">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Distributor</th>
                        <th scope="col">Business Name </th>
                        <th scope="col">Owner Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Contact No</th>
                        <th scope="col">Password</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($dealer as $item)
                        {{-- {{ $item }} --}}
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->distributor->pluck('business_name')->first() }}</td>
                            <td>{{ $item->business_name }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->email }}</td>
                            <td>{{ $item->mobile }}</td>
                            <td>{{ $item->passwordText }}</td>
                            <td>
                                <a href="" class="btn btn-primary btn-sm"><i class="fa-solid fa-pen"
                                        style="color:#fff"></i></a>
                                <form action="" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"
                                        onclick="return confirm('Are you sure you want to delete this item?');"><i
                                            class="fa-solid fa-trash" style="color:#fff"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModal" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="createModal">Create Dealer</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('dealer.store') }}" method="post" id="">
                        @csrf
                        <div class="card">
                            <div class="my-3 mx-3">
                                <div class="row mb-2">
                                    <div class="col-md-12">
                                        <label for="distributor" class="form-label">Select Distributor</label>
                                        <select name="distributer" class="form-select form-select-sm">
                                            <option disabled selected>Select Distributor</option>
                                            @foreach ($distributor as $item)
                                                <option value="{{ $item->id }}">{{ $item->business_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <label class="form-label">Business Name<span
                                                class="text-secondary badge">*</span></label>
                                        <input type="text" class="form-control form-control-sm" name="business_name"
                                            value="">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Name<span class="text-secondary badge">*</span></label>
                                        <input type="text" class="form-control form-control-sm" name="name"
                                            value="">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label">Email<span class="text-secondary badge">*</span></label>
                                        <input type="email" class="form-control form-control-sm" name="email"
                                            value="">
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3 mx-3">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label class="form-label">Gender<span class="text-secondary badge">*</span></label>
                                        <select name="gender" id="" class="form-select form-select-sm">
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label">Mobile<span
                                                class="text-secondary badge">*</span></label>
                                        <input type="number" class="form-control form-control-sm" name="mobile"
                                            value="">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label">Date Of Birth<span
                                                class="text-secondary badge">*</span></label>
                                        <input type="date" class="form-control form-control-sm" name="date_of_birth">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label">Age<span class="text-secondary badge">*</span></label>
                                        <input type="number" class="form-control form-control-sm" name="age"
                                            value="" readonly>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3 mx-3">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label class="form-label">Is Map Device Edit <span
                                                class="text-secondary badge">*</span></label><br>
                                        <select name="is_map_device_edit" class="form-select form-select-sm">
                                            <option selected disabled>Select Option</option>
                                            <option value="{{ 'yes' }}">Yes</option>
                                            <option value="{{ 'no' }}">No</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label">Pan Number<span
                                                class="text-secondary badge">*</span></label>
                                        <input type="text" class="form-control form-control-sm" name="pan_number"
                                            value="">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label">Occupation<span
                                                class="text-secondary badge">*</span></label>
                                        <select name="occupation" id="" class="form-select form-select-sm">
                                            <option value="" hidden>Select Occupation</option>
                                            <option value="Business Man">Business Man</option>
                                            <option value="Student">Student</option>
                                            <option value="House Wife">House Wife</option>
                                            <option value="VRS Employees">VRS Employees
                                            </option>
                                            <option value="Retired Employees">Retired
                                                Employees</option>
                                            <option value="Self Employed">Self Employed
                                            </option>
                                            <option value="Private Employees">Private
                                                Employees</option>
                                            <option value="Marketing Executives">Marketing
                                                Executives</option>
                                        </select>
                                    </div>
                                    {{-- <div class="col-md-3">
                                            <label for="">Payment Type<span
                                                    class="text-danger">*</span></label>
                                            <select name="paymentType" id=""
                                                class="form-select form-select-sm state">
                                                <option value="" hidden>Select Occupation</option>
                                                <option value="Advasnce">Advasnce</option>
                                                <option value="After Delivered">After Delivered
                                                </option>
                                            </select>
                                        </div> --}}
                                    <div class="col-md-3">
                                        <label class="form-label">Advance Payment<span
                                                class="text-secondary badge">*</span></label>
                                        <input type="number" class="form-control form-control-sm" name="advance_payment"
                                            value="">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 mx-3">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label class="form-label">Languages Known<span
                                                class="text-secondary badge">*</span></label><br>
                                        <select data-placeholder="Select Categories" multiple
                                            class="form-control chosen-select" name="language_known[]" tabindex="8">
                                            <option></option>
                                            <option value="english">English</option>
                                            <option value="hindi">Hindi</option>
                                            <option value="odiya">Odiya</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card my-3 py-3">
                            <div class="mb-3 mx-3">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label class="form-label">Country<span
                                                class="text-secondary badge">*</span></label>
                                        <select name="country" class="form-control form-control-sm country">
                                            <option disabled @selected(true)>Choose Country
                                            </option>
                                            <option value="china" @selected(old('country') == 'china')>China
                                            </option>
                                            <option value="india" @selected(old('country') == 'india')>India
                                            </option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">State<span class="text-secondary badge">*</span></label>
                                        <select class="form-control form-control-sm state" name="state"
                                            id=""></select>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">RTO Division<span
                                                class="text-secondary badge">*</span></label>
                                        <input type="text" class="form-control form-control-sm" name="rto_devision">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 mx-3">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label class="form-label">District<span
                                                class="text-secondary badge">*</span></label>
                                        <input type="text" class="form-control form-control-sm" name="district"
                                            value="">
                                    </div>

                                    <div class="col-md-4">
                                        <label class="form-label">Pin Code<span
                                                class="text-secondary badge">*</span></label>
                                        <input type="number" class="form-control form-control-sm" name="pincode"
                                            value="">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">Area<span class="text-secondary badge">*</span></label>
                                        <input type="text" class="form-control form-control-sm" name="area">

                                    </div>

                                    <div class="col-md-4">
                                        <label class="form-label">Address<span
                                                class="text-secondary badge">*</span></label>
                                        <textarea type="text" class="form-control Alphanumeric AddressValidation" name="address" value=''> </textarea>
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

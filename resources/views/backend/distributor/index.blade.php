@extends('layouts.manufacturer')
@section('content')
    <div class="row align-items-center mb-3" style="background-color: #260950;">
        <!-- Use align-items-center here -->
        <div class="col-md-4">
            <h4 class="card-title text-white px-2 py-3">Distributors List</h4>
        </div>
        <div class="col-md-8">
            <div class="d-flex justify-content-md-end justify-content-sm-center pe-2">
                <a href="{{ route('create.admin') }}" class="btn btn-sm btn-theme" data-bs-toggle="modal"
                    data-bs-target="#createModal">
                    Create Distributor
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
        <h5 class="text-capitalize"><em>It shows the list of Distributors and their details</em></h5>
        <div class="col-md-12">
            <table class="table table-bordered dataTable">
                <thead class="text-white" style="background-color: #260950">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Business Name </th>
                        <th scope="col">Owner Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Contact No</th>
                        <th scope="col">Password</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($distributors as $item)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$item->business_name}}</td>
                        <td>{{$item->name}}</td>
                        <td>{{$item->email}}</td>
                        <td>{{$item->mobile}}</td>
                        <td>{{$item->passwordText}}</td>
                        <td>
                            <a href="" class="btn btn-primary btn-sm"><i class="fa-solid fa-pen"
                                style="color:#fff"></i></a>
                        <form action="" method="POST"
                            style="display:inline-block;">
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

    <!-- Modal -->
    <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModal" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="createModal">Create Distributor</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('distributor.store') }}" method="post">
                        @csrf
                        <h5><em>Business Details</em></h5>
                        <div class="card">
                            <div class="my-3 mx-3">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label for="">Business Name<span
                                                class="badge text-secondary">*</span></label>
                                        <input type="text" class="form-control form-control-sm" name="business_name"
                                            value="{{ old('business_name') }}">
                                        @error('business_name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label for="">Name<span class="badge text-secondary">*</span></label>
                                        <input type="text" class="form-control form-control-sm" name="name"
                                            value="{{ old('name') }}">
                                        @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-3">
                                        <label for="">Email<span class="badge text-secondary">*</span></label>
                                        <input type="email" class="form-control form-control-sm" name="email"
                                            value="">
                                        @error('email')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3 mx-3">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label for="">Gender<span class="badge text-secondary">*</span></label>
                                        <select name="gender" id="" class="form-select form-select-sm">
                                            <option value="male" @selected(old('gender') == 'male')>Male</option>
                                            <option value="female" @selected(old('gender') == 'female')>Female</option>
                                        </select>
                                        @error('gender')
                                            {{ $message }}
                                        @enderror
                                    </div>
                                    <div class="col-md-3">
                                        <label for="">Mobile<span class="badge text-secondary">*</span></label>
                                        <input type="number" class="form-control form-control-sm" name="mobile"
                                            value="{{ old('mobile') }}">
                                        @error('mobile')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-3">
                                        <label for="">Date Of Birth<span
                                                class="badge text-secondary">*</span></label>
                                        <input type="date" class="form-control form-control-sm" name="date_of_birth"
                                            value="{{ old('date_of_birth') }}">
                                        @error('date_of_birth')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-3">
                                        <label for="">Age<span class="text-danger">*</span></label>
                                        <input type="number" class="form-control form-control-sm" name="age"
                                            readonly>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3 mx-3">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label>Is Map Device Edit <span class="badge text-secondary">*</span></label><br>
                                        <select name="is_map_device_edit" class="form-select form-select-sm">
                                            <option value="yes" @selected(old('is_map_device_edit') == 'yes')>Yes</option>
                                            <option value="no" @selected(old('is_map_device_edit') == 'no')> Yes</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="">Pan Number<span
                                                class="badge text-secondary">*</span></label>
                                        <input type="text" class="form-control form-control-sm" name="pan_number"
                                            value="{{ old('pan_number') }}">
                                        @error('pan_number')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-3">
                                        <label for="">Occupation<span
                                                class="badge text-secondary">*</span></label>
                                        <select name="occupation" id="" class="form-select form-select-sm">
                                            <option selected disabled>Select Occupation</option>
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
                                        @error('occupation')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
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
                                        <label for="">Advance Payment<span
                                                class="badge text-secondary">*</span></label>
                                        <input type="number" class="form-control form-control-sm" name="advance_payment"
                                            value="{{ old('advance_payment') }}">
                                        @error('advance_payment')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 mx-3">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label>Languages Known<span class="badge text-secondary">*</span></label><br>
                                        <select data-placeholder="Select language" multiple
                                            class="form-control chosen-select" name="language_known[]" tabindex="8">
                                            <option></option>
                                            <option value="english">English</option>
                                            <option value="hindi">Hindi</option>
                                            <option value="odiya">Odiya</option>
                                        </select>
                                        @error('language_known')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <h5 class="my-2"><em>Personal Details</em></h5>
                        <div class="card my-3 py-3">
                            <div class="mb-3 mx-3">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label for="">Country<span class="badge text-secondary">*</span></label>
                                        <select name="country" class="form-control form-control-sm country">
                                            <option disabled @selected(true)>Choose Country
                                            </option>
                                            <option value="china" @selected(old('country') == 'china')>China
                                            </option>
                                            <option value="india" @selected(old('country') == 'india')>India
                                            </option>
                                        </select>
                                        @error('country')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <label for="">State<span class="badge text-secondary">*</span></label>
                                        <select class="form-control form-control-sm state" name="state"
                                            id=""></select>
                                        @error('state')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <label for="">RTO Division<span
                                                class="badge text-secondary">*</span></label>
                                        <input type="text" class="form-control form-control-sm" name="rto_devision"
                                            value="{{ old('rto_devision') }}">
                                        @error('rto_devision')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 mx-3">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label for="">District<span class="badge text-secondary">*</span></label>
                                        <input type="text" class="form-control form-control-sm" name="district"
                                            value="{{ old('district') }}">
                                        @error('district')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-md-4">
                                        <label for="">Pin Code<span class="badge text-secondary">*</span></label>
                                        <input type="number" class="form-control form-control-sm" name="pincode"
                                            value="{{ old('pincode') }}">
                                        @error('pincode')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <label for="">Area<span class="badge text-secondary">*</span></label>
                                        <input type="text" class="form-control form-control-sm" name="area"
                                            value="{{ old('area') }}">
                                        @error('area')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-md-4">
                                        <label for="">Address<span class="badge text-secondary">*</span></label>
                                        <textarea type="text" class="form-control Alphanumeric AddressValidation" name="address">{{ old('address') }}</textarea>
                                        @error('address')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
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

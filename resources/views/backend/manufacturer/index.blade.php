@extends('layouts.wlp')
@section('content')
    <div class="row align-items-center mb-3" style="background-color: #260950;">
        <!-- Use align-items-center here -->
        <div class="col-md-4">
            <h4 class="card-title text-white px-2 py-3">Manufacturers List</h4>
        </div>
        <div class="col-md-8">
            <div class="d-flex justify-content-md-end justify-content-sm-center pe-2">
                <a href="{{ route('create.admin') }}" class="btn btn-sm btn-theme" data-bs-toggle="modal"
                    data-bs-target="#createModal">
                    Create Manufacturer
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
        <h5 class="text-capitalize"><em>It shows the list of Manufacturers and their details</em></h5>
        <div class="col-md-12">
            <table class="table table-bordered dataTable">
                <thead class="text-white" style="background-color: #260950">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Logo</th>
                        <th scope="col">Name</th>
                        <th scope="col">Business Nmae</th>
                        <th scope="col">Email</th>
                        <th scope="col">Password</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($mfg as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td><img src="{{ asset('storage/uploads/' . $item->logo) }}"></td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->businees_name }}</td>
                            <td>{{ $item->email }}</td>
                            <td>{{ $item->passwordText }}</td>
                            <td>
                                <a href="" class="btn btn-primary btn-sm"><i
                                        class="fa-solid fa-pen" style="color:#fff"></i></a>
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
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="createModal">Modal title</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('manufacturer.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-2">
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="">Select Country <span class="badge text-danger">*</span></label>
                                    <select name="country" class="form-select form-select-sm country">
                                        <option disabled @selected(true)>Choose Country
                                        </option>
                                        <option value="china" @selected(old('country') == 'china')>China</option>
                                        <option value="india" @selected(old('country') == 'india')>India</option>
                                    </select>
                                    @error('country')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-4">
                                    <label for="">Select State <span class="badge text-danger">*</span></label>
                                    <select name="state" id="" class="form-select form-select-sm state">
                                        <option disabled @selected(true)>Choose State</option>
                                    </select>
                                    @error('state')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <label for="">Manufacturer Code <span class="text-danger badge">*</span></label>
                                    <input type="text" class="form-control form-control-sm" name="manufacturer_code"
                                        value="{{ old('manufacturer_code') }}">
                                    @error('manufacturer_code')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="mb-2">
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="">Business Name</label><span class="badge text-danger">*</span>
                                    <input type="text" class="form-control form-control-sm" name="business_name"
                                        value="{{ old('business_name') }}">
                                    @error('business_name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <label for="">GST Number <span class="text-danger badge">*</span></label>
                                    <input type="text" class="form-control form-control-sm" name="gst_number"
                                        value="{{ old('gst_number') }}">
                                    @error('gst_number')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <label for="">Parent Name (WLP)<span
                                            class="text-danger badge">*</span></label>
                                    <input type="hidden" class="form-control form-control-sm" name="parent_name"
                                        value="{{ auth('wlp')->user()->id }}">
                                    <input type="text" value="{{ auth('wlp')->user()->name }}"
                                        class="form-control form-control-sm" readonly>
                                    @error('parent_name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="mb-2">
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="">Manufacturer Name <span
                                            class="text-danger badge">*</span></label>
                                    <input type="text" class="form-control form-control-sm" name="manufacturer_name"
                                        value="{{ old('manufacturer_name') }}">
                                    @error('manufacturer_name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <label for="">Mobile No. <span class="text-danger badge">*</span></label>
                                    <input type="text" class="form-control form-control-sm" name="mobile_no"
                                        value="{{ old('mobile_no') }}">
                                    @error('mobile_no')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <label for="">Email Id <span class="text-danger badge">*</span></label>
                                    <input type="text" class="form-control form-control-sm" name="email"
                                        value="{{ old('email') }}">
                                    @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="mb-2">
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="">Address <span class="text-danger badge">*</span></label>
                                    <textarea name="address" id="" cols="30" rows="10" class="form-control form-control-sm">
                                      {{ old('address') }}
                                    </textarea>
                                </div>
                                <div class="col-md-8">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="">Upload Logo</label><span
                                                class="text-danger badge">*</span>
                                            <input type="file" name="logo" class="form-control form-control-sm"
                                                id="imageInput" value="{{ old('logo') }}">
                                            @error('logo')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-md-6 p-2 text-center" style="border: 1px dashed;">
                                            <img src="{{ url('images\2265750.webp') }}" alt="" class="img-fluid"
                                                id="imagePreview">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <button class="btn btn-theme">Onboard</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        $('#imageInput').change(function() {
            var file = $(this)[0].files[0];
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#imagePreview').attr('src', e.target.result);
            };
            reader.readAsDataURL(file);
        });
    </script>
@endsection

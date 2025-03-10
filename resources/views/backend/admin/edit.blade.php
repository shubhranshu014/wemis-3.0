@extends($layout)

@section('content')
    <div class="align-items-center mb-3 row" style="background-color: #260950;">
        <div class="col-md-4">
            <h4 class="px-2 py-3 text-white card-title">Edit Admin</h4>
        </div>
        <div class="col-md-8">
            <div class="d-flex justify-content-md-end justify-content-sm-center pe-2">
                <a href="{{ route('admin.list') }}" class="btn btn-sm btn-theme"
                    style="border: 1px solid #fff;white-space: nowrap;">
                    Admin List
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
        <div class="col-md-12">
            <form action="{{ route('admin.update', $id = $admin->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="" class="form-label">Name Of The Business <span class="text-danger badge">*</span></label>
                    <input type="text" name="business_name" class="form-control"
                        value="{{ old('business_name', $admin->business_name) }}">
                    @error('business_name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="" class="form-label">Regd. Address <span class="text-danger badge">*</span></label>
                    <textarea name="regd_address" cols="30" rows="3"
                        class="form-control">{{ old('regd_address', $admin->regd_address) }}</textarea>
                    @error('regd_address')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <div class="row">
                        <div class="col-md-6">
                            <label for="" class="form-label">GSTIN No. <span class="text-danger badge">*</span></label>
                            <input type="text" name="gstin_no" class="form-control"
                                value="{{ old('gstin_no', $admin->gstin_no) }}">
                            @error('gstin_no')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="" class="form-label">Pan No. <span class="text-danger badge">*</span></label>
                            <input type="text" name="pan_no" class="form-control"
                                value="{{ old('pan_no', $admin->pan_no) }}">
                            @error('pan_no')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="" class="form-label">Name Of The Business Owner <span
                            class="text-danger badge">*</span></label>
                    <input type="text" name="name" class="form-control" value="{{ old('name', $admin->name) }}">
                    @error('name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <div class="row">
                        <div class="col-md-6">
                            <label for="" class="form-label">Email <span class="text-danger badge">*</span></label>
                            <input type="email" name="email" class="form-control" value="{{ old('email', $admin->email) }}">
                            @error('email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="" class="form-label">Contact No. <span class="text-danger badge">*</span></label>
                            <input type="text" name="contact_no" class="form-control"
                                value="{{ old('contact_no', $admin->contact_no) }}">
                            @error('contact_no')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <div class="row">
                        <div class="col-md-6">
                            <label for="" class="form-label">Upload GST Certificate <small>(PDF Only)</small></label>
                            <input type="file" name="gst_certificate" class="form-control">
                            @if ($admin->gst_certificate)
                                <p>Current File: <a href="{{ asset($admin->gst_certificate) }}" target="_blank">View</a></p>
                            @endif
                            @error('gst_certificate')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="" class="form-label">Upload Pan Card <small>(PDF Only)</small></label>
                            <input type="file" name="pan_card" class="form-control">
                            @if ($admin->pan_card)
                                <p>Current File: <a href="{{ asset($admin->pan_card) }}" target="_blank">View</a></p>
                            @endif
                            @error('pan_card')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <div class="row">
                        <div class="col-md-6">
                            <label for="" class="form-label">Upload Incorporation Certificate <small>(PDF
                                    Only)</small></label>
                            <input type="file" name="incorporation_certificate" class="form-control">
                            @if ($admin->incorporation_certificate)
                                <p>Current File: <a href="{{ asset($admin->incorporation_certificate) }}"
                                        target="_blank">View</a></p>
                            @endif
                            @error('incorporation_certificate')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="" class="form-label">Company Logo <span class="text-danger badge">*</span>
                                <small>(JPG, JPEG, PNG Only)</small></label>
                            <input type="file" name="logo" class="form-control">
                            @if ($admin->logo)
                                <p>Current Logo: <img src="{{ asset($admin->logo) }}" width="100"></p>
                            @endif
                            @error('logo')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <button class="text-white btn" style="background-color: #260950">Update Admin</button>
            </form>
        </div>
    </div>
@endsection
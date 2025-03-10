@extends($layout)

@section('content')
    <div class="row align-items-center mb-3" style="background-color: #260950;">
        <!-- Use align-items-center here -->
        <div class="col-md-4">
            <h4 class="card-title text-white px-2 py-3">Onboard Admin</h4>
        </div>
        <div class="col-md-8">
            <div class="d-flex justify-content-md-end justify-content-sm-center pe-2">
                <a href="{{ route('admin.list') }}" class="btn btn-sm btn-theme" style="white-space: nowrap;"
                    aria-label="Go to admin list">
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
        <div class="col-md-12 ">
            <form action="{{ route('store.admin') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="" class="form-label">Name Of The Business <span
                            class="badge text-danger">*</span></label>
                    <input type="text" name="name_of_the_business" class="form-control"
                        value="{{ old('name_of_the_business') }}">
                    @error('name_of_the_business')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                @csrf
                <div class="mb-3">
                    <label for="" class="form-label">Regd. Address <span class="badge text-danger">*</span></label>
                    <textarea name="regd_address" cols="30" rows="3" class="form-control">{{ old('regd_address') }}</textarea>
                    @error('regd_address')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <div class="row">
                        <div class="col-md-6">
                            <label for="" class="form-label">GSTIN No. <span
                                    class="badge text-danger">*</span></label>
                            <input type="text" name="gstin_no" class="form-control" value="{{ old('gstin_no') }}">
                            @error('gstin_no')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="" class="form-label">Pan No. <span
                                    class="badge text-danger">*</span></label>
                            <input type="text" name="pan_no" class="form-control" value="{{ old('pan_no') }}">
                            @error('pan_no')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Name Of The Business Owner <span
                            class="badge text-danger">*</span></label>
                    <input type="text" name="name_of_the_business_owner" class="form-control"
                        value="{{ old('name_of_the_business_owner') }}">
                    @error('name_of_the_business_owner')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <div class="row">
                        <div class="col-md-6">
                            <label for="" class="form-label">Email <span class="badge text-danger">*</span></label>
                            <input type="email" name="email" class="form-control" value="{{ old('email') }}">
                            @error('email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="" class="form-label">Contact No. <span
                                    class="badge text-danger">*</span></label>
                            <input type="number" name="contact_no" class="form-control" value="{{ old('contact_no') }}">
                            @error('contact_no')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="row">
                        <div class="col-md-6">
                            <label for="" class="form-label">Upload GST Certificate
                                <small>(PDF Only)</small>
                            </label>
                            <input type="file" name="gst_certificate" class="form-control">
                            @error('gst_certificate')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-6" class="form-label">
                            <label for="">Upload Pan Card
                                <small>(PDF Only)</small>
                            </label>
                            <input type="file" name="pan_card" class="form-control">
                            @error('pan_card')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="row">
                        <div class="col-md-6">
                            <label for="" class="form-label">Upload Incorporation Certificate
                                <small>(PDF
                                    Only)</small></label>
                            <input type="file" name="incorporation_certificate" class="form-control">
                            @error('incorporation_certificate')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="" class="form-label">Company Logo <span
                                    class="badge text-danger">*</span>
                                <small>(JPG,JPEG,PNG Only)</small> </label>
                            <input type="file" name="company_logo" id="" class="form-control">
                            @error('company_logo')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <button class="btn text-white" style="background-color: #260950">
                    Onboard</button>
            </form>
        </div>
    </div>
@endsection

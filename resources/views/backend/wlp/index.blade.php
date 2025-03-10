@extends($layout)
@section('content')
    <div class="align-items-center mb-3 row" style="background-color: #260950;">
        <!-- Use align-items-center here -->
        <div class="col-md-4">
            <h4 class="px-2 py-3 text-white card-title">WLP List</h4>
        </div>
        <div class="col-md-8">
            <div class="d-flex justify-content-md-end justify-content-sm-center pe-2">
                <a href="{{ route('create.admin') }}" class="btn btn-sm btn-theme" data-bs-toggle="modal"
                    data-bs-target="#wlpModal" style="border: 1px solid #fff;white-space: nowrap;">
                    Create WLP
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
        <h5 class="text-capitalize"><em>It shows the list of WLP and their details</em></h5>
        <div class="col-md-12">
            <table class="table table-bordered dataTable">
                <thead class="text-white" style="background-color: #260950">
                    <tr>
                        <th scope="col">#</th>
                        <td scope="col">Logo</td>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Mobile</th>
                        <th scope="col">Password</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($wlps as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                @if ($item->logo != null)
                                    <img src="{{ asset('storage/uploads/' . $item->logo) }}" alt="Logo"
                                        style="width:50px;height:50px;">
                                @else
                                    N/A
                                @endif

                            </td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->email }}</td>
                            <td>{{ $item->mobile_no }}</td>
                            <td>{{$item->passwordText}}</td>
                            <td>
                                <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#editModal{{ $loop->iteration }}">
                                    <i class="fa-pen-to-square fa-solid" style="color:#fff"></i>
                                </button>
                                <form action="{{ route('wlp.delete', $id = $item->id) }}" method="POST"
                                    style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"
                                        onclick="return confirm('Are you sure you want to delete this item?');"><i
                                            class="fa-solid fa-trash" style="color:#fff"></i></button>
                                </form>
                            </td>
                        </tr>
                        <!-- Edit Wlp Modal -->
                        <div class="modal fade" id="editModal{{ $item->id }}" tabindex="-1"
                            aria-labelledby="editModalLabel{{ $item->id }}" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="editModalLabel{{ $item->id }}">Edit Wlp</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('wlp.update', $id = $item->id) }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')

                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label for="">Select Country <span
                                                            class="text-danger badge">*</span></label>
                                                    <select name="country" class="form-select form-select-sm">
                                                        <option disabled>Choose Country</option>
                                                        <option value="china" @selected($item->country == 'china')>China</option>
                                                        <option value="india" @selected($item->country == 'india')>India</option>
                                                    </select>
                                                </div>

                                                <div class="col-md-4">
                                                    <label for="">Select State <span class="text-danger badge">*</span></label>
                                                    <select name="state" class="form-select form-select-sm">
                                                        <option disabled>Choose State</option>
                                                        <option value="odisha" @selected($item->state == 'odisha')>Odisha</option>
                                                        <option value="maharashtra" @selected($item->state == 'maharashtra')>
                                                            Maharashtra</option>
                                                    </select>
                                                </div>

                                                <div class="col-md-4">
                                                    <label for="">Default Language </label>
                                                    <select name="language" class="form-select form-select-sm">
                                                        <option value="english" @selected($item->language == 'english')>English
                                                        </option>
                                                        <option value="hindi" @selected($item->language == 'hindi')>Hindi</option>
                                                        <option value="oriya" @selected($item->language == 'oriya')>Oriya</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="my-3 row">
                                                <div class="col-md-8">
                                                    <label for="">Name <span class="text-danger badge">*</span></label>
                                                    <input type="text" name="name" class="form-control form-control-sm"
                                                        value="{{ $item->name }}">
                                                </div>

                                                <div class="col-md-4">
                                                    <label for="">Mobile No. <span class="text-danger badge">*</span></label>
                                                    <input type="text" name="mobile_no" class="form-control form-control-sm"
                                                        value="{{ $item->mobile_no }}">
                                                </div>
                                            </div>

                                            <div class="my-2 row">
                                                <div class="col-md-4">
                                                    <label for="">Sales Mobile No. (+91) </label>
                                                    <input type="text" name="sales_mobile_no"
                                                        class="form-control form-control-sm"
                                                        value="{{ $item->sales_mobile_no }}">
                                                    @error('sales_mobile_no')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="">Sales LandLine No.</label>
                                                    <input type="text" name="landline_no" class="form-control form-control-sm"
                                                        value="{{ $item->sales_landline_no }}">
                                                    @error('landline_no')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="">Email ID <span class="text-danger badge">*</span></label>
                                                    <input type="email" name="email_id" class="form-control form-control-sm"
                                                        value="{{ $item->email }}">
                                                </div>
                                            </div>
                                            <div class="my-2 row">
                                                <div class="col-md-4">
                                                    <label for="">Smart Parent App Package <span
                                                            class="text-danger badge">*</span></label>
                                                    <input type="text" name="smart_parent_app_package"
                                                        class="form-control form-control-sm"
                                                        value="{{ $item->smart_parent_app_package }}">
                                                    @error('smart_parent_app_package')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="">Show Powered By <span
                                                            class="text-danger badge">*</span></label>
                                                    <input type="text" name="show_powered_by"
                                                        class="form-control form-control-sm"
                                                        value="{{ $item->show_powered_by }}">
                                                    @error('show_powered_by')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="">Powered By </label>
                                                    <input type="text" name="power_by" class="form-control form-control-sm"
                                                        value="{{ $item->power_by }}">
                                                    @error('power_by')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="my-2 row">
                                                <div class="col-md-4">
                                                    <label for="">Account Limit <span class="text-danger badge">*</span></label>
                                                    <input type="number" name="account_limit"
                                                        class="form-control form-control-sm" value="{{ $item->account_limit }}">
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="">Http Sms Gateway URL </label>
                                                    <input type="text" name="http_sms_url" class="form-control form-control-sm"
                                                        value="{{ $item->http_sms_url }}">
                                                    @error('http_sms_url')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="">http Sms Gateway Method</label>
                                                    <input name="http_sms__gateway_method" class="form-control form-control-sm"
                                                        value="{{ $item->http_sms__gateway_method }}">
                                                    @error('http_sms__gateway_method')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="my-2 row">
                                                <div class="col-md-4">
                                                    <label for="">GSTN No.</label>
                                                    <input type="text" name="gstn_no" class="form-control form-control-sm"
                                                        value="{{ $item->gstn_no }}">
                                                    @error('gstn_no')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                                <div class="col-md-4">
                                                    <label for="">Billing Email</label>
                                                    <input type="email" name="billing_email"
                                                        class="form-control form-control-sm" value="{{ $item->billing_email }}">
                                                    @error('billing_email')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="">IsAllowThirdPartyAPI</label>
                                                    <input type="text" name="isallowthirdpartyapi"
                                                        class="form-control form-control-sm"
                                                        value="{{ $item->isallowthirdpartyapi }}">
                                                    @error('isallowthirdpartyapi')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="my-2 row">
                                                <div class="col-md-4">
                                                    <label for="">Web URL </label>
                                                    <input type="url" name="web_url" class="form-control form-control-sm"
                                                        value="{{ old('web_url') }}">
                                                    @error('web_url')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="">Logo</label>
                                                    <input type="file" name="profile_image"
                                                        class="form-control form-control-sm">
                                                    @if($item->profile_image)
                                                        <img src="{{ asset('uploads/' . $item->profile_image) }}"
                                                            alt="Profile Image" class="mt-2" width="80">
                                                    @endif
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="">Address </label>
                                                    <input type="text" name="address" class="form-control form-control-sm"
                                                        value="{{ $item->address }}">
                                                </div>
                                            </div>
                                            <div class="my-3">
                                                <button type="submit" class="btn btn-primary">Update WLP</button>
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Cancel</button>
                                            </div>

                                        </form>
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
    <div class="modal fade" id="wlpModal" tabindex="-1" aria-labelledby="wlpModal" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="wlpModal">Modal title</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('wlp.store') }}" method="post" id="wlp_rgd_form" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-4">
                                <label for="">Select Country <span class="text-danger badge">*</span></label>
                                <select name="country" class="form-select form-select-sm country">
                                    <option disabled @selected(true)>Choose Country</option>
                                    <option value="china" @selected(old('country') == 'china')>China</option>
                                    <option value="india" @selected(old('country') == 'india')>India</option>
                                </select>
                                @error('country')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <label for="">Select State <span class="text-danger badge">*</span></label>
                                <select name="state" id="" class="form-select form-select-sm state">
                                    <option disabled @selected(true)>Choose State</option>
                                </select>
                                @error('state')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <label for="">Default Language </label>
                                <select name="language" class="form-select form-select-sm">
                                    <option value="english" @selected(old('language') == 'english')>English</option>
                                    <option value="hindi" @selected(old('language') == 'hindi')>Hindi</option>
                                    <option value="oriya" @selected(old('language') == 'oriya')>Oriya</option>
                                </select>
                                @error('language')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="my-3 row">
                            <div class="col-md-8">
                                <label for="">Name <span class="text-danger badge">*</span></label>
                                <input type="text" name="name" class="form-control form-control-sm"
                                    value="{{ old('name') }}">
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <label for="">Mobile No. <span class="text-danger badge">*</span></label>
                                <input type="text" name="mobile_no" class="form-control form-control-sm"
                                    value="{{ old('mobile_no') }}">
                                @error('mobile_no')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        {{-- <div class="my-2 row">
                            <div class="col-md-4">
                                <label for="">Parent Name <span class="text-danger badge">*</span></label>
                                <input type="text" name="parent_name" class="form-control form-control-sm"
                                    value="{{ old('parent_name') }}">
                                @error('parent_name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="">Parent Code <span class="text-danger badge">*</span></label>
                                <input type="text" name="parent_code" class="form-control form-control-sm"
                                    value="{{ old('parent_code') }}">
                                @error('parent_code')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="">Website <span class="text-danger badge">*</span></label>
                                <input type="text" name="website" class="form-control form-control-sm"
                                    value="{{ old('website') }}">
                                @error('website')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div> --}}

                        <div class="my-2 row">
                            <div class="col-md-4">
                                <label for="">Sales Mobile No. (+91) </label>
                                <input type="text" name="sales_mobile_no" class="form-control form-control-sm"
                                    value="{{ old('sales_mobile_no') }}">
                                @error('sales_mobile_no')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="">Sales LandLine No.</label>
                                <input type="text" name="landline_no" class="form-control form-control-sm"
                                    value="{{ old('landline_no') }}">
                                @error('landline_no')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="">Email ID</label> <span class="text-danger badge">*</span>
                                <input type="text" name="email_id" class="form-control form-control-sm"
                                    value="{{ old('email_id') }}">
                                @error('email_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="my-2 row">
                            <div class="col-md-4">
                                <label for="">Smart Parent App Package <span class="text-danger badge">*</span></label>
                                <input type="text" name="smart_parent_app_package" class="form-control form-control-sm"
                                    value="{{ old('smart_parent_app_package') }}">
                                @error('smart_parent_app_package')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="">Show Powered By <span class="text-danger badge">*</span></label>
                                <input type="text" name="show_powered_by" class="form-control form-control-sm"
                                    value="{{ old('show_powered_by') }}">
                                @error('show_powered_by')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="">Powered By </label>
                                <input type="text" name="power_by" class="form-control form-control-sm"
                                    value="{{ old('power_by') }}">
                                @error('power_by')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="my-2 row">
                            <div class="col-md-4">
                                <label for="">Account limit <span class="text-danger badge">*</span></label>
                                <input type="text" name="account_limit" class="form-control form-control-sm"
                                    value="{{ old('account_limit') }}">
                                @error('account_limit')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="">Http Sms Gateway URL </label>
                                <input type="text" name="http_sms_url" class="form-control form-control-sm"
                                    value="{{ old('http_sms_url') }}">
                                @error('http_sms_url')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="">http Sms Gateway Method</label>
                                <input name="http_sms__gateway_method" class="form-control form-control-sm"
                                    value="{{ old('http_sms__gateway_method') }}">
                                @error('http_sms__gateway_method')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="my-2 row">
                            <div class="col-md-4">
                                <label for="">GSTN No.</label>
                                <input type="text" name="gstn_no" class="form-control form-control-sm"
                                    value="{{ old('gstn_no') }}">
                                @error('gstn_no')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="">Billing Email</label>
                                <input type="email" name="billing_email" class="form-control form-control-sm"
                                    value="{{ old('billing_email') }}">
                                @error('billing_email')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="">IsAllowThirdPartyAPI</label>
                                <input type="text" name="isallowthirdpartyapi" class="form-control form-control-sm"
                                    value="{{ old('isallowthirdpartyapi') }}">
                                @error('isallowthirdpartyapi')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="my-2 row">
                            <div class="col-md-4">
                                <label for="">Web URL </label>
                                <input type="url" name="web_url" class="form-control form-control-sm"
                                    value="{{ old('web_url') }}">
                                @error('web_url')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="">Logo</label>
                                <input type="file" name="logo" class="form-control form-control-sm" value="">
                                @error('logo')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="">Address</label> <span class="text-danger badge">*</span>
                                <textarea name="address" id="" cols="30" rows="3"
                                    class="form-control">{{ old('address') }}</textarea>
                                @error('address')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <button class="text-white btn" style="background-color: #260950">Onboard</button>
                    </form>
                </div>
                {{-- <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div> --}}
            </div>
        </div>
    </div>
@endsection
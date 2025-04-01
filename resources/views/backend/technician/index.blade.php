@extends('layouts.manufacturer')
@section('content')
    <div class="row align-items-center mb-3" style="background-color: #260950;">
        <!-- Use align-items-center here -->
        <div class="col-md-4">
            <h4 class="card-title text-white px-2 py-3">Technician List</h4>
        </div>
        <div class="col-md-8">
            <div class="d-flex justify-content-md-end justify-content-sm-center pe-2">
                <a href="" class="btn btn-sm btn-theme" data-bs-toggle="modal" data-bs-target="#createModal">
                    Create Technician
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
        <h5 class="text-capitalize"><em>It shows the list of Technician and their details</em></h5>
        <div class="col-md-12">
            <table class="table table-bordered dataTable">
                <thead class="text-white" style="background-color: #260950">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Dealer</th>
                        <th scope="col"> Name </th>
                        <th scope="col">Contact No</th>
                        <th scope="col">Email</th>
                        <th scope="col">Password</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($technician as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->dealer->pluck('business_name')->first()}}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->mobile }}</td>
                            <td>{{ $item->email }}</td>
                            <td>{{ $item->mobile }}</td>
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
                    <h1 class="modal-title fs-5" id="createModal">Create Technician</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('technician.store') }}" method="post" id="">
                        @csrf
                        <div class="mb-3">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="" class="form-label">Select Distributer</label>
                                    <select name="distributer" class="form-select form-select-sm" id="distributer">
                                        <option selected disabled>Select Distributer</option>
                                        @foreach ($distributor as $item)
                                            <option value="{{ $item->id }}">{{ $item->business_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="" class="form-label">Select Dealer</label>
                                    <select name="dealer" class="form-select form-select-sm" id="dealer">
                                        <option selected disabled>Select Distributer First</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="">Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="name">
                                </div>
                                <div class="col-md-3">
                                    <label for="">Gender<span class="text-danger">*</span></label>
                                    <select name="gender" id="gender" class="form-select">
                                        <option>Select Option</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label for="">Email Id <span class="text-danger">*</span></label>
                                    <input type="email" class="form-control" name="email">
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="row">

                                <div class="col-md-4">
                                    <label for="">Mobile Number</label>
                                    <input type="text" class="form-control" name="mobile_no">
                                </div>
                                <div class="col-md-4">
                                    <label for="">Aadhar</label>
                                    <input type="text" class="form-control" name="aadhar">
                                </div>
                                <div class="col-md-4">
                                    <label for="">DOB</label>
                                    <input type="date" class="form-control" name="dob">
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="row">

                                <div class="col-md-4">
                                    <label for="">Qulification</label> <span class="text-danger">*</span>
                                    <input type="text" class="form-control" name="qulification">
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        $('#distributer').on('change', function() {
            var distributer = $(this).val();
            alert(distributer);
            if (distributer) {
                // Make an AJAX request to fetch distributors
                $.ajax({
                    url: '/manufacturer/fetch-dealer',
                    type: 'GET',
                    data: {
                        distributer: distributer
                    },
                    success: function(response) {
                        alert(JSON.stringify(response))
                        $('#dealer').empty();
                        $('#dealer').append('<option value="">Select Dealer</option>');

                        // Loop through distributors and append them to the select
                        $.each(response, function(index, dealer) {
                            $('#dealer').append('<option value="' + dealer.id +
                                '">' + dealer.name + '</option>');
                        });
                    }
                });
            } else {
                // If no region selected, clear the distributor select
                $('#dealer').empty();
                $('#dealer').append('<option value="">Select Distributor</option>');
            }
        });
    </script>
@endsection

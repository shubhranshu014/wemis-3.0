@extends('layouts.admin')
@section('content')
    <div class="row align-items-center mb-3" style="background-color: #260950;">
        <!-- Use align-items-center here -->
        <div class="col-md-4">
            <h4 class="card-title text-white px-2 py-3">Assign Elements</h4>
        </div>
        <div class="col-md-8">
            <div class="d-flex justify-content-md-end justify-content-sm-center pe-2">
                <a href="" class="btn btn-sm btn-theme" data-bs-toggle="modal" data-bs-target="#assignModal">
                    Assign Elements
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
        <h5 class="text-capitalize"><em>It shows the list of assign elements to the admins</em></h5>
        <div class="col-md-12">
            <table class="table table-bordered table-striped dataTable">
                <thead style="background-color: #260950">
                    <th>Si no</th>
                    <th>Logo</th>
                    <th>Element name</th>
                    <th>Owner Name <small>(WLP)</small></th>
                    {{-- <th>Business Name</th> --}}
                </thead>
                <tbody>
                    @foreach ($assignElements as $item)
                        <tr>
                            
                            <td>{{ $loop->iteration }}</td>
                            <td>{{$item->wlp->pluck('logo')->first()}}</td>
                            {{-- <td><img src="{{ asset('storage/uploads/' . ) }}" alt="Logo"
                                style="width:50px;height:50px;"></td> --}}
                            <td>{{ $item->element->pluck('name')->first() }}</td>
                            <td>{{ $item->wlp->pluck('name')->first() }}</td>
                            
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="modal fade" id="assignModal" tabindex="-1" aria-labelledby="assignModal" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="assignModal">Modal title</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{route('assigneElement.wlp.store')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <div class="row">
                                <div class="col-md-6 mb-2">
                                    <label for="">Select Elements:</label>
                                    <select id="second" name="element[]"
                                        class="chosen-select form-control form-control-sm" multiple>

                                        @foreach ($element as $item)
                                            <option value="{{ $item->element_id }}">{{ $item->element->pluck('name')->first()}}</option>
                                        @endforeach
                                    </select>
                                    @error('element')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-2">
                                    <label for="">Select WLP:</label>
                                    <select name="wlp" class="form-select form-control-sm">
                                        <option selected @disabled(true)>Please select wlp</option>
                                        @foreach ($Wlp as $item)
                                            <option value="{{ $item->id }}"> {{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('admin')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <button class="btn text-white" style="background-color:#260950">
                            Assign</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

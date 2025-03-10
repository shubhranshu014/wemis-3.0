@extends($loyout)
@section('content')
    @include('subnav.element');

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
        <h5 class="text-capitalize"><em>It shows the list of COP and their details</em></h5>
        <div class="col-md-12">
            <table class="table table-bordered dataTable">
                <thead style="background-color: #260950;color:#fff">
                    <th>Si. no.</th>
                    <th>Element</th>
                    <th>Element type </th>
                    <th>Model no.</th>
                    <th>Part no.</th>
                    <th>TAC no.</th>
                    <th>COP no.</th>
                    <th>COP Valid Till</th>
                    <th>Action</th>
                </thead>
                <tbody>
                    @foreach ($cop as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->elements->pluck('name')->first() }}</td>
                            <td>{{ $item->type->pluck('type')->first() }}</td>
                            <td>{{ $item->model->pluck('model_no')->first() }}</td>
                            <td>{{ $item->part->pluck('part_no')->first() }}</td>
                            <td>{{ $item->tac->pluck('tacNo')->first() }}</td>
                            <td>{{ $item->COPNo }}</td>
                            <td>{{ $item->validTill }}</td>
                            <td>
                                <form action="{{ route('cop.delete', $id = $item->id) }}" method="POST"
                                    style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <a href="javascript:void(0);" class="btn" style="color: red"
                                        onclick="if(confirm('Are you sure you want to delete this item?')) { this.closest('form').submit(); }">
                                        <i class="fa-solid fa-trash"></i>
                                    </a>
                                </form>

                                <button type="button" class="btn" data-bs-toggle="modal"
                                    data-bs-target="#editCop{{ $loop->iteration }}">
                                    <i class="fa-pen-to-square fa-solid"></i>
                                </button>
                            </td>
                        </tr>
                        <div class="modal fade" id="editCop{{ $loop->iteration }}" tabindex="-1"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit TAC No</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('cop.update', $copId = $item->id) }}" method="post">
                                            @csrf
                                            @method('PUT')
                                            <div class="mb-2">
                                                <label for="" class="form-label">COP NO</label>
                                                <input type="text" name="copNo" class="form-control"
                                                    value="{{ $item->COPNo }}">
                                            </div>
                                            <div class="mb-2">
                                                <label for="" class="form-label">COP Valid Till</label>
                                                <input type="date" name="copValidTill" class="form-control"
                                                    value="{{ $item->validTill }}">
                                            </div>
                                            <button class="btn" type="submit"
                                                style="background-color: #260950;color:#fff">Submit</button>
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
@endsection

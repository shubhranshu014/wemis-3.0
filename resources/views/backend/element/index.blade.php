@extends($layout)
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
        <h5 class="text-capitalize"><em>It shows the list of elements and their details</em></h5>
        <div class="col-md-12">
            <table class="table table-bordered dataTable">
                <thead class="text-white" style="background-color: #260950">

                    <tr>
                        <th>Si. No.</th>
                        <th>Element Name</th>
                        <th>VLTD</th>
                        <th>Action</th>
                    </tr>

                </thead>
                <tbody>
                    @foreach ($element as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->name }}</td>
                            <td>
                                @if ($item->is_vltd == 0)
                                    <i class="fa-solid fa-square-check" style="color: green;font-size:25px"></i>
                                @else
                                    <i class="fa-solid fa-square-xmark" style="color: #260950;font-size:25px"></i>
                                @endif
                            </td>
                            <td>
                                <!-- Edit Button -->
                                <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#editModal{{ $loop->iteration }}">
                                    <i class="fa-pen-to-square fa-solid" style="color:#fff"></i>
                                </button>
                                <form action="{{ route('element.delete', $elementId = $item->id) }}" method="POST"
                                    style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"
                                        onclick="return confirm('Are you sure you want to delete this item?');"><i
                                            class="fa-solid fa-trash" style="color:#fff"></i></button>
                                </form>
                            </td>
                        </tr>
                        <!-- Edit Modal -->
                        <div class="modal fade" id="editModal{{ $loop->iteration }}" tabindex="-1"
                            aria-labelledby="editModalLabel{{ $loop->iteration }}" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="editModalLabel{{ $loop->iteration }}">
                                            Edit Element
                                        </h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('element.update', $item->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="mb-2">
                                                <label for="elementName{{ $loop->iteration }}" class="form-label">
                                                    Element Name
                                                </label>
                                                <input type="text" id="elementName{{ $loop->iteration }}"
                                                    class="form-control form-control-sm" name="element_name"
                                                    value="{{ $item->name }}" required>
                                            </div>
                                            <div class="mb-2">
                                                <label for="isVltd{{ $loop->iteration }}">Is VLTD</label>
                                                <select id="isVltd{{ $loop->iteration }}" name="is_vltd"
                                                    class="form-select form-select-sm" required>
                                                    <option value="0" @selected($item->is_vltd == '0')>Yes</option>
                                                    <option value="1" @selected($item->is_vltd == '1')>No</option>
                                                </select>
                                            </div>
                                            <div>
                                                <button type="submit" class="btn"
                                                    style="background-color: #260950; color: #fff;">
                                                    Update
                                                </button>
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
@endsection
@php
    $element = App\Models\Element::get(['id', 'name', 'is_vltd']);
@endphp

<section style="background-color: #260950;">
    <div class="row">
        <div class="col-md-3">
            <h4 class="text-white px-2 py-2">Manage Elements</h4>
        </div>
        <div class="col-md-9">
            <div class="d-flex flex-wrap justify-content-md-end justify-content-sm-center">
                <!-- Buttons Section -->
                @php
                    $buttons = [
                        ['label' => 'Add Element', 'target' => '#add_element'],
                        ['label' => 'Add Element Type', 'target' => '#add_element_type'],
                        ['label' => 'Add Device Model No', 'target' => '#add_device_model_no'],
                        ['label' => 'Add Device Part No', 'target' => '#add_device_part_no'],
                        ['label' => 'Add TAC', 'target' => '#addTacNo'],
                        ['label' => 'Add COP No', 'target' => '#addCopNo'],
                        ['label' => 'Add Testing Agency', 'target' => '#addTestingAgency'],
                    ];
                @endphp

                @foreach ($buttons as $button)
                    <div class="p-2">
                        <button type="button" class="btn btn-sm btn-outline-light styled-button" data-bs-toggle="modal"
                            data-bs-target="{{ $button['target'] }}" aria-label="Open modal for {{ $button['label'] }}">
                            {{ $button['label'] }}
                        </button>
                    </div>
                @endforeach
            </div>
        </div>
    </div>


    <style>
        .styled-button {
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        .styled-button:hover {
            background-color: #fff;
            /* Dark purple on hover */
            color: #260950;
            /* White text on hover */
            border-color: #ffffff;
            /* Matching border color */
        }

        .styled-button:focus {
            outline: none;
            /* Remove default focus outline */
            box-shadow: 0 0 0 2px rgba(38, 9, 80, 0.5);
            /* Custom focus outline for better accessibility */
        }
    </style>
    <!--Add Element Modal -->
    <div class="modal fade" id="add_element" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title fs-5" id="exampleModalLabel">Add Element</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('elements.store') }}" method="post">
                        @csrf
                        <div class="mb-2">
                            <label for="" class="form-label">Elements name</label>
                            <input type="text" class="form-control form-control-sm" name="element_name"
                                placeholder="Enter element name" value="{{ old('element_name') }}">
                            @error('element_name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-2">
                            <label for="" class="form-label">Is VLTD</label>
                            <select name="is_vltd" class="form-select form-select-sm">
                                <option value="0" @selected(old('is_vltd') == '0')>Yes</option>
                                <option value="1" @selected(old('is_vltd') == '1')>No</option>
                            </select>
                            @error('is_vltd')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-sm text-white me-2"
                            style="background-color: #260950">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!--Add Element Type Modal -->
    <div class="modal fade" id="add_element_type" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title fs-5" id="exampleModalLabel">Add Element Type</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('elements.types.store') }}" method="post">
                        @csrf
                        <div class="my-2">
                            <label for="" class="form-label">Select Element</label>
                            <select name="element" class="form-select form-select-sm element">
                                <option selected disabled>Element List:</option>
                                @foreach ($element as $item)
                                    <option value="{{ $item->id }}" is_vts="{{ $item->is_vltd }}"
                                        @selected(old('element') == $item->id)>
                                        {{ $item->name }}</option>
                                @endforeach

                            </select>
                            @error('element')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-2">
                            <label for="" class="form-label">Type</label>
                            <input type="text" class="form-control form-control-sm" name="type"
                                value="{{ old('type') }}" placeholder="Enter element type">
                            @error('type')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-sm me-2 text-white"
                            style="background-color: #260950">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!--Add device Model No -->
    <div class="modal fade" id="add_device_model_no" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title fs-5" id="exampleModalLabel">Add Device Model Number</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('model.store') }}" method="post">
                        @csrf
                        <div class="my-2">
                            <label for="" class="form-label">Select Element</label>
                            <select name="element" class="form-select form-select-sm element">
                                <option selected disabled>Element List:</option>
                                @foreach ($element as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                            @error('element')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-2">
                            <label for="" class="form-label">Select Type</label>
                            <select name="element_type" class="form-select form-select-sm element_type"></select>
                            @error('element_type')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-2">
                            <label for="" class="form-label">Model No</label>
                            <input type="text" class="form-control form-control-sm" name="model_no"
                                placeholder="OLED65C1PUB">
                            @error('model_no')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-2">
                            <label for="" class="form-label">Voltage</label>
                            <input type="text" class="form-control form-control-sm" name="voltage"
                                placeholder="Enter voltage">
                            @error('voltage')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-sm text-white me-2"
                            style="background-color: #260950">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--Add device Part No -->
    <div class="modal fade" id="add_device_part_no" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title fs-5" id="exampleModalLabel">Add Device Part Number</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="device-part-model">
                    <form action="{{ route('part.store') }}" method="post">
                        @csrf
                        <div class="my-2">
                            <label for="" class="form-label">Select Element</label>
                            <select name="element" class="form-select form-select-sm element">
                                <option selected disabled>Element List:</option>
                                @foreach ($element as $item)
                                    <option value="{{ $item->id }}" @selected(old('element') == $item->id)>
                                        {{ $item->name }}</option>
                                @endforeach

                            </select>
                            @error('element')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-2">
                            <label for="" class="form-label">Select Type</label>
                            <select name="element_type" class="form-select form-select-sm element_type"></select>
                            @error('element_type')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-2">
                            <label for="" class="form-label">Select Model No</label>
                            <select name="model_no" class="form-select form-select-sm model-no">
                            </select>
                            @error('model_no')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-2">
                            <label for="" class="form-label">Enter Device Part No</label>
                            <input type="text" class="form-control form-control-sm" name="device_part_no"
                                value="{{ old('device_part_no') }}" placeholder="Enter device part no">
                            @error('device_part_no')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-sm text-white me-2"
                            style="background-color: #260950">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!--Add TAC  -->
    <div class="modal fade" id="addTacNo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title fs-5" id="exampleModalLabel">Add TAC Number</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('tac.store') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="my-2">
                                    <label for="" class="form-label">Select Element</label>
                                    <select name="element" class="form-select form-select-sm element">
                                        <option selected disabled>Element List:</option>
                                        @foreach ($element as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('element')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="my-2">
                                    <label for="" class="form-label">Select Type</label>
                                    <select name="element_type"
                                        class="form-select form-select-sm element_type"></select>
                                    @error('element_type')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="my-2">
                                    <label for="" class="form-label">Select Model No</label>
                                    <select name="model_no" class="form-select form-select-sm model-no">
                                    </select>
                                    @error('model_no')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="my-2">
                                    <label for="" class="form-label">Select Device Part No</label>
                                    <select name="device_part_no" class="form-select form-select-sm partNo"></select>
                                </div>
                                @error('device_part_no')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-12  my-2">
                                <div style="text-align:right">
                                    <span class="btn add_more" style="background-color: #260950; color: white;"
                                        id="">Add
                                        More</span>
                                </div>
                                <div class="dynamic_form">
                                    <div class="row mb-2">
                                        <div class="col-md-9">
                                            <label for="" class="form-label">Enter Tac No</label>
                                            <input type="text" class="form-control form-control-sm"
                                                name="tac_No[]" placeholder="Enter TAC number">
                                            @error('tac_No')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-3 d-flex align-items-end">
                                            <button type="button"
                                                class="btn btn-danger btn-sm remove-row">Remove</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <button type="submit" class="btn btn-sm me-2 text-white"
                            style="background-color: #260950">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--Add COP Modal -->
    <div class="modal fade" id="addCopNo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title fs-5" id="exampleModalLabel">Add COP Number</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('cop.store') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="my-2">
                                    <label for="" class="form-label">Select Element</label>
                                    <select name="element" class="form-select form-select-sm element">
                                        <option disabled selected>Element List:</option>
                                        @foreach ($element as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                        @error('element')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="my-2">
                                    <label for="" class="form-label">Select Type</label>
                                    <select name="element_type"
                                        class="form-select form-select-sm element_type"></select>
                                    @error('element_type')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="my-2">
                                    <label for="" class="form-label">Select Model No</label>
                                    <select name="model_no" class="form-select form-select-sm model-no">
                                    </select>
                                    @error('model_no')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="my-2">
                                    <label for="" class="form-label">Select Device Part No</label>
                                    <select name="device_part_no" class="form-select form-select-sm partNo"></select>
                                    @error('device_part_no')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="my-2">
                                    <label for="" class="form-label">Select TAC No</label>
                                    <select name="device_tac_no" class="form-select form-select-sm tacNo"></select>
                                    @error('device_tac_no')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12  my-2">
                                <div style="text-align:right">
                                    <span class="btn add_more" style="background-color: #260950; color: white;"
                                        id="">Add
                                        More</span>
                                </div>
                                <div class="dynamic_form">
                                    <div class="row mb-2">
                                        <div class="col-md-5">
                                            <label for="" class="form-label">Enter COP No</label>
                                            <input type="text" class="form-control form-control-sm"
                                                name="cop_No[]" placeholder="Enter COP number">
                                            @error('cop_No')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-md-5">
                                            <label for="" class="form-label">COP valid till</label>
                                            <input type="date" class="form-control form-control-sm"
                                                name="cop_valid_till[]" placeholder="Enter COP number">
                                            @error('cop_valid_till')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-2 d-flex align-items-end">
                                            <button type="button"
                                                class="btn btn-danger btn-sm remove-row">Remove</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <button type="submit" class="btn btn-sm me-2"
                            style="background-color: #260950">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Add Testing Agency --}}
    <div class="modal fade" id="addTestingAgency" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title fs-5" id="exampleModalLabel">Add Testing Agency</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{route('testingAgency.store')}}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="my-2">
                                    <label for="" class="form-label">Select Element</label>
                                    <select name="element" class="form-select form-select-sm element">
                                        <option selected disabled>Element List:</option>
                                        @foreach ($element as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('element')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="my-2">
                                    <label for="" class="form-label">Select Type</label>
                                    <select name="element_type"
                                        class="form-select form-select-sm element_type"></select>
                                    @error('element_type')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="my-2">
                                    <label for="" class="form-label">Select Model No</label>
                                    <select name="model_no" class="form-select form-select-sm model-no">
                                    </select>
                                    @error('model_no')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="my-2">
                                    <label for="" class="form-label">Select Device Part No</label>
                                    <select name="device_part_no" class="form-select form-select-sm partNo"></select>
                                    @error('device_part_no')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="my-2">
                                    <label for="" class="form-label">Select TAC No</label>
                                    <select name="device_tac_no" class="form-select form-select-sm tacNo"></select>
                                    @error('device_tac_no')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="my-2">
                                    <label for="" class="form-label">Select COP No</label>
                                    <select name="cop_no" class="form-select form-select-sm cop"></select>
                                    @error('cop_no')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12  my-2">
                                <div style="text-align:right">
                                    <span class="btn add_more" style="background-color: #260950; color: white;"
                                        id="">Add
                                        More</span>
                                </div>
                                <div class="dynamic_form">
                                    <div class="row mb-2">
                                        <div class="col-md-8">
                                            <label for="" class="form-label">Enter Testing Agency</label>
                                            <input type="text" class="form-control form-control-sm"
                                                name="testing_agency[]" placeholder="Enter testing agency">
                                        </div>
                                        <div class="col-md-4 d-flex align-items-end">
                                            <button type="button"
                                                class="btn btn-danger btn-sm remove-row">Remove</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <button type="submit" class="btn btn-sm me-2"
                            style="background-color: #260950">Submit</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    {{-- <button type="button" class="btn btn-sm" style="background-color: #260950">Save changes</button> --}}
                </div>
            </div>
        </div>
    </div>

</section>



<script>
    $(document).ready(function() {
        const $element = $('.element');
        $element.on('change', function() {
            const is_vts = $(this).find('option:selected').attr('is_vts'); // Get the 'is_vts' attribute
            const selectedValue = $(this).val();
            console.log('Selected Value:', selectedValue); // Log the selected value for debugging

            const $form = $(this).parents("form"); // Cache the form for reuse
            const $elementType = $form.find(
                ".element_type"); // Target the dropdown within the same form

            if (is_vts === '0') { // Check if is_vts equals '0' (string comparison)
                // Add the input field if not already present
                if ($("#countOfSim").length === 0) {
                    $(this).parent().after(`
                <div class="my-2" id="countOfSim">
                <label>No. of SIM</label>
                <input type="number" name="no_of_sim" class="form-control form-control-sm" placeholder="Enter SIM count">
                </div>
               `);
                }
            } else {
                // Remove the input field if is_vts is not '0'
                $("#countOfSim").remove();
            }


            $elementType.empty(); // Clear previous options
            $elementType.append('<option value="">Loading...</option>'); // Temporary loading indicator


            $.ajax({
                url: `/superadmin/fetch/element-type/${selectedValue}`,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    $elementType.empty(); // Clear loading message
                    $elementType.append(
                        `<option disabled selected>Select Element Type</option>`
                    );
                    if (data && data.length > 0) {
                        data.forEach(type => {
                            $elementType.append(
                                `<option value="${type.id}">${type.type}</option>`
                            );
                        });
                    } else {
                        $elementType.append(
                            '<option value="">No options available</option>');
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error:', error); // Log the error for debugging
                    $elementType.empty();
                    $elementType.append('<option value="">Failed to load options</option>');
                }
            });
        });



        const $element_type = $('.element_type');
        $element_type.on('change', function() {
            // alert($(this).val());
            const $form = $(this).parents("form"); // Cache the form for reuse
            const $model_no = $form.find(
                ".model-no"); // Target the dropdown within the same form
            $model_no.empty(); // Clear previous options
            $model_no.append('<option value="">Loading...</option>'); // Temporary loading indicator

            $.ajax({
                url: `/superadmin/fetch/model-no/${$(this).val()}`,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    $model_no.empty(); // Clear loading message
                    $model_no.append(
                        `<option disabled selected>Select Model No.</option>`
                    );
                    if (data && data.length > 0) {
                        data.forEach(modelNo => {
                            $model_no.append(
                                `<option value="${modelNo.id}">${modelNo.model_no}</option>`
                            );
                        });
                    } else {
                        $model_no.append(
                            '<option value="">No options available</option>');
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error:', error); // Log the error for debugging
                    $model_no.empty();
                    $model_no.append('<option value="">Failed to load options</option>');
                }
            });
        })


        const $modelNo = $('.model-no');
        $modelNo.on('change', function() {
            // alert($(this).val());
            const $form = $(this).parents("form"); // Cache the form for reuse
            const $partNo = $form.find(
                ".partNo"); // Target the dropdown within the same form
            $partNo.empty(); // Clear previous options
            $partNo.append('<option value="">Loading...</option>'); // Temporary loading indicator


            $.ajax({
                url: `/superadmin/fetch/part-no/${$(this).val()}`,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    $partNo.empty(); // Clear loading message
                    $partNo.append(
                        `<option>Select Part No.</option>`
                    );
                    if (data && data.length > 0) {
                        data.forEach(partlNo => {
                            $partNo.append(
                                `<option value="${partlNo.id}">${partlNo.part_no}</option>`
                            );
                        });
                    } else {
                        $partNo.append(
                            '<option value="">No options available</option>');
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error:', error); // Log the error for debugging
                    $partNo.empty();
                    $partNo.append('<option value="">Failed to load options</option>');
                }
            });

        })


        //  Part No Change
        const $partNo = $('.partNo');
        $partNo.on('change', function() {
            // alert($(this).val());
            const $form = $(this).parents("form"); // Cache the form for reuse
            const $tacNo = $form.find(
                ".tacNo");
            $tacNo.empty(); // Clear previous options
            $tacNo.append('<option value="">Loading...</option>'); // Temporary loading indicator
            $.ajax({
                url: `/superadmin/fetch/tac-no/${$(this).val()}`,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    $tacNo.empty(); // Clear loading message
                    $tacNo.append(
                        `<option disabled selected>Select TAC No.</option>`
                    );
                    if (data && data.length > 0) {
                        data.forEach(tacNo => {
                            $tacNo.append(
                                `<option value="${tacNo.id}">${tacNo.tacNo}</option>`
                            );
                        });
                    } else {
                        $tacNo.append(
                            '<option value="">No options available</option>');
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error:', error); // Log the error for debugging
                    $tacNo.empty();
                    $tacNo.append('<option value="">Failed to load options</option>');
                }
            });
        });


    });
</script>
<script>
    $(document).ready(function() {
        $(".tacNo").on('change', function() {
            // const selectedValue = $(this).val();
            // console.log("Selected Value:", selectedValue);

            const $form = $(this).closest("form");
            const $copNO = $form.find(".cop");

            // Clear previous options or elements
            $copNO.empty(); // Clears options instead of removing the element

            // Add a loading option or fetch new options dynamically
            $copNO.append('<option value="">Loading...</option>');

            $.ajax({
                url: `/superadmin/fetch/cop-no/${$(this).val()}`,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    $copNO.empty(); // Clear loading message
                    if (data && data.length > 0) {
                        $copNO.append(
                            `<option disabled selected>Select COP No.</option>`
                        );
                        data.forEach(cop => {
                            $copNO.append(
                                `<option value="${cop.id}">${cop.COPNo}</option>`
                            );
                        });
                    } else {
                        $copNO.append(
                            '<option value="">No options available</option>');
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error:', error); // Log the error for debugging
                    $copNO.empty();
                    $copNO.append('<option value="">Failed to load options</option>');
                }
            });


        });
    });
</script>

<script>
    $(document).ready(function() {
        // Add More Rows
        $('.add_more').click(function() {
            const $form = $(this).parents("form");
            const $dynamicForm = $form.find(
                ".dynamic_form"); // Target the dropdown within the same form
            // const $dynamicForm = $('#dynamic_form');

            // Clone the first row
            const $newRow = $dynamicForm.children().first().clone();

            // Clear input values and reset dropdowns
            $newRow.find('input').val('');
            $newRow.find('select').prop('selectedIndex', 0);

            // Append the new row to the container
            $dynamicForm.append($newRow);
        });

        // Remove a row
        $(document).on('click', '.remove-row', function() {
            const $form = $(this).closest("form");
            const $dynamicForm = $form.find(".dynamic_form"); // Target the dynamic form container

            // Find all rows inside the .dynamic_form container
            const $rows = $dynamicForm.find('.row');

            if ($rows.length > 1) {
                // Remove the closest row to the clicked button
                $(this).closest('.row').remove();
            } else {
                alert('You must have at least one row.');
            }
        });

    });
</script>
{{-- the end --}}

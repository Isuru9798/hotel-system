@extends('layouts.app')

@section('css')

<style type="text/css">
    .save-btn {
        float: right;
    }

    .div-gap {
        margin-bottom: 5em;
    }
</style>
@endsection

@section('content')

<!-- Button trigger modal -->

<!-- Data Table -->
<div class="card text-center">
    <h5 class="card-header">Check Ins</h5>
    @if ($errors->any())
    <div class="alert alert-danger">Record not added! Please check the form</div>
    @endif
    @if (session()->has('room_select'))
    <div class="alert alert-danger">{{session('room_select')}}</div>
    @endif
    <!-- Button trigger modal -->

    <div class="card-body">
        <button type="button" class="btn btn-primary save-btn" data-toggle="modal" data-target="#exampleModal">
            +
        </button>
        <div class="div-gap"></div>
        <table class="table table-striped table-bordered table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Guest Name</th>
                    <th>Check In Date</th>
                    <th>Check Out Date</th>
                    <th>Nights</th>
                    <th>Adults</th>
                    <th>Child</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($checkIns as $key => $check)

                <tr>
                    <td>{{ $key }}</td>
                    <td>{{$check['guest']['gs_name']}}</td>
                    <td>{{ $check['ci_in_date'] }}</td>
                    <td>{{ $check['ci_out_date'] }}</td>
                    <td>{{ $check['ci_nights'] }}</td>
                    <td>{{ $check['ci_adults'] }}</td>
                    <td>{{ $check['ci_child'] }}</td>
                    @if( $check['ci_status'] == env('PAID'))
                    <td>Paid</td>
                    @endif
                    @if( $check['ci_status'] == env('UNPAID'))
                    <td>Un Paid</td>
                    @endif
                    @if( $check['ci_status'] == env('CANCELED'))
                    <td>Canceled</td>
                    @endif

                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Check In</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-sample" action="{{ route('checkIn.add') }}" method="post">
                    @csrf
                    <input type="hidden" name="selectedRooms" value="[]" id="selectedRooms">
                    <input type="hidden" name="guest_id" value="" id="guest_id">
                    <input type="hidden" name="guest_status" value="0" id="guest_status">
                    <div class="row">
                        <div class="col-md-6">

                            <div class="form-group">
                                <label class="col-sm-3 col-form-label">Passport Id</label>
                                <div class="col-sm-9">
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="gs_passport_or_id" id="gs_passport_or_id" placeholder="167834899" value="{{ old('gs_passport_or_id') }}" />
                                        <div class="input-group-append">
                                            <button class="btn btn-sm btn-primary" type="button" onclick="findGuest()">Search</button>
                                        </div>
                                    </div>
                                    @error('gs_passport_or_id')
                                    <code>{{ $message }}</code>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-sm-3 col-form-label">Full Name</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="gs_name" id="gs_name" placeholder="Jone Doe" value="{{ old('gs_name') }}" />
                                    @error('gs_name')
                                    <code>{{ $message }}</code>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-sm-3 col-form-label">Mobile Number</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="gs_mobile" id="gs_mobile" placeholder="+9477 40 70 378" value="{{ old('gs_mobile') }}" />
                                    @error('gs_mobile')
                                    <code>{{ $message }}</code>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-sm-3 col-form-label">Gender</label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="gs_gender" id="gs_gender">
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-sm-3 col-form-label">Check In Date</label>
                                <div class="col-sm-9">
                                    <input type="date" class="form-control" name="ci_in_date" id="ci_in_date" placeholder="dd/mm/yyyy" />
                                    @error('ci_in_date')
                                    <code>{{ $message }}</code>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-sm-3 col-form-label">Check Out Date</label>
                                <div class="col-sm-9">
                                    <div class="input-group">
                                        <input type="date" class="form-control" name="ci_out_date" id="ci_out_date" placeholder="dd/mm/yyyy" />
                                        <div class="input-group-append">
                                            <button class="btn btn-sm btn-primary" type="button" onclick="timedif()">count days</button>
                                        </div>
                                    </div>
                                    @error('ci_out_date')
                                    <code>{{ $message }}</code>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-sm-3 col-form-label">Address</label>
                                <div class="col-sm-9">
                                    <textarea class="form-control" id="gs_address" rows="3" name="gs_address" placeholder="241/1,Village junction, NewYork" value="{{ old('gs_address') }}">{{ old('gs_mobile') }}</textarea>
                                    @error('gs_address')
                                    <code>{{ $message }}</code>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-sm-3 col-form-label">Country</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="gs_country" name="gs_country" placeholder="USA" value="{{ old('gs_country') }}" />
                                    @error('gs_country')
                                    <code>{{ $message }}</code>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-sm-3 col-form-label">Night</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="ci_nights" name="ci_nights" readonly placeholder="0" value="{{ old('ci_nights') }}" />
                                    @error('ci_nights')
                                    <code>{{ $message }}</code>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-sm-3 col-form-label">Adults</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="ci_adults" placeholder="0" value="{{old('ci_adults') ? old('ci_adults') : '0'}}" />
                                    @error('ci_adults')
                                    <code>{{ $message }}</code>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-sm-3 col-form-label">Child</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="ci_child" placeholder="0" value="{{old('ci_child') ? old('ci_child') : '0'}}" />
                                    @error('ci_child')
                                    <code>{{ $message }}</code>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-sm-3 col-form-label">Room Numbers</label>
                                <div class="col-sm-4">
                                    @foreach ($rooms as $room)
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input type="checkbox" class="form-check-input" onchange="selectRoom({{ $room->id }})" id="room_{{ $room->id }}" value="{{ $room->id }}" class="form-check-input" {{ ($room->rm_availability == 0) ? 'disabled' : '' }}>
                                            {{$room->rm_number}}
                                        </label>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="save-btn">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add</button>
                    </div>

                </form>


            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<script>
    function timedif() {

        const startDate = $('#ci_in_date').val();
        const endDate = $('#ci_out_date').val();
        if (startDate == null) {
            alert('please pick check in date')
        }
        if (endDate == null) {
            alert('please pick check out date')
        }
        if (startDate !== null && endDate !== null) {
            const diffInMs = new Date(endDate) - new Date(startDate)
            const diffInDays = diffInMs / (1000 * 60 * 60 * 24);

            $('#ci_nights').val(diffInDays);
        } else {
            $('#ci_nights').val(0);
        }
    }

    function selectRoom(id) {
        var checkedRoomsArray = JSON.parse($('#selectedRooms').val());

        if ($("#room_" + id).prop('checked') == true) {
            checkedRoomsArray.push(id);
        } else {
            checkedRoomsArray.splice(checkedRoomsArray.indexOf(id), 1);
        }
        $('#selectedRooms').val(JSON.stringify(checkedRoomsArray));
        console.log(checkedRoomsArray);
    }

    function findGuest() {
        let gs_passport_or_id = $('#gs_passport_or_id').val();
        let _token = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
            type: 'POST',
            url: "{{ route('findGuest') }}",
            data: {
                gs_passport_or_id: gs_passport_or_id,
                _token: _token
            },
            success: function(data) {
                console.log(data);
                if (data.status) {
                    $('#guest_status').val(1);
                } else {
                    $('#guest_status').val(0);
                }
                if (data.status) {
                    $('#guest_id').val(data.guest.id);
                    $('#gs_name').val(data.guest.gs_name);
                    $('#gs_mobile').val(data.guest.gs_mobile);
                    $('#gs_gender').val(data.guest.gs_gender);
                    $('#gs_address').val(data.guest.gs_address);
                    $('#gs_country').val(data.guest.gs_country);
                } else {
                    $('#guest_id').val('');
                    $('#gs_name').val('');
                    $('#gs_mobile').val('');
                    $('#gs_gender').val('');
                    $('#gs_address').val('');
                    $('#gs_country').val('');
                }

            }
        });
    }
</script>

@endsection
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
    <h5 class="card-header">Rooms</h5>
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
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-sm-3 col-form-label">Passport Id</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="gs_passport_or_id" placeholder="167834899" value="{{ old('gs_passport_or_id') }}" />
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
                                    <input type="text" class="form-control" name="gs_name" placeholder="Jone Doe" value="{{ old('gs_name') }}" />
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
                                    <input type="text" class="form-control" name="gs_mobile" placeholder="+9477 40 70 378" value="{{ old('gs_mobile') }}" />
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
                                    <select class="form-control" name="gs_gender">
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
                                    <input type="date" class="form-control" name="ci_in_date" placeholder="dd/mm/yyyy" />
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
                                    <input type="date" class="form-control" name="ci_out_date" placeholder="dd/mm/yyyy" />
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
                                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="gs_address" placeholder="241/1,Village junction, NewYork" value="{{ old('gs_address') }}"></textarea>
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
                                    <input type="text" class="form-control" name="gs_country" placeholder="USA" value="{{ old('gs_country') }}" />
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
                                    <input type="text" class="form-control" name="ci_nights" placeholder="1" value="{{ old('ci_nights') }}" />
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
                                    <input type="text" class="form-control" name="ci_adults" placeholder="2" value="{{ old('ci_adults') }}" />
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
                                    <input type="text" class="form-control" name="ci_child" placeholder="0" value="{{ old('ci_child') }}" />
                                    @error('ci_child')
                                    <code>{{ $message }}</code>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-sm-3 col-form-label">Room Number</label>
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
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>

                </form>



                <!-- <form action="{{ route('checkIn.add') }}" method="post">
                    @csrf
                    <input type="hidden" name="selectedRooms" value="[]" id="selectedRooms">

                    <input type="text" name="gs_name" placeholder="gs_name">
                    <input type="text" name="gs_address" placeholder="gs_address">
                    <input type="text" name="gs_gender" placeholder="gs_gender">
                    <input type="text" name="gs_passport_or_id" placeholder="gs_passport_or_id">
                    <input type="text" name="gs_mobile" placeholder="gs_mobile">
                    <input type="text" name="gs_country" placeholder="gs_country">

                    <hr>
                    <input type="date" name="ci_in_date" placeholder="ci_in_date">
                    <input type="date" name="ci_out_date" placeholder="ci_out_date">
                    <input type="text" name="ci_nights" placeholder="ci_nights">
                    <input type="text" name="ci_adults" placeholder="ci_adults">
                    <input type="text" name="ci_child" placeholder="ci_child">


                    @foreach ($rooms as $room)
                    <div class="form-check form-check-primary">
                        <label class="form-check-label">
                            <input type="checkbox" onchange="selectRoom({{ $room->id }})" id="room_{{ $room->id }}" value="{{ $room->id }}" class="form-check-input" {{ ($room->rm_availability == 0) ? 'disabled' : '' }}>
                            {{$room->rm_number}}
                    </div>
                    @endforeach
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </form> -->
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<script>
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
</script>
@endsection
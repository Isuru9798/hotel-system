@extends('layouts.app')

@section('content')

<button class="btn btn-primary">add</button>
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
    Launch demo modal
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('checkIn.add') }}" method="post">
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
                </form>
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
@extends('layouts.app')

@section('content')

<select name="roomSelect" id="roomSelect" onchange="getRoomBills()">
    <option value="noId">Select the Room</option>
    @foreach($rooms as $room)
    <option value="{{ $room->id }}">{{ $room->rm_number }}</option>
    @endforeach
</select>
<br>
guest name
<input type="text" name="guest" id="guest" readonly>
<br>
@endsection
@section('js')
<script>
    function getRoomBills() {
        let roomId = $('#roomSelect').val();
        let _token = $('meta[name="csrf-token"]').attr('content');
        if (roomId !== 'noId') {
            $.ajax({
                type: 'POST',
                url: "{{ route('room-bills.getByRoom') }}",
                data: {
                    id: roomId,
                    _token: _token
                },
                success: function(data) {
                    $('#guest').val(data.gs_name);
                    console.log(data);
                }
            });
        } else {
            $('#guest').val('');
        }
    }
</script>
@endsection
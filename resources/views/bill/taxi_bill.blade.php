@extends('layouts.app')

@section('content')
<div class="row">
    <form action="{{ route('room-bill.add') }}" method="post">
        @csrf
        <select id="roomSelect" onchange="getRoomData()">
            @foreach($rooms as $room)
            <option value="{{ $room->id }}">{{ $room->rm_number }}</option>
            @endforeach
        </select>
        <input type="text" name="guest" id="guest" readonly>
        <input type="date" name="rb_issue_date" placeholder="rb_issue_date">
        <input type="text" placeholder="$ rate" id="rb_doller_rate" name="rb_doller_rate" value="0">
        <input type="text" placeholder="amount by $" id="rb_amount_doller" name="rb_amount_doller" value="0" onkeyup="calCost()">
        <input type="text" placeholder="amount by LKR" name="rb_cost" value="0" id="rb_cost">
        <input type="hidden" id="checked_rooms_id" name="checked_rooms_id" value="">
        <button type="submit" class="btn btn-primary">Save changes</button>
    </form>
</div>
<div class="row">
    <table>
        <tr>
            <th>Description</th>
            <th>doller rate</th>
            <th>amount_doller</th>
            <th>amount_lkr</th>
            <th>date</th>
            <th>status</th>
            <th>action</th>
        </tr>
        @foreach($room_bills as $room_bill)
        <tr>
            <td>{{ $room_bill->rm_type }}</td>
            <td>{{ $room_bill->rb_doller_rate }}</td>
            <td>{{ $room_bill->rb_amount_doller }}</td>
            <td>{{ $room_bill->rb_cost }}</td>
            <td>{{ $room_bill->rb_issue_date }}</td>
            @if( $room_bill->rb_status == env('PAID'))
            <td>Paid</td>
            @endif
            @if( $room_bill->rb_status == env('UNPAID'))
            <td>Un Paid</td>
            @endif
            @if( $room_bill->rb_status == env('CANCELED'))
            <td>Canceled</td>
            @endif
            <td>
                <a href="{{ route('room-bill.cancel',$room_bill->room_bill_id) }}">Cancel</a>
            </td>
        </tr>
        @endforeach
    </table>
</div>
@endsection

@section('js')
<script>
    function getRoomData() {
        let roomId = $('#roomSelect').val();
        let _token = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            type: 'POST',
            url: "{{ route('room-bills.getByRoom') }}",
            data: {
                id: roomId,
                _token: _token
            },
            success: function(data) {
                $('#checked_rooms_id').val(data.checked_rooms_id);
                $('#guest').val(data.gs_name);
                console.log(data);
            }
        });
    }

    function calCost() {
        $d_rate = $('#rb_doller_rate').val();
        $d_amount = $('#rb_amount_doller').val();
        $lkr_cost = $d_rate * $d_amount;
        $('#rb_cost').val($lkr_cost);
    }
</script>
@endsection
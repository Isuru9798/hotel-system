@extends('layouts.app')

@section('content')
<div class="row">
    <form action="{{ route('laundry-bill.add') }}" method="post">
        @csrf
        <select id="roomSelect" onclick="getRoomData()">
            @foreach($rooms as $room)
            <option value="{{ $room->id }}">{{ $room->rm_number }}</option>
            @endforeach
        </select>
        <input type="text" name="guest" id="guest" readonly>
        <input type="date" name="lon_issue_date" placeholder="lon_issue_date">

        <input type="text" placeholder="lon_item" id="lon_item" name="lon_item">
        <input type="text" placeholder="lon_quantity" id="lon_quantity" name="lon_quantity">
        <input type="text" placeholder="lon_amount per unit " id="lon_amount" name="lon_amount">

        <input type="hidden" id="checked_rooms_id" name="checked_rooms_id" value="">
        <button type="submit" class="btn btn-primary">Save changes</button>
    </form>
</div>
<div class="row">
    <table>
        <tr>
            <th>Room Number</th>
            <th>lon_amount</th>
            <th>lon_quantity</th>
            <th>total</th>
            <th>date</th>
            <th>status</th>
            <th>action</th>
        </tr>
        @foreach($laundry_bills as $laundry_bill)
        <tr>
            <td>{{ $laundry_bill->rm_number }}</td>
            <td>{{ $laundry_bill->lon_amount }}</td>
            <td>{{ $laundry_bill->lon_quantity }}</td>
            <td>{{ $laundry_bill->lon_amount * $laundry_bill->lon_quantity }}</td>
            <td>{{ $laundry_bill->lon_issue_date }}</td>

            @if( $laundry_bill->lon_status == env('PAID'))
            <td>Paid</td>
            @endif
            @if( $laundry_bill->lon_status == env('UNPAID'))
            <td>Un Paid</td>
            @endif
            @if( $laundry_bill->lon_status == env('CANCELED'))
            <td>Canceled</td>
            @endif
            <td>
                <a href="{{ route('laundry-bill.cancel',$laundry_bill->laundry_id) }}">Cancel</a>
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
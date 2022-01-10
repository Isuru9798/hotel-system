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
            <th>Description</th>
            <th>lon_amount</th>
            <th>lon_quantity</th>
            
            <th>tx_vehicle_num</th>
            <th>tx_amount</th>
            <th>tx_tax</th>
            <th>date</th>
            <th>total</th>
            <th>status</th>
            <th>action</th>
        </tr>
        @foreach($taxi_bills as $taxi_bill)
        <tr>
            <td>{{ $taxi_bill->rm_type }}</td>
            <td>{{ $taxi_bill->tx_destination }}</td>
            <td>{{ $taxi_bill->tx_num_of_days }}</td>
            <td>{{ $taxi_bill->tx_vehicle_num }}</td>
            <td>{{ $taxi_bill->tx_amount }}</td>
            <td>{{ $taxi_bill->tx_tax }}</td>
            <td>{{ $taxi_bill->tx_issue_date }}</td>
            <td>{{ $taxi_bill->tx_amount + $taxi_bill->tx_tax }}</td>
            @if( $taxi_bill->tx_status == env('PAID'))
            <td>Paid</td>
            @endif
            @if( $taxi_bill->tx_status == env('UNPAID'))
            <td>Un Paid</td>
            @endif
            @if( $taxi_bill->tx_status == env('CANCELED'))
            <td>Canceled</td>
            @endif
            <td>
                <a href="{{ route('taxi-bill.cancel',$taxi_bill->taxi_id) }}">Cancel</a>
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
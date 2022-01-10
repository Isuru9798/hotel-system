@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-body">
        <form>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputEmail4">Room Id</label>
                    <select class="form-control" id="roomSelect" onclick="getRoomData()">
                        @foreach($rooms as $room)
                        <option value="{{ $room->id }}">{{ $room->rm_number }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label for="inputPassword4">Guest Name</label>
                    <input type="text" class="form-control" placeholder="Jone Doe" name="guest" id="guest" readonly>
                </div>
            </div>
            <div class="form-row ">
                <div class="form-group col-md-6">
                    <label for="inputAddress">Address</label>
                    <input type="text" class="form-control" id="inputAddress" placeholder="1234 Main St">
                </div>
                <div class="form-group col-md-6">
                    <label for="inputAddress2">Address 2</label>
                    <input type="text" class="form-control" id="inputAddress2" placeholder="Apartment, studio, or floor">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputCity">City</label>
                    <input type="text" class="form-control" id="inputCity">
                </div>
                <div class="form-group col-md-4">
                    <label for="inputState">State</label>
                    <select id="inputState" class="form-control">
                        <option selected>Choose...</option>
                        <option>...</option>
                    </select>
                </div>
                <div class="form-group col-md-2">
                    <label for="inputZip">Zip</label>
                    <input type="text" class="form-control" id="inputZip">
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Sign in</button>
        </form>
    </div>
</div>
<div class="row">
    <form action="{{ route('taxi-bill.add') }}" method="post">
        @csrf
        <select id="roomSelect" onclick="getRoomData()">
            @foreach($rooms as $room)
            <option value="{{ $room->id }}">{{ $room->rm_number }}</option>
            @endforeach
        </select>
        <input type="text" name="guest" id="guest" readonly>
        <input type="date" name="tx_issue_date" placeholder="tx_issue_date">

        <input type="text" placeholder="tx_destination" id="tx_destination" name="tx_destination">
        <input type="text" placeholder="tx_vehicle_num" id="tx_vehicle_num" name="tx_vehicle_num">
        <input type="text" placeholder="tx_num_of_days" id="tx_num_of_days" name="tx_num_of_days">
        <input type="text" placeholder="tx_amount" id="tx_amount" name="tx_amount">
        <input type="text" placeholder="tx_tax" id="tx_tax" name="tx_tax">
        <input type="hidden" id="checked_rooms_id" name="checked_rooms_id" value="">
        <button type="submit" class="btn btn-primary">Save changes</button>
    </form>
</div>
<div class="row">
    <table>
        <tr>
            <th>Description</th>
            <th>tx_destination</th>
            <th>tx_num_of_days</th>
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
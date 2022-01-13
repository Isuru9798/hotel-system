@extends('layouts.app')

@section('css')

<style type="text/css">
    .save-btn {
        float: right;
    }

    .div-gap {
        margin-bottom: 2em;
    }
</style>
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ route('taxi-bill.add') }}" method="post">
            @csrf
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
                    <label for="inputAddress">Date</label>
                    <input type="date" class="form-control" name="tx_issue_date" placeholder="dd/mm/yyyy" value="{{ old('tx_issue_date') }}">
                    @error('tx_issue_date')
                    <code>{{ $message }}</code>
                    @enderror
                </div>
                <div class="form-group col-md-6">
                    <label for="inputAddress2">Destination</label>
                    <input type="text" class="form-control" id="tx_destination" name="tx_destination" placeholder="Destination" value="{{ old('tx_destination') }}">
                    @error('tx_destination')
                    <code>{{ $message }}</code>
                    @enderror
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputCity">Vehicle Number</label>
                    <input type="text" class="form-control" id="tx_vehicle_num" name="tx_vehicle_num" placeholder="BDB - 2244" value="{{ old('tx_vehicle_num') }}">
                    @error('tx_vehicle_num')
                    <code>{{ $message }}</code>
                    @enderror
                </div>
                <div class="form-group col-md-4">
                    <label for="inputState">Number of Dayes</label>
                    <input type="text" class="form-control" id="tx_num_of_days" name="tx_num_of_days" placeholder="1" value="{{ old('tx_num_of_days') }}">
                    @error('tx_num_of_days')
                    <code>{{ $message }}</code>
                    @enderror
                </div>
                <div class="form-group col-md-2">
                    <label for="inputAddress2">Tax Amount</label>
                    <input type="text" class="form-control" id="tx_tax" name="tx_tax" placeholder="Taxt Amount">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputZip">Amount</label>
                    <input type="text" class="form-control" id="tx_amount" name="tx_amount" placeholder="Amount" value="{{ old('tx_amount') }}">
                    @error('tx_amount')
                    <code>{{ $message }}</code>
                    @enderror
                </div>
            </div>
            <input type="hidden" id="checked_rooms_id" name="checked_rooms_id" value="">

            <button type="submit" class="btn btn-primary save-btn">Save changes</button>
        </form>
    </div>
</div>
<div class="div-gap"></div>
<div class="card">
    <div class="card-body">
        <table class="table table-striped table-bordered table-hover">
            <thead>
                <tr>
                    <th>Room Number</th>
                    <th>Destination</th>
                    <th>Number of Dayes</th>
                    <th>Vehicle Number</th>
                    <th>Amount</th>
                    <th>Tax</th>
                    <th>Date</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($taxi_bills as $taxi_bill)
                <tr>
                    <td>{{ $taxi_bill->rm_number }}</td>
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
            </tbody>
        </table>
    </div>
</div>
<!-- <div class="row">
    <table>
        <tr>
            <th>Room Number</th>
            <th>Destination</th>
            <th>Number Of Dayes</th>
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
            <td>{{ $taxi_bill->rm_number }}</td>
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
</div> -->
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
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
        <form action="{{ route('laundry-bill.add') }}" method="post">
            @csrf
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputEmail4">Room Id</label>
                    <select class="form-control" id="roomSelect" onclick="getRoomData()">
                        <option value="null">select room</option>
                        @foreach($rooms as $room)
                        <option value="{{ $room->id }}">{{ $room->rm_number }}</option>
                        @endforeach
                    </select>
                    @error('checked_rooms_id')
                    <code>{{ $message }}</code>
                    @enderror
                </div>
                <div class="form-group col-md-6">
                    <label for="inputPassword4">Guest Name</label>
                    <input type="text" class="form-control" placeholder="Jone Doe" name="guest" id="guest" readonly>
                </div>
            </div>
            <div class="form-row ">
                <div class="form-group col-md-6">
                    <label for="inputAddress">Date</label>
                    <input type="date" class="form-control" name="lon_issue_date" placeholder="dd/mm/yyyy" value="{{ old('lon_issue_date') }}">
                    @error('lon_issue_date')
                    <code>{{ $message }}</code>
                    @enderror
                </div>
                <div class="form-group col-md-6">
                    <label for="inputAddress2">Londry Item</label>
                    <input type="text" class="form-control" id="lon_item" name="lon_item" placeholder="Item Name" value="{{ old('lon_item') }}">
                    @error('lon_item')
                    <code>{{ $message }}</code>
                    @enderror
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputCity">Quentity</label>
                    <input type="text" class="form-control" id="lon_quantity" name="lon_quantity" placeholder="0" value="{{ old('lon_quantity') }}">
                    @error('lon_quantity')
                    <code>{{ $message }}</code>
                    @enderror
                </div>

                <div class="form-group col-md-2">
                    <label for="inputZip">Amount</label>
                    <input type="text" class="form-control" id="lon_amount" name="lon_amount" placeholder="Amount" value="{{ old('lon_amount') }}">
                    @error('lon_amount')
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
                    <th>Londry Amount</th>
                    <th>Quantity</th>
                    <th>Total</th>
                    <th>Date</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
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
            </tbody>
        </table>
    </div>
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
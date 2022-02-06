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
        <form action="{{ route('room-bill.add') }}" method="post">
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
                    <input type="text" class="form-control" name="guest" id="guest" placeholder="Jone Doe" readonly>

                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputAddress">Date</label>
                    <input type="Date" class="form-control" name="rb_issue_date" placeholder="dd/mm/yyyy">
                    @error('rb_issue_date')
                    <code>{{ $message }}</code>
                    @enderror
                </div>
                <div class="form-group col-md-6">
                    <label for="inputAddress2">Doller Rate</label>
                    <input type="text" class="form-control" name="rb_doller_rate" id="rb_doller_rate" placeholder="$ Rate" value="{{ old('rb_doller_rate') }}">
                    @error('rb_doller_rate')
                    <code>{{ $message }}</code>
                    @enderror
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputCity">Amount By Doller</label>
                    <input type="text" class="form-control" name="rb_amount_doller" id="rb_amount_doller" onkeyup="calCost()" placeholder="Amount By $" value="{{ old('rb_amount_doller') }}">
                    @error('rb_amount_doller')
                    <code>{{ $message }}</code>
                    @enderror
                </div>
                <div class="form-group col-md-6">
                    <label for="inputAddress2">Amount By LKR</label>
                    <input type="text" class="form-control" placeholder="Amount By LKR" name="rb_cost" id="rb_cost" value="{{ old('rb_cost') }}">
                    @error('rb_cost')
                    <code>{{ $message }}</code>
                    @enderror
                </div>
                <input type="hidden" id="checked_rooms_id" name="checked_rooms_id" value="">
            </div>

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
                    <th>doller rate</th>
                    <th>amount_doller</th>
                    <th>amount_lkr</th>
                    <th>date</th>
                    <th>status</th>
                    <th>action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($room_bills as $room_bill)
                <tr>
                    <td>{{ $room_bill->rm_number }}</td>
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
            </tbody>
        </table>
    </div>
</div>
<!-- <div class="row">
    <form action="{{ route('room-bill.add') }}" method="post">
        @csrf
        <select id="roomSelect" onclick="getRoomData()">
            @foreach($rooms as $room)
            <option value="{{ $room->id }}">{{ $room->rm_number }}</option>
            @endforeach
        </select>
        <input type="text" name="guest" id="guest" readonly>
        <input type="date" name="rb_issue_date" placeholder="rb_issue_date">
        <input type="text" placeholder="$ rate" id="rb_doller_rate" name="rb_doller_rate" value="0">
        <input type="text" placeholder="amount by $" id="rb_amount_doller" name="rb_amount_doller" value="0" onkeyup="calCost()">
        <input type="text" placeholder="amount by LKR" name="rb_cost" value="0" id="rb_cost">

        <button type="submit" class="btn btn-primary">Save changes</button>
    </form>
</div> -->
<!--  -->
@endsection

@section('js')
<script>
    function getRoomData() {
        let roomId = $('#roomSelect').val();
        let _token = $('meta[name="csrf-token"]').attr('content');
        if (roomId !== 0) {
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
        } else {
            alert('please select room')
        }
    }

    function calCost() {
        $d_rate = $('#rb_doller_rate').val();
        $d_amount = $('#rb_amount_doller').val();
        $lkr_cost = $d_rate * $d_amount;
        $('#rb_cost').val($lkr_cost);
    }
</script>
@endsection
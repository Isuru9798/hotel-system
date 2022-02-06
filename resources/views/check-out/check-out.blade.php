@extends('layouts.app')

@section('content')
@if(session()->has('bill_id') )
<script>
    document.onload(window.open("invoice-view/{{session('bill_id')}}", '_blank'));
</script>
@endif
<!-- <select name="roomSelect" id="roomSelect" onchange="getRoomBills()">
    <option value="noId">Select the Room</option>
    @foreach($rooms as $room)
    <option value="{{ $room->id }}">{{ $room->rm_number }}</option>
    @endforeach
</select>
<br>
guest name
<input type="text" name="guest" id="guest" readonly>
<input type="text" name="guestId" id="gs_passport_or_id" readonly> -->

<div class="card">
    <div class="card-body">
        <form>
            @csrf
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="inputEmail4">Room Id</label>
                    <select class="form-control" id="roomSelect" name="roomSelect" onclick="getRoomBills()">
                        @foreach($rooms as $room)
                        <option value="{{ $room->id }}">{{ $room->rm_number }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-4">
                    <label for="inputPassword4">Guest Name</label>
                    <input type="text" class="form-control" placeholder="Jone Doe" name="guest" id="guest" readonly>
                </div>
                <div class="form-group col-md-4">
                    <label for="inputPassword4">Passport or Id</label>
                    <input type="text" class="form-control" name="guestId" id="gs_passport_or_id" readonly>
                </div>
            </div>
        </form>
    </div>
</div>
<div class="div-gap"></div>
<div class="card">
    <div class="card-body">
        <table class="table table-striped table-bordered table-hover">
            <tbody>
                <tr>
                    <td>Room Bill </td>
                    <td id="roomBillTot">00.00</td>
                </tr>
                <tr>
                    <td>Taxi Bill</td>
                    <td id="taxiBillTot">00.00</td>
                </tr>
                <tr>
                    <td>Laundry Bill</td>
                    <td id="laundryBillTot">00.00</td>
                </tr>
                <tr>
                    <td>Restaurant Bill</td>
                    <td id="restaurantBillTot">00.00</td>
                </tr>
                <tr>
                    <td>Grand Total</td>
                    <td id="billTot">00.00</td>
                </tr>
            </tbody>
        </table>
        <button class="btn btn-success" disabled="true" id="check-out-btn" onclick="event.preventDefault();
                                                     document.getElementById('checkout-form').submit();">
            Check Out
        </button>
    </div>
</div>
<form id="checkout-form" action="{{ route('checkOut.store') }}" method="POST" class="d-none">
    @csrf
    <input type="hidden" name="checkin_id" value="0" id="checkin_id">
    <input type="hidden" name="room_id" value="0" id="room_id">
    <input type="hidden" name="guest_id" value="0" id="guest_id">
    <input type="hidden" name="bill_tot" value="0" id="bill_tot">
</form>
@endsection
@section('js')
<script>
    function getRoomBills() {
        let roomId = $('#roomSelect').val();
        let _token = $('meta[name="csrf-token"]').attr('content');

        console.log(roomId == 'noId');
        if (roomId !== 'noId') {
            $('#check-out-btn').prop('disabled', false);

            $.ajax({
                type: 'POST',
                url: "{{ route('checkOut.bills') }}",
                data: {
                    id: roomId,
                    _token: _token
                },
                success: function(data) {
                    console.log(data);
                    if (data.checkin == false) {
                        $('#checkin_id').val(0);
                    } else {
                        $('#checkin_id').val(data.checkin.check_ins_id);
                    }
                    $('#guest').val(data.guest.gs_name);
                    $('#gs_passport_or_id').val(data.guest.gs_passport_or_id);
                    $('#room_id').val(roomId);



                    let grandTotal = 0;

                    // room_bills
                    let room_tot = 0;
                    data.room_bills.forEach(element => {
                        room_tot = room_tot + parseInt(element.rb_cost);
                    });
                    $('#roomBillTot').html(room_tot);
                    grandTotal = grandTotal + room_tot;


                    // restaurant_bills
                    let restaurant_tot = 0;
                    data.restaurant_bills.forEach(element => {
                        restaurant_tot = restaurant_tot + parseInt(element.or_tot);
                    });
                    $('#restaurantBillTot').html(restaurant_tot);
                    grandTotal = grandTotal + restaurant_tot;


                    // taxi_bills
                    let taxi_tot = 0;
                    data.taxi_bills.forEach(element => {
                        taxi_tot = taxi_tot + ((parseInt(element.tx_num_of_days) * parseInt(element.tx_amount)) + parseInt(element.tx_tax));
                    });
                    $('#taxiBillTot').html(taxi_tot);
                    grandTotal = grandTotal + taxi_tot;


                    // laundry_bills
                    let laundry_tot = 0;
                    data.laundry_bills.forEach(element => {
                        laundry_tot = laundry_tot + (parseInt(element.lon_amount) * parseInt(element.lon_quantity));
                    });
                    $('#laundryBillTot').html(laundry_tot);
                    grandTotal = grandTotal + laundry_tot;

                    $('#billTot').html(grandTotal);

                    // set for the form
                    $('#guest_id').val(data.guest.guest_id);
                    $('#bill_tot').val(grandTotal);
                }
            });
        } else {
            $('#check-out-btn').prop('disabled', true);
            $('#guest').val('');
        }
    }
</script>
@endsection
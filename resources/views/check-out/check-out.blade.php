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
<input type="text" name="guestId" id="guestId" readonly>
<br>

bills
<table>
    <tr>
        <td>Room Bill</td>
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
</table>
<button type="button" class="btn btn-success" id="checkout-btn">Check Out</button>
@endsection
@section('js')
<script>
    function getRoomBills() {
        let roomId = $('#roomSelect').val();
        let _token = $('meta[name="csrf-token"]').attr('content');
        if (roomId !== 'noId') {
            $.ajax({
                type: 'POST',
                url: "{{ route('checkOut.bills') }}",
                data: {
                    id: roomId,
                    _token: _token
                },
                success: function(data) {
                    $('#guest').val(data.guest.gs_name);
                    $('#guestId').val(data.guest.guest_id);

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

                }
            });
        } else {
            $('#guest').val('');
        }
    }
</script>
@endsection
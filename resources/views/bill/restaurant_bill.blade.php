@extends('layouts.app')

@section('content')
<div class="row">
    <form action="{{ route('restaurant-bill.add') }}" method="post">
        @csrf
        <select id="roomSelect" onclick="getRoomData()">
            @foreach($rooms as $room)
            <option value="{{ $room->id }}">{{ $room->rm_number }}</option>
            @endforeach
        </select>
        <input type="text" name="guest" id="guest" readonly>
        <br>
        item code
        <select name="items_id" id="items_id" onclick="getItemData()">
            @foreach($items as $item)
            <option value="{{ $item->id }}">{{ $item->itm_item_code }}</option>
            @endforeach
        </select>
        <input type="hidden" name="itm_item_price" id="itm_item_price" value="0">
        <br>
        quentity
        <input type="text" placeholder="or_quantity" id="or_quantity" name="or_quantity" onkeyup="calTot()" value="0">
        <br>
        service charge
        <input type="text" placeholder="or_service_chrge" id="or_service_chrge" name="or_service_chrge" onkeyup="calTot()" value="0">
        <br>
        total
        <input type="text" placeholder="or_tot" id="or_tot" name="or_tot" readonly value="0">
        <br>
        <input type="hidden" id="checked_rooms_id" name="checked_rooms_id" value="">
        <button type="submit" class="btn btn-primary">Save changes</button>
    </form>
</div>
<div class="row">
    <table>
        <tr>
            <th>itm_img</th>
            <th>Room Number</th>
            <th>itm_description</th>
            <th>itm_item_code</th>
            <th>itm_item_name</th>
            <th>or_tot</th>
            <th>or_quantity</th>
            <th>or_status</th>
            <th>action</th>
        </tr>
        @foreach($restaurant_bills as $restaurant_bill)
        <tr>
            <td>
                <img src="{{ asset('upload/'.$restaurant_bill->itm_img) }}" alt="" srcset="" style="width: 40px;">
            </td>
            <td>{{ $restaurant_bill->rm_number }}</td>
            <td>{{ $restaurant_bill->itm_description }}</td>
            <td>{{ $restaurant_bill->itm_item_code }}</td>
            <td>{{ $restaurant_bill->itm_item_name }}</td>
            <td>{{ $restaurant_bill->or_tot }}</td>
            <td>{{ $restaurant_bill->or_quantity }}</td>
            @if( $restaurant_bill->or_status == env('PAID'))
            <td>Paid</td>
            @endif
            @if( $restaurant_bill->or_status == env('UNPAID'))
            <td>Un Paid</td>
            @endif
            @if( $restaurant_bill->or_status == env('CANCELED'))
            <td>Canceled</td>
            @endif
            <td>
                <a href="{{ route('restaurant-bill.cancel',$restaurant_bill->orders_id) }}">Cancel</a>
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
        let d_rate = $('#rb_doller_rate').val();
        let d_amount = $('#rb_amount_doller').val();
        let lkr_cost = $d_rate * $d_amount;
        $('#rb_cost').val($lkr_cost);
    }

    function getItemData() {
        let itemsId = $('#items_id').val();
        let _token = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            type: 'POST',
            url: "{{ route('restaurant-bills.getItem-data') }}",
            data: {
                id: itemsId,
                _token: _token
            },
            success: function(data) {
                $('#itm_item_price').val(data.itm_item_price);
                console.log(data);
            }
        });
    }

    function calTot() {
        let itm_item_price = parseInt($('#itm_item_price').val());
        let or_quantity = parseInt($('#or_quantity').val());
        let or_service_chrge = parseInt($('#or_service_chrge').val());

        $('#or_tot').val((itm_item_price * or_quantity) + or_service_chrge);

    }
</script>
@endsection
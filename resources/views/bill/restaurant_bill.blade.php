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
        <form action="{{ route('restaurant-bill.add') }}" method="post">
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
                    <label for="inputAddress">Item Code</label>
                    <select class="form-control" name="items_id" id="items_id" onclick="getItemData()">
                        @foreach($items as $item)
                        <option value="{{ $item->id }}">{{ $item->itm_item_code }}</option>
                        @endforeach
                    </select>
                </div>
                <input type="hidden" name="itm_item_price" id="itm_item_price" value="0">
                <div class="form-group col-md-6">
                    <label for="inputAddress2">Quentity</label>
                    <input type="text" class="form-control" id="or_quantity" name="or_quantity" onkeyup="calTot()" placeholder="Quentity" value="{{ old('or_quantity') }}">
                    @error('or_quantity')
                    <code>{{ $message }}</code>
                    @enderror
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputCity">Service charge (%)</label>
                    <input type="text" class="form-control" id="or_service_chrge" name="or_service_chrge" onkeyup="calTot()" value="0" placeholder="Service charge" >
                    @error('or_service_chrge')
                    <code>{{ $message }}</code>
                    @enderror
                </div>
                <div class="form-group col-md-4">
                    <label for="inputState">Total</label>
                    <input type="text" class="form-control" id="or_tot" name="or_tot" readonly value="0" placeholder="Total">
                </div>
            </div>
            <input type="hidden" id="checked_rooms_id" name="checked_rooms_id" value="">
            <button type="submit" class="btn btn-primary save-btn">Save Changes</button>
        </form>
    </div>
</div>

<div class="div-gap"></div>
<div class="card">
    <div class="card-body">
        <table class="table table-striped table-bordered table-hover">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Room Number</th>
                    <th>Item Description</th>
                    <th>Item Code</th>
                    <th>Item Name</th>
                    <th>Order Total</th>
                    <th>Order Quantity</th>
                    <th>Order Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
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
            </tbody>
        </table>
    </div>
</div>

<!-- <div class="row">
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
</div> -->
<!-- <div class="row">
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
        if (or_service_chrge > 100) {
            alert('invalid presantage!');
        }
        let service_charge = ((itm_item_price * or_quantity) * or_service_chrge) / 100

        $('#or_tot').val((itm_item_price * or_quantity) + service_charge);

    }
</script>
@endsection
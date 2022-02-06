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
        <table class="table table-striped table-bordered table-hover">
            <thead>
                <tr>
                    <th>date</th>
                    <th>Amount</th>
                    <th>Invoice Number</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($bills as $bill)
                <tr>
                    <td>{{ $bill->date }}</td>
                    <td>{{ $bill->bill_tot }}</td>
                    <td>{{ $bill->invoice_num }}</td>
                    @if( $bill->status == env('PAID'))
                    <td>Paid</td>
                    @endif
                    @if( $bill->status == env('UNPAID'))
                    <td>Un Paid</td>
                    @endif
                    @if( $bill->status == env('CANCELED'))
                    <td>Canceled</td>
                    @endif
                    <td>
                        <a target="_blank" href="{{ route('invoice-view',$bill->id) }}">View</a>
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
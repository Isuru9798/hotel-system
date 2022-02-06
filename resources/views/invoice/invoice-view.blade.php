<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>{{$bill->invoice_num}}</title>
    <style>
        @page {
            size: auto;
            margin-top: 0mm;
            margin-bottom: 0mm;
        }
    </style>
</head>

<body>
    <?php $tot = 0 ?>
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <!-- <tr>
            <td colspan="2"><img src="logo.png" width="150" /></td>
        </tr>
        <tr>
            <td colspan="2">&nbsp;</td>
        </tr> -->
        <tr>
            <td width="49%">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td>
                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td style="font-family:Verdana, Geneva, sans-serif; font-weight:600; font-size:15px;">Receipt</td>
                                </tr>
                                <tr>
                                    <td style="font-family:Verdana, Geneva, sans-serif; font-weight:300; font-size:13px;">Invoice Number: {{$bill->invoice_num}}</td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                </tr>
                                <!-- <tr>
                                    <td style="font-family:Verdana, Geneva, sans-serif; font-weight:600; font-size:15px;">Service Provider </td>
                                </tr>
                                <tr>
                                    <td style="font-family:Verdana, Geneva, sans-serif; font-weight:300; font-size:13px;">National Payment corporation of India (BBPS Dept.) </td>
                                </tr>
                                <tr>
                                    <td style="font-family:Verdana, Geneva, sans-serif; font-weight:300; font-size:13px;">National Payment corporation of India (BBPS Dept.)</td>
                                </tr>
                                <tr>
                                    <td style="font-family:Verdana, Geneva, sans-serif; font-weight:300; font-size:13px;">1001A, The Capital B Wing, 10th Floor, Bandra Kurla Complex, Bandra (E), Mumbai </td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                </tr>
                                <tr>
                                    <td style="font-family:Verdana, Geneva, sans-serif; font-weight:300; font-size:13px;">BBPS Biller Id: UGVCL0000GUJ01</td>
                                </tr>
                                <tr>
                                    <td style="font-family:Verdana, Geneva, sans-serif; font-weight:300; font-size:13px;">BBPS Transaction Id: PT01GYWT4625</td>
                                </tr>
                                <tr>
                                    <td style="font-family:Verdana, Geneva, sans-serif; font-weight:300; font-size:13px;">Payment Channel: androidapp 8.14.55</td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                </tr> -->
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
            <td width="51%" valign="top">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td align="right"><img src="logo.png" alt="" width="150" /></td>
                    </tr>
                    <tr>
                        <td style="font-family:Verdana, Geneva, sans-serif; font-weight:300; font-size:13px;" align="right"></td>
                    </tr>
                    <tr>
                        <td style="font-family:Verdana, Geneva, sans-serif; font-weight:300; font-size:13px;" align="right">&nbsp;</td>
                    </tr>
                    <tr>
                        <td style="font-family:Verdana, Geneva, sans-serif; font-weight:300; font-size:13px;" align="right">Receipt Date : {{ $bill->bill_date }}</td>
                    </tr>
                    <tr>
                        <td style="font-family:Verdana, Geneva, sans-serif; font-weight:600; font-size:15px;" align="right">Payer</td>
                    </tr>
                    <tr>
                        <td style="font-family:Verdana, Geneva, sans-serif; font-weight:300; font-size:13px;" align="right">{{ $guest->gs_name }}</td>
                    </tr>
                    <tr>
                        <td style="font-family:Verdana, Geneva, sans-serif; font-weight:300; font-size:13px;" align="right">{{ $guest->gs_mobile }}</td>
                    </tr>
                    <tr>
                        <td style="font-family:Verdana, Geneva, sans-serif; font-weight:300; font-size:13px;" align="right">{{ $guest->gs_passport_or_id }}</td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td colspan="2">&nbsp;</td>
        </tr>
        <tr>
            <td colspan="2">Room Bills</td>
        </tr>
        <tr>
            <td colspan="2">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td style="font-family:Verdana, Geneva, sans-serif; font-weight:600; font-size:13px; border-top:1px solid #333; border-bottom:1px solid #333; border-left:1px solid #333; border-right:1px solid #333;" width="25%" height="32" align="center">Room Number</td>
                        <td style="font-family:Verdana, Geneva, sans-serif; font-weight:600; font-size:13px; border-top:1px solid #333; border-bottom:1px solid #333; border-right:1px solid #333; border-right:1px solid #333;" width="25%" align="center">Date</td>
                        <td style="font-family:Verdana, Geneva, sans-serif; font-weight:600; font-size:13px; border-top:1px solid #333; border-bottom:1px solid #333; border-right:1px solid #333;" width="25%" align="center">Bill Amount</td>
                        <td style="font-family:Verdana, Geneva, sans-serif; font-weight:600; font-size:13px; border-top:1px solid #333; border-bottom:1px solid #333; border-right:1px solid #333;" width="25%" align="center">Status</td>
                    </tr>
                    @foreach($room_bills as $room_bill)
                    <tr>
                        <td style="font-family:Verdana, Geneva, sans-serif; font-weight:300; font-size:13px; border-bottom:1px solid #333; border-left:1px solid #333; border-right:1px solid #333;" height="32" align="center">{{ $room_bill->rm_number }}</td>
                        <td style="font-family:Verdana, Geneva, sans-serif; font-weight:300; font-size:13px; border-bottom:1px solid #333; border-right:1px solid #333; border-right:1px solid #333;" align="center">{{ $room_bill->rb_issue_date }}</td>
                        <td style="font-family:Verdana, Geneva, sans-serif; font-weight:300; font-size:13px; border-bottom:1px solid #333; border-right:1px solid #333;" align="center">{{ $room_bill->rb_cost }}</td>

                        @if( $room_bill->rb_status == env('PAID'))
                        <td style="font-family:Verdana, Geneva, sans-serif; font-weight:300; font-size:13px; border-bottom:1px solid #333; border-right:1px solid #333;" align="center">Paid</td>
                        @endif
                        @if( $room_bill->rb_status == env('UNPAID'))
                        <td style="font-family:Verdana, Geneva, sans-serif; font-weight:300; font-size:13px; border-bottom:1px solid #333; border-right:1px solid #333;" align="center">Un Paid</td>
                        @endif
                        @if( $room_bill->rb_status == env('CANCELED'))
                        <td style="font-family:Verdana, Geneva, sans-serif; font-weight:300; font-size:13px; border-bottom:1px solid #333; border-right:1px solid #333;" align="center">Canceled</td>
                        @endif
                    </tr>
                    <?php $tot = $tot + $room_bill->rb_cost ?>
                    @endforeach
                </table>
            </td>
        </tr>
        <tr>
            <td colspan="2">&nbsp;</td>
        </tr>
        <tr>
            <td colspan="2">Restaurant Bills </td>
        </tr>

        <tr>
            <td colspan="2">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td style="font-family:Verdana, Geneva, sans-serif; font-weight:600; font-size:13px; border-top:1px solid #333; border-bottom:1px solid #333; border-right:1px solid #333;" width="16%" align="center">Room Number</td>
                        <td style="font-family:Verdana, Geneva, sans-serif; font-weight:600; font-size:13px; border-top:1px solid #333; border-bottom:1px solid #333; border-left:1px solid #333; border-right:1px solid #333;" width="16%" height="32" align="center">Item Name</td>
                        <td style="font-family:Verdana, Geneva, sans-serif; font-weight:600; font-size:13px; border-top:1px solid #333; border-bottom:1px solid #333; border-right:1px solid #333;" width="16%" align="center">Item Code</td>
                        <td style="font-family:Verdana, Geneva, sans-serif; font-weight:600; font-size:13px; border-top:1px solid #333; border-bottom:1px solid #333; border-right:1px solid #333; border-right:1px solid #333;" width="16%" align="center">Quantity</td>
                        <td style="font-family:Verdana, Geneva, sans-serif; font-weight:600; font-size:13px; border-top:1px solid #333; border-bottom:1px solid #333; border-right:1px solid #333; border-right:1px solid #333;" width="16%" align="center">Total</td>
                        <td style="font-family:Verdana, Geneva, sans-serif; font-weight:600; font-size:13px; border-top:1px solid #333; border-bottom:1px solid #333; border-right:1px solid #333; border-right:1px solid #333;" width="16%" align="center">Status</td>
                    </tr>
                    @foreach($restaurant_bills as $restaurant_bill)
                    <tr>
                        <td style="font-family:Verdana, Geneva, sans-serif; font-weight:300; font-size:13px; border-bottom:1px solid #333; border-left:1px solid #333; border-right:1px solid #333;" height="32" align="center">{{ $restaurant_bill->rm_number }}</td>
                        <td style="font-family:Verdana, Geneva, sans-serif; font-weight:300; font-size:13px; border-bottom:1px solid #333; border-right:1px solid #333;" align="center">{{ $restaurant_bill->itm_item_name }}</td>
                        <td style="font-family:Verdana, Geneva, sans-serif; font-weight:300; font-size:13px; border-bottom:1px solid #333; border-right:1px solid #333;" align="center">{{ $restaurant_bill->itm_item_code }}</td>
                        <td style="font-family:Verdana, Geneva, sans-serif; font-weight:300; font-size:13px; border-bottom:1px solid #333; border-right:1px solid #333; border-right:1px solid #333;" align="center">{{ $restaurant_bill->or_quantity }}</td>
                        <td style="font-family:Verdana, Geneva, sans-serif; font-weight:300; font-size:13px; border-bottom:1px solid #333; border-right:1px solid #333; border-right:1px solid #333;" align="center">{{ $restaurant_bill->or_tot }}</td>
                        @if( $restaurant_bill->or_status == env('PAID'))
                        <td style="font-family:Verdana, Geneva, sans-serif; font-weight:300; font-size:13px; border-bottom:1px solid #333; border-right:1px solid #333;" align="center">Paid</td>
                        @endif
                        @if( $restaurant_bill->or_status == env('UNPAID'))
                        <td style="font-family:Verdana, Geneva, sans-serif; font-weight:300; font-size:13px; border-bottom:1px solid #333; border-right:1px solid #333;" align="center">Un Paid</td>
                        @endif
                        @if( $restaurant_bill->or_status == env('CANCELED'))
                        <td style="font-family:Verdana, Geneva, sans-serif; font-weight:300; font-size:13px; border-bottom:1px solid #333; border-right:1px solid #333;" align="center">Canceled</td>
                        @endif
                    </tr>
                    <?php $tot = $tot + $restaurant_bill->or_tot ?>
                    @endforeach
                </table>
            </td>
        </tr>
        <tr>
            <td colspan="2">&nbsp;</td>
        </tr>
        <tr>
            <td colspan="2">Taxi Bills</td>
        </tr>
        <tr>
            <td colspan="2">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td style="font-family:Verdana, Geneva, sans-serif; font-weight:600; font-size:13px; border-top:1px solid #333; border-bottom:1px solid #333; border-left:1px solid #333; border-right:1px solid #333;" width="12.5%" height="32" align="center">Room Number</td>
                        <td style="font-family:Verdana, Geneva, sans-serif; font-weight:600; font-size:13px; border-top:1px solid #333; border-bottom:1px solid #333; border-right:1px solid #333;" width="12.5%" align="center">Destination</td>
                        <td style="font-family:Verdana, Geneva, sans-serif; font-weight:600; font-size:13px; border-top:1px solid #333; border-bottom:1px solid #333; border-right:1px solid #333;" width="12.5%" align="center">Vehicle Numbber</td>
                        <td style="font-family:Verdana, Geneva, sans-serif; font-weight:600; font-size:13px; border-top:1px solid #333; border-bottom:1px solid #333; border-right:1px solid #333;" width="12.5%" align="center">Number Of Days</td>
                        <td style="font-family:Verdana, Geneva, sans-serif; font-weight:600; font-size:13px; border-top:1px solid #333; border-bottom:1px solid #333; border-right:1px solid #333;" width="12.5%" align="center">Amount</td>
                        <td style="font-family:Verdana, Geneva, sans-serif; font-weight:600; font-size:13px; border-top:1px solid #333; border-bottom:1px solid #333; border-right:1px solid #333;" width="12.5%" align="center">Date</td>
                        <td style="font-family:Verdana, Geneva, sans-serif; font-weight:600; font-size:13px; border-top:1px solid #333; border-bottom:1px solid #333; border-right:1px solid #333; border-right:1px solid #333;" width="12.5%" align="center">Total Amount</td>
                        <td style="font-family:Verdana, Geneva, sans-serif; font-weight:600; font-size:13px; border-top:1px solid #333; border-bottom:1px solid #333; border-right:1px solid #333;" width="12.5%" align="center">Status</td>
                    </tr>
                    @foreach($taxi_bills as $taxi_bill)
                    <tr>
                        <td style="font-family:Verdana, Geneva, sans-serif; font-weight:300; font-size:13px; border-bottom:1px solid #333; border-left:1px solid #333; border-right:1px solid #333;" height="32" align="center">{{ $taxi_bill->rm_number }}</td>
                        <td style="font-family:Verdana, Geneva, sans-serif; font-weight:300; font-size:13px; border-bottom:1px solid #333; border-right:1px solid #333;" align="center">{{ $taxi_bill->tx_destination }}</td>
                        <td style="font-family:Verdana, Geneva, sans-serif; font-weight:300; font-size:13px; border-bottom:1px solid #333; border-right:1px solid #333;" align="center">{{ $taxi_bill->tx_vehicle_num }}</td>
                        <td style="font-family:Verdana, Geneva, sans-serif; font-weight:300; font-size:13px; border-bottom:1px solid #333; border-right:1px solid #333;" align="center">{{ $taxi_bill->tx_num_of_days }}</td>
                        <td style="font-family:Verdana, Geneva, sans-serif; font-weight:300; font-size:13px; border-bottom:1px solid #333; border-right:1px solid #333;" align="center">{{ $taxi_bill->tx_amount }}</td>
                        <td style="font-family:Verdana, Geneva, sans-serif; font-weight:300; font-size:13px; border-bottom:1px solid #333; border-right:1px solid #333;" align="center">{{ $taxi_bill->tx_issue_date }}</td>
                        <td style="font-family:Verdana, Geneva, sans-serif; font-weight:300; font-size:13px; border-bottom:1px solid #333; border-right:1px solid #333; border-right:1px solid #333;" align="center">{{ $taxi_bill->tx_num_of_days * $taxi_bill->tx_amount + ( ($taxi_bill->tx_num_of_days * $taxi_bill->tx_amount )* $taxi_bill->tx_tax /100) }}</td>
                        @if( $taxi_bill->tx_status == env('PAID'))
                        <td style="font-family:Verdana, Geneva, sans-serif; font-weight:300; font-size:13px; border-bottom:1px solid #333; border-right:1px solid #333;" align="center">Paid</td>
                        @endif
                        @if( $taxi_bill->tx_status == env('UNPAID'))
                        <td style="font-family:Verdana, Geneva, sans-serif; font-weight:300; font-size:13px; border-bottom:1px solid #333; border-right:1px solid #333;" align="center">Un Paid</td>
                        @endif
                        @if( $taxi_bill->tx_status == env('CANCELED'))
                        <td style="font-family:Verdana, Geneva, sans-serif; font-weight:300; font-size:13px; border-bottom:1px solid #333; border-right:1px solid #333;" align="center">Canceled</td>
                        @endif
                    </tr>
                    <?php $tot = $tot + $taxi_bill->tx_num_of_days * $taxi_bill->tx_amount + ( ($taxi_bill->tx_num_of_days * $taxi_bill->tx_amount )* $taxi_bill->tx_tax /100) ?>
                    @endforeach
                </table>
            </td>
        </tr>
        <tr>
            <td colspan="2">&nbsp;</td>
        </tr>
        <tr>
            <td colspan="2">Laundry Bills</td>
        </tr>
        <tr>
            <td colspan="2">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td style="font-family:Verdana, Geneva, sans-serif; font-weight:600; font-size:13px; border-top:1px solid #333; border-bottom:1px solid #333; border-left:1px solid #333; border-right:1px solid #333;" width="16.6%" height="32" align="center">Room Number</td>
                        <td style="font-family:Verdana, Geneva, sans-serif; font-weight:600; font-size:13px; border-top:1px solid #333; border-bottom:1px solid #333; border-right:1px solid #333;" width="16.6%" align="center">Date</td>
                        <td style="font-family:Verdana, Geneva, sans-serif; font-weight:600; font-size:13px; border-top:1px solid #333; border-bottom:1px solid #333; border-right:1px solid #333;" width="16.6%" align="center">Item</td>
                        <td style="font-family:Verdana, Geneva, sans-serif; font-weight:600; font-size:13px; border-top:1px solid #333; border-bottom:1px solid #333; border-right:1px solid #333; border-right:1px solid #333;" width="16.6%" align="center">Quantity</td>
                        <td style="font-family:Verdana, Geneva, sans-serif; font-weight:600; font-size:13px; border-top:1px solid #333; border-bottom:1px solid #333; border-right:1px solid #333; border-right:1px solid #333;" width="16.6%" align="center">Total</td>
                        <td style="font-family:Verdana, Geneva, sans-serif; font-weight:600; font-size:13px; border-top:1px solid #333; border-bottom:1px solid #333; border-right:1px solid #333; border-right:1px solid #333;" width="16.6%" align="center">Status</td>
                    </tr>
                    @foreach($laundry_bills as $laundry_bill)
                    <tr>
                        <td style="font-family:Verdana, Geneva, sans-serif; font-weight:300; font-size:13px; border-bottom:1px solid #333; border-left:1px solid #333; border-right:1px solid #333;" height="32" align="center">{{ $laundry_bill->rm_number }}</td>
                        <td style="font-family:Verdana, Geneva, sans-serif; font-weight:300; font-size:13px; border-bottom:1px solid #333; border-right:1px solid #333;" align="center">{{ $laundry_bill->lon_issue_date }}</td>
                        <td style="font-family:Verdana, Geneva, sans-serif; font-weight:300; font-size:13px; border-bottom:1px solid #333; border-right:1px solid #333;" align="center">{{ $laundry_bill->lon_item }}</td>
                        <td style="font-family:Verdana, Geneva, sans-serif; font-weight:300; font-size:13px; border-bottom:1px solid #333; border-right:1px solid #333; border-right:1px solid #333;" align="center">{{ $laundry_bill->lon_quantity }}</td>
                        <td style="font-family:Verdana, Geneva, sans-serif; font-weight:300; font-size:13px; border-bottom:1px solid #333; border-right:1px solid #333; border-right:1px solid #333;" align="center">{{ $laundry_bill->lon_amount }}</td>
                        @if( $laundry_bill->lon_status == env('PAID'))
                        <td style="font-family:Verdana, Geneva, sans-serif; font-weight:300; font-size:13px; border-bottom:1px solid #333; border-right:1px solid #333;" align="center">Paid</td>
                        @endif
                        @if( $laundry_bill->lon_status == env('UNPAID'))
                        <td style="font-family:Verdana, Geneva, sans-serif; font-weight:300; font-size:13px; border-bottom:1px solid #333; border-right:1px solid #333;" align="center">Un Paid</td>
                        @endif
                        @if( $laundry_bill->lon_status == env('CANCELED'))
                        <td style="font-family:Verdana, Geneva, sans-serif; font-weight:300; font-size:13px; border-bottom:1px solid #333; border-right:1px solid #333;" align="center">Canceled</td>
                        @endif
                    </tr>
                    <?php $tot = $tot + $laundry_bill->lon_amount; ?>

                    @endforeach
                </table>
            </td>
        </tr>
        <!-- <tr>
            <td style="font-family:Verdana, Geneva, sans-serif; font-weight:300; font-size:13px;" colspan="2">Total Amount in Words: Three Thousand Seven Hundred Seventy Rupees Only</td>
        </tr>
        <tr>
            <td colspan="2">&nbsp;</td>
        </tr>
        <tr>
            <td style="font-family:Verdana, Geneva, sans-serif; font-weight:600; font-size:13px;" colspan="2">Please Note:</td>
        </tr>
        <tr>
            <td style="font-family:Verdana, Geneva, sans-serif; font-weight:300; font-size:13px;" colspan="2">Dear Consumer, the bill payment will reflect in next 48 hours or in the next billing cycle, at your service provider&rsquo;s end. Please contact paytm customer support for any queries regarding this order.</td>
        </tr>
        <tr>
            <td colspan="2">&nbsp;</td>
        </tr>
        <tr>
            <td style="font-family:Verdana, Geneva, sans-serif; font-weight:600; font-size:13px;" colspan="2">DECLARATION:</td>
        </tr>
        <tr>
            <td style="font-family:Verdana, Geneva, sans-serif; font-weight:300; font-size:13px;" colspan="2">This is not an invoice but only a confirmation of the receipt of the amount paid against for the service as described above. Subject to terms and conditions mentioned at paytm.com</td>
        </tr>
        <tr>
            <td colspan="2">&nbsp;</td>
        </tr> -->
        <tr>
            <td colspan="2">&nbsp;</td>
        </tr>
        <!-- <tr>
            <td style="font-family:Verdana, Geneva, sans-serif; font-weight:300; font-size:13px;" colspan="2" align="center">(This is computer generated receipt and does not require physical signature.) <br />B-121 Sector 5, Noida, Uttar Pradesh 201301,<br /> Service tax registration number: AAACO4007ASD002<br /> Paytm Order ID :12252016430</td>
        </tr> -->
        <tr>
            <td colspan="2">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td width="80%" style="text-align: end;">Total Amount</td>
                        <td width="20%" style="text-align: end;padding-right: 20px;">{{$tot}}</td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td colspan="2">&nbsp;</td>
        </tr>
        <tr>
            <td colspan="2">&nbsp;</td>
        </tr>
    </table>
</body>
<script>
    window.onload(window.print())
</script>

</html>
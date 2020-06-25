{{--@extends('Layouts.master')--}}
{{--@section('content')--}}
    <!DOCTYPE html>
<html lang="en">
<head>
    <title>PHarmacy Management</title>
    <meta charset="utf-8">
{{--    <link href='http://fonts.googleapis.com/css?family=Merienda+One' rel='stylesheet' type='text/css'>--}}
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
{{--    <link rel="stylesheet" type="text/css" href="{{asset('css/bootstrappdf.css')}}">--}}
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.css">

    <link rel="stylesheet" type="text/css" href="{{asset('css/main.css')}}">
    <style>
        { font-family: Myanmar Sans Pro !important;
        @import url(//fonts.googleapis.com/earlyaccess/myanmarsanspro.css);

        }
    </style>
</head>
<body>
<div class="mb-1 pb-">
    <div>
        <div>
            <h1><strong>PMS</strong></h1>
            <h3><strong>Pharmacy Management</strong></h3>
            <p>
                @php
                    $b_id= \Illuminate\Support\Facades\Auth::user()->branch_id;
                    $branch=\App\Model\Branch::find($b_id);
                @endphp
                {{$branch->name}},{{$branch->address}}.
                Ph-{{$branch->phone_number}}
            </p>
        </div>
        <div>
            <p>Date     : {{$sale->date_time}}</p>
            <p>Trans No : {{$sale->invoice_no}}</p>
            <p>Name     : {{$sale->staff->name}}</p>
{{--            <p>ကောင်းဆက်ခန့်</p>--}}
        </div>
    </div>
    <div>
                <table class="table bg-white box-shadow-mount rounded-table-mount mt-1"  id="myTable" >
                    <thead>
                    <tr>    
                        <th scope="col" class=" border-top-0 fontsize-mount6">Item</th>
                        <th scope="col" class=" border-top-0 fontsize-mount6">Qty</th>
                        <th scope="col" class=" border-top-0 fontsize-mount6">Price</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($sale->items as $it)
                        <tr>
                            <td scope="col" class=" border-top-0 fontsize-mount6"  > {{$it->name}}</td>
                            <td scope="col" class=" border-top-0 fontsize-mount6"  > {{$it->pivot->qty}}</td>
                            <td scope="col" class=" border-top-0 fontsize-mount6"  > {{$it->price}}</td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
        <p>Total  :  {{$sale->total_kyats}}</p>
    </div>


</div>
{{--@endsection--}}
</body>
</html>

{{--Undefined variable: voucher (View: /home/kaungsattkhant/Projects/NorthernBreeze/resources/views/Sale/print_voucher.blade.php)--}}


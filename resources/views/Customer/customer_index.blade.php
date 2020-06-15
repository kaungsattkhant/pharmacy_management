@extends('Layouts.master')
@section('content')
    <div class="content">
        <div class="sub-content pt-4 mt-3">
            <div class="float-left">
                <div class="mb-3 ">
                    <form action="{{url('customer/search')}}" method="get">
                        <input type="text"  autocomplete="off" name="search" class="  mount-input" placeholder="search..Name | NRC | Ph No">
                    </form>
                </div>

            </div>
            <div class="float-right">
                <button class="btn btn-default cs-btn" data-toggle="modal" data-target="#customer_create">Add</button>
            </div>
        </div>
        <div class="pt-4 mt-auto">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                    <tr>
                        <th></th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>NRC</th>
                        <th>Phone Number</th>
                        <th>Date</th>
                        <th>Pulse Rate</th>
                        <th>Blood Pressure</th>
                        <th>Address</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($customers as $ct)
                        <tr>
                            <td></td>
                            <td>{{$ct->name}}</td>
                            <td>{{$ct->email}}</td>
                            <td>{{$ct->nrc}}</td>
                            <td>{{$ct->phone_number}}</td>
                            <td>{{$ct->date_time}}</td>
                            <td>{{$ct->pulse_rate}}</td>
                            <td>{{$ct->blood_pressure}}</td>
                            <td>{{$ct->address}}</td>
                            <td>
                                <button class="btn btn-default btn-sm cs-btn" onclick="editCustomer({{$ct->id}})">Edit</button>
                                <button class="btn btn-default btn-sm cs-btn" style="background-color: darkred" onclick="destroyCustomer({{$ct->id}})">Delete</button>
                            </td>
                            {{--                        <td>Branch1</td>--}}
                            {{--                        <td>Mandalay</td>--}}
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@include('Customer.customer_create')
@include('Customer.customer_edit')
@include('Customer.customer_destroy')
@section('script')
    <script src="{{asset('js/Customer/customer.js')}}">
    </script>
@endsection

@extends('Layouts.master')
@section('content')
    <div class="content">
        <div class="sub-content pt-4 mt-3">
                <button class="btn btn-default cs-btn" data-toggle="modal" data-target="#staff_create">Add</button>
        </div>
        <div class="pt-4 mt-auto">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                    <tr>
                        <th></th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone Number</th>
                        <th>Photo</th>
                        <th>Branch</th>
                        <th>Address</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td></td>
                        <td>Mg Kaung</td>
                        <td>aa@gmail.com</td>
                        <td>0998898484</td>
                        <td>Null</td>
                        <td>Branch1</td>
                        <td>Mandalay</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>


    </div>
@endsection
@include('Staff.staff_create')

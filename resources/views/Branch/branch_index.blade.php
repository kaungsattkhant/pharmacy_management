@extends('Layouts.master')
@section('content')
    <div class="content">
        {{--        <h3>StaffAuth Management</h3>--}}
        <div class="sub-content pt-4 mt-3">
            <div class="float-right">
                <button class="btn btn-default cs-btn" data-toggle="modal" data-target="#branch_create" >Add</button>

            </div>
        </div>
        <div class="pt-4 mt-auto">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                    <tr>
                        <th></th>
                        <th>Name</th>
                        <th>Phone_Number</th>
                        <th>Address</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($branch as $br)
                        <tr>
                            <td></td>
                            <td>{{$br->name}}</td>
                            <td>{{$br->phone_number}}</td>
                            <td>{{$br->address}}</td>
                            <td>
                                <button class="btn btn-default btn-sm cs-btn" onclick="editBranch({{$br->id}})">Edit</button>
                                <button class="btn btn-default btn-sm cs-btn" style="background-color: darkred" onclick="destroyBranch({{$br->id}})">Delete</button>
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
@include('Branch.branch_create')
@include('Branch.branch_edit')
@include('Branch.branch_destroy')
@section('script')
    <script src="{{asset('js/Branch/branch.js')}}">
    </script>
@endsection

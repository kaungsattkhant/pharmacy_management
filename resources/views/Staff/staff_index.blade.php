@extends('Layouts.master')
@section('content')
    <div class="content">
{{--        <h3>StaffAuth Management</h3>--}}
        <div class="sub-content pt-4 mt-3">
            <div class="float-right">
                <button class="btn btn-default cs-btn" data-toggle="modal" data-target="#staff_create">Add</button>

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
{{--                        <th>Phone Number</th>--}}
{{--                        <th>Photo</th>--}}
                        <th>Branch</th>
                        <th>Address</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($staff as $st)
                    <tr>
                        <td></td>
                        <td>{{$st->name}}</td>
                        <td>{{$st->email}}</td>
                        <td>{{$st->role->name}}</td>
                        <td>{{$st->branch->name}}</td>
                        <td>
                            <button class="btn btn-default btn-sm cs-btn" onclick="editStaff({{$st->id}})">Edit</button>
                            <button class="btn btn-default btn-sm cs-btn" style="background-color: darkred" onclick="destroyStaff({{$st->id}})">Delete</button>
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
@include('Staff.staff_create')
@include('Staff.staff_edit')
@include('Staff.staff_destroy')
@section('script')
<script src="{{asset('js/Staff/staff.js')}}">
</script>
@endsection

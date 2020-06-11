@extends('Layouts.master')
@section('content')
    <div class="content">
{{--        <h3>StaffAuth Management</h3>--}}
        <div class="sub-content pt-4 mt-3">
            <div class="float-left">
                <div class="mb-3 ">

                    <select name="branch" class="form-control-sm show-menu-arrow ml-1 bd-bottom-mount bg-white" style="background:none;" id="staff_branch">
                        <option selected disabled>--Choose Branch--</option>
                        @php
                            $branches=\App\Model\Branch::all();
                        @endphp
                        @foreach($branches as $branch)
                            <option value="{{$branch->id}}">{{$branch->name}}</option>
                        @endforeach
                    </select>
                </div>

            </div>
            <div class="float-right">
                <button class="btn btn-default cs-btn" data-toggle="modal" data-target="#staff_create">Add</button>
            </div>
        </div>
        <div class="pt-4 mt-auto" id="staff_filter">
            @include('Staff.staff_index_filter')
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

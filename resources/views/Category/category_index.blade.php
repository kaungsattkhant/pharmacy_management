@extends('Layouts.master')
@section('content')
    <div class="content">
        {{--        <h3>Staff Management</h3>--}}
        <div class="sub-content pt-4 mt-3">
            <div class="float-right">
                <button class="btn btn-default cs-btn" data-toggle="modal" data-target="#category_create" >Add</button>

            </div>
        </div>
        <div class="pt-4 mt-auto">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                    <tr>
                        <th></th>
                        <th>Name</th>
{{--                        <th>Price</th>--}}
{{--                        <th>Category</th>--}}
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($category as $cate)
                        <tr>
                            <td></td>
                            <td>{{$cate->name}}</td>
{{--                            <td>{{$cate->price}}</td>--}}
{{--                            <td>{{$cate->category->name}}</td>--}}
                            <td>
                                <button class="btn btn-default btn-sm cs-btn" onclick="editCategory({{$cate->id}})">Edit</button>
                                <button class="btn btn-default btn-sm cs-btn" style="background-color: darkred" onclick="destroyCategory({{$cate->id}})">Delete</button>
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
@include('Category.category_create')
@include('Category.category_edit')
@include('Category.category_destroy')
@section('script')
    <script src="{{asset('js/Category/category.js')}}">
    </script>
@endsection

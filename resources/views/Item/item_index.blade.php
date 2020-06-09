@extends('Layouts.master')
@section('content')
    <div class="content">
        {{--        <h3>StaffAuth Management</h3>--}}
        <div class="sub-content pt-4 mt-3">
            <div class="float-left">
                <div class="mb-3 ">
{{--                    <label for="#name123" class="w-25">Name</label>--}}
                    <form action="{{url('item/search')}}">
                        <input type="text" autocomplete="off" name="search" class="mount-input" placeholder="search">
                    </form>
                </div>

            </div>
            <div class="float-right">
                <button class="btn btn-default cs-btn" data-toggle="modal" data-target="#item_create" >Add</button>

            </div>
        </div>
        <div class="pt-4 mt-auto">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                    <tr>
                        <th></th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Qty</th>
                        <th>Category</th>
                        <th>Branch</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($items as $item)
                        <tr>
                            <td></td>
                            <td>{{$item->name}}</td>
                            <td>{{$item->price}}</td>
                            <td>{{$item->qty}}</td>
                            <td>{{$item->category->name}}</td>
                            <td>{{$item->branch->name}}</td>
                            <td>
                                <button class="btn btn-default btn-sm cs-btn" onclick="editItem({{$item->id}})">Edit</button>
                                <button class="btn btn-default btn-sm cs-btn" style="background-color: darkred" onclick="destroyItem({{$item->id}})">Delete</button>
                                <button class="btn btn-default btn-sm cs-btn" onclick="addQty({{$item->id}})">+</button>
                            </td>
                            {{--                        <td>Branch1</td>--}}
                            {{--                        <td>Mandalay</td>--}}
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {{$items->links()}}
            </div>
        </div>
    </div>
@endsection
@include('Item.item_create')
@include('Item.item_edit')
@include('Item.item_destroy')
@include('Item.item_add_qty')
@section('script')
    <script src="{{asset('js/Item/item.js')}}">
    </script>
@endsection

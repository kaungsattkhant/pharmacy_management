@extends('Layouts.master')
@section('content')
    <div class="content">
        <div class="sub-content pt-4 mt-3">
            <div class="float-left">

                <div class="mb-3 ">
                    @if(\Illuminate\Support\Facades\Auth::user()->isAdmin())
                    <select name="branch" class="form-control-sm show-menu-arrow ml-1 bd-bottom-mount bg-white" style="background:none;" id="item_branch">
                        <option selected disabled>--Choose Branch--</option>
                        @php
                            $branches=\App\Model\Branch::all();
                        @endphp
                        @foreach($branches as $branch)
                            <option value="{{$branch->id}}" @if($branch->id==1) selected @endif>{{$branch->name}}</option>
                        @endforeach
                    </select>
                        @endif
                    <select name="sort_by" class="form-control-sm show-menu-arrow ml-1 bd-bottom-mount bg-white" style="background:none;" id="sort_by">
                        <option disabled>--Sort By--</option>
                        <option value="sort_by_alphabet" selected>Alphabet</option>
                        <option value="sort_by_qty">Qty</option>
                        <option value="sort_by_price">Price</option>
                        <option value="sort_by_category">Category</option>
                        <option value="sort_by_expire_date">Expire Date</option>
                    </select>
                            <button class="btn btn-default cs-btn btn-sm" id="item_index_filter">Filter</button>
                </div>

            </div>
            <div class="float-right">
                <button class="btn btn-default cs-btn" data-toggle="modal" data-target="#item_create" ><i class="fas fa-plus"></i></button>

            </div>
        </div>
        <div class="pt-4 mt-auto" id="item_filter">
            @include('Item.item_index_filter')
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

    @extends('Layouts.master')
@section('content')
    <div class="content">
        {{--        <h3>StaffAuth Management</h3>--}}
        <div class="sub-content pt-4 mt-3">
            <div class="float-left">
                <div class="mb-3 ">
                    {{--                    <label for="#name123" class="w-25">Name</label>--}}
                    <form action="{{url('sale/invoice_search')}}">
                        <input type="text" autocomplete="off" name="search" class="mount-input" placeholder="invoice_search">
                    </form>
                </div>
            </div>
{{--            <div class="float-right">--}}
{{--                <button class="btn btn-default cs-btn" data-toggle="modal" data-target="#item_create" >Add</button>--}}
{{--            </div>--}}
        </div>
        <div class="pt-4 mt-auto">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Invoice NO</th>
                        <th>Total</th>
{{--                        <th>Items</th>--}}
                        <th>Front Man</th>
                        <th>Branch</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($sales as $s)
                        <tr>
                            <td></td>
                            <td>{{$s->invoice_no}}</td>
                            <td>{{$s->total_kyats}}</td>
                            <td>{{$s->staff->name}}</td>
{{--                            <td>{{$item->qty}}</td>--}}
{{--                            <td>{{$item->category->name}}</td>--}}
                            <td>{{$s->staff->branch->name}}</td>
                            <td>
                                <button class="btn btn-default btn-sm cs-btn" onclick="detail({{$s->id}})">Detail</button>
{{--                                <button class="btn btn-default btn-sm cs-btn" style="background-color: darkred" onclick="destroyItem({{$s->id}})">Delete</button>--}}
{{--                                <button class="btn btn-default btn-sm cs-btn" onclick="addQty({{$s->id}})">+</button>--}}
                            </td>
                            {{--                        <td>Branch1</td>--}}
                            {{--                        <td>Mandalay</td>--}}
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {{$sales->links()}}
            </div>
        </div>
    </div>
    @include('Sale.detail_modal')
@endsection
@section('script')
    <script src="{{asset('js/Sale/sale.js')}}">
    </script>
@endsection


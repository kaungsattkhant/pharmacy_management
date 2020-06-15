    @extends('Layouts.master')
@section('content')
    <div class="content">
        {{--        <h3>StaffAuth Management</h3>--}}
        <div class="sub-content pt-4 mt-3">
            <div class="float-left">
                <div class="mb-3 ">
                    <form action="{{url('sale/sale_record_export')}}" method="post">
                        @csrf
                            @if(\Illuminate\Support\Facades\Auth::user()->isAdmin())
                                <select name="branch" class="form-control-sm show-menu-arrow ml-1 bd-bottom-mount bg-white" style="background:none;" id="sale_branch">
                                    <option selected disabled>--Choose Branch--</option>
                                    @php
                                        $branches=\App\Model\Branch::all();
                                    @endphp
                                    @foreach($branches as $branch)
                                        <option value="{{$branch->id}}">{{$branch->name}}</option>
                                    @endforeach
                                </select>
                            @endif
                            <label class="label">
                                <span  class="field">From:</span>
                                <input type="text" id="datepicker" autocomplete="off" style=""  name="from_date" class=" from_date border-top-0 border-right-0 border-left-0  dtpick-input2 col-md-8" placeholder="YY-MM-DD">
                            </label>
                            <label class="label">
                                <span class="field">To:</span>
                                <input type="text" id="to_datepicker" autocomplete="off" style=""  name="to_date" class=" to_date border-top-0 border-right-0 border-left-0  dtpick-input2 col-md-8" placeholder="YY-MM-DD">
                            </label>
                                <a  class="btn btn-default fontsize-mount cs-btn btn-sm"  style="color: white;" id="sale_record_filter">Filter</a>
                            <button  class="btn btn-p fontsize-mount cs-btn btn-sm" style="background: darkcyan"  id="sale_record_export">export</button>
{{--                        </div>--}}
                    </form>

                </div>
            </div>
{{--            <div class="float-right">--}}
{{--                <button class="btn btn-default cs-btn" data-toggle="modal" data-target="#item_create" >Add</button>--}}
{{--            </div>--}}
        </div>
        <div class="pt-4 mt-auto" id="sale_filter">
            @include('Sale.sale_record_filter')
{{--            <div class="table-responsive">--}}
{{--                <table class="table">--}}
{{--                    <thead>--}}
{{--                    <tr>--}}
{{--                        <th>#</th>--}}
{{--                        <th>Invoice NO</th>--}}
{{--                        <th>Total</th>--}}
{{--                        <th>Items</th>--}}
{{--                        <th>Front Man</th>--}}
{{--                        <th>Branch</th>--}}
{{--                        <th>Action</th>--}}
{{--                    </tr>--}}
{{--                    </thead>--}}
{{--                    <tbody>--}}
{{--                    @foreach($sales as $s)--}}
{{--                        <tr>--}}
{{--                            <td></td>--}}
{{--                            <td>{{$s->invoice_no}}</td>--}}
{{--                            <td>{{$s->total_kyats}}</td>--}}
{{--                            <td>{{$s->staff->name}}</td>--}}
{{--                            <td>{{$item->qty}}</td>--}}
{{--                            <td>{{$item->category->name}}</td>--}}
{{--                            <td>{{$s->staff->branch->name}}</td>--}}
{{--                            <td>--}}
{{--                                <button class="btn btn-default btn-sm cs-btn" onclick="detail({{$s->id}})">Detail</button>--}}
{{--                                <button class="btn btn-default btn-sm cs-btn" style="background-color: darkred" onclick="destroyItem({{$s->id}})">Delete</button>--}}
{{--                                <button class="btn btn-default btn-sm cs-btn" onclick="addQty({{$s->id}})">+</button>--}}
{{--                            </td>--}}
{{--                            --}}{{--                        <td>Branch1</td>--}}
{{--                            --}}{{--                        <td>Mandalay</td>--}}
{{--                        </tr>--}}
{{--                    @endforeach--}}
{{--                    </tbody>--}}
{{--                </table>--}}
{{--                {{$sales->links()}}--}}
{{--            </div>--}}
        </div>
    </div>
    @include('Sale.detail_modal')
@endsection
@section('script')
    <script src="{{asset('js/Sale/sale.js')}}">
    </script>
@endsection


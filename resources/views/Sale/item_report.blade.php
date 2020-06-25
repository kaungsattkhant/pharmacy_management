@extends('Layouts.master')
@section('content')
    <div class="content">
        {{--        <h3>StaffAuth Management</h3>--}}
        <div class="sub-content pt-4 mt-3">
            <div class="float-left">
                <div class="mb-3 ">
                    <form action="{{url('sale/item_export')}}" method="post">
                        @csrf
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
                    <label class="label">
                        <span  class="field">From:</span>
                        <input type="text" id="datepicker" autocomplete="off" style=""  name="from_date" class=" from_date border-top-0 border-right-0 border-left-0  dtpick-input2 col-md-8" placeholder="YY-MM-DD">
                    </label>
                    <label class="label">
                        <span class="field">To:</span>
                        <input type="text" id="to_datepicker" autocomplete="off" style=""  name="to_date" class=" to_date border-top-0 border-right-0 border-left-0  dtpick-input2 col-md-8" placeholder="YY-MM-DD">
                    </label>
                        <a  class="btn btn-default fontsize-mount cs-btn btn-sm"  id="item_report_filter" style="color:white;">Filter</a>
                        <button  class="btn btn-p fontsize-mount cs-btn btn-sm" style="background: darkcyan">export</button>
                    </form>

                </div>
            </div>
        </div>
        <div class="pt-4 mt-auto" id="item_report">
            @include('Sale.item_report_filter')

        </div>
    </div>
@endsection
@section('script')
    <script src="{{asset('js/Item/item_report.js')}}">
    </script>
@endsection


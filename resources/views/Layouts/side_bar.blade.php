<div class="side_bar" >
    <ul class="side-bar-body">
        <li style="background-color:darkslategray;padding-bottom: 30px;">Pharmacy Management </li>
        @if(\Illuminate\Support\Facades\Auth::user()->isFrontMan())
            <a href="{{url('sale')}}"><li><i class="fas fa-money-check"></i>POS</li></a>
        @endif
{{--        <a href="{{url('sale')}}"><li>sale</li></a>--}}
        @if(\Illuminate\Support\Facades\Auth::user()->isAdmin() || \Illuminate\Support\Facades\Auth::user()->isManager())
            <a href="{{url('item')}}"><li><i class="fas fa-laptop-medical"></i>Item</li></a>
            <a href="{{url('staff')}}"><li><i class="fas fa-house-user"></i>Staff</li></a>
        @endif
    @if(\Illuminate\Support\Facades\Auth::user()->isAdmin())
            <a href="{{url('branch')}}"><li><i class="fas fa-border-all"></i>Branch</li></a>
            <a href="{{url('category')}}"><li><i class="fas fa-caret-right"></i>Category</li></a>
{{--        <a href="{{url('staff')}}"><li>Staff</li></a>--}}
        @endif
        <a href="{{url('customer')}}"><li><i class="fas fa-users"></i>Customer</li></a>
        <a href="{{url('/sale/sale_record')}}"><li><i class="fas fa-history"></i>History</li></a>
        @if(\Illuminate\Support\Facades\Auth::user()->isAdmin())
            <li data-toggle="collapse" data-target="#report"><i class="fas fa-chart-bar"></i>Report </li>
            <div id="report" class="collapse in">
                <a href="{{url('/sale/sale_report')}}"><li style="background: whitesmoke;color:black">Sale Report</li></a>
                <a href="{{url('/sale/item_report')}}"><li style="background: whitesmoke;color:black"> Item Report</li></a>
            </div>
        @endif
        <a href="{{url('logout')}}"><li><i class="fas fa-power-off"></i>Logout</li></a>
    </ul>
</div>

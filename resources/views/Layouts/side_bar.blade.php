<div class="side_bar" >
    <ul class="side-bar-body">
        <li style="background-color:darkslategray;padding-bottom: 30px;">Pharmacy Management </li>
        @if(\Illuminate\Support\Facades\Auth::user()->isFrontMan())
        <a href="{{url('pos')}}"><li>POS</li></a>
        @endif
        <a href="{{url('sale')}}"><li>sale</li></a>
    @if(\Illuminate\Support\Facades\Auth::user()->isAdmin())
        <a href="{{url('item')}}"><li>Item</li></a>
        <a href="{{url('category')}}"><li>Category</li></a>
        <a href="{{url('branch')}}"><li>Branch</li></a>
        <a href="{{url('staff')}}"><li>Staff</li></a>
        @endif
        <a href="{{url('logout')}}"><li>Logout</li></a>

    </ul>
</div>

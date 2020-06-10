<div class="table-responsive" >
    <table class="table">
        <thead>
        <!--                        <tr ><p style="background-color: gray">Cart</p></tr>-->
        <tr>
            <th>Name</th>
            <th>Qty</th>
            <th>Price</th>
        </tr>
        </thead>
        <tbody>
        @foreach($items as $t)
            <tr>
                <td>
                    {{$t->name}}
                </td>
                <td>
                    {{$t->pivot->qty}}
{{--                                <span class="badge"> {{$t->qty}}--}}
{{--                                </span>--}}
                </td>
                <td>{{$t->price}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

<div class="table-responsive">
    <table class="table">
        <thead>
        <tr>
            <th>Name</th>
            {{--                        <th>Items</th>--}}
            <th>Total Qty</th>
            <th>Price</th>
            <th>Total Sale</th>

            <th>Branch</th>
        </tr>
        </thead>
        <tbody>
        @foreach($items as $it)
            <tr>
                <td>{{$it->name}}</td>
                <td>{{$it->total_qty}}</td>
                <td>{{$it->price}}</td>
                <td>{{$it->sale}}</td>

                <td>{{$it->branch->name}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{$items->links()}}
</div>

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

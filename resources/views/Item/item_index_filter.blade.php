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

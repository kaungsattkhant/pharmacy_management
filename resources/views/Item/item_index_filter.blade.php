<div class="table-responsive">
    <table class="table">
        <thead>
        <tr>
            <th></th>
            <th>Name</th>
            <th>Price</th>
            <th>Qty</th>
            <th>Expire Date</th>
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
                <td>{{$item->expire_date}}</td>
                <td>{{$item->category->name}}</td>
                <td>{{$item->branch->name}}</td>
                <td>
                    <button class="btn btn-default btn-sm cs-btn" style="background: none" onclick="editItem({{$item->id}})"><i class="fas fa-edit" style="color: darkblue"></i></button>
                    <button class="btn btn-default btn-sm cs-btn" style="background: none" onclick="destroyItem({{$item->id}})"><i class="fas fa-trash " style="color:red"></i></button>
                    <button class="btn btn-default btn-sm cs-btn" onclick="addQty({{$item->id}})" style="background: none" ><i class="fas fa-plus" style="color:black"></i></button>
                </td>
                {{--                        <td>Branch1</td>--}}
                {{--                        <td>Mandalay</td>--}}
            </tr>
        @endforeach
        </tbody>
    </table>
    {{$items->links()}}
</div>

<div class="table-responsive">
    <table class="table">
        <thead>
        <tr>
            <th></th>
            <th>Name</th>
            <th>Email</th>
            {{--                        <th>Phone Number</th>--}}
            {{--                        <th>Photo</th>--}}
            @if(\Illuminate\Support\Facades\Auth::user()->isManager())
                <th>Branch</th>
            @endif
            <th>Role</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($staff as $st)
            <tr>
                <td></td>
                <td>{{$st->name}}</td>
                <td>{{$st->email}}</td>
                <td>{{$st->role->name}}</td>
                @if(\Illuminate\Support\Facades\Auth::user()->isManager())
                    <td>{{$st->branch->name}}</td>
                @endif
                <td>
                    <button class="btn btn-default btn-sm cs-btn" onclick="editStaff({{$st->id}})">Edit</button>
                    <button class="btn btn-default btn-sm cs-btn" style="background-color: darkred" onclick="destroyStaff({{$st->id}})">Delete</button>
                </td>
                {{--                        <td>Branch1</td>--}}
                {{--                        <td>Mandalay</td>--}}
            </tr>
        @endforeach
        </tbody>
    </table>
    {{$staff->links()}}
</div>

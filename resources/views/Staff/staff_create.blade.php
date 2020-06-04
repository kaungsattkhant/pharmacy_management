<div class="modal fade" id="staff_create" tabindex="-1" role="dialog" aria-labelledby="add" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document" style="width: 490px;">
        <div class="modal-content border-0 btr-mount">
            <div class="modal-header modal-title-bg text-center pb-1 border-0 btr-mount">
                <h5 class="text-center mx-auto" id="exampleModalLongTitle">Add New Staff</h5>
            </div>
            <div class="modal-body mx-5 px-0">
{{--                <ul id="createMessage">--}}
{{--                    <li class="col-md-10 alert alert-success" style="height:40px;list-style:none;">--}}
{{--                        <p id="success"></p>--}}
{{--                    </li>--}}
{{--                </ul>--}}
                <form>
                    {{csrf_field()}}
                    <div class="mb-3 {{$errors->has('name') ? 'has:error':''}}">
                        <label for="#name123" class="w-25">Name</label>
                        <input type="text" id="name" class="border-top-0 border-right-0 border-left-0 rounded-0 mount-input">
                    </div>
                    <span class="text-danger">
                                    <strong id="name_error"></strong>
                                </span>
                    <br>
                    <div class="mb-3 {{$errors->has('email') ? 'has:error':''}}">
                        <label for="#pass123" class="w-25">Email</label>
                        <input type="text" id="email" class="border-top-0 border-right-0 border-left-0 rounded-0 mount-input">

                    </div>
                    <span class="text-danger">
                                    <strong id="email-error"></strong>
                                </span>
                    <div class="mb-3 {{$errors->has('password') ? 'has:error':''}}">
                        <label for="#pass123" class="w-25">Password</label>
                        <input type="password" id="password"  class="border-top-0 border-right-0 border-left-0 rounded-0 mount-input">

                    </div>
                    <span class="text-danger">
                                    <strong id="password-error"></strong>
                                </span>
                    <div class="mb-1 {{$errors->has('password_confirmation') ? 'has:error':''}}">
                        <label for="#pass123" class="w-25">Password<br><small>(confirmation)</small></label>
                        <input type="password" id="password_confirmation" class="border-top-0 border-right-0 border-left-0 rounded-0 mount-input">
                        <span class="text-danger">
                                    <strong id="password_confirmation-error"></strong>
                                </span>
                    </div>

                    <div class="mb-3 row fs-select4 {{$errors->has('role') ? 'has:error':''}}" >
                        <label for="#role" class="w-25" style="padding-left: 16px;">Roles</label>
                        <select name="role" class="form-control show-menu-arrow m-md-1 bd-bottom-mount role_branch_filter" data-width="300px" id="role">
                            <option selected disabled>--None--</option>
                            @foreach(\App\Model\Role::all() as $role)
                                <option value="{{$role->id}}">{{$role->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <span class="text-danger">
                                    <strong id="role-error"></strong>
                                </span>

                    <div class="branch_div mb-3 row fs-select4 {{$errors->has('branch') ? 'has:error':''}}" id="branch_div">
                        <label for="#role" class="w-25" style="padding-left: 16px;">Branch</label>
                        <select name="branch" class="selectpicker show-menu-arrow ml-1 bd-bottom-mount" data-width="300px" id="b">
                            <option selected disabled>--None--</option>
                            @php
                                $branches=\App\Model\Branch::all();
                            @endphp
                            @foreach($branches as $branch)
                                <option value="{{$branch->id}}">{{$branch->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <span class="text-danger">
                                    <strong id="branch-error"></strong>
                                </span>
                    <div class="m-button pt-3">
                        <button type="button" class="btn btn-default cs-btn" data-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-default cs-btn" id="staffSubmit">Save</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>


{{--<div id="staff_create" class="modal fade" role="dialog">--}}
{{--    <div class="modal-dialog">--}}

{{--        <!-- Modal content-->--}}
{{--        <div class="modal-content">--}}
{{--            <div class="modal-header">--}}
{{--                <button type="button" class="close" data-dismiss="modal">&times;</button>--}}
{{--                <h4 class="modal-title">Modal Header</h4>--}}
{{--            </div>--}}
{{--            <div class="modal-body">--}}
{{--                <p>Some text in the modal.</p>--}}
{{--            </div>--}}
{{--            <div class="modal-footer">--}}
{{--                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>--}}
{{--            </div>--}}
{{--        </div>--}}

{{--    </div>--}}
{{--</div>--}}


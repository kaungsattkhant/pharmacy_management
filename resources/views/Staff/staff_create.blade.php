<div class="modal fade" id="staff_create" tabindex="-1" role="dialog" aria-labelledby="add" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document" style="width: 490px;">
        <div class="modal-content border-0 btr-mount">
            <form>

            <div class="modal-header modal-title-bg text-center pb-1 border-0 btr-mount">
                <h5 class="text-center mx-auto" id="exampleModalLongTitle">Add New Staff</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>

            </div>
            <div class="modal-body mx-5 px-0">
                <ul id="createMessage">
                    <li class="col-md-10 alert alert-success" style="height:40px;list-style:none;">
                        <p id="success"></p>
                    </li>
                </ul>
                    {{csrf_field()}}
                    <div class="mb-3 {{$errors->has('name') ? 'has:error':''}}">
                        <label for="#name123" class="w-25">Name</label>
                        <input type="text" id="name" class="border-top-0 border-right-0 border-left-0 rounded-0 mount-input col-md-7" autocomplete="off">
                    </div>
                    <span class="text-danger">
                                    <strong id="name_error"></strong>
                                </span>
                    <div class="mb-3 {{$errors->has('email') ? 'has:error':''}}">
                        <label for="#pass123" class="w-25">Email</label>
                        <input type="text" id="email" class="border-top-0 border-right-0 border-left-0 rounded-0 mount-input col-md-7">
                    </div>
                    <span class="text-danger">
                                    <strong id="email-error"></strong>
                                </span>
                    <div class="mb-3 {{$errors->has('password') ? 'has:error':''}}">
                        <label for="#pass123" class="w-25">Password</label>
                        <input type="password" id="password"  class="border-top-0 border-right-0 border-left-0 rounded-0 mount-input col-md-7">

                    </div>
                    <span class="text-danger">
                                    <strong id="password-error"></strong>
                                </span>
                    <div class="mb-3 {{$errors->has('password_confirmation') ? 'has:error':''}}">
                        <label for="#pass123" class="w-25">Password<br><small>(confirmation)</small></label>
                        <input type="password" id="password_confirmation" class="border-top-0 border-right-0 border-left-0 rounded-0 mount-input col-md-7">

                    </div>
                    <span class="text-danger">
                                    <strong id="password_confirmation-error"></strong>
                                </span>

                    <div class="mb-3 row fs-select4 {{$errors->has('role') ? 'has:error':''}}" >
                        <label for="#role" class="w-25" style="padding-left: 16px;">Roles</label>
                        <select name="role" class="form-control-sm show-menu-arrow m-md-1 bd-bottom-mount role_branch_filter col-md-7" style="background:none;border-top:0;border-left:0;border-right:0;border-bottom: 0;" data-width="300px"  id="role">
                            <option selected disabled>--Choose Role--</option>
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
                        <select name="branch" class="form-control-sm show-menu-arrow ml-1 bd-bottom-mount border-top-0 col-md-7" style="background:none;border-top:0;border-left:0;border-right:0;border-bottom: 0;" id="b">
                            <option selected disabled>--Choose Branch--</option>
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
{{--                        <button type="button" class="btn btn-default cs-btn" data-dismiss="modal">Cancel</button>--}}
                        <button type="button" class="btn btn-default cs-btn" id="staffSubmit">Save</button>
                    </div>
            </div>

            </form>

            </div>
    </div>
</div>


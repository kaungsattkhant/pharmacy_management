<div class="modal fade" id="customer_create" tabindex="-1" role="dialog" aria-labelledby="add" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document" style="width: 490px;">
        <div class="modal-content border-0 btr-mount">
            <form>
                <div class="modal-header modal-title-bg text-center pb-1 border-0 btr-mount">
                    <h5 class="text-center mx-auto" id="exampleModalLongTitle">Add New Customer</h5>
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
                                    <strong id="email_error"></strong>
                                </span>
                        <div class="mb-3 {{$errors->has('email') ? 'has:error':''}}">
                            <label for="#pass123" class="w-25">NRC</label>
                            <input type="text" id="nrc" class="border-top-0 border-right-0 border-left-0 rounded-0 mount-input col-md-7">
                        </div>
                        <span class="text-danger">
                                    <strong id="nrc_error"></strong>
                                </span>
                        <div class="mb-3">
                        <label for="#pass123" class="w-25">Phone No</label>
                        <input type="text" id="phone_number"  class="border-top-0 border-right-0 border-left-0 rounded-0 mount-input col-md-7">

                    </div>
                    <span class="text-danger">
                                    <strong id="phone_number_error"></strong>
                                </span>
                    <div class="mb-3">
                        <label for="#pass123" class="w-25">Pulse Rate</label>
                        <input type="number" id="pulse_rate" class="border-top-0 border-right-0 border-left-0 rounded-0 mount-input col-md-7">
                    </div>

                    <span class="text-danger">
                                    <strong id="pulse_rate_error"></strong>
                                </span>
                    <div class="mb-3">
                        <label for="#pass123" class="w-25">Address</label>
                        <textarea id="address" class="border-top-0 border-right-0 border-left-0 rounded-0 mount-input col-md-7"></textarea>
                    </div>
                    <span class="text-danger">
                                    <strong id="address_error"></strong>
                    </span>
                    <div class="mb-3">
                        <label for="#pass123" class="w-25">Special Note</label>
                        <textarea id="special_note" class="border-top-0 border-right-0 border-left-0 rounded-0 mount-input col-md-7"></textarea>
                    </div>
                    <span class="text-danger">
                                    <strong id="special_note_error"></strong>
                    </span>
                    <div class="m-button pt-3">
                        {{--                        <button type="button" class="btn btn-default cs-btn" data-dismiss="modal">Cancel</button>--}}
                        <button type="button" class="btn btn-default cs-btn" id="customerSubmit">Save</button>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>


<div class="modal fade" id="item_edit" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document" style="width: 480px;">
        <div class="modal-content border-0 btr-mount">

            <div class="modal-header modal-title-bg text-center pb-1 border-0 btr-mount">
                <h5 class="text-center mx-auto" id="exampleModalLongTitle">Edit Item</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body mx-5 px-0">

                <ul id="editMessage">
                    <li class="col-md-10 alert alert-success" style="height:40px;list-style:none;">
                        <p id="success1"></p>
                    </li>
                </ul>
                <form>
                    @csrf
                    <input type="hidden" name="id" id="id">
                    <div class="mb-3 ">
                        <label for="#name123" class="w-25">Name</label>
                        <input type="text" id="name1" name="name" class="border-top-0 border-right-0 border-left-0 rounded-0 mount-input col-md-7">
                    </div>
                    <span class="text-danger" id="name_error1">
                                </span>
                    <div class="mb-3 ">
                        <label for="#role" class="w-25">Price</label>
                        <input type="number" id="price1"  name="price" class="border-top-0 border-right-0 border-left-0 rounded-0 mount-input col-md-7">
                    </div>
                    <span class="text-danger" id="price_error1">
                                </span>
                    <div class="mb-3 ">
                        <label for="#role" class="w-25">Qty</label>
                        <input type="number" id="qty1"  min="0" name="qty" class="border-top-0 border-right-0 border-left-0 rounded-0 mount-input col-md-7">
                    </div>
                    <span class="text-danger" id="qty_error1">
                                </span>

                    <div class=" mb-3 row fs-select4 {{$errors->has('category') ? 'has:error':''}}" >
                        <label for="#role" class="w-25" style="padding-left: 16px;">Category</label>
                        <select name="category" class="form-control-sm show-menu-arrow ml-1 bd-bottom-mount border-top-0 col-md-7" style="background:none;border-top:0;border-left:0;border-right:0;border-bottom: 0;"  id="category1">
                            <option selected disabled>--Select Category--</option>
                            @php
                                $category=\App\Model\Category::all();
                            @endphp
                            @foreach($category as $cate)
                                <option value="{{$cate->id}}">{{$cate->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <span class="text-danger" id="category_error1">
                                </span> <div class=" branch1 branch_div mb-3 row fs-select4 {{$errors->has('branch') ? 'has:error':''}}">
                        <label for="#role" class="w-25" style="padding-left: 16px;">Branch</label>
                        <select name="branch" class="form-control-sm show-menu-arrow  margin-left-mount bd-bottom-mount col-md-7" data-width="300px" id="branch1" style="background:none;border-top:0;border-left:0;border-right:0;border-bottom: 0;">
                            {{--                            <option selected disabled>--None--</option>--}}
                            @php
                                $branches=\App\Model\Branch::all();
                            @endphp
                            @foreach($branches as $branch)
                                <option value="{{$branch->id}}">{{$branch->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <span class="text-danger">
                                    <strong id="branch-error1"></strong>
                                </span>
                    <div class="m-button pt-3">
                        {{--                        <button type="button" class="btn btn-nb-mount2 px-3 pt-0 pb-0 mr-4 shadow-0 fontsize-mount22" data-dismiss="modal">Cancel</button>--}}
                        <button type="submit" class="btn btn-nb-mount2 fontsize-mount22 px-3 cs-btn" id="itemSubmit1" >Save</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

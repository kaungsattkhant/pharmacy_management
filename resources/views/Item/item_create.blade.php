<div class="modal fade" id="item_create" tabindex="-1" role="dialog" aria-labelledby="add" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document" style="width: 490px;">
        <div class="modal-content border-0 btr-mount">
            <div class="modal-header modal-title-bg text-center pb-1 border-0 btr-mount">
                <h5 class="text-center mx-auto" id="exampleModalLongTitle">Add Item</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body mx-5 px-0">

                <ul id="createMessage">
                    <li class="col-md-10 alert alert-success" style="height:40px;list-style:none;">
                        <p id="success"></p>
                    </li>
                </ul>
                <form>
                    @csrf
                    <div class="mb-3 ">
                        <label for="#name123" class="w-25">Name</label>
                        <input type="text" id="name" autocomplete="off" name="name" class="border-top-0 border-right-0 border-left-0 rounded-0 mount-input col-md-7">
                    </div>
                    <span class="text-danger" id="name_error">
                                </span>
                    <div class="mb-3 ">
                        <label for="#role" class="w-25">Price</label>
                        <input type="number" id="price"  min="0" name="price" class="border-top-0 border-right-0 border-left-0 rounded-0 mount-input col-md-7">
                    </div>
                    <span class="text-danger" id="price_error">
                                </span>
                    <div class="mb-3 ">
                        <label for="#role" class="w-25">Qty</label>
                        <input type="number" id="qty"  min="0" name="qty" class="border-top-0 border-right-0 border-left-0 rounded-0 mount-input col-md-7">
                    </div>
                    <span class="text-danger" id="qty_error">
                                </span>
                    <div class="branch_div mb-3 row fs-select4 {{$errors->has('category') ? 'has:error':''}}" >
                        <label for="#role" class="w-25" style="padding-left: 16px;">Category</label>
                        <select name="category" class="form-control-sm show-menu-arrow ml-1 bd-bottom-mount border-top-0 col-md-7" style="background:none;border-top:0;border-left:0;border-right:0;border-bottom: 0;" id="category">
                            <option selected disabled>--Select Category--</option>
                            @php
                                $category=\App\Model\Category::all();
                            @endphp
                            @foreach($category as $cate)
                                <option value="{{$cate->id}}">{{$cate->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <span class="text-danger" id="category_error">
                                </span>
                    <div class="m-button pt-3 ">
                        {{--                        <button type="button" class="btn btn-nb-mount2 px-3 pt-0 pb-0 mr-4 shadow-0 fontsize-mount22" data-dismiss="modal">Cancel</button>--}}
                        <button type="submit" class="btn btn-nb-mount2 fontsize-mount22 px-3  cs-btn" id="itemSubmit" >Save</button>
                    </div>
                </form>

            </div>

        </div>
    </div>
</div>


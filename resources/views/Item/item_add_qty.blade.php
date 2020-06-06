<div class="modal fade" id="item_add_qty" tabindex="-1" role="dialog" aria-labelledby="Delete" aria-hidden="true">
    <div class="modal-dialog modal-dialog" role="document" style="width: 350px;">
        <div class="modal-content">
            <div class="modal-header modal-title-bg text-center pb-1 border-0 btr-mount">
                <h5 class="mount-modal-title2 mb-3 text-dark" id="exampleModalLongTitle">Add Quantity</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>

            </div>
            <form action="{{url('item/add_qty')}}" method="post">
                @csrf
                <div class="modal-body mx-3">
                    <div class="mb-3 ">
                        <label for="#role" class="w-25">Qty</label>
                        <input type="number" id="add_qty"  min="0" name="qty" class="border-top-0 border-right-0 border-left-0 rounded-0 mount-input col-md-7">
                    </div>

{{--                    <p style="font-size: 15px;">Do you want to add Item quantity ?<br>--}}
{{--                        You cannot undo this.</p>--}}
                    <input type="hidden" name="id" id="item_id">

                    <div class="m-button">
                        {{--                        <button type="button" class="btn  text-primary " data-dismiss="modal">Cancel</button>--}}
                        <button type="submit" class="btn btn-default  btn-sm cs-btn">Add</button>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>

<div class="modal fade" id="customer_destroy" tabindex="-1" role="dialog" aria-labelledby="Delete" aria-hidden="true">
    <div class="modal-dialog modal-dialog" role="document" style="width: 350px;">
        <div class="modal-content">
            <div class="modal-header modal-title-bg text-center pb-1 border-0 btr-mount">
                <h5 class="mount-modal-title2 mb-3 text-dark" id="exampleModalLongTitle">Delete?</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>

            </div>
            <form action="{{url('staff/destroy')}}" method="post">
                @csrf
                <div class="modal-body mx-3">

                    <p style="font-size: 15px;">Do you want to delete permanently?<br>
                        You cannot undo this.</p>
                    <input type="hidden" name="id" id="delete_id">

                    <div class="m-button">
                        {{--                        <button type="button" class="btn  text-primary " data-dismiss="modal">Cancel</button>--}}
                        <button type="submit" class="btn btn-default  cs-btn">Delete</button>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>

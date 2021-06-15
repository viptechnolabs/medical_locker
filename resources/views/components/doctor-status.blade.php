<!-- update doctor status -->
<div class="modal fade" id="change_status" tabindex="-1"
     role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <form action="{{ $action }}"
                  class="form-horizontal form-label-left" method="POST">
                @method('put')
                @csrf
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel2">
                        Change Status</h4>
                    <button type="button" class="close"
                            data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h6>Are You Sure to change Status..?</h6>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                            data-dismiss="modal">Cancel
                    </button>
                    <button type="submit" class="btn btn-primary">
                        Confirm
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- /update doctor status -->

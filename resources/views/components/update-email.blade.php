<!-- update email -->
<div class="modal fade" id="update_email" tabindex="-1"
     role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <form action="{{route('hospital_update_email')}}"
                  class="form-horizontal form-label-left" method="POST">
                @csrf
                @method('PUT')
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel2">
                    Update
                    Email</h4>
                <button type="button" class="close"
                        data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <h4>Email</h4>

                <input type="text" class="form-control"
                       value="{{$email}}"
                       placeholder="Mobile No" name="hospital_email">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary"
                        data-dismiss="modal">Close
                </button>
                <button type="submit" class="btn btn-primary">
                    Next
                </button>
            </div>
            </form>
        </div>
    </div>
</div>
<!-- /update email -->

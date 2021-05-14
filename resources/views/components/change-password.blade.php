    <!-- change password -->
    <div class="modal fade" id="change_password" tabindex="-1"
         role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <form action="{{route('hospital_change_password')}}"
                      class="form-horizontal form-label-left" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel2">
                            Change Password</h4>
                        <button type="button" class="close"
                                data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <h4>Password</h4>

                        <input type="password" class="form-control" value=""
                               name="password">
                    </div>

                    <div class="modal-body">
                        <h4>Confirm Password</h4>

                        <input type="password" class="form-control" value=""
                               name="confirm_password">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                                data-dismiss="modal">Close
                        </button>

                            <button type="submit" class="btn btn-primary">
                                Save
                            </button>

                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- / change password -->

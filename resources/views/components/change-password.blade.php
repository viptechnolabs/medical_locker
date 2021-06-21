    <!-- change password -->
    <div class="modal fade" id="change_password" tabindex="-1"
         role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <form action="{{route('change_password')}}"
                      class="form-horizontal form-label-left" method="POST" id="change_password_form">
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
                    <input type="hidden" class="form-control" name="id" value="{{$id}}">
                    <input type="hidden" class="form-control" name="user_type" value="{{$user_type}}">

{{--                    <div class="modal-body">--}}
{{--                        <h4>Current Password</h4>--}}

{{--                        <input type="password" class="form-control" placeholder="Current Password" name="current_password"--}}
{{--                               id="current_password">--}}
{{--                    </div>--}}

                    <div class="modal-body">
                        <h4>Password</h4>

                        <input type="password" class="form-control" placeholder="New Password" value=""
                               name="password" id="password">
                    </div>

                    <div class="modal-body">
                        <h4>Confirm Password</h4>

                        <input type="password" class="form-control" placeholder="Retype New Password" value=""
                               name="confirm_password">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                                data-dismiss="modal">Cancel
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

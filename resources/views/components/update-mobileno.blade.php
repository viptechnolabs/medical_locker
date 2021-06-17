<!-- Mobile Modal -->
<div id="change_mobile_modal" class="modal fade small-modal form-white-field" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form id="change_mobile_form" onsubmit="return disabledSubmitBtn(this);">
                @csrf
                <input type="hidden" name="id" value="{{ $data->id }}"/>
                <input type="hidden" id="user_type" value="{{ $user_type }}"/>
                <input type="hidden" id="old_mobile_no" value="{{ $data->mobile_no }}"/>

                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel2">
                        Update
                        Mobile no</h4>
                    <button type="button" class="close"
                            data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h4>Mobile No</h4>

                    <input type="text" class="form-control"
                           value="{{ $data->mobile_no }}"
                           placeholder="Update Mobile No" name="mobile_no" id="mobile_no">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" id="change_email" class="btn btn-primary" data-toggle="modal">Continue
                    </button>
                </div>
                <script>
                    function verification_mobile() {
                        var newMobile = $('#mobile_no').val()
                        var user_type = $('#user_type').val()
                        $.ajax({
                            method: "post",
                            url: "{{ route('profile.update.mobile_verification_code') }}",
                            data: {
                                _token: "{{ csrf_token() }}",
                                id: "{{$data->id}}",
                                mobile_no: "{{ $data->mobile_no }}",
                                newMobile: newMobile,
                                user_type: user_type,
                            },
                            success: function (result) {
                                console.log(result);
                                $("#verification-code").modal('show');
                                $("#change_mobile_modal").modal('hide');
                            },
                            error: function (error) {
                                console.log(error);
                                $("#change_mobile_modal").modal('hide');
                            }
                        });
                    }

                    function showVerificationCodeModal() {
                        $("#verification-code").modal('show');
                        $("#verification-code-error-message").modal('hide');
                    }
                </script>
            </form>
        </div>
    </div>
</div>


<!-- verification error code Message Modal -->
<div class="code-content">
    <div id="verification-code-error-message" class="modal fade small-modal form-white-field" tabindex="-1"
         role="dialog"
         aria-labelledby="exampleModalCenterTitle">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel2">
                        Update
                        Mobile No</h4>
                    <button type="button" class="close"
                            data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="modal-field">
                        <p>Please enter the verification code we just sent to your new email address.</p>
                    </div>
                </div>
                <div class="modal-footer m-t-0">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"
                            onclick="showVerificationCodeModal()">Cancel
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Mobile Verified Modal -->
<div id="mobile-verified" class="modal fade small-modal form-white-field" tabindex="-1" role="dialog"
     aria-labelledby="exampleModalCenterTitle">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel2">
                    Update
                    Mobile No</h4>
                <button type="button" class="close"
                        data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="modal-field" style="text-align: center">
                    <img src="{{asset('images/check-green-icon.svg')}}" style="height: 88px; width: 88px;">
                    <h2>Mobile No Verified</h2>
                </div>
            </div>
            <div class="modal-footer">

                <button type="button" class="btn btn-primary" onClick="window.location.reload();">Done</button>

            </div>
        </div>
    </div>
</div>


<!-- verification code Modal -->
<div class="code-content">
    <div id="verification-code" class="modal fade small-modal form-white-field" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalCenterTitle">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel2">
                        Update
                        Mobile No</h4>
                    <button type="button" class="close"
                            data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="modal-field">
                        <p>Please enter the verification code we just sent to your new mobile no.</p>

                        <form method="get" name="verification_code" class="digit-group" data-group-name="digits"
                              data-autosubmit="false" autocomplete="off">
                            @csrf
                            <div class="modal-body">
                                <h4>Verification Code</h4>

                                <input type="text" class="form-control"
                                       placeholder="Enter Verification Code " name="verification_code"
                                       id="verification_code">
                            </div>
                        </form>
                        <div id="error_msg" style="display:none">
                            <span id="email-error" class="validation-error">Please enter the valid verification code Please try again...</span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer m-t-0">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="checkVerificationCode">Continue</button>
                </div>
                <script>
                    jQuery('#checkVerificationCode').click(function () {
                        var code = $('#verification_code').val();
                        var newMobile = $('#mobile_no').val()
                        var user_type = $('#user_type').val()
                        $.ajax({
                            method: "post",
                            url: "{{ route('profile.update.mobile') }}?date=" + Date.now(),
                            data: {
                                _token: $('meta[name="csrf-token"]').attr('content'),
                                id: "{{$data->id}}",
                                newMobile: newMobile,
                                verification_code: code,
                                user_type: user_type,
                            },
                            success: function (result) {
                                console.log(result);
                                $("#verification-code").modal('hide');
                                $("#mobile-verified").modal('show');
                            },
                            error: function (error) {
                                console.log(error);
                                $("#error_msg").toggle();
                            }
                        });
                    })
                </script>
            </div>
        </div>
    </div>
</div>


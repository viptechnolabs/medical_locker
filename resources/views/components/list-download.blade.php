<!-- list download -->
<div class="modal fade" id="patient_list_download" tabindex="-1"
     role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <form action="{{ route('patient.patient_list_download') }}"
                  class="form-horizontal form-label-left" id="list_download" name="list_download">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel2">
                        Patient List Download</h5>
                    <button type="button" class="close"
                            data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="option">
                        <div class="modal-body">
                            <div class="radio">
                                @foreach(App\Models\Hospital::OPTION as $key => $value )
                                    <label>
                                        <input type="radio" class="flat" value="{{ $key }}" id="option"
                                               name="option"  onchange="disableElement(this.value)" {{$key === 'all' ? 'checked' : ''}}> {{ $value }} &nbsp;&nbsp;
                                    </label>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="date_range" style="display: none">
{{--                        <h6 class="text-center">(Choose any one)</h6>--}}
                        <div class="modal-body select-wrapper white-select-style">
                            <h6>Choose Date</h6>
                            <input id="start_date" name="start_date" class="date-picker form-control" placeholder="dd-mm-yyyy"
                                   type="text" onfocus="this.type='date'" onmouseover="this.type='date'"
                                   onclick="this.type='date'" onblur="this.type='text'"
                                   onmouseout="timeFunctionLong(this)">
                            <script>
                                function timeFunctionLong(input) {
                                    setTimeout(function () {
                                        input.type = 'text';
                                    }, 60000);
                                }
                            </script>
                        </div>


                        <h6 class="text-center">To</h6>
                        <div class="modal-body select-wrapper white-select-style">
                            <input id="end_date" name="end_date" class="date-picker form-control" placeholder="dd-mm-yyyy"
                                   type="text" onfocus="this.type='date'" onmouseover="this.type='date'"
                                   onclick="this.type='date'" onblur="this.type='text'"
                                   onmouseout="timeFunctionLong(this)">
                            <script>
                                function timeFunctionLong(input) {
                                    setTimeout(function () {
                                        input.type = 'text';
                                    }, 60000);
                                }
                            </script>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                                data-dismiss="modal">Cancel
                        </button>

                        <button  type="submit" id="submit-btn" class="btn btn-primary">
                            Save
                        </button>
                    </div>
                    <script type="text/javascript">
                        $('#submit-btn').on('click',function(e){
                            setTimeout(() => {
                                $('#patient_list_download').modal('hide');
                            }, 100);
                        });
                    </script>
                </div>
            </form>
        </div>
    </div>
</div>



<script>
    // function elementDisable(value) {
    //         $('.option').slideDown();
    //         validator.destroy();
    //         validator = null;

    // }
    function disableElement(value) {
        if (value === 'all' || value  === 'last_day' || value === 'last_week' || value === 'current_month' || value === 'last_month')
        {
            $('.date_range').slideUp();
            validator.destroy();
            validator = null;
        }
        else
        {
            $('.date_range').slideDown();
            validator.destroy();
            validator = null;
        }

    }

    // function elementDisable(value) {
        // if (value === 'all' || value  === 'last_day' || value === 'last_week' || value === 'current_month' || value === 'last_month') {
        //     $('.option').slideUp();
            // validator.destroy();
            // validator = null;
        // }
        // else
        // {
        //     $('.option').slideUp();
        //     validator.destroy();
        //     validator = null;
        // }
    // }
</script>
<!-- / list download -->

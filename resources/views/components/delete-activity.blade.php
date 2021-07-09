<!-- list download -->
<div class="modal fade" id="delete_activity" tabindex="-1"
     role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <form action="{{ route('activity_delete') }}"
                  class="form-horizontal form-label-left" id="delete_activity" name="delete_activity">
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
                                @foreach(collect(App\Models\Hospital::OPTION)->filter(function ($value, $key) {return $key !== "custom";}) as $key => $value )
                                    <label>
                                        <input type="radio" class="flat" value="{{ $key }}" id="option"
                                               name="option" {{$key === 'last_month' ? 'checked' : ''}}> {{ $value }} &nbsp;&nbsp;
                                    </label>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                                data-dismiss="modal">Cancel
                        </button>

                        <button  type="submit" id="delete-btn" class="btn btn-primary">
                            Save
                        </button>
                    </div>
                    <script type="text/javascript">
                        $('#delete-btn').on('click',function(e){
                            setTimeout(() => {
                                $('#delete_activity').modal('hide');
                            }, 100);
                        });
                    </script>
                </div>
            </form>
        </div>
    </div>
</div>

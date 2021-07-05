<select id="state" name="state" class="form-control">
    <option value="" disabled selected>-- Select State --</option>
    @foreach($getStates as $states)
{{--        <option value="{{ $states->id }}" > {{ $states->name }}</option>--}}
        <option value="{{ $states->id }}" {{($states->id == $select_state) ? "selected" : ""}}> {{ $states->name }}</option>
    @endforeach
</select>

<select id="getCityList" name="city" class="form-control" id="getCityList">
    <option value="" disabled selected>-- Select City --</option>
    @if($cities)
        @forelse($cities as $city)
            <option value="{{ $city->id }}" {{($city->name === $selectCity) ? "selected" : ""}} > {{ $city->name }}</option>
        @empty
        @endforelse
    @endif
</select>

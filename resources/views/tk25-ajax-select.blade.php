<optgroup label="تذاكر 25دج">

@if(!empty($temp25))

  @foreach($temp25 as $key => $value)

    <option value="{{ $key }}">{{ $value }}</option>

  @endforeach
@endif

</optgroup>

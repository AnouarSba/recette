<optgroup label="تذاكر 20دج">

@if(!empty($temp20))

  @foreach($temp20 as $key => $value)

    <option value="{{ $key }}">{{ $value }}</option>

  @endforeach
@endif

</optgroup>

<optgroup label="تذاكر 30دج">

@if(!empty($temp30))

  @foreach($temp30 as $key => $value)

    <option selected value="{{ $key }}">{{ $value }}</option>

  @endforeach
@endif

</optgroup>

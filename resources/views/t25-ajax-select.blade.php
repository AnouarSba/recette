<optgroup label="دفاتر 25دج">

@if(!empty($emp25))

  @foreach($emp25 as $key => $value)

    <option value="{{ $key }}">{{ $value }}</option>

  @endforeach
@endif

</optgroup>

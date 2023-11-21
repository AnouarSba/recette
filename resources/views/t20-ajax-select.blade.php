<optgroup label="دفاتر 20دج">

@if(!empty($emp20))

  @foreach($emp20 as $key => $value)

    <option value="{{ $key }}">{{ $value }}</option>

  @endforeach
@endif

</optgroup>

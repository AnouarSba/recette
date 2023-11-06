<optgroup label="دفاتر 30دج">

@if(!empty($emp30))

  @foreach($emp30 as $key => $value)

    <option value="{{ $key }}">{{ $value }}</option>

  @endforeach
@endif

</optgroup>

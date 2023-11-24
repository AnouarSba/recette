<optgroup label="تذاكر 20دج">

@if(!empty($temp20))
@php
  $i=0;
  $j=0;
  $arr=['lightblue','lightcyan','lightyellow','lightskyblue','lightgreen'];
  $color=$arr[$i];
@endphp
  @foreach($temp20 as $key => $value)
  @php
  
  if ((explode('- ',$value)[1]) % 100 == 1) {
    $i++;

    if ($i==count($arr)) {
      $i=0;
    }
   
    
   $color=$arr[$i];
  } 
  
     
  @endphp
    <option style="background-color: {{$color}}"  value="{{ $key }}">{{ $value }}</option>
   
  @endforeach
@endif

</optgroup>

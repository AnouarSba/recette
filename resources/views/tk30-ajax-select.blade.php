<optgroup label="تذاكر 30دج">

@if(!empty($temp30))
@php
  $i=0;
  $j=0;
  $arr=['lightyellow','lightskyblue','lightblue','lightcyan','lightgreen'];
  $color=$arr[$i];
@endphp
@foreach($temp30 as $key => $value)
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

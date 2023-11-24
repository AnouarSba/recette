<optgroup label="تذاكر 25دج">

@if(!empty($temp25))
@php
  $i=0;
  $j=0;
  $arr=['lightskyblue','lightgreen','lightblue','lightcyan','lightyellow'];
  $color=$arr[$i];
@endphp
@foreach($temp25 as $key => $value)
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

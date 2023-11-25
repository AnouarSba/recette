@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css'>
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha.6/css/bootstrap.min.css'><link rel="stylesheet" href="./style.css">

<style>
.row {
      margin-bottom: 20px;
    }
       
    .button.button-small {
      height: 30px;
      line-height: 30px;
      padding: 0px 10px;
    }
    
    td input[type=text],
    td select {
      width: 100%;
      height: 30px;
      margin: 0;
      padding: 1px 8px;
    }
    
    th:last-child {
      text-align: right;
    }
    
    td:last-child {
      text-align: right;
    }
    
    td:last-child .button {
      width: 30px;
      height: 30px;
      text-align: center;
      padding: 0px;
      margin-bottom: 0px;
      margin-right: 5px;
      background-color: #FFF;
    }
    
    td:last-child .button .fa {
      line-height: 30px;
      width: 30px;
    }
    </style>
@section('content')


    <div class="" dir="rtl" style="overflow-x: scroll">

       <!-- <div class="row">
          <div class="col-md-12">
            <br>
            <button class="btn btn-default pull-right add-row"><i class="fa fa-plus"></i>&nbsp;&nbsp; Add Row</button>
          </div>
        </div>-->
      <br>
        @if (isset($_GET['confirm']))
            <script>
              alert("لقد تم التأكيد")
            </script>
        @endif
      <form method="POST" hidden action="{{ route('list') }}">
        @csrf
        <div class="row align-items-center">


            <div class="col-auto" >
                <label for="exampleFormControlInput1" style="float: right" dir="rtl">يوم</label>
                <input type="date" class="form-control" id="game-date-time-text" name="start_date"
                    value="{{ ($start_date)? $start_date : now()->setTimezone('T')->format('Y-m-d') }}">
                @error('start_date') <span class="text-danger error">{{ $message }}</span>@enderror
            </div>

            <div class="col-auto">
                <label for="exampleFormControlInput1">&nbsp; </label>
                <select name="brigade" class="form-control" id="brigade" required>
                    <option value="0" {{ ($brigade == 0)? 'selected' : ''}}>يوم كامل</option>
                    <option value="1" {{ ($brigade == 1)? 'selected' : ''}}>صباح</option>
                    <option value="2" {{ ($brigade == 2)? 'selected' : ''}}>مساء</option>
                   
                </select>
                @error('type_id') <span class="text-danger error">{{ $message }}</span>@enderror
            </div>


            <div class="col-auto">
                <label for="exampleFormControlInput1">&nbsp; </label>
                <br>
                <button type="submit" class="btn sbm btn-primary mb-2"> متابعة</button>
            </div>

        </div>
    </form>
        <div class="row">
          <div class="col-md-12">
            <table class="table table-bordered" id="editableTable">
              <thead>
                <tr>
                  <th>القابض</th>
                  <th>الخط</th>
                  <th>الحافلة</th>
                  <th>الانطلاق</th>
                  <th>الفترة</th>
                  <th>تذاكر 20دج</th>
                  <th>تذاكر 25دج</th>
                  <th>تذاكر 30دج</th>
                  <th> دفاتر 20دج</th>
                  <th> دفاتر 25دج</th>
                  <th> دفاتر 203ج</th>
                  <th>سلسلة 20دج</th>
                  <th>سلسلة 25دج</th>
                  <th>سلسلة 30دج</th>
                  <th>rotation</th>
                  <th>التعبئة</th>
                  <th>المداخيل</th>
                  <th>الديون</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                @php
                    $tr=0;
                    $tf=0;
                    $td=0;
                    $ts=0;
                @endphp
                @foreach ($data as $data_item )
                @php
                   $dette = $data_item->dettes;
                   // $dette = App\Models\Kabid::where('name',$data_item->kname)->first()->dettes;
                    // $data_item->s20*20*100 - $data_item->t20*20 + $data_item->s25*25*100 - $data_item->t25 * 25  + $data_item->s30*30*100 - $data_item->s30*30;
                    $types = ['','A','B','C','D'];
                    $brigades = ['','الصباحية','المسائية','الليلية'];
                    $tr+=$data_item->recette;
                    $tf+=$data_item->flexy;
                    $td+=$dette;
                    $ts=$tr+$tf;
                    @endphp
                    <tr id="{{$data_item->r_id}}" data-id="{{$data_item->r_id}}">
                  <td data-field="id" hidden>{{$data_item->r_id}}</td>
                  <td data-field="kname">{{$data_item->kname}}</td>
                  <td data-field="lname">{{$data_item->lname}}</td>
                  <td data-field="bname">{{$data_item->bname}}</td>
                  <td data-field="type">{{$types[$data_item->type]}}</td>
                  <td data-field="brigade">{{$brigades[$data_item->brigade]}}</td>
                  <td data-field="t20">{{$data_item->t20}}</td>
                  <td data-field="t25">{{$data_item->t25}}</td>
                  <td data-field="t30">{{$data_item->t30}}</td>
                  <td data-field="s20">{{$data_item->s20}}</td>
                  <td data-field="s25">{{$data_item->s25}}</td>
                  <td data-field="s30">{{$data_item->s30}}</td>
                  <td data-field="r20">{{$data_item->r20}}</td>
                  <td data-field="r25">{{$data_item->r25}}</td>
                  <td data-field="r30">{{$data_item->r30}}</td>
                  <td data-field="rotation">{{$data_item->rotation}}</td>
                  <td data-field="flexy">{{$data_item->flexy}}</td>
                  <td data-field="recette">{{$data_item->recette}}</td>
                  <td data-field="dette">{{$dette}}</td>
                  <td>
                    <a class="button button-small edit" title="Edit">
                      <i class="fa fa-pencil"></i>
                    </a>
                    
                   <a class="button button-small edit" title="Delete">
                      <i class="fa fa-trash"></i>
                    </a> 
                  </td>
                </tr>
                @endforeach
                <tr >
                  <td colspan="15"></td>
                  
                  <td >{{$tf}}</td>
                  <td >{{$tr}}</td>
                  <td >{{$td}}</td>
                  <td >{{$ts}}</td>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <div class="row" dir="rtl">
        @if(Illuminate\Support\Facades\Auth::user()->id==3)
        <form action="{{route('confirm')}}" method="POST" style="display: contents">
          @csrf
        <span style="margin: 7px 10px;
    color: black;
    text-align: center;
    justify-content: center;
    font-size: large;">تعبئة المراقبين</span><input style="height: 40px"  type="number" name="cf" value="{{$cf}}" id="tc">
          <span style="margin: 7px 10px;
    color: black;
    text-align: center;
    justify-content: center;
    font-size: large;">عدد بطاقة رحلات </span><input style="height: 40px"  type="number" name="tc" value="{{$cr}}" id="tc">
     <span style="margin: 7px 10px;
    color: black;
    text-align: center;
    justify-content: center;
    font-size: large;">عدد بطاقة المتمدرس </span><input style="height: 40px" type="number" name="tsc" value="{{$cs}}" id="tsc">
          <input type="hidden" name="flexy" value="{{$tf}}" id="flexy">
          <input type="hidden" name="date" value="{{$start_date}}" id="date">
          <input type="hidden" name="brigade" value="{{$brigade}}" id="brigade">
          <input type="submit" style="width:10%; margin-right:2%" class="btn btn-danger" value="تأكيد">
        </form>
        @endif
        <a style="width:10%; margin-right:2%" href="{{route('confirm')}}"><button style="width: 100%" class="btn btn-success">طباعة</button></a>
        <a style="width:10%; margin-right:2%" href="{{route('home')}}"><button style="width: 100%" class="btn btn-primary">العودة</button></a>
      </div>


    
        @include('layouts.footers.auth.footer')
@endsection

@push('js')
<script>
  function ch(v) {

x = document.getElementById("t20").value * 20;
y = document.getElementById("t25").value * 25;
z = document.getElementById("t30").value * 30;
xs = document.getElementById("s20").value * 20;
ys = document.getElementById("s25").value * 25;
zs = document.getElementById("s30").value * 30;
/*document.getElementById("tp20").textContent = x;
document.getElementById("tp25").textContent = y;
document.getElementById("tp30").textContent = z;
*/

document.getElementById("somme").value = x + y + z;
document.getElementById("recette").value = x + y + z;
document.getElementById("dette").value = xs * 100 - x + ys * 100 - y + zs * 100 - z;
document.getElementById("dettes").value = xs * 100 - x + ys * 100 - y + zs * 100 - z;
}
    (function($, window, document, undefined) {
  var pluginName = "editable",
    defaults = {
      keyboard: true,
      dblclick: true,
      button: true,
      buttonSelector: ".edit",
      maintainWidth: true,
      dropdowns: {},
      
      edit: function() {},
      save: function() {},
      cancel: function() {}
    };
/*
    $('td').on('click', function () {
  console.log($(this).parent())
})*/
  function editable(element, options) {
    this.element = element;
    this.options = $.extend({}, defaults, options);

    this._defaults = defaults;
    this._name = pluginName;

    this.init();
  }

  editable.prototype = {
    init: function() {
      this.editing = false;

      if (this.options.dblclick) {
        $(this.element)
          .css('cursor', 'pointer')
          .bind('dblclick', this.toggle.bind(this));
      }

      if (this.options.button) {
        $(this.options.buttonSelector, this.element)
          .bind('click', this.toggle.bind(this));
      }
    },

    toggle: function(e) {
      e.preventDefault();

      this.editing = !this.editing;

      if (this.editing) {
        this.edit();
      } else {
        this.save();
      }
    },

    edit: function() {
      var instance = this,
        values = {};

      $('td[data-field]', this.element).each(function() {
        var input,
          field = $(this).data('field'),
          value = $(this).text(),
          s='',
          width = $(this).width();
        values[field] = value;

        $(this).empty();

        if (instance.options.maintainWidth) {
          $(this).width(width);
        }

        if (field in instance.options.dropdowns) {

          input = $('<select required name="'+field+'" id="'+field+'"></select>');

          for (var i = 0; i < instance.options.dropdowns[field].length; i++) {
              
            if (value == instance.options.dropdowns[field][i]) {
              s='selected';
            } else s='';
            input.append('<option value="'+instance.options.dropdowns[field+'id'][i]+'" '+s+' >'+instance.options.dropdowns[field][i]+'</option>');
            
          }
          input
            .data('old-value', value)
            .dblclick(instance._captureEvent);
        } else {
          if (field == 'recette' ) {
            input = $('<input name="somme" id="somme" type="text" disabled />')
            .val(value)
            .data('old-value', value)
            .dblclick(instance._captureEvent);
            inputh = $('<input name="recette" id="recette" type="hidden"  />')
            .val(value)
            .data('old-value', value)
            .dblclick(instance._captureEvent);
            inputh.appendTo(this);
          }else if (field== 'dette') {
            input = $('<input name="'+field+'" id="'+field+'" type="hidden"  />')
            .val(value)
            .data('old-value', value)
            .dblclick(instance._captureEvent);
            inputh = $('<input name="dettes" id="dettes" type="text" disabled />')
            .val(value)
            .data('old-value', value)
            .dblclick(instance._captureEvent);
            inputh.appendTo(this);
          }else if (field== 'id') {
           
            input = $('<input name="id" id="id" type="hidden"  />')
            .val(value)
            .data('old-value', value)
            .dblclick(instance._captureEvent);
          }else 
          input = $('<input  onkeyup="ch(1)"  name="'+field+'" id="'+field+'" type="text" />')
            .val(value)
            .data('old-value', value)
            .dblclick(instance._captureEvent);
        }

        input.appendTo(this);

        if (instance.options.keyboard) {
          input.keydown(instance._captureKey.bind(instance));
        }
      });

      this.options.edit.bind(this.element)(values);
    },
    save: function() {
      var instance = this,

        values = {};
        var b_array = [];
  var l_array = [];
  var k_array = [];
  b_array.push('');
  k_array.push('');
  l_array.push('');

<?php foreach ($buses as $bus) {?>
    b_array.push('<?php echo $bus->name; ?>');
<?php }?>

<?php $k=1; 
foreach ($kabids as $kabid) {
  if ($kabid->id == $k) {
    ?>
    k_array.push('<?php echo $kabid->name; ?>');
   
<?php $k++;} else {while ($kabid->id > $k) {
   ?>
  k_array.push('');

  <?php $k++;}?>
  k_array.push('<?php echo $kabid->name; ?>');
  
  <?php $k++;
}   }?>
l_array.push('');
l_array.push('');
<?php foreach ($lignes as $ligne) {?>
    l_array.push('<?php echo $ligne->name; ?>');
<?php }?>
      tps=['','A','B','C','D'];
      brgds=['','الصباحية','المسائية','الليلية'];
      $('td[data-field]', this.element).each(function() {
        var value = $(':input', this).val();
        if ($(this).data('field')=='brigade') {
          values[$(this).data('field')] = brgds[value];
          $(this).empty()
          .text(brgds[value]);
        }
        else if ($(this).data('field')=='type') {
          values[$(this).data('field')] = tps[value];
          $(this).empty()
          .text(tps[value]);
        }
        else if ($(this).data('field')=='kname') {
          values[$(this).data('field')] = k_array[value];
          $(this).empty()
          .text(k_array[value]);
        }
        else if ($(this).data('field')=='lname') {
          values[$(this).data('field')] = l_array[value];
          $(this).empty()
          .text(l_array[value]);
        }
        else if ($(this).data('field')=='bname') {
          values[$(this).data('field')] = b_array[value];
          $(this).empty()
          .text(b_array[value]);
        }
        else {values[$(this).data('field')] = value;

        $(this).empty()
          .text(value);}
          values[$(this).data('field')] = value;
      });
      console.log(values);
      $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url:"{{ route('update') }}",
            type:"get",
            data:{
                val:values,
            },
            success:function(response)
            {
                alert(response[0]);
                $('.sbm').click();
            },
            error:function(jqXHR, textStatus, errorThrown) {
                alert('خلل ما')
            }
        });
    
      this.options.save.bind(this.element)(values);
    },

    cancel: function() {
      var instance = this,
        values = {};

      $('td[data-field]', this.element).each(function() {
        var value = $(':input', this).data('old-value');

        values[$(this).data('field')] = value;

        $(this).empty()
          .text(value);
      });

      this.options.cancel.bind(this.element)(values);
    },

    _captureEvent: function(e) {
      e.stopPropagation();
    },

    _captureKey: function(e) {
      if (e.which === 13) {
        this.editing = false;
        this.save();
      } else if (e.which === 27) {
        this.editing = false;
        this.cancel();
      }
    }
  };

  $.fn[pluginName] = function(options) {
    return this.each(function() {
      if (!$.data(this, "plugin_" + pluginName)) {
        $.data(this, "plugin_" + pluginName,
          new editable(this, options));
      }
    });
  };

})(jQuery, window, document);

editTable();

//custome editable starts
function editTable(){
  
  $(function() {
  var pickers = {};
  var b_array = [];
  var b_array_ids = [];
  var l_array = [];
  var l_array_ids = [];
  var k_array = [];
  var k_array_ids = [];
<?php foreach ($buses as $bus) {?>
    b_array.push('<?php echo $bus->name; ?>');
    b_array_ids.push('<?php echo $bus->id; ?>');
<?php }?>
<?php foreach ($kabids as $kabid) {?>
    k_array.push('<?php echo $kabid->name; ?>');
    k_array_ids.push('<?php echo $kabid->id; ?>');
<?php }?>
<?php foreach ($lignes as $ligne) {?>
    l_array.push('<?php echo $ligne->name; ?>');
    l_array_ids.push('<?php echo $ligne->id; ?>');
<?php }?>
/*array.forEach(function(value){
    $("#new").append('<label for="nice_text">ID Type</label><input type="text" id="nice_text" name="cureIdtype" class="input-text" VALUE="'+value+'"/>')
});    */
  $('table tr').editable({
    dropdowns: {
      bname: b_array,
      bnameid: b_array_ids,
      kname: k_array,
      knameid: k_array_ids,
      lname: l_array,
      lnameid: l_array_ids,
      brigade: ['الصباحية', 'المسائية'],
      brigadeid: [1, 2],
      type: ['A', 'B','C','D'],
      typeid: [1, 2, 3, 4]
    },
    edit: function(values) {
      $(".edit i", this)
        .removeClass('fa-pencil')
        .addClass('fa-save')
        .attr('title', 'Save');

      pickers[this] = new Pikaday({
        field: $("td[data-field=birthday] input", this)[0],
        format: 'MMM D, YYYY'
      });
    },
    save: function(values) {
      $(".edit i", this)
        .removeClass('fa-save')
        .addClass('fa-pencil')
        .attr('title', 'Edit');

      if (this in pickers) {
        pickers[this].destroy();
        delete pickers[this];
      }
    },
    cancel: function(values) {
      $(".edit i", this)
        .removeClass('fa-save')
        .addClass('fa-pencil')
        .attr('title', 'Edit');

      if (this in pickers) {
        pickers[this].destroy();
        delete pickers[this];
      }
    }
  });
});
  
}

$(".add-row").click(function(){
  $("#editableTable").find("tbody tr:first").before("<tr><td data-field='name'></td><td data-field='name'></td><td data-field='name'></td><td data-field='name'></td><td><a class='button button-small edit' title='Edit'><i class='fa fa-pencil'></i></a> <a class='button button-small' title='Delete'><i class='fa fa-trash'></i></a></td></tr>");   
  editTable();  
  setTimeout(function(){   
    $("#editableTable").find("tbody tr:first td:last a[title='Edit']").click(); 
  }, 200); 
  
  setTimeout(function(){ 
    $("#editableTable").find("tbody tr:first td:first input[type='text']").focus();
      }, 300); 
  
   $("#editableTable").find("a[title='Delete']").unbind('click').click(function(e){
        $(this).closest("tr").remove();
    });
   
});

function myFunction() {
    
}

$("#editableTable").find("a[title='Delete']").click(function(e){  
  var x;
    if (confirm("Are you sure you want to delete entire row?") == true) {

      $.ajax({
            url:"{{ route('delete') }}",
            type:"get",
            data:{
                val:($(this).closest("tr")).attr('id'),
            },
            success:function(response)
            {
                alert(response[0]);
                $('.sbm').click();
             
            },
            error:function(jqXHR, textStatus, errorThrown) {
                alert('خلل ما')
            }
        });
              $(this).closest("tr").remove();
    } else {
        
    }     
});
</script>
@endpush

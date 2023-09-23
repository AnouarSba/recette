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


    <div class="" dir="rtl">

       <!-- <div class="row">
          <div class="col-md-12">
            <br>
            <button class="btn btn-default pull-right add-row"><i class="fa fa-plus"></i>&nbsp;&nbsp; Add Row</button>
          </div>
        </div>-->
      
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
                  <th>التعبئة</th>
                  <th>المداخيل</th>
                  <th>الديون</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                @foreach ($data as $data_item )
                @php
                    $dette = $data_item->s20*20*100 - $data_item->t20*20 + $data_item->s25*25*100 - $data_item->t25 * 25  + $data_item->s30*30*100 - $data_item->s30*30;
                    $types = ['','A','B','C','D'];
                    $brigades = ['','الصباحية','المسائية','الليلية'];
                    @endphp
                    <tr data-id="{{$data_item->id}}">
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
                  <td data-field="flexy">{{$data_item->flexy}}</td>
                  <td data-field="recette">{{$data_item->recette}}</td>
                  <td data-field="dette">{{$dette}}</td>
                  <td>
                    <a class="button button-small edit" title="Edit">
                      <i class="fa fa-pencil"></i>
                    </a>
                    
                  <!--  <a class="button button-small edit" title="Delete">
                      <i class="fa fa-trash"></i>
                    </a> -->
                  </td>
                </tr>
                @endforeach

              </tbody>
            </table>
          </div>
        </div>
      </div>


    
        @include('layouts.footers.auth.footer')
@endsection

@push('js')
<script>
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
          width = $(this).width();

        values[field] = value;

        $(this).empty();

        if (instance.options.maintainWidth) {
          $(this).width(width);
        }

        if (field in instance.options.dropdowns) {
          input = $('<select></select>');

          for (var i = 0; i < instance.options.dropdowns[field].length; i++) {
            input.append('<option value="'+instance.options.dropdowns[field+'id'][i]+'">'+instance.options.dropdowns[field][i]+'</option>');
            
          };

          input.val(value)
            .data('old-value', value)
            .dblclick(instance._captureEvent);
        } else {
          if (field == 'recette' || field== 'dette') {
            input = $('<input type="text" disabled />')
            .val(value)
            .data('old-value', value)
            .dblclick(instance._captureEvent);
          }else 
          input = $('<input type="text" />')
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
      brigade: ['صباحية', 'مسائية'],
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
        $(this).closest("tr").remove();
    } else {
        
    }     
});
</script>
@endpush

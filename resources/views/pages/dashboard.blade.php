@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])
<link href="https://fonts.googleapis.com/css?family=Lora" rel="stylesheet">
<link href="http://github.hubspot.com/odometer/themes/odometer-theme-plaza.css" rel="stylesheet">
<style>
    .news-container {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        align-content: space-between;
    }

    .ribbon {
        position: absolute;
        right: 0;
        top: 0px;
        z-index: 1;
        overflow: hidden;
        width: 100px;
        height: 100px;
        text-align: right;
    }

    /* card with ribbon */
    .ribbon span {
        text-transform: uppercase;
        text-align: center;
        line-height: 25px;
        transform: rotate(45deg);
        -webkit-transform: rotate(45deg);
        width: 115px;
        display: block;
        background: #f5431a;
        box-shadow: 0 0 10px 3px #ff6e4e;
        position: absolute;
        top: 20px;
        right: -25px;
        color: white;
    }

    .disabled {
        display: none;
    }

    .article-container {
        text-decoration: none;
        color: black;
        display: flex;
        flex-direction: column;
        width: 28vw;
        /* Increase this value if you want more articles per row, decrease if you want less*/
        min-width: 150px;
        max-width: 700px;
        box-shadow: 2px 2px 25px 2px rgba(0, 0, 0, 0.9);
        margin: 20px;
        transition: 0.3s;
        font-size: 14px;
        font-family: 'Lora', serif;
    }

    @media only screen and (max-width: 850px) {
        .article-container {
            width: 90vw;
        }
    }

    .article-container:hover {
        transform: scale(1.02);
        box-shadow: 2px 2px 25px 2px rgba(139, 139, 139, 0.89);

    }

    .article-image {
        width: 100%;
        max-height: 100%;
    }

    .article-title {
        padding: 10px;
    }
</style>

<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/css/bootstrap.min.css'>
<link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css'>

<style>
    #wrapper {
        position: relative;
    }

    .left {
        position: relative;
        left: 15px;

    }

    #sidebar-wrapper {
        position: fixed;
        min-height: 100vh;
        margin-left: -15rem;
        transition: all 0.25s ease-out;
        background: #8d7b68;
        width: 75px;
        z-index: 10;
        padding-left: 6px;
    }

    #sidebar-wrapper .sidebar-heading {
        padding: 0.875rem 1.25rem;
        font-size: 1.2rem;
    }

    #sidebar-wrapper .list-group {
        width: 100%;
    }

    #page-content-wrapper {
        width: 100%;
        margin-left: 6rem;
    }

    body.sb-sidenav-toggled #wrapper #sidebar-wrapper {
        margin-left: 0;
    }

    .active {
        position: relative;
        background: #c8b6a6;
        border-top-left-radius: 50%;
        border-bottom-left-radius: 50%;
        box-shadow: -3px 0px 3px 0px #444;
    }

    .nav .nav-item {
        margin: 3px 0;
    }

    .nav .nav-item>a {
        border: 0px solid #375c5d;
        background: transparent;
        color: #8d7b68;
        border-radius: 50% !important;
        height: 60px;
        width: 60px;
        margin: 7px;
    }

    .nav .nav-item.active>a {
        border: 0px solid #375c5d;
        background: #f1dec9;
        color: #8d7b68;
        border-radius: 50% !important;
        margin: 7px;
        padding: 0px 0px;
    }

    .nav .nav-item.active::before {
        position: absolute;
        content: "";
        width: 30px;
        height: 30px;
        background: #00000000;
        right: 5px;
        top: -30px;
        border-bottom-right-radius: 50%;
        box-shadow: 7px 3px 0px 0px #c8b6a6;
    }

    .nav .nav-item.active::after {
        position: absolute;
        content: "";
        width: 30px;
        height: 30px;
        background: transparent;
        right: 5px;
        bottom: -30px;
        border-top-right-radius: 50%;
        box-shadow: 7px -3px 0px 0px #c8b6a6;
    }

    section {
        min-height: 100vh;
    }

    .border-top {
        border-top: 1px solid #c8b6a6 !important;
    }

    @media (max-width: 767px) {
        #page-content-wrapper {
            margin-left: 0.5rem;
        }
    }

    @media (min-width: 768px) {
        #sidebar-wrapper {
            margin-left: 0;
        }

        #page-content-wrapper {
            min-width: 0;
            width: 100%;
        }

        body.sb-sidenav-toggled #wrapper #sidebar-wrapper {
            margin-left: -15rem;
        }
    }

    /* ----------universal selector with font-family--------- */
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        text-align: center;
        font-family: "Belanosima", sans-serif;
        font-family: "Bree Serif", serif;
        font-family: "Indie Flower", cursive;
        font-family: "Kanit", sans-serif;
        font-family: "Outfit", sans-serif;
        font-family: "Poppins", sans-serif;
        font-family: "Roboto", sans-serif;
    }

    /* Overall Container styles */
    .container {
        width: 100%;
        height: 50%;
        background-color: white;
        display: flex;
        flex-direction: column;
    }

    h1 {
        font-weight: 600;
        font-size: 35px;
        font-family: "Poppins", sans-serif;
        margin: 30px 0 20px 0;
    }

    p {
        margin-bottom: 25px;
        font-family: "Outfit", sans-serif;
        font-size: 16px;
    }

    /* ----Common style for table--- */
    table {
        margin: auto;
        width: 65%;
    }

    table,
    th,
    td {
        border-width: 1px !important;
        border: 1px solid dimgrey;
        border-collapse: collapse;
    }

    th {
        text-transform: uppercase;
        font-size: 20px;
        font-weight: bold;
        padding: 15px 35px;
    }

    /* ----Empty cell removal------- */
    table th:empty {
        border-top: 1px solid white;
        border-left: 1px solid white;
    }

    td {
        font-size: 15px;
        font-weight: bold;
        font-family: "Outfit", sans-serif;
        padding: 15px 35px;
    }

    .align {
        text-align: left;
        padding-left: 10px;
    }

    .color {
        color: white;
        font-size: 25px;
    }

    .color:nth-last-child(3) {
        background-color: green;
    }

    .color:nth-last-child(2) {
        background-color: rgb(12, 108, 138);
    }

    .color:nth-last-child(1) {
        background-color: crimson;
    }

    button {
        padding: 10px 30px;
        background-color: rgb(200, 193, 193);
        text-transform: uppercase;
    }

    .multi-select-row {
  min-width: 750px;
  max-width: 1000px;
}

.multi-select-box {
  width: 100%;
  height: 100%;
  min-height: 300px;
}

.multi-select-button-container {
  width: 100%;
  height: 100%;
  min-height: 300px;
}


.multi-select-heading {
  text-align: center;
}

.override-padding {
  padding-left: 2px;
  padding-right: 2px;
  horizontal-align: center;
}

  .odometer{
    font-size: 65px;
    margin-top: 3em;
  }

</style>
<style>
    /* Add some styling to make the tooltip visible */
    .custom-dropdown {
            position: relative;
            display: inline-block;
        }

        .custom-dropdown::before {
            content: attr(data-tooltip);
            position: absolute;
            background: rgba(0, 0, 0, 0.7);
            color: #fff;
            padding: 5px;
            border-radius: 5px;
            bottom: 125%;
            left: 50%;
            transform: translateX(-50%);
            white-space: nowrap;
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.3s ease;
        }

        .custom-dropdown:hover::before {
            opacity: 1;
        }

        .custom-select {
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            cursor: pointer;
        }

        .custom-select:focus {
            outline: none;
        }

        .custom-dropdown1 {
            position: relative;
            display: inline-block;
        }

        .custom-dropdown1::before {
            content: attr(data-tooltip);
            position: absolute;
            background: rgba(0, 0, 0, 0.7);
            color: #fff;
            padding: 5px;
            border-radius: 5px;
            bottom: 125%;
            left: 50%;
            transform: translateX(-50%);
            white-space: nowrap;
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.3s ease;
        }

        .custom-dropdown1:hover::before {
            opacity: 1;
        }

        .custom-select1 {
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            cursor: pointer;
        }

        .custom-select1:focus {
            outline: none;
        }


        .custom-dropdown2 {
            position: relative;
            display: inline-block;
        }

        .custom-dropdown2::before {
            content: attr(data-tooltip);
            position: absolute;
            background: rgba(0, 0, 0, 0.7);
            color: #fff;
            padding: 5px;
            border-radius: 5px;
            bottom: 125%;
            left: 50%;
            transform: translateX(-50%);
            white-space: nowrap;
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.3s ease;
        }

        .custom-dropdown2:hover::before {
            opacity: 1;
        }

        .custom-select2 {
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            cursor: pointer;
        }

        .custom-select2:focus {
            outline: none;
        }



        .custom-dropdownT {
            position: relative;
            display: inline-block;
        }

        .custom-dropdownT::before {
            content: attr(data-tooltip);
            position: absolute;
            background: rgba(0, 0, 0, 0.7);
            color: #fff;
            padding: 5px;
            border-radius: 5px;
            bottom: 125%;
            left: 50%;
            transform: translateX(-50%);
            white-space: nowrap;
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.3s ease;
        }

        .custom-dropdownT:hover::before {
            opacity: 1;
        }

        .custom-selectT {
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            cursor: pointer;
        }

        .custom-selectT:focus {
            outline: none;
        }

        .custom-dropdownT1 {
            position: relative;
            display: inline-block;
        }

        .custom-dropdownT1::before {
            content: attr(data-tooltip);
            position: absolute;
            background: rgba(0, 0, 0, 0.7);
            color: #fff;
            padding: 5px;
            border-radius: 5px;
            bottom: 125%;
            left: 50%;
            transform: translateX(-50%);
            white-space: nowrap;
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.3s ease;
        }

        .custom-dropdownT1:hover::before {
            opacity: 1;
        }

        .custom-selectT1 {
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            cursor: pointer;
        }

        .custom-selectT1:focus {
            outline: none;
        }


        .custom-dropdownT2 {
            position: relative;
            display: inline-block;
        }

        .custom-dropdownT2::before {
            content: attr(data-tooltip);
            position: absolute;
            background: rgba(0, 0, 0, 0.7);
            color: #fff;
            padding: 5px;
            border-radius: 5px;
            bottom: 125%;
            left: 50%;
            transform: translateX(-50%);
            white-space: nowrap;
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.3s ease;
        }

        .custom-dropdownT2:hover::before {
            opacity: 1;
        }

        .custom-selectT2 {
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            cursor: pointer;
        }

        .custom-selectT2:focus {
            outline: none;
        }
</style>
@section('content')
    <div class="container-fluid py-1">
        <div class="row">
            @if (Illuminate\Support\Facades\Auth::user()->id > 2)
            @else
                {{--  @include('layouts.navbars.auth.topnav', ['title' => 'الرئيسية'])
                  @include('layouts.navbars.auth.sidenav')
                 --}}
            @endif
            @if (isset($add))
                <script>
                    alert('تمت العملية بنجاح')
                </script>
            @endif
        </div>

        @if (Illuminate\Support\Facades\Auth::user()->id > 2)

            <div class="d-flex" id="wrapper">
                <!-- Sidebar-->
                <div class="" id="sidebar-wrapper">
                    <a href="//etus22.dz" style="color:#F1DEC9;"
                        class="d-block p-3 text-center text-decoration-none logo mb-4" title="الموقع الرسمي"
                        data-bs-toggle="tooltip" data-bs-placement="right">
                        <i class="bi bi-browser-chrome" style="font-size:27px;"></i>
                    </a>

                    <ul class="nav flex-column mb-auto text-center">
                        @if (Illuminate\Support\Facades\Auth::user()->id == 3)
                        <li class="nav-item active">
                            <a href="#section-sp" class="nav-link  text-dark py-2" aria-current="page" title="مراقبة"
                                data-bs-toggle="tooltip" data-bs-placement="right">
                                <i class="bi bi-house" style="font-size:27px;"></i>
                            </a>
                        </li>
                        @else
                            <li class="nav-item active">
                                <a href="#section-1" class="nav-link  text-dark py-2" aria-current="page" title="الرئيسية"
                                    data-bs-toggle="tooltip" data-bs-placement="right">
                                    <i class="bi bi-house" style="font-size:27px;"></i>
                                </a>
                            </li>
                        @endif

                        <li class="nav-item ">
                            <a href="#section-2" class="nav-link text-dark py-2  rounded-0" title="مراقبة البيانات"
                                data-bs-toggle="tooltip" data-bs-placement="right">
                                <i class="bi bi-file-earmark-plus" style="font-size:27px;"></i>
                            </a>
                        </li>

                    </ul>
                    <div class="dropdown border-top position-absolute bottom-0">
                        <a href="#" style="color:#333;"
                            class="d-flex align-items-center justify-content-center p-3 link-body-emphasis text-decoration-none dropdown-toggle"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-box-arrow-right" style="font-size:27px;"></i>
                        </a>
                        <ul class="dropdown-menu text-small shadow">
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="{{ route('logout') }}">خروج</a></li>
                        </ul>
                    </div>
                </div>
                <!-- Page content wrapper-->
                <div id="page-content-wrapper">

                    <!-- Top navigation-->
                    <nav class="navbar position-fixed">
                        <div class="container-fluid">
                            <button style="background-color:#8D7B68;" class="btn" id="sidebarToggle"><i
                                    class="bi bi-list text-light"></i></button>
                        </div>
                    </nav>
                    @if (Illuminate\Support\Facades\Auth::user()->id > 3)
                        <!-- Page content-->
                        <section id="section-1" class="pt-5">
                            <div class="container-fluid">


                                <form action="{{ route('recette') }}" dir="rtl"
                                    style="margin-left:10px; margin-top:10px;
                                             z-index: 99;
                                             position: relative;
                                             font-size: 25px;">

                                    <input type="date" name="date" id="dd" value="{{ $today }}">
                                    <select name="brigade" id="brigad" required>
                                        <option value="">-- الفترة --</option>
                                        <option value="1">صباح</option>
                                        <option value="2">مساء</option>
                                        <option value="3">ليل</option
                                        <!--   @php

                                            for ($i = 1; $i <= 64; $i++) {
                                                echo ' ';
                                        } @endphp> -->
                                    </select>
                                    <br>
                                    <br>
                                    <div class="row">
                                        <div class="col-1">
                                            <label dir="rtl" for="receveur">القابض</label>

                                        </div>
                                        <div class="col-3">
                                            <select name="name" onchange="ck();" id="name" required>
                                                <option value="">-- القابض --</option>
                                                @foreach ($kabids as $kabid)
                                                    <option value="{{ $kabid->id }}">{{ $kabid->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-1">
                                            <label dir="rtl" for="receveur">التعبئة</label>
                                        </div>

                                        <div class="col-3">


                                            <input type="number" name="flexy" id="flexy">
                                        </div>
                                        <div class="col-1">
                                            <label dir="rtl" for="rotation">rotation</label>
                                        </div>

                                        <div class="col-3">


                                            <input type="number" step='0.5' name="rotation" id="rotation">
                                        </div>
                                    </div>
                                    <div>
                                        <table style="width:100%">
                                            <thead>
                                                <th>الخط</th>
                                                <th>الحافلة</th>
                                                <th>الانطلاق</th>
                                                <th>تذاكر 20دج</th>
                                                <th>تذاكر 25دج</th>
                                                <th>تذاكر 30دج</th>
                                                <th>عدد دفاتر 20دج</th>
                                                <th>عدد دفاتر 25دج</th>
                                                <th>عدد دفاتر 30دج</th>
                                                <th>رقم سلسلة 20دج</th>
                                                <th>رقم سلسلة 25دج</th>
                                                <th>رقم سلسلة 30دج</th>
                                            </thead>
                                            <tbody>
                                                <tr>


                                                    <td><select name="ligne_id" id="ligne_id" required>
                                                            <option value="">-- الخط --</option>

                                                            @foreach ($lignes as $ligne)
                                                                <option value="{{ $ligne->id }}">{{ $ligne->name }}
                                                                </option>
                                                            @endforeach
                                                        </select></td>
                                                    <td><select name="bus_id" id="bus_id" required>

                                                            <option value="">-- الحافلة --</option>
                                                            @foreach ($buses as $bus)
                                                                <option value="{{ $bus->id }}">{{ $bus->name }}
                                                                </option>
                                                            @endforeach
                                                        </select></td>
                                                    <td><select name="type" id="type" required>

                                                            <option value="">-- اختر --</option>
                                                            <option value="1">A</option>
                                                            <option value="2">B</option>
                                                            <option value="3">C</option>
                                                            <option value="4">D</option>
                                                        </select></td>

                                                    <td><input type="number" onkeyup="ch(1)" style="width:80px"
                                                            name="t20" id="t20">
                                                    </td>
                                                    <td><input type="number" onkeyup="ch(2)" style="width:80px"
                                                            name="t25" id="t25">
                                                    </td>
                                                    <td><input type="number" onkeyup="ch(3)" style="width:80px"
                                                            name="t30" id="t30">
                                                    </td>
                                                    <td><input type="number" onkeyup="ch(4)" style="width:80px"
                                                            name="s20" id="s20">
                                                    </td>
                                                    <td><input type="number" onkeyup="ch(5)" style="width:80px"
                                                            name="s25" id="s25">
                                                    </td>
                                                    <td><input type="number" onkeyup="ch(6)" style="width:80px"
                                                            name="s30" id="s30">
                                                    </td>
                                                    <td><input type="text" style="width:100px" name="r20"
                                                            id="r20"></td>
                                                    <td><input type="text" style="width:100px" name="r25"
                                                            id="r25"></td>
                                                    <td><input type="text" style="width:100px" name="r30"
                                                            id="r30"></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <br>
                                        المداخيل
                                        <input type="number" name="somme" id="somme" disabled value="0">
                                        <input type="number" hidden name="recette" id="recette">
                                        الديون
                                        <input type="number" name="dette" id="dette" disabled value="0">
                                        <input type="number" hidden name="dettes" id="dettes">
                                        الديون القديمة
                                        <input type="number" name="dette" id="odette" disabled value="0">
                                        @if (Illuminate\Support\Facades\Auth::user()->id >3)
                            
                            <div hidden class="row"  style="color: black" dir="rtl">
                                <div class="row multi-select-row">
                                    <div class="col-xs-offset-1 col-xs-4" style="width: 40%;">
                                      <h4 class="multi-select-heading">
                                        التذاكر الخاصة ب <span id="nameRT"></span> 
                                      </h4>
                                    </div>
                                    <div class="col-xs-1 override-padding" style="width: 20%;"> </div>
                                    <div class="col-xs-4" style="width: 40%;">
                                      <h4 class="multi-select-heading">
                                التذاكر المباعة
                                    
                                    
                                      </h4>
                                    </div>
                                  </div>
                                  <div class="row multi-select-row">
                                    <div class="col-xs-offset-1 col-xs-4" style="width: 40%;">
                                        <div  style="display: inline; width: 100%"  class="custom-dropdownT" data-tooltip="Selected items: 0">
                                     
                                      <select style="display: inline; width: 30%" id="Tleft_box" name="ttc20[]" data-tooltip="Selected items: 0" multiple="" class="custom-selectT form-control multi-select-box">
                                        <optgroup label="تذاكر 20دج">
                                            
                                        </optgroup> 
                                        
                                      </select>
                                        </div>
                                        <div  style="display: inline; width: 100%"  class="custom-dropdownT1" data-tooltip="Selected items: 0">

                                      <select style="display: inline; width: 30%" id="Tleft_box1" name="ttc25[]" data-tooltip="Selected items: 0" multiple="" class="custom-selectT1 form-control multi-select-box">
                                        <optgroup label="تذاكر 25دج">
                                                                                 
                                        </optgroup>
                                      </select>
                                        </div>
                                        <div  style="display: inline; width: 100%"  class="custom-dropdownT2" data-tooltip="Selected items: 0">

                                    <select style="display: inline; width: 30%" id="Tleft_box2" name="ttc30[]" data-tooltip="Selected items: 0" multiple="" class="custom-selectT2 form-control multi-select-box">
                                        <optgroup label="تذاكر 30دج">
                                                                                  
                                        </optgroup>                         
                                     </select>
                                        </div>
                                    </div>
                                  
                                    <div class="col-xs-1 override-padding" style="width: 20%;">
                                      <div class="multi-select-button-container">
                                        <input type="button" id="btnRight_multiT" class="btn btn-danger btn-block" value=" >>> ">
                                        <br>
                                        <input type="button" id="btnRight_singleT" class="btn btn-default btn-block" value="  >">
                                        <br>
                                        <input type="button" id="btnLeft_singleT" class="btn btn-default btn-block" value="  <  ">
                                        <br>
                                        <input type="button" id="btnLeft_multiT" class="btn btn-warning btn-block" value="<<<">
                                        <br><br>
                                        <input type="button" id="btn_resetT" class="btn btn-secondary btn-block" value="reset">
                                        <br><br>
                                      </div>
                                    </div>
                                    <div class="col-xs-4" style="width: 40%;">
                                        <select style="display: inline; width: 30%" id="right_boxT" name="tt20[]" multiple="" class="form-control multi-select-box">
                                            <optgroup label="تذاكر 20دج">
                                               
                                            </optgroup> 
                                            
                                          </select>
                                          <select style="display: inline; width: 30%" id="right_boxT1" name="tt25[]" multiple="" class="form-control multi-select-box">
                                            <optgroup label="تذاكر 25دج">
                                              
                                            </optgroup>
                                          </select>
                                        <select style="display: inline; width: 30%" id="right_boxT2" name="tt30[]" multiple="" class="form-control multi-select-box">
                                            <optgroup label="تذاكر 30دج" >
                                              
                                            </optgroup>                         
                                         </select>
                                    </div>
                                    <div style="display:none">
                                      <select id="hidden_Tleft_box"></select>
                                      <select id="hidden_Tleft_box1"></select>
                                      <select id="hidden_Tleft_box2"></select>
                                      <select id="hidden_right_boxT"></select>
                                      <select id="hidden_right_boxT1"></select>
                                      <select id="hidden_right_boxT2"></select>
                                    </div>
                                  </div>
                            </div>
                            <br>
                            <div hidden class="row"  style="color: black" dir="rtl">
                                <div class="row multi-select-row">
                                    <div class="col-xs-offset-1 col-xs-4" style="width: 40%;">
                                      <h4 class="multi-select-heading">
                                        مخزون دفاتر جامع الأموال 
                                      </h4>
                                    </div>
                                    <div class="col-xs-1 override-padding" style="width: 20%;"> </div>
                                    <div class="col-xs-4" style="width: 40%;">
                                      <h4 class="multi-select-heading">
                                    الدفاتر الخاصة ب   <span id="nameR"></span>
                                    
                                    <input  type="hidden" id="nameC" required name="nameC">
                                    
                                      </h4>
                                    </div>
                                  </div>
                                  <div class="row multi-select-row">
                                    <div class="col-xs-offset-1 col-xs-4" style="width: 40%;">
                                     
                                        <div  style="display: inline; width: 100%"  class="custom-dropdown" data-tooltip="Selected items: 0">
                                     
                                        <select style="display: inline; width: 30%" id="left_box" name="canselect_code" data-tooltip="Selected items: 0" multiple="" class="custom-select form-control multi-select-box">
                                        <optgroup label="دفاتر 20دج">
                                            @foreach (App\Models\Carnet::where('status',2)->where('type',1)->get() as $k)
                                            <option value="{{$k->id}}">{{$k->name}}</option>
                                            @endforeach
                                        </optgroup> 
                                        
                                      </select>
                                        </div>
                                        <div  style="display: inline; width: 100%"  class="custom-dropdown1" data-tooltip="Selected items: 0">

                                      <select style="display: inline; width: 30%" id="left_box1" name="canselect_code" data-tooltip="Selected items: 0" multiple="" class="custom-select1 form-control multi-select-box">
                                        <optgroup label="دفاتر 25دج">
                                            @foreach (App\Models\Carnet::where('status',2)->where('type',2)->get() as $k)
                                            <option value="{{$k->id}}">{{$k->name}}</option>
                                            @endforeach                                        
                                        </optgroup>
                                      </select>
                                        </div>
                                        <div  style="display: inline; width: 100%"  class="custom-dropdown2" data-tooltip="Selected items: 0">

                                    <select style="display: inline; width: 30%" id="left_box2" name="canselect_code" data-tooltip="Selected items: 0" multiple="" class="custom-select2 form-control multi-select-box">
                                        <optgroup label="دفاتر 30دج">
                                            @foreach (App\Models\Carnet::where('status',2)->where('type',3)->get() as $k)
                                            <option value="{{$k->id}}">{{$k->name}}</option>
                                            @endforeach                                        
                                        </optgroup>                         
                                     </select>
                                        </div>
                                    </div>
                                  
                                    <div class="col-xs-1 override-padding" style="width: 20%;">
                                      <div class="multi-select-button-container">
                                        <input type="button" id="btnRight_multi" class="btn btn-danger btn-block" value=" >>> ">
                                        <br>
                                        <input type="button" id="btnRight_single" class="btn btn-default btn-block" value="  >">
                                        <br>
                                        <input type="button" id="btnLeft_single" class="btn btn-default btn-block" value="  <  ">
                                        <br>
                                        <input type="button" id="btnLeft_multi" class="btn btn-warning btn-block" value="<<<">
                                        <br><br>
                                        <input type="button" id="btn_reset" class="btn btn-secondary btn-block" value="reset">
                                        <br><br>
                                      </div>
                                    </div>
                                    <div class="col-xs-4" style="width: 40%;">
                                        <select style="display: inline; width: 30%" id="right_box" name="tc20[]" multiple="" class="form-control multi-select-box">
                                            <optgroup label="دفاتر 20دج">
                                               
                                            </optgroup> 
                                            
                                          </select>
                                          <select style="display: inline; width: 30%" id="right_box1" name="tc25[]" multiple="" class="form-control multi-select-box">
                                            <optgroup label="دفاتر 25دج">
                                              
                                            </optgroup>
                                          </select>
                                        <select style="display: inline; width: 30%" id="right_box2" name="tc30[]" multiple="" class="form-control multi-select-box">
                                            <optgroup label="دفاتر 30دج" >
                                              
                                            </optgroup>                         
                                         </select>
                                    </div>
                                    <div style="display:none">
                                      <select id="hidden_left_box"></select>
                                      <select id="hidden_left_box1"></select>
                                      <select id="hidden_left_box2"></select>
                                      <select id="hidden_right_box"></select>
                                      <select id="hidden_right_box1"></select>
                                      <select id="hidden_right_box2"></select>
                                    </div>
                                  </div>
                            </div>
                            <br>
                    @endif
                    <br>
                                        <input type="submit" onclick="empty()"  class="btn btn-success "  style="width: 200px;font-size: 22px" value="تأكيد">
                                    </div>
                                </form>
                            </div>
                        </section>
                    @endif
                    @if (Illuminate\Support\Facades\Auth::user()->id > 2)
                        <!-- Page content-->
                        <section id="section-sp" class="pt-5">
                            <br>
                            @php
                                $mnth = ['جانفي', 'فيفري', 'مارس', 'أفريل', 'ماي', 'جوان', 'جويلية', 'أوت', 'سبتمبر', 'أكتوبر', 'نوفمبر', 'ديسمبر'];
                            @endphp
                            <b style="font-size: 24px">مداخيل شهر {{ $mnth[$m - 1] }} {{ $day }}</b>
                            <br>
                            <div style="    display: inline-flex;
                                        color: black;
                                        font-size: 16px;
                                        flex-flow: nowrap;
                                        font-size: 32px;"
                                dir="rtl">البحث عن مداخيل
                                &nbsp; &nbsp; <form method="post" action="{{ route('home') }}">
                                    @csrf
                                    <select name="month" style=>
                                        @for ($i = 0; $i < 12; $i++)
                                            <option value="{{ $i + 1 }}" {{ $m == $i + 1 ? 'selected' : '' }}>
                                                {{ $mnth[$i] }}</option>
                                        @endfor
                                    </select>
                                    <input type="submit" class="btn btn-secondary" value="ابحث">
                                </form>
                            </div>
                            <div class="container" dir="rtl" style="color:black;  overflow:scroll">
                                <table class="tbl" style="width:80%; overflow:scroll">
                                    <thead style="background-color:lightgrey; font-size">
                                        <tr>
                                            <th rowspan="2" style="width:40px">يوم</th>
                                            <th colspan="3">مداخيل التذاكر الكلاسيكية</th>
                                            <th colspan="3">الدفع الالكتروني</th>
                                            <th rowspan="2">القيمة الاجمالية </th>
                                        </tr>
                                        <tr>
                                            <th>الفترة الصباحية</th>
                                            <th>الفترة المسائية</th>
                                            <th>الفترة الليلية</th>
                                            <th>مداخيل بطافة رحلات </th>
                                            <th>مداخيل بطاقة المتمدرس </th>
                                            <th>مداخيل التعبئة </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $totalc = 0;
                                            $tf = 0;
                                            $tt = 0;
                                        @endphp
                                        @foreach ($data as $d)
                                            @php
                                                $tc = $d->tc * 200;
                                                $tsc = $d->tsc * 300;
                                                $f = $d->flexy;
                                                $t = $d->money + $f + $tsc + $tc;
                                                $tt += $t;

                                                $tc = $d->tc * 200;
                                                $tsc = $d->tsc * 300;
                                                $f = $d->flexy;
                                                $t = $d->money + $f + $tsc + $tc;

                                                $totalc += $d->money;
                                                $tf += $f + $tsc + $tc;
                                            @endphp
                                            <tr>
                                                <td rowspan="2" style="text-wrap: nowrap;">{{ $d->c_date }}</td>
                                                <td>{{ $d->sbm }}</td>
                                                <td>{{ $d->sbs }}</td>
                                                                                <td>{{ $d->sbn }}</td>

                                                <td>{{ $tc }}</td>
                                                <td>{{ $tsc }}</td>
                                                <td>{{ $f }}</td>
                                                <td rowspan="2">{{ $t }}</td>
                                            </tr>
                                            <tr>
                                                <td colspan="3">{{ $d->money }}</td>
                                                <td colspan="3">{{ $tsc + $tc + $f }}</td>

                                            </tr>
                                        @endforeach
                                        <tr>
                                            <td colspan="1">المجموع</td>
                                            <td colspan="3">{{ $totalc }}</td>
                                            <td colspan="3">{{ $tf }}</td>
                                            <td>{{ $totalc + $tf }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <a href="{{ route('control') }}"><button class="btn btn-primary">طباعة</button></a>

                            </div>
                    </section>
                    
                    @endif
                    <section id="section-2" class="pt-5">

                        <div class="container-fluid" dir="rtl">
                            <br>
                            <form method="POST" action="{{ route('list') }}">
                                @csrf
                                <div class="row align-items-center">


                                    <div class="col-auto">
                                        <label for="exampleFormControlInput1" style="float: right"
                                            dir="rtl">يوم</label>
                                        <input type="date" class="form-control" id="game-date-time-text"
                                            name="start_date" value="{{ now()->setTimezone('T')->format('Y-m-d') }}">
                                        @error('start_date')
                                            <span class="text-danger error">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-auto">
                                        <label for="exampleFormControlInput1">&nbsp; </label>
                                        <select name="brigade" class="form-control" id="brigade" required>
                                            <option value="0">يوم كامل</option>
                                            <option value="1">صباح</option>
                                            <option value="2">مساء</optio>
                                            <option value="3">ليل</option
                                            <!--   @php

                                                for ($i = 1; $i <= 64; $i++) {
                                                    echo ' ';
                                            } @endphp
                                            > -->
                                        </select>
                                        @error('type_id')
                                            <span class="text-danger error">{{ $message }}</span>
                                        @enderror
                                    </div>


                                    <div class="col-auto">
                                        <label for="exampleFormControlInput1">&nbsp; </label>
                                        <br>
                                        <button type="submit" class="btn btn-primary mb-2"> متابعة</button>
                                    </div>

                                </div>
                            </form>
                    @if (Illuminate\Support\Facades\Auth::user()->id ==3)
                            <div class="row"  style="color: black" dir="rtl">
                                <div class="row multi-select-row">
                                    <div class="col-xs-offset-1 col-xs-4" style="width: 40%;">
                                      <h4 class="multi-select-heading">
                                      مخزون دفاتر جامع الأموال الرئيسي
                                      </h4>
                                    </div>
                                    <div class="col-xs-1 override-padding" style="width: 20%;"> </div>
                                    <div class="col-xs-4" style="width: 40%;">
                                      <h4 class="multi-select-heading">
                                       مخزون دفاتر جامع الأموال 
                                    <select hidden class="" required id="nameC" form="myform" required name="nameC">
                                        <option value="2">Caisse</option>
                                    </select>
                                      </h4>
                                    </div>
                                  </div>
                                  <div class="row multi-select-row">
                                    <div class="col-xs-offset-1 col-xs-4" style="width: 40%;">
                                      
                                      <div  style="display: inline; width: 100%"  class="custom-dropdown" data-tooltip="Selected items: 0">
                                        
                                        <select style="display: inline; width: 30%" id="left_box" name="canselect_code" data-tooltip="Selected items: 0" multiple="" class="custom-select form-control multi-select-box">
                                            <optgroup label="دفاتر 20دج">
                                                @foreach (App\Models\Carnet::where('status',1)->where('type',1)->get() as $k)
                                                <option value="{{$k->id}}">{{$k->name}}</option>
                                                @endforeach
                                            </optgroup> 
                                            
                                          </select>
                                    </div>
                                    <div  style="display: inline; width: 100%"  class="custom-dropdown1" data-tooltip="Selected items: 0">

                                      <select style="display: inline; width: 30%" id="left_box1" name="canselect_code" data-tooltip="Selected items: 0" multiple="" class="custom-select1 form-control multi-select-box">
                                        <optgroup label="دفاتر 25دج">
                                            @foreach (App\Models\Carnet::where('status',1)->where('type',2)->get() as $k)
                                            <option value="{{$k->id}}">{{$k->name}}</option>
                                            @endforeach                                        
                                        </optgroup>
                                      </select>
                                    </div>
                                    <div  style="display: inline; width: 100%"  class="custom-dropdown2" data-tooltip="Selected items: 0">

                                    <select style="display: inline; width: 30%" id="left_box2" name="canselect_code" data-tooltip="Selected items: 0" multiple="" class="custom-select2 form-control multi-select-box">
                                        <optgroup label="دفاتر 30دج">
                                            @foreach (App\Models\Carnet::where('status',1)->where('type',3)->get() as $k)
                                            <option value="{{$k->id}}">{{$k->name}}</option>
                                            @endforeach                                        
                                        </optgroup>                         
                                     </select>
                                    </div>
                                    </div>
                                  
                                    <div class="col-xs-1 override-padding" style="width: 20%;">
                                      <div class="multi-select-button-container">
                                        <input type="button" id="btnRight_multi" class="btn btn-warning btn-block" value=" >>> ">
                                        <br>
                                        <input type="button" id="btnRight_single" class="btn btn-default btn-block" value="  >">
                                        <br>
                                        <input type="button" id="btnLeft_single" class="btn btn-default btn-block" value="  <  ">
                                        <br>
                                        <input type="button" id="btnLeft_multi" class="btn btn-danger btn-block" value="<<<">
                                        <br><br>
                                        <input type="button" id="btn_reset" class="btn btn-secondary btn-block" value="reset">
                                        <br><br>
                                        <input type="submit" form="myform" id="btn_confirm" class="btn btn-success btn-block" value="confirm">
                                      </div>
                                    </div>
                                    <div class="col-xs-4" style="width: 40%;">
                                        <form method="POST" id="myform" action="{{ route('caisse') }}">
                                            @csrf
                                        <select style="display: inline; width: 30%" id="right_box" name="tc20[]" multiple="" class="form-control multi-select-box">
                                            <optgroup label="دفاتر 20دج">
                                                @foreach (App\Models\Carnet::where('status',2)->where('type',1)->get() as $k)
                                                <option value="{{$k->id}}" selected>{{$k->name}}</option>
                                                @endforeach
                                            </optgroup> 
                                            
                                          </select>
                                          <select style="display: inline; width: 30%" id="right_box1" name="tc25[]" multiple="" class="form-control multi-select-box">
                                            <optgroup label="دفاتر 25دج">
                                                @foreach (App\Models\Carnet::where('status',2)->where('type',2)->get() as $k)
                                                <option value="{{$k->id}}" selected>{{$k->name}}</option>
                                                @endforeach
                                            </optgroup>
                                          </select>
                                        <select style="display: inline; width: 30%" id="right_box2" name="tc30[]" multiple="" class="form-control multi-select-box">
                                            <optgroup label="دفاتر 30دج" >
                                                @foreach (App\Models\Carnet::where('status',2)->where('type',3)->get() as $k)
                                                <option value="{{$k->id}}" selected>{{$k->name}}</option>
                                                @endforeach
                                            </optgroup>                         
                                         </select>
                                        </form>
                                    </div>
                                    <div style="display:none">
                                      <select id="hidden_left_box"></select>
                                      <select id="hidden_left_box1"></select>
                                      <select id="hidden_left_box2"></select>
                                      <select id="hidden_right_box"></select>
                                      <select id="hidden_right_box1"></select>
                                      <select id="hidden_right_box2"></select>
                                    </div>
                                  </div>
                            </div>
                    @endif
                        </div>
                    </section>
                </div>
            </div>
        @else
            <br>
            @php
                $mnth = ['جانفي', 'فيفري', 'مارس', 'أفريل', 'ماي', 'جوان', 'جويلية', 'أوت', 'سبتمبر', 'أكتوبر', 'نوفمبر', 'ديسمبر'];
            @endphp
            <b style="font-size: 24px">مداخيل شهر {{ $mnth[$m - 1] }} {{ $day }}</b>
            <br>
            <div style="    display: inline-flex;
                                 color: black;
                          font-size: 16px;
                          flex-flow: nowrap;
                          font-size: 32px;"
                dir="rtl">البحث عن مداخيل
                &nbsp; &nbsp; <form method="post" action="{{ route('home') }}">
                    @csrf
                    <select name="month" style=>
                        @for ($i = 0; $i < 12; $i++)
                            <option value="{{ $i + 1 }}" {{ $m == $i + 1 ? 'selected' : '' }}>{{ $mnth[$i] }}
                            </option>
                        @endfor
                    </select>
                    <input type="submit" class="btn btn-secondary" value="ابحث">
                </form>
            </div>

            <div class="container" dir="rtl" style="color:black; height:100%; overflow:scroll">
                <div id="odometer" style="font-size: xxx-large" dir="ltr" class="odometer">0000000000</div>
                <div style="    position: relative;
                top: -53px;
                right: 145px;
                font-size: xx-large;"> دج</div>
                <table class="tbl" style="width:80%; overflow:scroll">
                    <thead style="background-color:lightgrey; font-size">
                        <tr>
                            <th rowspan="2" style="width:40px">يوم</th>
                            <th colspan="3">مداخيل التذاكر الكلاسيكية</th>
                            <th colspan="3">الدفع الالكتروني</th>
                            <th rowspan="2">القيمة الاجمالية </th>
                        </tr>
                        <tr>
                            <th>الفترة الصباحية</th>
                            <th>الفترة المسائية</th>

                                            <th>الفترة الليلية</th>
                            <th>مداخيل بطافة رحلات </th>
                            <th>مداخيل بطاقة المتمدرس </th>
                            <th>مداخيل التعبئة </th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $totalc = 0;
                            $tf = 0;
                            $tt = 0;
                        @endphp
                        @foreach ($data as $d)
                            @php
                                $tc = $d->tc * 200;
                                $tsc = $d->tsc * 300;
                                $f = $d->flexy;
                                $t = $d->money + $f + $tsc + $tc;
                                $tt += $t;

                                $tc = $d->tc * 200;
                                $tsc = $d->tsc * 300;
                                $f = $d->flexy;
                                $t = $d->money + $f + $tsc + $tc;

                                $totalc += $d->money;
                                $tf += $f + $tsc + $tc;
                            @endphp
                            <tr>
                                <td rowspan="2" style="text-wrap: nowrap;">{{ $d->c_date }}</td>
                                <td>{{ $d->sbm }}</td>
                                <td>{{ $d->sbs }}</td>
                                <td>{{ $d->sbn }}</td>
                                <td>{{ $tc }}</td>
                                <td>{{ $tsc }}</td>
                                <td>{{ $f }}</td>
                                <td rowspan="2">{{ $t }}</td>
                            </tr>
                            <tr>
                                <td colspan="3">{{ $d->money }}</td>
                                <td colspan="3">{{ $tsc + $tc + $f }}</td>

                            </tr>
                        @endforeach
                        <tr>
                            <td colspan="1">المجموع</td>
                            <td colspan="3">{{ $totalc }}</td>
                            <td colspan="3">{{ $tf }}</td>
                            <td>{{ $totalc +$tf  }}</td>
                        </tr>
                    </tbody>
                </table>
                <a href="{{ route('control') }}"><button class="btn btn-primary">طباعة</button></a>

                @if (Illuminate\Support\Facades\Auth::user()->id <= 2)
                    <a href="{{ route('control') }}"><button class="btn btn-primary">الاحصاء</button></a>
                @endif
            </div>





        @endif

        @include('layouts.footers.auth.footer')
    </div>
@endsection

@push('js')
    <script src="./assets/js/plugins/chartjs.min.js"></script>
    <script src="http://github.hubspot.com/odometer/odometer.js"></script>
    <script>
        // Get the select element
        var selectElement = document.getElementById("left_box");

        // Get the paragraph element to display the count
        var customDropdown = document.querySelector(".custom-dropdown");

        // Add an event listener to the select element
        selectElement.addEventListener("change", function() {
            // Get the selected options
            var selectedOptions = selectElement.selectedOptions;

            // Update the count and set the tooltip text
            var count = selectedOptions.length;
            customDropdown.dataset.tooltip = "Selected items: " + count;
        });


        var selectElement2 = document.getElementById("left_box2");

// Get the paragraph element to display the count
var customDropdown2 = document.querySelector(".custom-dropdown2");

// Add an event listener to the select element
selectElement2.addEventListener("change", function() {
    // Get the selected options
    var selectedOptions = selectElement2.selectedOptions;

    // Update the count and set the tooltip text
    var count = selectedOptions.length;
    customDropdown2.dataset.tooltip = "Selected items: " + count;
});

var selectElement1 = document.getElementById("left_box1");

// Get the paragraph element to display the count
var customDropdown1 = document.querySelector(".custom-dropdown1");

// Add an event listener to the select element
selectElement1.addEventListener("change", function() {
    // Get the selected options
    var selectedOptions = selectElement1.selectedOptions;

    // Update the count and set the tooltip text
    var count = selectedOptions.length;
    customDropdown1.dataset.tooltip = "Selected items: " + count;
});







var selectElementT = document.getElementById("Tleft_box");

// Get the paragraph element to display the count
var customDropdownT = document.querySelector(".custom-dropdownT");

// Add an event listener to the select element
selectElementT.addEventListener("change", function() {
    // Get the selected options
    var selectedOptions = selectElementT.selectedOptions;

    // Update the count and set the tooltip text
    var count = selectedOptions.length;
    customDropdownT.dataset.tooltip = "Selected items: " + count;
});


var selectElementT2 = document.getElementById("Tleft_box2");

// Get the paragraph element to display the count
var customDropdownT2 = document.querySelector(".custom-dropdownT2");

// Add an event listener to the select element
selectElementT2.addEventListener("change", function() {
// Get the selected options
var selectedOptions = selectElementT2.selectedOptions;

// Update the count and set the tooltip text
var count = selectedOptions.length;
customDropdownT2.dataset.tooltip = "Selected items: " + count;
});

var selectElementT1 = document.getElementById("Tleft_box1");

// Get the paragraph element to display the count
var customDropdownT1 = document.querySelector(".custom-dropdownT1");

// Add an event listener to the select element
selectElementT1.addEventListener("change", function() {
// Get the selected options
var selectedOptions = selectElementT1.selectedOptions;

// Update the count and set the tooltip text
var count = selectedOptions.length;
customDropdownT1.dataset.tooltip = "Selected items: " + count;
});
    </script>
    <script>
        /* Populates the hiddent selects for resetting */
        setTimeout(function(){
       odometer.innerHTML={{$totalc + $tf}};
  }, 1000)
 
$("#left_box").find('option').clone().appendTo('#hidden_left_box');
$("#left_box1").find('option').clone().appendTo('#hidden_left_box1');
$("#left_box2").find('option').clone().appendTo('#hidden_left_box2');
$("#right_box").find('option').clone().appendTo('#hidden_right_box');
$("#right_box1").find('option').clone().appendTo('#hidden_right_box1');
$("#right_box2").find('option').clone().appendTo('#hidden_right_box2');


/* Reset button handler */
$('#btn_reset').click(function (e) {
		$("#left_box").find('option').remove();
		$("#left_box1").find('option').remove();
		$("#left_box2").find('option').remove();
    $("#right_box").find('option').remove();
    $("#right_box1").find('option').remove();
    $("#right_box2").find('option').remove();
    $("#hidden_left_box").find('option').clone().appendTo('#left_box');
    $("#hidden_left_box1").find('option').clone().appendTo('#left_box1');
    $("#hidden_left_box2").find('option').clone().appendTo('#left_box2');
		$("#hidden_right_box").find('option').clone().appendTo('#right_box');
		$("#hidden_right_box1").find('option').clone().appendTo('#right_box1');
		$("#hidden_right_box2").find('option').clone().appendTo('#right_box2');
});

/* Double click hander */

$("#left_box").on('dblclick', 'option', function () {
  $("#left_box").find('option:selected').remove().appendTo('#right_box');
  var txt= $(this).text();
  var s = $("#right_box option").length-$("#hidden_right_box option").length;
  $('#s20').val(s);
  if (  $('#r20').val()) {
  $('#r20').val($('#r20').val()+'-'+txt);
    
  } else {
    $('#r20').val(txt)
  } ch(0)
});
$("#left_box1").on('dblclick', 'option', function () {
  $("#left_box1").find('option:selected').remove().appendTo('#right_box1');
  var txt= $(this).text();
  var s = $("#right_box1 option").length-$("#hidden_right_box1 option").length;
  $('#s25').val(s);
  if (  $('#r25').val()) {
  $('#r25').val($('#r25').val()+'-'+txt);
    
  } else {
    $('#r25').val(txt)
  } ch(0)
});
$("#left_box2").on('dblclick', 'option', function () {
  $("#left_box2").find('option:selected').remove().appendTo('#right_box2');
  var txt= $(this).text();
  var s = $("#right_box2 option").length-$("#hidden_right_box2 option").length;
  $('#s30').val(s);
  if (  $('#r30').val()) {
  $('#r30').val($('#r30').val()+'-'+txt);
    
  } else {
    $('#r30').val(txt)
  }
  ch(0)
});
Array.prototype.difference = function (a) {
            return this.filter(function (i) {
                return a.indexOf(i) < 0;
            });
        };
$("#right_box").on('dblclick', 'option', function () {
  $("#right_box").find('option:selected').remove().appendTo('#left_box');
  $("#right_box option").prop("selected", "selected");
   arr1 = [];
             arr2 = [];
            $.each($('#right_box option'), function () {
                arr1.push($(this).text());
            });
            $.each($('#hidden_right_box option'), function () {
                arr2.push($(this).text());
            });

             diff1 = arr1.difference(arr2);  
  $('#s20').val(diff1.length);
          
  $('#r20').val(diff1.join('-'));
  ch(0)
});
$("#right_box1").on('dblclick', 'option', function () {
  $("#right_box1").find('option:selected').remove().appendTo('#left_box1');
  $("#right_box1 option").prop("selected", "selected");
   arr1 = [];
             arr2 = [];
            $.each($('#right_box1 option'), function () {
                arr1.push($(this).text());
            });
            $.each($('#hidden_right_box1 option'), function () {
                arr2.push($(this).text());
            });

             diff1 = arr1.difference(arr2);
  $('#s25').val(diff1.length);
          
  $('#r25').val(diff1.join('-'));
  ch(0)
});
$("#right_box2").on('dblclick', 'option', function () {
  $("#right_box2").find('option:selected').remove().appendTo('#left_box2');
  $("#right_box2 option").prop("selected", "selected");
   arr1 = [];
             arr2 = [];
            $.each($('#right_box2 option'), function () {
                arr1.push($(this).text());
            });
            $.each($('#hidden_right_box2 option'), function () {
                arr2.push($(this).text());
            });

             diff1 = arr1.difference(arr2);
  $('#s30').val(diff1.length);
          
  $('#r30').val(diff1.join('-'));
  ch(0)
});

/* Button click handlers */

$('#btnRight_multi').click(function (e) {
    $("#left_box").find('option').remove().appendTo('#right_box');
    $("#left_box1").find('option').remove().appendTo('#right_box1');
    $("#left_box2").find('option').remove().appendTo('#right_box2');
    arr1 = [];
             arr2 = [];
            $.each($('#right_box option'), function () {
                arr1.push($(this).text());
            });
            $.each($('#hidden_right_box option'), function () {
                arr2.push($(this).text());
            });

             diff1 = arr1.difference(arr2);
  $('#s20').val(diff1.length);
          
  $('#r20').val(diff1.join('-'));
         arr1 = [];
             arr2 = [];
            $.each($('#right_box1 option'), function () {
                arr1.push($(this).text());
            });
            $.each($('#hidden_right_box1 option'), function () {
                arr2.push($(this).text());
            });

             diff1 = arr1.difference(arr2);
  $('#s25').val(diff1.length);
          
  $('#r25').val(diff1.join('-'));


   arr1 = [];
             arr2 = [];
            $.each($('#right_box2 option'), function () {
                arr1.push($(this).text());
            });
            $.each($('#hidden_right_box2 option'), function () {
                arr2.push($(this).text());
            });

            var diff1 = arr1.difference(arr2);
  $('#s30').val(diff1.length);
          
  $('#r30').val(diff1.join('-'));
  ch(0)
});

$('#btnRight_single').click(function (e) {
    $("#left_box").find('option:selected').remove().appendTo('#right_box');
    $("#left_box1").find('option:selected').remove().appendTo('#right_box1');
    $("#left_box2").find('option:selected').remove().appendTo('#right_box2');

    $(function () {
        arr1 = [];
             arr2 = [];
            $.each($('#right_box option'), function () {
                arr1.push($(this).text());
            });
            $.each($('#hidden_right_box option'), function () {
                arr2.push($(this).text());
            });

             diff1 = arr1.difference(arr2);
  $('#s20').val(diff1.length);
          
  $('#r20').val(diff1.join('-'));
         arr1 = [];
             arr2 = [];
            $.each($('#right_box1 option'), function () {
                arr1.push($(this).text());
            });
            $.each($('#hidden_right_box1 option'), function () {
                arr2.push($(this).text());
            });

             diff1 = arr1.difference(arr2);
  $('#s25').val(diff1.length);
          
  $('#r25').val(diff1.join('-'));


   arr1 = [];
             arr2 = [];
            $.each($('#right_box2 option'), function () {
                arr1.push($(this).text());
            });
            $.each($('#hidden_right_box2 option'), function () {
                arr2.push($(this).text());
            });

            var diff1 = arr1.difference(arr2);
  $('#s30').val(diff1.length);
          
  $('#r30').val(diff1.join('-'));
  ch(0)
        });
        Array.prototype.difference = function (a) {
            return this.filter(function (i) {
                return a.indexOf(i) < 0;
            });
        };
});

$('#btnLeft_single').click(function (e) {
    $("#right_box").find('option:selected').remove().appendTo('#left_box');
    $("#right_box1").find('option:selected').remove().appendTo('#left_box1');
    $("#right_box2").find('option:selected').remove().appendTo('#left_box2');
    $(function () {
             arr1 = [];
             arr2 = [];
            $.each($('#right_box option'), function () {
                arr1.push($(this).text());
            });
            $.each($('#hidden_right_box option'), function () {
                arr2.push($(this).text());
            });

             diff1 = arr1.difference(arr2);
  $('#s20').val(diff1.length);
          
  $('#r20').val(diff1.join('-'));
         arr1 = [];
             arr2 = [];
            $.each($('#right_box1 option'), function () {
                arr1.push($(this).text());
            });
            $.each($('#hidden_right_box1 option'), function () {
                arr2.push($(this).text());
            });

             diff1 = arr1.difference(arr2);
  $('#s25').val(diff1.length);
          
  $('#r25').val(diff1.join('-'));


   arr1 = [];
             arr2 = [];
            $.each($('#right_box2 option'), function () {
                arr1.push($(this).text());
            });
            $.each($('#hidden_right_box2 option'), function () {
                arr2.push($(this).text());
            });

            var diff1 = arr1.difference(arr2);
  $('#s30').val(diff1.length);
          
  $('#r30').val(diff1.join('-'));
  ch(0)
        });
        Array.prototype.difference = function (a) {
            return this.filter(function (i) {
                return a.indexOf(i) < 0;
            });
        };
});

$('#btnLeft_multi').click(function (e) {
    $("#right_box").find('option').remove().appendTo('#left_box');
    $("#right_box1").find('option').remove().appendTo('#left_box1');
    $("#right_box2").find('option').remove().appendTo('#left_box2');
    arr1 = [];
             arr2 = [];
            $.each($('#right_box option'), function () {
                arr1.push($(this).text());
            });
            $.each($('#hidden_right_box option'), function () {
                arr2.push($(this).text());
            });

             diff1 = arr1.difference(arr2);
  $('#s20').val(diff1.length);
          
  $('#r20').val(diff1.join('-'));
         arr1 = [];
             arr2 = [];
            $.each($('#right_box1 option'), function () {
                arr1.push($(this).text());
            });
            $.each($('#hidden_right_box1 option'), function () {
                arr2.push($(this).text());
            });

             diff1 = arr1.difference(arr2);
  $('#s25').val(diff1.length);
          
  $('#r25').val(diff1.join('-'));


   arr1 = [];
             arr2 = [];
            $.each($('#right_box2 option'), function () {
                arr1.push($(this).text());
            });
            $.each($('#hidden_right_box2 option'), function () {
                arr2.push($(this).text());
            });

            var diff1 = arr1.difference(arr2);
  $('#s30').val(diff1.length);
          
  $('#r30').val(diff1.join('-'));
  ch(0)    
});

$('#nameC').on( "change", function() {

var x = $('#nameC').val();
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
    
$.ajax({
    method: "GET",
    url: "/ticket_show/" + x,

}).done(function(data) {
    $("select[name='tc20[]']").html('');
    $("select[name='tc25[]']").html('');
    $("select[name='tc30[]']").html('');
    $("#hidden_right_box").html('');
    $("#hidden_right_box1").html('');
    $("#hidden_right_box2").html('');
    
    $("select[name='tc20[]']").html(data.options20);
    $("#hidden_right_box").html(data.options20);
    $("select[name='tc25[]']").html(data.options25);
    $("#hidden_right_box1").html(data.options25);
    $("select[name='tc30[]']").html(data.options30);
    $("#hidden_right_box2").html(data.options30);
}); 

} );
$("#Tleft_box").find('option').clone().appendTo('#hidden_Tleft_box');
$("#Tleft_box1").find('option').clone().appendTo('#hidden_Tleft_box1');
$("#Tleft_box2").find('option').clone().appendTo('#hidden_Tleft_box2');
$("#right_boxT").find('option').clone().appendTo('#hidden_right_boxT');
$("#right_boxT1").find('option').clone().appendTo('#hidden_right_boxT1');
$("#right_boxT2").find('option').clone().appendTo('#hidden_right_boxT2');


/* Reset button handler */
$('#btn_resetT').click(function (e) {
		$("#Tleft_box").find('option').remove();
		$("#Tleft_box1").find('option').remove();
		$("#Tleft_box2").find('option').remove();
    $("#right_boxT").find('option').remove();
    $("#right_boxT1").find('option').remove();
    $("#right_boxT2").find('option').remove();
    $("#hidden_Tleft_box").find('option').clone().appendTo('#Tleft_box');
    $("#hidden_Tleft_box1").find('option').clone().appendTo('#Tleft_box1');
    $("#hidden_Tleft_box2").find('option').clone().appendTo('#Tleft_box2');
		$("#hidden_right_boxT").find('option').clone().appendTo('#right_boxT');
		$("#hidden_right_boxT1").find('option').clone().appendTo('#right_boxT1');
		$("#hidden_right_boxT2").find('option').clone().appendTo('#right_boxT2');
});

/* Double click hander */

$("#Tleft_box").on('dblclick', 'option', function () {
  $("#Tleft_box").find('option:selected').remove().appendTo('#right_boxT');
  arr1 = [];
             arr2 = [];
            $.each($('#right_boxT option'), function () {
                arr1.push($(this).text());
            });
            $.each($('#hidden_right_boxT option'), function () {
                arr2.push($(this).text());
            });

             diff1 = arr1.difference(arr2);
  $('#t20').val(diff1.length);
  ch(0)    
});
$("#Tleft_box1").on('dblclick', 'option', function () {
  $("#Tleft_box1").find('option:selected').remove().appendTo('#right_boxT1');
 
         arr1 = [];
             arr2 = [];
            $.each($('#right_boxT1 option'), function () {
                arr1.push($(this).text());
            });
            $.each($('#hidden_right_boxT1 option'), function () {
                arr2.push($(this).text());
            });

             diff1 = arr1.difference(arr2);
  $('#t25').val(diff1.length);
          
  ch(0)
});

$("#Tleft_box2").on('dblclick', 'option', function () {
  $("#Tleft_box2").find('option:selected').remove().appendTo('#right_boxT2');
 
   arr1 = [];
             arr2 = [];
            $.each($('#right_boxT2 option'), function () {
                arr1.push($(this).text());
            });
            $.each($('#hidden_right_boxT2 option'), function () {
                arr2.push($(this).text());
            });

            var diff1 = arr1.difference(arr2);
  $('#t30').val(diff1.length);
  ch(0)
});
$("#right_boxT").on('dblclick', 'option', function () {
  $("#right_boxT").find('option:selected').remove().appendTo('#Tleft_box');
  $("#right_boxT option").prop("selected", "selected");
});
$("#right_boxT1").on('dblclick', 'option', function () {
  $("#right_boxT1").find('option:selected').remove().appendTo('#Tleft_box1');
  $("#right_boxT1 option").prop("selected", "selected");
  ch(0)
});
$("#right_boxT2").on('dblclick', 'option', function () {
  $("#right_boxT2").find('option:selected').remove().appendTo('#Tleft_box2');
  $("#right_boxT2 option").prop("selected", "selected");
  ch(0)
});

/* Button click handlers */

$('#btnRight_multiT').click(function (e) {
    $("#Tleft_box").find('option').remove().appendTo('#right_boxT');
    $("#Tleft_box1").find('option').remove().appendTo('#right_boxT1');
    $("#Tleft_box2").find('option').remove().appendTo('#right_boxT2');
    arr1 = [];
             arr2 = [];
            $.each($('#right_boxT option'), function () {
                arr1.push($(this).text());
            });
            $.each($('#hidden_right_boxT option'), function () {
                arr2.push($(this).text());
            });

             diff1 = arr1.difference(arr2);
  $('#t20').val(diff1.length);
          
         arr1 = [];
             arr2 = [];
            $.each($('#right_boxT1 option'), function () {
                arr1.push($(this).text());
            });
            $.each($('#hidden_right_boxT1 option'), function () {
                arr2.push($(this).text());
            });

             diff1 = arr1.difference(arr2);
  $('#t25').val(diff1.length);
          


   arr1 = [];
             arr2 = [];
            $.each($('#right_boxT2 option'), function () {
                arr1.push($(this).text());
            });
            $.each($('#hidden_right_boxT2 option'), function () {
                arr2.push($(this).text());
            });

            var diff1 = arr1.difference(arr2);
  $('#t30').val(diff1.length);
  ch(0)    
});

$('#btnRight_singleT').click(function (e) {
    $("#Tleft_box").find('option:selected').remove().appendTo('#right_boxT');
    $("#Tleft_box1").find('option:selected').remove().appendTo('#right_boxT1');
    $("#Tleft_box2").find('option:selected').remove().appendTo('#right_boxT2');
    arr1 = [];
             arr2 = [];
            $.each($('#right_boxT option'), function () {
                arr1.push($(this).text());
            });
            $.each($('#hidden_right_boxT option'), function () {
                arr2.push($(this).text());
            });

             diff1 = arr1.difference(arr2);
  $('#t20').val(diff1.length);
          
         arr1 = [];
             arr2 = [];
            $.each($('#right_boxT1 option'), function () {
                arr1.push($(this).text());
            });
            $.each($('#hidden_right_boxT1 option'), function () {
                arr2.push($(this).text());
            });

             diff1 = arr1.difference(arr2);
  $('#t25').val(diff1.length);
          


   arr1 = [];
             arr2 = [];
            $.each($('#right_boxT2 option'), function () {
                arr1.push($(this).text());
            });
            $.each($('#hidden_right_boxT2 option'), function () {
                arr2.push($(this).text());
            });

            var diff1 = arr1.difference(arr2);
  $('#t30').val(diff1.length);
  ch(0) 
});

$('#btnLeft_singleT').click(function (e) {
    $("#right_boxT").find('option:selected').remove().appendTo('#Tleft_box');
    $("#right_boxT1").find('option:selected').remove().appendTo('#Tleft_box1');
    $("#right_boxT2").find('option:selected').remove().appendTo('#Tleft_box2');
    arr1 = [];
             arr2 = [];
            $.each($('#right_boxT option'), function () {
                arr1.push($(this).text());
            });
            $.each($('#hidden_right_boxT option'), function () {
                arr2.push($(this).text());
            });

             diff1 = arr1.difference(arr2);
  $('#t20').val(diff1.length);
          
         arr1 = [];
             arr2 = [];
            $.each($('#right_boxT1 option'), function () {
                arr1.push($(this).text());
            });
            $.each($('#hidden_right_boxT1 option'), function () {
                arr2.push($(this).text());
            });

             diff1 = arr1.difference(arr2);
  $('#t25').val(diff1.length);
          


   arr1 = [];
             arr2 = [];
            $.each($('#right_boxT2 option'), function () {
                arr1.push($(this).text());
            });
            $.each($('#hidden_right_boxT2 option'), function () {
                arr2.push($(this).text());
            });

            var diff1 = arr1.difference(arr2);
  $('#t30').val(diff1.length);
  ch(0)
});
$('#btnLeft_multiT').click(function (e) {
    $("#right_boxT").find('option').remove().appendTo('#Tleft_box');
    $("#right_boxT1").find('option').remove().appendTo('#Tleft_box1');
    $("#right_boxT2").find('option').remove().appendTo('#Tleft_box2');
    arr1 = [];
             arr2 = [];
            $.each($('#right_boxT option'), function () {
                arr1.push($(this).text());
            });
            $.each($('#hidden_right_boxT option'), function () {
                arr2.push($(this).text());
            });

             diff1 = arr1.difference(arr2);
  $('#t20').val(diff1.length);
          
         arr1 = [];
             arr2 = [];
            $.each($('#right_boxT1 option'), function () {
                arr1.push($(this).text());
            });
            $.each($('#hidden_right_boxT1 option'), function () {
                arr2.push($(this).text());
            });

             diff1 = arr1.difference(arr2);
  $('#t25').val(diff1.length);
          


   arr1 = [];
             arr2 = [];
            $.each($('#right_boxT2 option'), function () {
                arr1.push($(this).text());
            });
            $.each($('#hidden_right_boxT2 option'), function () {
                arr2.push($(this).text());
            });

            var diff1 = arr1.difference(arr2);
  $('#t30').val(diff1.length);
          ch(0)
});
        checkCookie();

        function ck() {
            var x = document.getElementById("dd").value;
            var y = document.getElementById("brigad").value;
            var z = $("#name option:selected").text();
             document.getElementById("nameR").innerHTML = z;
             document.getElementById("nameRT").innerHTML = z;
             var z = $("#name").val();
             document.getElementById("nameC").value = z;
           setCookie("date", x, 365);
            setCookie("brigade", y, 365);
              
$.ajax({
    method: "GET",
    url: "/ticket_show/" + z,

}).done(function(data) {
    $("select[name='tc20[]']").html('');
    $("select[name='tc25[]']").html('');
    $("select[name='tc30[]']").html('');

    $("#r20").val('');
    $("#r25").val('');
    $("#r30").val('');
    $("#s20").val('');
    $("#s25").val('');
    $("#s30").val('');
    $("#t20").val('');
    $("#t25").val('');
    $("#t30").val('');
    $("#dette").val(0);
    $("#dettes").val(0);
    $("#odette").val(0);
    $("#recette").val(0);
    $("#somme").val(0);

    $("#left_box").find('option').remove();
		$("#left_box1").find('option').remove();
		$("#left_box2").find('option').remove();
    $("#right_box").find('option').remove();
    $("#right_box1").find('option').remove();
    $("#right_box2").find('option').remove();
    $("#hidden_left_box").find('option').clone().appendTo('#left_box');
    $("#hidden_left_box1").find('option').clone().appendTo('#left_box1');
    $("#hidden_left_box2").find('option').clone().appendTo('#left_box2');
		$("#hidden_right_box").find('option').clone().appendTo('#right_box');
		$("#hidden_right_box1").find('option').clone().appendTo('#right_box1');
		$("#hidden_right_box2").find('option').clone().appendTo('#right_box2');
    
    $("#hidden_right_box").html('');
    $("#hidden_right_box1").html('');
    $("#hidden_right_box2").html('');
    $("select[name='tc20[]']").html(data.options20);
    $("#hidden_right_box").html(data.options20);
    $("select[name='tc25[]']").html(data.options25);
    $("#hidden_right_box1").html(data.options25);
    $("select[name='tc30[]']").html(data.options30);
    $("#hidden_right_box2").html(data.options30);
  $("#right_box option").prop("selected", "selected");
  $("#right_box1 option").prop("selected", "selected");
  $("#right_box2 option").prop("selected", "selected");


  $("select[name='ttc20[]']").html('');
    $("select[name='ttc25[]']").html('');
    $("select[name='ttc30[]']").html('');
    $("#hidden_Tleft_box").html('');
    $("#hidden_Tleft_box1").html('');
    $("#hidden_Tleft_box2").html('');
    $("select[name='ttc20[]']").html(data.tickets20);
    $("#hidden_Tleft_box").html(data.tickets20);
    $("select[name='ttc25[]']").html(data.tickets25);
    $("#hidden_Tleft_box1").html(data.tickets25);
    $("select[name='ttc30[]']").html(data.tickets30);
    $("#hidden_Tleft_box2").html(data.tickets30);
  /*
   $("#Tleft_box option").prop("selected", "selected");
  $("#Tleft_box1 option").prop("selected", "selected");
  $("#Tleft_box2 option").prop("selected", "selected");*/


  $("select[name='tt20[]']").html('');
    $("select[name='tt25[]']").html('');
    $("select[name='tt30[]']").html('');
}); 
$.ajax({
    method: "GET",
    url: "/dette/" + z,

}).done(function(data) {
    if (data) {
        $("#odette").val(data);
    } else {
        $("#odette").val(0);
    }
   
}); 
        }

        function setCookie(cname, cvalue, exdays) {
            const d = new Date();
            d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
            let expires = "expires=" + d.toUTCString();
            document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
        }

        function getCookie(cname) {
            let name = cname + "=";
            let ca = document.cookie.split(';');
            for (let i = 0; i < ca.length; i++) {
                let c = ca[i];
                while (c.charAt(0) == ' ') {
                    c = c.substring(1);
                }
                if (c.indexOf(name) == 0) {
                    return c.substring(name.length, c.length);
                }
            }
            return "";
        }

        function checkCookie() {
            var user = getCookie("date");
            if (user != "") {
                document.getElementById("dd").value = user;
                document.getElementById("name").focus();
            } else {
                document.getElementById("dd").focus();
            }
            var br = getCookie("brigade");
            if (br != "") {
                document.getElementById("brigad").value = br;
            } else {
                document.getElementById("dd").focus();
            }
        }

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
            document.getElementById("dette").value = parseInt(document.getElementById("odette").value) + xs * 100 - x + ys * 100 - y + zs * 100 - z;
            document.getElementById("dettes").value = parseInt(document.getElementById("odette").value) + xs * 100 - x + ys * 100 - y + zs * 100 - z;
        }

        function empty() {
            if (document.getElementById("t20").value == "") {
                document.getElementById("t20").value = 0;
            }
            if (document.getElementById("t25").value == "") {
                document.getElementById("t25").value = 0;
            }
            if (document.getElementById("t30").value == "") {
                document.getElementById("t30").value = 0;
            }
            if (document.getElementById("s20").value == "") {
                document.getElementById("s20").value = 0;
            }
            if (document.getElementById("s25").value == "") {
                document.getElementById("s25").value = 0;
            }
            if (document.getElementById("s30").value == "") {
                document.getElementById("s30").value = 0;
            }
            if (document.getElementById("flexy").value == "") {
                document.getElementById("flexy").value = 0;
            }
        }
 
    </script>
    <!-- partial -->
    <script src='https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.min.js'></script>
    <script src='https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js'></script>

    <script>
        $(document).ready(function() {
            /*
            $(".nav").on("mouseenter", "li", function () {  $(this).addClass("hover").siblings().removeClass("hover");}); 
              */
            $(".nav").on("click", "li", function() {
                $(this).addClass("active").siblings().removeClass("active");
            });
        });

        const tooltipTriggerList = document.querySelectorAll(
            '[data-bs-toggle="tooltip"]'
        );
        const tooltipList = [...tooltipTriggerList].map(
            (tooltipTriggerEl) => new bootstrap.Tooltip(tooltipTriggerEl)
        );

        window.addEventListener("DOMContentLoaded", (event) => {
            // Toggle the side navigation
            const sidebarToggle = document.body.querySelector("#sidebarToggle");
            if (sidebarToggle) {
                sidebarToggle.addEventListener("click", (event) => {
                    event.preventDefault();
                    document.body.classList.toggle("sb-sidenav-toggled");
                    localStorage.setItem(
                        "sb|sidebar-toggle",
                        document.body.classList.contains("sb-sidenav-toggled")
                    );
                    // content will slide on left
                    const content = document.getElementById("page-content-wrapper");
                    content.classList.toggle("left");
                });
            }
        });
    </script>
@endpush

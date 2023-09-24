@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])
<link href="https://fonts.googleapis.com/css?family=Lora" rel="stylesheet">
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
</style>
@section('content')
<div class="container-fluid py-1">
    <div class="row">
        @if(Illuminate\Support\Facades\Auth::user()->id>2)


        @else
        {{--  @include('layouts.navbars.auth.topnav', ['title' => 'الرئيسية'])
        @include('layouts.navbars.auth.sidenav')
--}}


        @endif
        @if(isset($add))
        <script>
        alert('تمت العملية بنجاح')
        </script>
        @endif
    </div>

    @if(Illuminate\Support\Facades\Auth::user()->id>2)

    <div class="d-flex" id="wrapper">
        <!-- Sidebar-->
        <div class="" id="sidebar-wrapper">
            <a href="//etus22.dz" style="color:#F1DEC9;" class="d-block p-3 text-center text-decoration-none logo mb-4"
                title="الموقع الرسمي" data-bs-toggle="tooltip" data-bs-placement="right">
                <i class="bi bi-browser-chrome" style="font-size:27px;"></i>
            </a>

            <ul class="nav flex-column mb-auto text-center">
                @if(Illuminate\Support\Facades\Auth::user()->id>3)
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
            @if(Illuminate\Support\Facades\Auth::user()->id>3)

            <!-- Page content-->
            <section id="section-1" class="pt-5">
                <div class="container-fluid">


                    <form action="{{ route('recette') }}" dir="rtl" style="margin-left:10px; margin-top:10px;
            z-index: 99;
            position: relative;
            font-size: 25px;">

                        <input type="date" name="date" value="{{$today}}">
                        <select name="brigade" id="brigade" required>
                            <option value="">-- الفترة --</option>
                            <option value="1">صباح</option>
                            <option value="2">مساء</option>
                            <!--   @php
        
                for($i=1; $i<=64 ; $i++){ echo " " ; } @endphp<option value="3">ليل</option> -->
                        </select>
                        <br>
                        <br>
                        <div class="row">
                            <div class="col-1">
                                <label dir="rtl" for="receveur">القابض</label>

                            </div>
                            <div class="col-4">
                                <select name="name" id="name" required>
                                    <option value="">-- القابض --</option>
                                    @foreach($kabids as $kabid)
                                    <option value="{{$kabid->id}}">{{$kabid->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-1">
                                <label dir="rtl" for="receveur">التعبئة</label>
                            </div>

                            <div class="col-4">


                                <input type="number" name="flexy" id="flexy">
                            </div>
                            <div class="col-1">
                                <label dir="rtl" for="rotation">rotation</label>
                            </div>

                            <div class="col-4">


                                <input type="number" name="rotation" id="rotation">
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

                                                @foreach($lignes as $ligne)
                                                <option value="{{$ligne->id}}">{{$ligne->name}}</option>
                                                @endforeach
                                            </select></td>
                                        <td><select name="bus_id" id="bus_id" required>

                                                <option value="">-- الحافلة --</option>
                                                @foreach($buses as $bus)
                                                <option value="{{$bus->id}}">{{$bus->name}}</option>
                                                @endforeach
                                            </select></td>
                                        <td><select name="type" id="type" required>

                                                <option value="">-- اختر --</option>
                                                <option value="1">A</option>
                                                <option value="2">B</option>
                                                <option value="3">C</option>
                                                <option value="4">D</option>
                                            </select></td>

                                        <td><input type="number" onkeyup="ch(1)" style="width:80px" name="t20" id="t20">
                                        </td>
                                        <td><input type="number" onkeyup="ch(2)" style="width:80px" name="t25" id="t25">
                                        </td>
                                        <td><input type="number" onkeyup="ch(3)" style="width:80px" name="t30" id="t30">
                                        </td>
                                        <td><input type="number" onkeyup="ch(4)" style="width:80px" name="s20" id="s20">
                                        </td>
                                        <td><input type="number" onkeyup="ch(5)" style="width:80px" name="s25" id="s25">
                                        </td>
                                        <td><input type="number" onkeyup="ch(6)" style="width:80px" name="s30" id="s30">
                                        </td>
                                        <td><input type="text" style="width:100px" name="r20" id="r20"></td>
                                        <td><input type="text" style="width:100px" name="r25" id="r25"></td>
                                        <td><input type="text" style="width:100px" name="r30" id="r30"></td>
                                    </tr>
                                </tbody>
                            </table>
                            <br>
                            المداخيل
                            <input type="number" name="somme" id="somme" disabled>
                            <input type="hidden" name="recette" id="recette">
                            الديون
                            <input type="number" name="dette" id="dette" disabled>
                            <input type="hidden" name="dettes" id="dettes">
                            <input type="submit" onclick="empty()" value="تأكيد">
                        </div>
                    </form>
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
                                <label for="exampleFormControlInput1" style="float: right" dir="rtl">يوم</label>
                                <input type="date" class="form-control" id="game-date-time-text" name="start_date"
                                    value="{{ now()->setTimezone('T')->format('Y-m-d') }}">
                                @error('start_date') <span class="text-danger error">{{ $message }}</span>@enderror
                            </div>

                            <div class="col-auto">
                                <label for="exampleFormControlInput1">&nbsp; </label>
                                <select name="brigade" class="form-control" id="brigade" required>
                                    <option value="0">يوم كامل</option>
                                    <option value="1">صباح</option>
                                    <option value="2">مساء</option>
                                    <!--   @php

for($i=1; $i<=64 ; $i++){ echo " " ; } @endphp<option value="3">ليل</option> -->
                                </select>
                                @error('type_id') <span class="text-danger error">{{ $message }}</span>@enderror
                            </div>


                            <div class="col-auto">
                                <label for="exampleFormControlInput1">&nbsp; </label>
                                <br>
                                <button type="submit" class="btn btn-primary mb-2"> متابعة</button>
                            </div>

                        </div>
                    </form>
                </div>
            </section>
        </div>
    </div>

    @else
    <br>
    @php
    $mnth = ['جانفي','فيفري','مارس','أفريل','ماي','جوان','جويلية','أوت','سبتمبر','أكتوبر','نوفمبر','ديسمبر'];
    @endphp
    <b style="font-size: 24px">مداخيل شهر {{$mnth[$m-1]}} ليوم {{$day}}</b>


    <div class="container" dir="rtl" style="color:black">
        <table class="tbl" style="width:80%">
            <thead style="background-color:lightgrey; font-size">
                <th rowspan="2"  style="width:40px">يوم</th>
                <th  colspan="2">مداخيل التذاكر الكلاسيكية</th>
                <th >الفترة الصباحية</th>
                <th >الفترة المسائية</th>
                <th colspan="3" >الدفع الالكتروني</th>
                <th>مداخيل بطافة رحلات </th>
                <th>مداخيل بطاقة المتمدرس </th>
                <th>مداخيل التعبئة </th>
                <th rowspan="2">القيمة الاجمالية </th>
            </thead>
            <tbody>
                @php
                $tt = 0;
                @endphp
                @foreach($data as $d)
                @php
                $t=$d->money+$d->flexy;
                $tt+=$t;
                @endphp
                <tr>
                    <td style="text-wrap: nowrap;">{{$d->c_date}}</td>
                    <td>{{$d->money}}</td>
                    <td>{{$d->sbm}}</td>
                    <td>{{$d->sbs}}</td>
                    <td>{{$d->flexy}}</td>
                    <td>{{$t}}</td>
                </tr>
                @endforeach
                <tr>
                    <td colspan="5">المجموع</td>
                    <td>{{$tt}}</td>
                </tr>
            </tbody>
        </table>
        <a href="{{route('control')}}"><button class="btn btn-primary">طباعة</button></a>

        @if(Illuminate\Support\Facades\Auth::user()->id==2)
        <a href="{{route('control')}}"><button class="btn btn-primary">الاحصاء</button></a>
        @endif
    </div>





    @endif

    @include('layouts.footers.auth.footer')
</div>
@endsection

@push('js')

<script src="./assets/js/plugins/chartjs.min.js"></script>

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
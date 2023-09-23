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
@section('content')
<div class="container-fluid py-1">
    <div class="row">
        @if(Illuminate\Support\Facades\Auth::user()->id>2)


        @else
        @include('layouts.navbars.auth.topnav', ['title' => 'الرئيسية'])
        @include('layouts.navbars.auth.sidenav')


        @endif
        @if(isset($ctrl_b))
        <script>
        alert('انت تراقب الحافلة {{$buses[$ctrl_b]->name}}')
        </script>
        @endif
    </div>

    @if(Illuminate\Support\Facades\Auth::user()->id>2)
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
                <select  name="name" id="name" required>
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

            
            <input type="number"  name="flexy" id="flexy">
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

                        <td><input type="number" onkeyup="ch(1)" style="width:80px" name="t20" id="t20"></td>
                        <td><input type="number" onkeyup="ch(2)" style="width:80px" name="t25" id="t25"></td>
                        <td><input type="number" onkeyup="ch(3)" style="width:80px" name="t30" id="t30"></td>
                        <td><input type="number" onkeyup="ch(4)" style="width:80px" name="s20" id="s20"></td>
                        <td><input type="number" onkeyup="ch(5)" style="width:80px" name="s25" id="s25"></td>
                        <td><input type="number" onkeyup="ch(6)" style="width:80px" name="s30" id="s30"></td>
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
@endpush
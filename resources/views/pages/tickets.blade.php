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

    .odometer {
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



        <div class="d-flex" id="wrapper">
            <!-- Sidebar-->

            <!-- Page content wrapper-->
            <div id="page-content-wrapper">

                    <!-- Page content-->
                    <section id="section-1" class="pt-5" dir="rtl">
                        <div class="container-fluid">



                            <br>
                            <br>
                            <div class="row">
                                <div class="col-2">
                                    <label dir="rtl" style="font-size: 22px" for="receveur">القابض</label>

                                </div>
                                <div class="col-5">
                                    <select name="name" style="font-size: 18px" onchange="ck();" id="name" required>
                                        <option value="">-- القابض --</option>
                                        @foreach ($kabids as $kabid)
                                            <option value="{{ $kabid->id }}">{{ $kabid->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                            </div>
                            <div>

                                <br>
                                الديون القديمة
                                <input type="number" name="dette" id="odette" disabled value="0">

                                <div class="row" style="color: black" dir="rtl">
                                    
                                    <div class="col-sm-12 col-lg-5">
                                        <h4 class="multi-select-heading" style="position: relative">
                                            الدفاتر الخاصة ب <span id="nameR"></span>

                                            <input type="hidden" id="nameC" required name="nameC">

                                        </h4>
                                        <div class="">
                                            <select style="display: inline; width: 32%" id="right_box" name="tc20[]"
                                                multiple="" class="form-control multi-select-box">
                                                <optgroup label="دفاتر 20دج">

                                                </optgroup>

                                            </select>
                                            <select style="display: inline; width: 32%" id="right_box1" name="tc25[]"
                                                multiple="" class="form-control multi-select-box">
                                                <optgroup label="دفاتر 25دج">

                                                </optgroup>
                                            </select>
                                            <select style="display: inline; width: 32%" id="right_box2" name="tc30[]"
                                                multiple="" class="form-control multi-select-box">
                                                <optgroup label="دفاتر 30دج">

                                                </optgroup>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-lg-2 " > </div>
                                    <div class="col-sm-12 col-lg-5">
                                        <h4 class="multi-select-heading">
                                            التذاكر الخاصة ب <span id="nameRT"></span>
                                        </h4>
                                        <div class="">
                                            <div style="display: inline; width: 100%" class="custom-dropdownT"
                                                data-tooltip="Selected items: 0">

                                                <select style="display: inline; width: 32%" id="Tleft_box" name="ttc20[]"
                                                    data-tooltip="Selected items: 0" multiple=""
                                                    class="custom-selectT form-control multi-select-box">
                                                    <optgroup label="تذاكر 20دج">

                                                    </optgroup>

                                                </select>
                                            </div>
                                            <div style="display: inline; width: 100%" class="custom-dropdownT1"
                                                data-tooltip="Selected items: 0">

                                                <select style="display: inline; width: 32%" id="Tleft_box1" name="ttc25[]"
                                                    data-tooltip="Selected items: 0" multiple=""
                                                    class="custom-selectT1 form-control multi-select-box">
                                                    <optgroup label="تذاكر 25دج">

                                                    </optgroup>
                                                </select>
                                            </div>
                                            <div style="display: inline; width: 100%" class="custom-dropdownT2"
                                                data-tooltip="Selected items: 0">

                                                <select style="display: inline; width: 32%" id="Tleft_box2" name="ttc30[]"
                                                    data-tooltip="Selected items: 0" multiple=""
                                                    class="custom-selectT2 form-control multi-select-box">
                                                    <optgroup label="تذاكر 30دج">

                                                    </optgroup>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <br>
                            <br>


            </div>
        </div>


    </div>
@endsection

@push('js')
    <script src="./assets/js/plugins/chartjs.min.js"></script>
    <script src="http://github.hubspot.com/odometer/odometer.js"></script>
    <script>
        // Get the select element

        $('#nameC').on("change", function() {

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

        });

        function ck() {
            var z = $("#name option:selected").text();
            document.getElementById("nameR").innerHTML = z;
            document.getElementById("nameRT").innerHTML = z;
            var z = $("#name").val();
            document.getElementById("nameC").value = z;

            $.ajax({
                method: "GET",
                url: "/ticket_show/" + z,

            }).done(function(data) {
                $("select[name='tc20[]']").html('');
                $("select[name='tc25[]']").html('');
                $("select[name='tc30[]']").html('');
                $("#dette").val(0);
                $("#dettes").val(0);
                $("#odette").val(0);

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
           setTimeout(function () {
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
}, 10000);
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
            document.getElementById("dette").value = parseInt(document.getElementById("odette").value) + xs * 100 - x + ys *
                100 - y + zs * 100 - z;
            document.getElementById("dettes").value = parseInt(document.getElementById("odette").value) + xs * 100 - x +
                ys * 100 - y + zs * 100 - z;
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

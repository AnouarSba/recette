<link rel="stylesheet" href="{{ asset('assets/css/adminlte.min.css') }}">

<div class="col-md-12">
    <div class="row justify-content-center">
        <div class="col-md-12 py-2">

            <div class="card" style="background-color: rgb(120, 144, 230)">
                <div class="card-header">
                    <h3>{{ __('ETAT') }}</h3>
                </div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif
                    <form method="POST" id="form" action="{{ route('etat') }}">
                        @csrf
                        <div class="form-row align-items-center">


                            <div class="col-auto">
                                <label for="exampleFormControlInput1">De</label>
                                <input type="date" class="form-control" id="start_date" name="start_date"
                                    value="{{ now()->setTimezone('T')->format('Y-m-d') }}">
                                @error('start_date') <span class="text-danger error">{{ $message }}</span>@enderror
                            </div>
                            <div class="col-auto">
                                <label for="exampleFormControlInput1">A</label>
                                <input type="date" class="form-control" id="end_date" name="end_date"
                                    value="{{ now()->setTimezone('T')->format('Y-m-d') }}">
                                @error('end_date') <span class="text-danger error">{{ $message }}</span>@enderror
                            </div>
                            <input type="hidden" name="month" id="month">
                            <input type="hidden" name="day" id="day">
                            <input type="hidden" name="day2" id="day2">
                            <input type="hidden" name="year" id="year">
<!--    
                            <div class="col-auto">
                                <label for="exampleFormControlInput1">&nbsp; </label>
                                <select name="brigade" class="form-control" id="brigade" required>
                                   <!-- <option value="0">يوم كامل</option>--
                                    <option value="1">صباح</option>
                                    <option value="2">مساء</option>
                                    <!--   php

        for($i=1; $i<=64 ; $i++){ echo " " ; } endphp<option value="3">ليل</option> --
                                </select> 
                                error('type_id') <span class="text-danger error">{{-- $message --}}</span>enderror
                            </div> -->


                            <div class="col-auto">
                                <label for="exampleFormControlInput1">&nbsp; </label>
                                <br>
                                <button type="button" onclick="check()" class="btn btn-primary mb-2"> Envoyer</button>
                            </div>

                        </div>
                    </form>

                </div>
            </div>

        </div>
        <div class="col-12" style="display: contents;">
            <a href="/"> <button type="button" class="btn btn-primary mb-2"> Retour</button></a>
        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<script>
    function check() {
        const d = new Date($('#start_date').val());
        const d2 = new Date($('#end_date').val());
let month = d.getMonth();
let month2 = d2.getMonth();
let year = d.getFullYear();
let year2 = d2.getFullYear();
let day = d.getDate();
let day2 = d2.getDate();
        if (month == month2 && year == year2) {
            $('#month').val(month);
            $('#day').val(day);
            $('#day2').val(day2);
            $('#year').val(year);
            $('#form').submit();
        } else {
            alert('يرجى تحديد تواريخ من نفس الشهر')
        }
}
</script>
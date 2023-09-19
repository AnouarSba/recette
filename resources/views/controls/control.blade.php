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
                    <form method="POST" action="{{ route('etat') }}">
                        @csrf
                        <div class="form-row align-items-center">


                            <div class="col-auto">
                                <label for="exampleFormControlInput1">Le</label>
                                <input type="date" class="form-control" id="game-date-time-text" name="start_date"
                                    value="{{ now()->setTimezone('T')->format('Y-m-d') }}">
                                @error('start_date') <span class="text-danger error">{{ $message }}</span>@enderror
                            </div>



                            <div class="col-auto">
                                <label for="exampleFormControlInput1"> </label>
                                <br>
                                <button type="submit" class="btn btn-primary mb-2"> Envoyer</button>
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
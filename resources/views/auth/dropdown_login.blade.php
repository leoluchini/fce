<div class="dropup{{ $errors->has('email') ? ' open' : '' }}">
    <button class="btn btn-link dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Iniciar sesi&oacute;n
    </button>
    <div class="dropdown-menu dropdown-login" aria-labelledby="dropdownMenu2">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                @include('auth.login_form')
            </div>
        </div>
    </div>
</div>
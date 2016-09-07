<div class="dropup{{ $errors->has('email') ? ' open' : '' }}">
    <button class="btn btn-link dropdown-toggle iniciar_sesion" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <span class="icon-login-1"></span>
        Iniciar sesi&oacute;n
    </button>
    <div class="dropdown-menu dropdown-login" aria-labelledby="dropdownMenu2" id="form_login">

            <div class="col-xs-12">
                @include('auth.login_form')
            </div>

    </div>
</div>
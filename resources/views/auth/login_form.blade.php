{!! Form::open(['url' => '/login', 'method' => 'post', 'class' => 'form-horizontal']) !!}
    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
        <label class="sr-only" for="exampleInputEmail2">Email</label>
        <input type="email" name="email" class="form-control" placeholder="Email" required>
        @if ($errors->has('email'))
            <span class="help-block">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
        @endif
    </div>
    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
        <label class="sr-only">Password</label>
        <input type="password" class="form-control" name="password" id="exampleInputPassword2" placeholder="Password" required>
        @if ($errors->has('password'))
            <span class="help-block">
                <strong>{{ $errors->first('password') }}</strong>
            </span>
        @endif
    </div>
    <div class="checkbox">
        <label>
        <input type="checkbox" name="remember"> Recordarme
        </label>
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-primary btn-block">
            <span class="glyphicon glyphicon-log-in"></span> Iniciar
        </button>
        <a class="btn btn-link" href="{{ url('/password/reset') }}">Olvidó su clave?</a>
    </div>
{!! Form::close() !!}
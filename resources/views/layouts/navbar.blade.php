
<header class="header">
    <div class="container">
        <div class="logo">
            <a href="/"><img src="images/logo.gif" alt=""></a>
        </div>
        @if (Auth::guest())
            <a class="out popup-trigger" href="#" id="login">Login</a>
            <a class="out popup-trigger" href="#" id="register">Register</a>
        @else
            <nav class="nav">
                <ul>
                    <li class="active">
                        @include('app.tasks')
                    </li>
                    <li class="active">
                        @include('app.notifications')
                    </li>
                </ul>
            </nav>
            <div class="user_in"><p>{{Auth::user()->name}} {{Auth::user()->surname}}</p></div>
            <div class="header__date">
                <p class="date">May 28, 2017</p>
                <p class="time">15:50</p>
            </div>
            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="out">Log out</a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">{{ csrf_field() }}</form>
        @endif
  </div>
</header>
<div class="popup reset">
    <strong>Remember password</strong>
    <div class="close"></div>
    <div class="content">
        <form class="form-horizontal" method="POST" action="{{ route('password.email') }}">
            {{ csrf_field() }}

            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                <label for="email" class="col-md-4 control-label">E-Mail Address</label>
                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
            </div>

            <div class="form-group">
                <div class="col-md-6 col-md-offset-4">
                    <input type="submit" class="btn btn-primary" value="Send Password Reset Link">

                </div>
            </div>
        </form>
    </div>
</div>
<div class="popup login">
    <strong>Login</strong>
    <div class="close"></div>
    <div class="content">
        <form class="form-horizontal" method="POST" action="{{ route('login') }}">
            {{ csrf_field() }}

            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif

            </div>

            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                <label for="password" class="col-md-4 control-label">Password</label>
                <input id="password" type="password" class="form-control" name="password" required>

                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
            </div>

            <div class="form-group">
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                    </label>
                </div>
            </div>

            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Login">
                <a class="btn btn-link popup-trigger" href="#" id="reset">Forgot Your Password?</a>
            </div>
        </form>
    </div>
</div>
<div class="popup register">
    <strong>Register</strong>
    <div class="close"></div>
    <div class="content">
        <form class="" method="POST" action="{{ route('register') }}">
            {{ csrf_field() }}

            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                <label for="name" class="control-label">Name</label>
                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>
                @if ($errors->has('name'))
                    <span class="help-block">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group{{ $errors->has('surname') ? ' has-error' : '' }}">
                <label for="name" class="control-label">Surame</label>


                    <input id="surname" type="text" class="form-control" name="surname" value="{{ old('surname') }}" required autofocus>

                    @if ($errors->has('surname'))
                        <span class="help-block">
                            <strong>{{ $errors->first('surname') }}</strong>
                        </span>
                    @endif
            </div>
            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                <label for="email" class="control-label">E-Mail Address</label>


                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
            </div>
            <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                <label for="email" class="control-label">Phone number</label>


                    <input id="phone" type="phone" class="form-control" name="phone" value="{{ old('phone') }}" required>

                    @if ($errors->has('phone'))
                        <span class="help-block">
                            <strong>{{ $errors->first('phone') }}</strong>
                        </span>
                    @endif
            </div>

            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                <label for="password" class="control-label">Password</label>


                    <input id="password" type="password" class="form-control" name="password" required>

                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
            </div>

            <div class="form-group">
                <label for="password-confirm" class="control-label">Confirm Password</label>
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
            </div>

            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Register"/>
            </div>
        </form>
    </div>
</div>

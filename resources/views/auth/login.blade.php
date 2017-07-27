@extends('auth.master')

@section('content')

<div>
    <div class="login_wrapper">
        <div class="form">
            <section class="login_content">
                <form role="form" method="POST" action="{{ route('login') }}">
                    {{ csrf_field() }}
                    <h1>Login</h1>
                    <div><input type="email" id="email" name="email" value="{{ old('email') }}" class="form-control" placeholder="Email" autofocus required></div>
                    <div><input type="password" id="password" name="password" class="form-control" placeholder="Password" required></div>
                    <div>
                        <button type="submit" class="btn btn-default submit">login</button>
                        <a class="reset_pass" href="{{url('password/reset')}}">Lost your password?</a>
                    </div>
                    <div class="clearfix"></div>
                    <div class="separator">
                        <p class="change_link">New to site?
                            <a href="{{url('register')}}" class="to_register"> Create Account </a>
                        </p>
                        <div class="clearfix"></div>
                        <br>
                    </div>
                </form>
            </section>
        </div>
    </div>
</div>

@endsection
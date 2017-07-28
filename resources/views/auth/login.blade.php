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
                        <button type="submit" class="btn btn-default pull-left">Login</button>
                        <p style="margin-right: 0px;" class="reset_pass">Lost your password?
                        <a href="{{url('password/reset')}}"> <b>Recover</b></a>
                        </p>
                    </div>
                    <div class="clearfix"></div>
                    <div class="separator">
                        <p class="change_link text-right">New to site?
                            <a style="margin-right: 0px;" href="{{url('register')}}" class="to_register"> <b>Create Account</b></a>
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
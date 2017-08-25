@extends('auth.master')

@section('content')

<div>
    <div class="login_wrapper">
        <div id="register" class="form">
            <section class="login_content">
                <form role="form" method="POST" action="{{ route('register') }}">
                    {{ csrf_field() }}
                    <h1>Create Account</h1>
                    <div><input type="text" id="name" name="name" value="{{ old('name') }}" class="form-control" placeholder="Name" autofocus required></div>
                    <div><input type="email" id="email" name="email"  value="{{ old('email') }}" class="form-control" placeholder="Email" required></div>
                    <div><input type="password" id="password" name="password" class="form-control" placeholder="Password" required></div>
                    <div><input type="password" id="password-confirm" name="password_confirmation" class="form-control" placeholder="Confirm Password" required></div>
                    <div>
                        <button type="submit" class="btn btn-default submit">Register</button>
                    </div>
                    <div class="clearfix"></div>
                    <div class="separator">
                        <p class="change_link">Already a member ?
                            <a href="{{url('login')}}" class="to_register"> <b>Log in</b></a>
                        </p>
                        <div class="clearfix"></div>
                    </div>
                </form>
            </section>
        </div>
    </div>
</div>

@endsection
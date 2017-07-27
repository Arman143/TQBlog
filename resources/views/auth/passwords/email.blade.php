@extends('auth.master')

@section('content')

<div>
    <div class="login_wrapper">
        <div id="register" class="form">
            <section class="login_content">
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif
                <form role="form" method="POST" action="{{ route('password.email') }}">
                    {{ csrf_field() }}
                    <h1>Reset Password</h1>
                    <div><input type="email" id="email" name="email" class="form-control" value="{{ old('email') }}" placeholder="Email" required></div>
                    <div>
                        <button type="submit" class="btn btn-default submit">Send Password Reset Link</button>
                    </div>
                    <div class="clearfix"></div>
                    <div class="separator">
                        <p class="change_link">Already a member ?
                            <a href="{{url('login')}}" class="to_register"> Log in </a>
                        </p>
                        <div class="clearfix"></div>
                    </div>
                </form>
            </section>
        </div>
    </div>
</div>

@endsection
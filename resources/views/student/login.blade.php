@extends('layouts.loginheader')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 ">
            <div class="container bg-white p-5">
                <h4 class="mb-4 text-center">{{ __('STUDENT LOGIN') }}</h4>
                <div class="container">
                
                    <div class="row">
                        <div class="col-md-6 mb-2">
                            <a href="{{route('student.facebook.login',['student'=>'studentFacebook'])}}" class="FacebookButton">
                                <i class="fa-brands fa-facebook-square" style="font-size: 22px; margin-right: 15px"></i>
                                Login with facebook</a>
                        </div>
                        <div class="col-md-6">
                            <a href="{{route('student.google.login',['student'=>'studentGoogle'])}}" class="GoogleButton">
                                <i class="fa-brands fa-google" style="font-size: 22px; margin-right: 15px"></i>
                                Login with google</a>
                        </div>
                        <div class="col-md-3"></div>
                    </div>
                </div>
               <div class="container mt-1 ">
                @if (session('oath'))
                <div class="alert alert-danger">
                    {{ session('oath') }}
                </div>
                @endif
               </div>
                <div class="card-body ">

                    <form method="POST" action="{{ route('student.login') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address')
                                }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                    name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password')
                                }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password"
                                    required autocomplete="current-password">
                                    <div ><span style="color: #029e02" id="showPassord">Show password</span></div>
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{
                                        old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4 d-grid">
                                <button type="submit" class="btn btn-block"
                                    style="background-color: #029e02; color:white">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function(){
            $('#showPassord').click(function(){
                if ($('#showPassord').html() === 'Hide password') {
                    $('#showPassord').html('Show password');
                    $('#password').attr('type', 'password');
                }else{
                     $('#showPassord').html('Hide password');
                    $('#password').attr('type', 'text');
                }
            })
        });
    </script>
</div>
@endsection
<style scoped>
    #passwordContainer{
        position: relative;
    }
    #showPassord{
    cursor: pointer;
    }
    .fa-google {
  background: conic-gradient(from -45deg, #ea4335 110deg, #4285f4 90deg 180deg, #34a853 180deg 270deg, #fbbc05 270deg) 73% 55%/150% 150% no-repeat;
  -webkit-background-clip: text;
  background-clip: text;
  color: transparent;
  -webkit-text-fill-color: transparent;
}
</style>
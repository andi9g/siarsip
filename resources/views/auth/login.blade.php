@extends('layouts.login')

@section('content')
<div class="login-box bg-white box-shadow border-radius-10">
    <div class="login-title">
        <h2 class="text-center text-primary">Login</h2>
    </div>
    <form action="{{ route('login', []) }}" method="POST">
        @csrf
        <div class="input-group custom">
            <input type="text" name="username" value="{{ old('username') }}" class="form-control form-control-lg" placeholder="Username"/>
            <div class="input-group-append custom">
                <span class="input-group-text">
                    <i class="icon-copy dw dw-user1"></i >
                </span>
            </div>
        </div>
        <div class="input-group custom">
            <input 
                value="{{ old('password') }}"
                name="password"
                type="password"
                class="form-control form-control-lg"
                placeholder="**********"/>
            <div class="input-group-append custom">
                <span class="input-group-text">
                    <i class="dw dw-padlock1"></i >
                </span>
            </div>
        </div>
        <div class="row pb-30">
            <div class="col-6">
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }} class="custom-control-input" id="customCheck1"/>
                    <label class="custom-control-label" for="customCheck1">Remember</label >
                </div>
            </div>
            <div class="col-sm-6">
              <div class="input-group mb-0">
                  <!-- use code for form submit <input class="btn btn-primary btn-lg btn-block"
                  type="submit" value="Sign In"> -->
                  <button type="submit" class="btn btn-primary btn-lg btn-block">Sign In</a >
              </div>
              
          </div>
            
        </div>
        <div class="row">
            
        </div>
    </form>
</div>

@endsection

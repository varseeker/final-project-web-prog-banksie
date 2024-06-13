@extends('layouts.app')

@section('content')
<div class="container">
    <div class="flex justify-content-center">
        <div class="col-md-12">
            <div class="card mx-auto mt-3" style="max-width: 720px;">
                <div class="row g-0">
                  <div class="col-md-5">
                    <img src="{{asset('img/side-img.png')}}" class="img-fluid rounded-start" alt="...">
                  </div>
                  <div class="col-md-7">
                    <div class="card-body">
                    <div class="card-header fs-4 text-md-center">{{ __('Hello new user!') }}</div>
                        <div class=" px-3 mt-2">
                            <div class="card-body"  data-bs-theme="light">
                                <form method="POST" action="{{ route('register') }}">
                                    @csrf
            
                                    <div class="row mb-3">
                                        <label for="name" class="fs-6 col-md-4 col-form-label">{{ __('Name') }}</label>
            
                                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
            
                                            @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                    </div>
            
                                    <div class="row mb-3">
                                        <label for="email" class="fs-6 col-md-8 col-form-label">{{ __('Email Address') }}</label>
            
                                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
            
                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                    </div>
            
                                    <div class="row mb-3">
                                        <label for="password" class="fs-6 col-md-4 col-form-label">{{ __('Password') }}</label>
            
                                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
            
                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                    </div>
            
                                    <div class="row mb-3">
                                        <label for="password-confirm" class="fs-6 col-md-6 col-form-label">{{ __('Confirm Password') }}</label>
            
                                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                    </div>
            
                                    <div class="row mb-0">
                                        <div class="col-md-6 offset-md-4">
                                            <button type="submit" class="btn btn-primary fs-6">
                                                {{ __('Register') }}
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                  </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

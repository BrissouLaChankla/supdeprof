@extends('layouts.app')

@section('content')
    <div class="bg-light align-items-md-center d-flex h-100 card-log">
        <div class="container bg-white rounded-4 ">
            <div class="row h-100">
                <div class="col-md-6 d-flex align-items-center order-md-2">
                    <div class="text-center w-100 py-md-5 px-3 pb-5 pb-md-0 ">
                        
                        <h1>SupdeCours</h1>
                        <p class="text-muted  my-3 mb-4">Créez vos cours, partagez les et simplifiez votre organisation.</p>

                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="form-floating mb-3">
                                <input type="email" name="email"
                                    class="form-control w-100 @error('email') is-invalid @enderror" id="floatingInput"
                                    required autofocus placeholder="name@example.com">
                                <label for="floatingInput">Adresse mail</label>
                            </div>
                            @error('email')
                                <span class="text-danger" role="alert">
                                    <small>{{ $message }}</small>
                                </span>
                            @enderror

                            <div class="form-floating">
                                <input name="password" required autocomplete="current-password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" id="floatingPassword"
                                    placeholder="Password">
                                <label for="floatingPassword">Mot de passe</label>
                            </div>
                            @error('password')
                                <span class="text-danger" role="alert">
                                    <small>{{ $message }}</small>
                                </span>
                            @enderror

                            <input class="form-check-input d-none" type="checkbox" checked name="remember" id="remember">

                            <button type="submit" class="btn btn-primary w-100 mt-4">
                                {{ __('Login') }}
                            </button>

                            @if (Route::has('password.request'))
                                <a class="btn btn-link text-decoration-none small mt-3"
                                    href="{{ route('password.request') }}">
                                    {{ __('Mot de passe oublié ?') }}
                                </a>
                            @endif
                        </form>

                    </div>
                </div>
                <div class="col-md-6 order-md-1 p-0 d-none d-md-block">
                    <div class="position-relative overflow-hidden h-100 w-100 rounded-start-4 imgDudeContainer">
                        <img src="{{ Vite::asset('resources/images/login/img1.webp') }}" class="imgDude" alt="Bonhomme">
                        <div class="cloud_one"></div>
                        <div class="cloud_two"></div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

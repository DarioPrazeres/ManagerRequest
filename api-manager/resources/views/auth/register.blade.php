@extends('layout')
  
@section('content')
<x-guest-layout>
    <div class="card shadow-lg p-3 mb-5 bg-white rounded mx-auto" style="max-width: 500px;">
        <div class="card-body">
            <h3 class="card-title text-center mb-4">Register</h3>

            <x-jet-validation-errors class="alert alert-danger mb-4" />

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- Name -->
                <div class="mb-3">
                    <label for="name" class="form-label">{{ __('Name') }}</label>
                    <input id="name" class="form-control" type="text" name="name" :value="old('name')" required autofocus autocomplete="name">
                </div>

                <!-- Email -->
                <div class="mb-3">
                    <label for="email" class="form-label">{{ __('Email') }}</label>
                    <input id="email" class="form-control" type="email" name="email" :value="old('email')" required>
                </div>

                <!-- Password -->
                <div class="mb-3">
                    <label for="password" class="form-label">{{ __('Password') }}</label>
                    <input id="password" class="form-control" type="password" name="password" required autocomplete="new-password">
                </div>

                <!-- Confirm Password -->
                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">{{ __('Confirm Password') }}</label>
                    <input id="password_confirmation" class="form-control" type="password" name="password_confirmation" required autocomplete="new-password">
                </div>

                <!-- Perfil -->
                <div class="mb-3">
                    <label for="perfil" class="form-label">Perfil</label>
                    <select name="perfil" id="perfil" class="form-control" required>
                        <option value="solicitante">Solicitante</option>
                        <option value="aprovador">Aprovador</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="grupo_id">Grupo</label>
                    <select name="grupo_id" id="grupo_id" class="form-control">
                        @foreach($grupos as $grupo)
                        <option value="{{ $grupo->id }}">{{ $grupo->nome }}</option>
                        @endforeach
                    </select>
                </div>

                @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <!-- Terms and Privacy Policy -->
                <div class="mb-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="terms" id="terms">
                        <label class="form-check-label" for="terms">
                            {!! __('I agree to the :terms_of_service and :privacy_policy', [
                            'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="text-decoration-underline">'.__('Terms of Service').'</a>',
                            'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="text-decoration-underline">'.__('Privacy Policy').'</a>',
                            ]) !!}
                        </label>
                    </div>
                </div>
                @endif

                <!-- Register Button -->
                <div class="d-flex justify-content-between">
                    <a href="{{ route('login') }}" class="text-muted">{{ __('Já tem Conta?') }}</a>
                    <button type="submit" class="btn btn-primary">{{ __('Register') }}</button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
@endsection
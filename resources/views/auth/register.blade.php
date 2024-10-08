@extends('adminlte::page')

@section('title', 'Configuracion')

@section('content_header')
    <h1>Nuevo usuario</h1>
@stop

@section('content')
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Nombre completo')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="off" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="off" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Contraseña')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirmar contraseña')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>
        <div>
            <x-input-label for="role" :value="__('Asignar Rol')" />
            
            <div class="form-check">
                <input class="form-check-input" type="radio" name="role" value="admin" id="flexRadioDefault1">
                <label class="form-check-label" for="flexRadioDefault1">
                    Administrador
                </label>
            </div>
            
            <div class="form-check">
                <input class="form-check-input" type="radio" name="role" value="seller" id="flexRadioDefault2" checked>
                <label class="form-check-label" for="flexRadioDefault2">
                    Vendedor
                </label>
            </div>
        </div>
        
        
        <div class="flex items-center justify-end mt-4">
            {{--
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>
            --}}

            <x-primary-button class="ms-4">
                {{ __('Guardar') }}
            </x-primary-button>
        </div>
    </form>

@stop

@section('css')
@stop

@section('js')
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
@stop

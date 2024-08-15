

@extends('adminlte::page')

@section('title', 'Configuracion')

@section('content_header')



@stop

@section('content')

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="max-w-xl">
                @include('profile.partials.update-profile-information-form')
            </div>

            <div class="max-w-xl">
                @include('profile.partials.update-password-form')
            </div>
        {{--Eliminar cuenta
        <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
            <div class="max-w-xl">
                @include('profile.partials.delete-user-form')
            </div>
        </div>
        --}}
    </div>
</div>
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    @vite(['resources/js/app.js', 'resources/js/bootstrap.bundle.min.js'])
@stop

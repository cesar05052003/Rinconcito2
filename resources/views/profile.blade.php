@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-6">
        {{ __('Perfil') }}
    </h2>

    <div class="bg-white shadow sm:rounded-lg p-6">
        <h3 class="text-lg font-medium text-gray-900 mb-4">{{ __('Información del Perfil') }}</h3>
        <p>{{ __('Aquí puedes ver y editar la información de tu perfil.') }}</p>

        <div class="mt-6 flex justify-end">
            <a href="{{ url('/profile/show') }}" class="inline-flex items-center px-4 py-2 bg-gray-300 border border-transparent rounded-md font-semibold text-gray-700 hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                {{ __('Regresar a Perfil') }}
            </a>
        </div>
    </div>
</div>
@endsection

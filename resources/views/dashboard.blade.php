
<x-app-layout>
    
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Bienvenido {{ Auth::user()->name }}
        </h2>
    </x-slot>
<div class="py-12" style="background-color: #f4eedb;">
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <p>Este es tu panel de cliente. Aquí podrás ver y comprar platos disponibles.</p>
            </div>
        </div>
    </div>

        </div>
    </div>
    
</x-app-layout>

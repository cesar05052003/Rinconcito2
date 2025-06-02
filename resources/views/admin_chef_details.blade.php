<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Detalles del Chef: {{ $chef->name }}
        </h2>
    </x-slot>

    <div class="py-12" style="background-color: #f4eedb;">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white p-6 shadow rounded-lg">
                <h3 class="text-lg font-semibold text-gray-700 mb-4">Información del Chef</h3>
                <p><strong>Nombre:</strong> {{ $chef->name }}</p>
                <p><strong>Email:</strong> {{ $chef->email }}</p>
                <p><strong>Fecha de nacimiento:</strong> {{ $chef->fecha_nacimiento ? $chef->fecha_nacimiento->format('d/m/Y') : 'N/A' }}</p>
            </div>

            <div class="bg-white p-6 shadow rounded-lg">
                <h3 class="text-lg font-semibold text-gray-700 mb-4">Platos y Ventas</h3>
                @if(empty($ventasPorPlato))
                    <p class="text-gray-500">Este chef no tiene platos registrados.</p>
                @else
                    <table class="min-w-full bg-white border border-gray-300 rounded-md shadow-sm">
                        <thead>
                            <tr class="bg-gray-100 text-gray-700">
                                <th class="py-2 px-4 border-b border-gray-300 text-left">Nombre del Plato</th>
                                <th class="py-2 px-4 border-b border-gray-300 text-left">Descripción</th>
                                <th class="py-2 px-4 border-b border-gray-300 text-left">Precio</th>
                                <th class="py-2 px-4 border-b border-gray-300 text-center">Cantidad Vendida</th>
                                <th class="py-2 px-4 border-b border-gray-300 text-right">Total Ventas</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($ventasPorPlato as $venta)
                                <tr class="border-b border-gray-300">
                                    <td class="py-2 px-4">{{ $venta['plato']->nombre }}</td>
                                    <td class="py-2 px-4">{{ $venta['plato']->descripcion }}</td>
                                    <td class="py-2 px-4">{{ number_format($venta['plato']->precio, 2) }}</td>
                                    <td class="py-2 px-4 text-center">{{ $venta['cantidad_vendida'] }}</td>
                                    <td class="py-2 px-4 text-right">${{ number_format($venta['total_ventas'], 2) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>

            <div class="mt-6">
                <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center px-4 py-2 bg-gray-600 text-white rounded-md hover:bg-gray-700">
                    Volver al Panel de Administración
                </a>
            </div>
        </div>
    </div>
</x-app-layout>

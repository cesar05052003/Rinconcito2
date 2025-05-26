<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="text-2xl font-bold text-gray-800">
                Bienvenido, Administrador
            </h2>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                    class="inline-flex items-center px-4 py-2 bg-red-600 text-white text-sm font-semibold rounded-md shadow hover:bg-red-700 focus:outline-none transition duration-200">
                    Cerrar sesión
                    <svg xmlns="http://www.w3.org/2000/svg" class="ml-2 h-4 w-4" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 16l4-4m0 0l-4-4m4 4H7" />
                    </svg>
                </button>
            </form>
        </div>
    </x-slot>

   <div class="py-12" style="background-color: #f4eedb;">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <!-- Bienvenida -->
            <div class="bg-white p-8 shadow rounded-lg">
                <h3 class="text-xl font-semibold text-gray-700 mb-2">Panel de Administración</h3>
                <p class="text-gray-600">Gestiona usuarios, chefs, repartidores y el estado general de la plataforma Rinconcito.</p>
                <div class="mt-4">
                    <a href="{{ route('admin.users.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-semibold rounded-md shadow hover:bg-blue-700 focus:outline-none transition duration-200">
                        + Crear Nuevo Usuario
                    </a>
                </div>
            </div>

            <!-- Usuarios -->
            <div class="bg-white p-6 shadow rounded-lg">
                <h4 class="text-lg font-semibold text-gray-800 mb-4">👥 Usuarios Registrados</h4>
                @if($usuarios->isEmpty())
                    <p class="text-gray-500">No hay usuarios registrados.</p>
                @else
                    <ul class="space-y-1 text-gray-700">
                        @foreach($usuarios as $usuario)
                            <li class="flex justify-between items-center">
                                <span>- {{ $usuario->name }} <span class="text-sm text-gray-500">({{ $usuario->email }})</span></span>
                                <span class="space-x-2">
                                    <a href="{{ route('admin.users.edit', $usuario) }}" class="text-blue-600 hover:underline">Editar</a>
                                    <form action="{{ route('admin.users.destroy', $usuario) }}" method="POST" class="inline" onsubmit="return confirm('¿Estás seguro de eliminar este usuario?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:underline">Eliminar</button>
                                    </form>
                                </span>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>

            <!-- Chefs -->
            <div class="bg-white p-6 shadow rounded-lg">
                <h4 class="text-lg font-semibold text-gray-800 mb-4">👨‍🍳 Chefs</h4>
                @if($chefs->isEmpty())
                    <p class="text-gray-500">No hay chefs registrados.</p>
                @else
                    <ul class="space-y-1 text-gray-700">
                        @foreach($chefs as $chef)
                            <li class="flex justify-between items-center">
                                <span>- {{ $chef->name }} <span class="text-sm text-gray-500">({{ $chef->email }})</span></span>
                                <span class="space-x-2">
                                    <a href="{{ route('admin.users.edit', $chef) }}" class="text-blue-600 hover:underline">Editar</a>
                                    <form action="{{ route('admin.users.destroy', $chef) }}" method="POST" class="inline" onsubmit="return confirm('¿Estás seguro de eliminar este usuario?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:underline">Eliminar</button>
                                    </form>
                                </span>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>

            <!-- Repartidores -->
            <div class="bg-white p-6 shadow rounded-lg">
                <h4 class="text-lg font-semibold text-gray-800 mb-4">🚴 Repartidores</h4>
                @if($repartidores->isEmpty())
                    <p class="text-gray-500">No hay repartidores registrados.</p>
                @else
                    <ul class="space-y-1 text-gray-700">
                        @foreach($repartidores as $repartidor)
                            <li class="flex justify-between items-center">
                                <span>- {{ $repartidor->name }} <span class="text-sm text-gray-500">({{ $repartidor->email }})</span></span>
                                <span class="space-x-2">
                                    <a href="{{ route('admin.users.edit', $repartidor) }}" class="text-blue-600 hover:underline">Editar</a>
                                    <form action="{{ route('admin.users.destroy', $repartidor) }}" method="POST" class="inline" onsubmit="return confirm('¿Estás seguro de eliminar este usuario?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:underline">Eliminar</button>
                                    </form>
                                </span>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>

            <!-- Sección de Reportes de Ventas -->
            <div class="bg-white p-8 shadow rounded-lg mt-8">
                <h3 class="text-xl font-semibold text-gray-700 mb-4">📊 Reportes de Ventas</h3>

                {{-- Filtro de fechas --}}
                <form method="GET" action="{{ route('admin.dashboard') }}">
                    <div class="flex flex-wrap gap-4 items-end mb-4">
                        <div>
                            <label for="start_date" class="block text-sm font-medium text-gray-700">Fecha inicio</label>
                            <input type="date" id="start_date" name="start_date" value="{{ old('start_date', $startDate ?? '') }}" class="border-gray-300 rounded-md shadow-sm">
                        </div>
                        <div>
                            <label for="end_date" class="block text-sm font-medium text-gray-700">Fecha fin</label>
                            <input type="date" id="end_date" name="end_date" value="{{ old('end_date', $endDate ?? '') }}" class="border-gray-300 rounded-md shadow-sm">
                        </div>
                        <div>
                            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md shadow hover:bg-blue-700 transition duration-200">Filtrar</button>
                        </div>
                    </div>
                </form>

                {{-- Botones de descarga --}}
                @if(!empty($startDate) && !empty($endDate))
                <div class="mb-4 flex gap-2">
                    <a href="{{ route('reports.pdf', ['start_date' => $startDate, 'end_date' => $endDate]) }}" class="px-4 py-2 bg-red-600 text-white rounded-md shadow hover:bg-red-700 transition duration-200 inline-flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="currentColor" viewBox="0 0 24 24"><path d="M6 2h9a2 2 0 012 2v2h-2V4H6v16h6v2H6a2 2 0 01-2-2V4a2 2 0 012-2z"/><path d="M15 12l-3 3-3-3h2V7h2v5h2z"/></svg>
                        Descargar PDF
                    </a>
                    {{-- <a href="{{ route('reports.excel', ['start_date' => $startDate, 'end_date' => $endDate]) }}" class="px-4 py-2 bg-green-600 text-white rounded-md shadow hover:bg-green-700 transition duration-200 inline-flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="currentColor" viewBox="0 0 24 24"><path d="M19 3H5a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2V5a2 2 0 00-2-2zM8.5 17h-2v-6h2v6zm3-6h-2v6h2v-6zm3 0h-2v6h2v-6z"/></svg>
                        Descargar Excel
                    </a> --}}
                </div>
                @endif

                {{-- Resumen y tabla --}}
                @if(isset($pedidos))
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white border border-gray-300 rounded-md shadow-sm">
                        <thead>
                            <tr class="bg-gray-100 text-gray-700">
                                <th class="py-2 px-4 border-b border-gray-300 text-left">ID Pedido</th>
                                <th class="py-2 px-4 border-b border-gray-300 text-left">Cliente</th>
                                <th class="py-2 px-4 border-b border-gray-300 text-left">Plato</th>
                                <th class="py-2 px-4 border-b border-gray-300 text-center">Cantidad</th>
                                <th class="py-2 px-4 border-b border-gray-300 text-right">Total</th>
                                <th class="py-2 px-4 border-b border-gray-300 text-center">Fecha</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($pedidos as $pedido)
                            <tr class="border-b border-gray-300">
                                <td class="py-2 px-4">{{ $pedido->id }}</td>
                                <td class="py-2 px-4">{{ $pedido->cliente->nombre ?? 'N/A' }}</td>
                                <td class="py-2 px-4">{{ $pedido->plato->nombre ?? 'N/A' }}</td>
                                <td class="py-2 px-4 text-center">{{ $pedido->cantidad }}</td>
                                <td class="py-2 px-4 text-right text-green-600 font-semibold">${{ number_format($pedido->total, 0, ',', '.') }}</td>
                                <td class="py-2 px-4 text-center">{{ $pedido->created_at->format('d/m/Y') }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="py-4 text-center text-gray-500">No hay registros para este período.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                @endif
            </div>

            <!-- Sección de Platos -->
            <div class="bg-white p-6 shadow rounded-lg mt-8">
                <h4 class="text-lg font-semibold text-gray-800 mb-4">🍽️ Platos</h4>
                @if(isset($platos) && $platos->isEmpty())
                    <p class="text-gray-500">No hay platos registrados.</p>
                @elseif(isset($platos))
                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white border border-gray-300 rounded-md shadow-sm">
                            <thead>
                                <tr class="bg-gray-100 text-gray-700">
                                    <th class="py-2 px-4 border-b border-gray-300 text-left">ID</th>
                                    <th class="py-2 px-4 border-b border-gray-300 text-left">Nombre</th>
                                    <th class="py-2 px-4 border-b border-gray-300 text-left">Descripción</th>
                                    <th class="py-2 px-4 border-b border-gray-300 text-left">Precio</th>
                                    <th class="py-2 px-4 border-b border-gray-300 text-center">Cantidad</th>
                                    <th class="py-2 px-4 border-b border-gray-300 text-center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($platos as $plato)
                                <tr class="border-b border-gray-300">
                                    <td class="py-2 px-4">{{ $plato->id }}</td>
                                    <td class="py-2 px-4">{{ $plato->nombre }}</td>
                                    <td class="py-2 px-4">{{ $plato->descripcion }}</td>
                                    <td class="py-2 px-4">{{ $plato->precio }}</td>
                                    <td class="py-2 px-4 text-center">{{ $plato->cantidad }}</td>
                                    <td class="py-2 px-4 text-center space-x-2">
                                        <form action="{{ route('admin.platos.destroy', $plato->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de eliminar este plato?');" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:underline">Eliminar</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>

<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use App\Models\Pedido;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        // Obtener todos los usuarios sin filtrar por tipo para edición completa
        $usuarios = User::all();

        // Filtrar para mostrar en listas por tipo
        $clientes = $usuarios->where('tipo_usuario', 'cliente');
        $chefs = $usuarios->where('tipo_usuario', 'chef');
        $repartidores = $usuarios->where('tipo_usuario', 'repartidor');

        // Obtener datos de reportes de ventas
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $query = Pedido::query();

        if ($startDate) {
            $query->whereDate('created_at', '>=', $startDate);
        }
        if ($endDate) {
            $query->whereDate('created_at', '<=', $endDate);
        }

        $pedidos = $query->with('plato', 'cliente')->get();

        $totalVentas = $pedidos->sum('total');
        $totalPedidos = $pedidos->count();

        $platos = \App\Models\Plato::all();

        return view('admin', [
            'usuarios' => $clientes,
            'chefs' => $chefs,
            'repartidores' => $repartidores,
            'todosUsuarios' => $usuarios, // si se necesita para otras vistas
            'pedidos' => $pedidos,
            'totalVentas' => $totalVentas,
            'totalPedidos' => $totalPedidos,
            'startDate' => $startDate,
            'endDate' => $endDate,
            'platos' => $platos,
        ]);
    }

    public function indexPlatos()
    {
        $platos = \App\Models\Plato::all();
        return view('admin', [
            'platos' => $platos,
        ]);
    }

    public function destroyPlato($id)
    {
        $plato = \App\Models\Plato::findOrFail($id);
        $plato->delete();
        return redirect()->route('admin.platos.index')->with('success', 'Plato eliminado correctamente.');
    }

    public function create()
    {
        return view('admin_create_user');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'tipo_usuario' => ['required', Rule::in(['cliente', 'chef', 'repartidor', 'admin'])],
            'role' => 'nullable|string|max:255',
            'fecha_nacimiento' => 'nullable|date',
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'tipo_usuario' => $validated['tipo_usuario'],
            'role' => $validated['role'] ?? null,
            'fecha_nacimiento' => $validated['fecha_nacimiento'] ?? null,
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'Usuario creado correctamente.');
    }

    public function edit(User $user)
    {
        return view('admin_edit_user', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required','email', Rule::unique('users')->ignore($user->id)],
            'password' => 'nullable|string|min:8|confirmed',
            'tipo_usuario' => ['required', Rule::in(['cliente', 'chef', 'repartidor', 'admin'])],
            'role' => 'nullable|string|max:255',
            'fecha_nacimiento' => 'nullable|date',
        ]);

        $user->name = $validated['name'];
        $user->email = $validated['email'];
        if (!empty($validated['password'])) {
            $user->password = Hash::make($validated['password']);
        }
        $user->tipo_usuario = $validated['tipo_usuario'];
        $user->role = $validated['role'] ?? null;
        $user->fecha_nacimiento = $validated['fecha_nacimiento'] ?? null;
        $user->save();

        return redirect()->route('admin.dashboard')->with('success', 'Usuario actualizado correctamente.');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.dashboard')->with('success', 'Usuario eliminado correctamente.');
    }
}

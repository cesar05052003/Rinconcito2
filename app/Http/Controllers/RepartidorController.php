<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use Illuminate\Http\Request;

class RepartidorController extends Controller
{
    public function dashboard()
    {
        // Obtener pedidos que no estén entregados para que el repartidor pueda gestionarlos
        $pedidos = Pedido::whereIn('estado', ['en_espera', 'listo'])->with('plato', 'cliente')->get();
        return view('repartidor', compact('pedidos'));
    }

    public function actualizarEstado(Request $request, $id)
    {
        $request->validate([
            'estado' => 'required|in:en_espera,listo,entregado',
        ]);

        $pedido = Pedido::findOrFail($id);
        $pedido->estado = $request->estado;
        $pedido->save();

        if ($request->estado === 'entregado') {
            // Notificar al cliente
            $pedido->cliente->notify(new \App\Notifications\PedidoEntregadoCliente($pedido));

            // Notificar a todos los chefs
            $chefs = \App\Models\User::where('role', 'chef')->get();
            foreach ($chefs as $chef) {
                $chef->notify(new \App\Notifications\PedidoEntregadoChef($pedido));
            }
        }

        return redirect()->route('repartidor.dashboard')->with('success', 'Estado del pedido actualizado correctamente.');
    }

    public function iniciarSesion()
    {
        return view('iniciar-sesion-repartidor');
    }

    public function aceptarPedido()
    {
        return view('aceptar-pedido');
    }

    public function recogerPedido()
    {
        return view('recoger-pedido');
    }

    // Eliminado método duplicado actualizarEstado que causaba conflicto

    public function resolverIncidencias()
    {
        return view('resolver-incidencias');
    }
}

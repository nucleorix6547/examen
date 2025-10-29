<?php

use App\Models\Bitacora;
use Illuminate\Support\Facades\Log;

function registrarBitacora($usuario, $accion, $request = null, $descripcion = null)
{
    try {
        // Si no se pasa request, obtener el actual
        $req = $request ?? request();

        // Obtener IP real
        $ip = $req->ip()
            ?? $req->server('REMOTE_ADDR')
            ?? ($_SERVER['REMOTE_ADDR'] ?? '127.0.0.1');
        
        // Convertir IPv6 localhost a IPv4
        if ($ip === '::1' || !$ip || trim($ip) === '') {
            $ip = '127.0.0.1';
        }

        // Registrar en la base de datos
        Bitacora::create([
            'usuario_registro' => $usuario->registro ?? $usuario->id ?? null,
            'accion' => $accion,
            'descripcion' => $descripcion ?? '',
            'ip' => $ip,
        ]);

    } catch (\Exception $e) {
        Log::error('[Bitacora] Error registrando acción: ' . $e->getMessage());
    }
}
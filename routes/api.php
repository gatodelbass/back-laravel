<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Mail\MyTestMail;
use Illuminate\Support\Facades\Mail;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user()->load("rol.permisos.permiso");
    //return $request->user()->load("userPermisos");


});


Route::get('obtenerUsuarioLogin', [App\Http\Controllers\Api\UsuarioController::class, 'obtenerUsuarioLogin'])->name('obtenerUsuarioLogin');


Route::get('activarUsuario/{usuarioId}/{token}', [App\Http\Controllers\Api\UsuarioController::class, 'activarUsuario'])->name('activarUsuario');
Route::get('obtenerUsuario/{usuarioId}', [App\Http\Controllers\Api\UsuarioController::class, 'obtenerUsuario'])->name('obtenerUsuario');
Route::post('cambiarPassword', [App\Http\Controllers\Api\UsuarioController::class, 'cambiarPassword'])->name('cambiarPassword');
Route::post('olvidoEmailEnviar', [App\Http\Controllers\Api\UsuarioController::class, 'olvidoEmailEnviar'])->name('olvidoEmailEnviar');
Route::post('olvidoEmailEnviarToken', [App\Http\Controllers\Api\UsuarioController::class, 'olvidoEmailEnviarToken'])->name('olvidoEmailEnviarToken');




Route::group(['middleware' => ['auth:sanctum']], function () {
    //aqui se deben dejar todas las rutas a proteger    

    //usuarios
    Route::get('usuariosIndex', [App\Http\Controllers\Api\UsuarioController::class, 'index'])->name('usuariosIndex');
    Route::get('usuariosDetail/{usuarioId}', [App\Http\Controllers\Api\UsuarioController::class, 'detail'])->name('usuarioId');
    Route::post('usuariosStore', [App\Http\Controllers\Api\UsuarioController::class, 'store'])->name('usuariosStore');
    Route::put('usuariosUpdate/{usuarioId}', [App\Http\Controllers\Api\UsuarioController::class, 'update'])->name('usuariosUpdate');
    Route::delete('usuariosDelete/{usuarioId}', [App\Http\Controllers\Api\UsuarioController::class, 'usuariosDelete'])->name('usuariosDelete');


    Route::get('setCliente/{clientepath}', [App\Http\Controllers\Api\ClienteController::class, 'setCliente'])->name('setCliente');

    //solicitudes
    Route::get('solicitudesIndex/{clienteId}', [App\Http\Controllers\Api\SolicitudController::class, 'index'])->name('solicitudesIndex');
    Route::get('solicitudesDetail/{solicitudId}', [App\Http\Controllers\Api\SolicitudController::class, 'detail'])->name('solicitudesDetail');
    Route::get('solicitudesShow/{id}', [App\Http\Controllers\Api\SolicitudController::class, 'show'])->name('solicitudesShow');
    Route::post('solicitudesStore/', [App\Http\Controllers\Api\SolicitudController::class, 'store'])->name('solicitudesStore');
    Route::put('solicitudesUpdate/{solicitudId}', [App\Http\Controllers\Api\SolicitudController::class, 'update'])->name('solicitudesUpdate');
    Route::delete('solicitudesDelete/{solicitudId}', [App\Http\Controllers\Api\SolicitudController::class, 'solicitudesDelete'])->name('solicitudesDelete');

    //clientes
    Route::get('clientesIndex', [App\Http\Controllers\Api\ClienteController::class, 'index'])->name('clientesIndex');
    Route::get('clientesDetail/{clienteId}', [App\Http\Controllers\Api\ClienteController::class, 'detail'])->name('clienteId');
    Route::post('clientesStore', [App\Http\Controllers\Api\ClienteController::class, 'store'])->name('clientesStore');
    Route::put('clientesUpdate/{clienteId}', [App\Http\Controllers\Api\ClienteController::class, 'update'])->name('clientesUpdate');
    Route::get('habilitarUsuario/{clienteId}/{usuarioId}', [App\Http\Controllers\Api\ClienteController::class, 'habilitarUsuario'])->name('habilitarUsuario');
    Route::get('obtenerUsuariosHabilitados/{clienteId}', [App\Http\Controllers\Api\ClienteController::class, 'obtenerUsuariosHabilitados'])->name('obtenerUsuariosHabilitados');
    Route::delete('clientesDelete/{clienteId}', [App\Http\Controllers\Api\ClienteController::class, 'clientesDelete'])->name('clientesDelete');


    //tipos de solicitudes
    Route::get('obtenerSolicitudTipos/', [App\Http\Controllers\Api\SolicitudTipoController::class, 'obtenerSolicitudTipos'])->name('obtenerSolicitudTipos');

    Route::post('solicitudesReporte', [App\Http\Controllers\Api\SolicitudController::class, 'reporte'])->name('solicitudesReporte');
    Route::post('solicitudesReporteEstadistico', [App\Http\Controllers\Api\SolicitudController::class, 'reporteEstadistico'])->name('solicitudesReporteEstadistico');

    //anexos de la solicitud
    Route::get('obtenerAnexoTipos', [App\Http\Controllers\Api\SolicitudAnexosController::class, 'obtenerAnexoTipos'])->name('obtenerAnexoTipos');
    Route::get('solicitudesAnexosShow/{solicitudesvalpsanexoid}', [App\Http\Controllers\Api\SolicitudAnexosController::class, 'show'])->name('solicitudesAnexosShow');
    Route::post('solicitudAnexosStore', [App\Http\Controllers\Api\SolicitudAnexosController::class, 'store'])->name('solicitudAnexosStore');
    Route::put('solicitudAnexosUpdate/{anexoId}', [App\Http\Controllers\Api\SolicitudAnexosController::class, 'update'])->name('solicitudAnexosUpdate');
    Route::get('solicitudAnexosDownload/{anexoId}', [App\Http\Controllers\Api\SolicitudAnexosController::class, 'solicitudAnexosDownload'])->name('solicitudAnexosDownload');

    //notas de la solicitud
    Route::post('solicitudNotasStore', [App\Http\Controllers\Api\SolicitudNotasController::class, 'store'])->name('solicitudNotasStore');
    Route::put('solicitudNotasUpdate/{anexoId}', [App\Http\Controllers\Api\SolicitudNotasController::class, 'update'])->name('solicitudNotasUpdate');


    //roles
    Route::get('rolesIndex', [App\Http\Controllers\Api\RolController::class, 'index'])->name('rolesIndex');
    Route::post('rolesStore', [App\Http\Controllers\Api\RolController::class, 'store'])->name('rolesStore');
    Route::get('rolesDetail/{rolId}', [App\Http\Controllers\Api\RolController::class, 'detail'])->name('rolesDetail');
    Route::get('obtenerPermisosRol/{rolId}', [App\Http\Controllers\Api\RolController::class, 'obtenerPermisosRol'])->name('obtenerPermisosRol');
    Route::get('habilitarPermiso/{rolId}/{permisoId}', [App\Http\Controllers\Api\RolController::class, 'habilitarPermiso'])->name('habilitarPermiso');
    Route::delete('rolesDelete/{rolId}', [App\Http\Controllers\Api\RolController::class, 'rolesDelete'])->name('rolesDelete');


    ///permisos
    Route::get('permisosIndex', [App\Http\Controllers\Api\PermisoController::class, 'index'])->name('permisosIndex');

    //clientes
    Route::get('obtenerClientesActivos', [App\Http\Controllers\Api\ClienteController::class, 'obtenerClientesActivos'])->name('obtenerClientesActivos');
    Route::get('obtenerClientePorId/{clienteId}', [App\Http\Controllers\Api\ClienteController::class, 'obtenerClientePorId'])->name('obtenerClientePorId');
});

Route::get('testApi', [App\Http\Controllers\Api\SolicitudController::class, 'testApi'])->name('testApi');

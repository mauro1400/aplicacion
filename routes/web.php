<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\reporte\ReporteArticulosController;
use App\Http\Controllers\reporte\ReporteCertificadoOrigenController;
use App\Http\Controllers\reporte\ReportePartidasController;
use App\Http\Controllers\SolicitudArticulo\SolicitudArticuloController;

Route::get('/', function () {
    return view('welcome');
});
////////////////////////////////////////////////////////////
Route::resource('/SolicitudArticulo/solicitud-articulo', SolicitudArticuloController::class);
Route::get('/SolicitudArticulo/busquedacodigo',[SolicitudArticuloController::class,'buscarSolicitud']);
Route::get('/aprovado/{id}',[SolicitudArticuloController::class,'aprobado'])->name('SolicitudArticulo.aprobado');
Route::get('/pendiente/{id}',[SolicitudArticuloController::class,'pendiente'])->name('SolicitudArticulo.pendiente');

////////////////////////////////////////////////////////////
Route::resource('/reporte/reporteCertificadoOrigen', ReporteCertificadoOrigenController::class);//->name('')
Route::get('/reporte/filtroregional', [ReporteCertificadoOrigenController::class,'filtroRegional']);//->name('')
Route::get('/reporte/filtrofecha', [ReporteCertificadoOrigenController::class,'filtroFecha']);//->name('')
Route::get('/reporte/busquedafechas',[ReporteCertificadoOrigenController::class,'busquedaFechas']);//->name('')
Route::get('/reporte/busquedaregional',[ReporteCertificadoOrigenController::class,'busquedaRegional']);//->name('')
Route::get('/reporte/exportarReporteCORegional', [ReporteCertificadoOrigenController::class, 'exportarReporteRegional']);//->name('')
Route::get('/reporte/exportarReporteCOFechas', [ReporteCertificadoOrigenController::class, 'exportarReporteFechas']);//->name('')

////////////////////////////////////////////////////////////
Route::resource('/reporte/ReporteArticulos', ReporteArticulosController::class);//->name('')
Route::get('/reporte/busquedacodigo',[ReporteArticulosController::class,'busquedaCodigo']);//->name('')
Route::get('/reporte/exportarReporteArticulos', [ReporteArticulosController::class, 'exportarReporteArticulos']);//->name('')

////////////////////////////////////////////////////////////
Route::resource('/reporte/reportePartidas', ReportePartidasController::class);//->name('')
Route::get('/reporte/busquedapartida',[ReportePartidasController::class,'busquedaPartida']);//->name('')
Route::get('/reporte/exportarReportePartida', [ReportePartidasController::class, 'exportarReportePartidas']);//->name('')
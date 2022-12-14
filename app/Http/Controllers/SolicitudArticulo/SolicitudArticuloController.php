<?php

namespace App\Http\Controllers\SolicitudArticulo;

use App\Http\Controllers\Controller;
use App\Models\SolicitudArticulo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SolicitudArticuloController extends Controller
{
    public function index()
    {
        $solicitudarticulo = DB::table('subarticle_requests')
            ->join('requests', 'subarticle_requests.request_id', '=', 'requests.id')
            ->join('subarticles', 'subarticle_requests.subarticle_id', '=', 'subarticles.id')
            ->select('subarticles.description', 'subarticles.unit', 'requests.nro_solicitud', 'subarticle_requests.*')
            ->simplePaginate(100);
        return view('SolicitudArticulo.solicitud-articulo.index', ['solicitudarticulo' => $solicitudarticulo]);
    }

    public function buscarSolicitud(Request $request)
    {
        $keyword = trim($request->get('search'));
        $perPage = 25;
        $solicitudarticulo = DB::table('subarticle_requests')
            ->join('requests', 'subarticle_requests.request_id', '=', 'requests.id')
            ->join('subarticles', 'subarticle_requests.subarticle_id', '=', 'subarticles.id')
            ->select('subarticles.description', 'subarticles.unit', 'requests.nro_solicitud', 'subarticle_requests.*')
            ->where('nro_solicitud', 'LIKE', "$keyword")->simplePaginate($perPage);
        return view('SolicitudArticulo.solicitud-articulo.index', ['solicitudarticulo' => $solicitudarticulo]);
    }

    public function edit($id)
    {
        $solicitudarticulo = SolicitudArticulo::findOrFail($id);

        return view('SolicitudArticulo.solicitud-articulo.edit', ['solicitudarticulo' => $solicitudarticulo]);
    }


    public function update(Request $request, $id)
    {

        $requestData = $request->all();
        $solicitudarticulo = SolicitudArticulo::findOrFail($id);
        $solicitudarticulo->update($requestData);
        return redirect('SolicitudArticulo/solicitud-articulo');
    }

    public function aprobado($id)
    {
        $solicitudarticulo = SolicitudArticulo::findOrFail($id);
        $solicitudarticulo->estado = 1;
        $solicitudarticulo->save();
        return back();
    }
}

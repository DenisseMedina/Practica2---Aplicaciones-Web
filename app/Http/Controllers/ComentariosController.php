<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Comentarios;
use Illuminate\Http\Request;


class ComentariosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Comentarios  $comentarios
     * @return \Illuminate\Http\Response
     */
    public function show(Comentarios $comentarios)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Comentarios  $comentarios
     * @return \Illuminate\Http\Response
     */
    public function edit(Comentarios $comentarios)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Comentarios  $comentarios
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comentarios $comentarios)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Comentarios  $comentarios
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comentarios $comentarios)
    {
        //
    }
    public function comentarios(string $comentario, string $usuario_id, int $publicacion_id){

        $insertaComentario = new \App\Comentarios;
        $insertaComentario->comentario =$comentario;
        $insertaComentario->usuario_id =$usuario_id;
        $insertaComentario->publicacion_id =$publicacion_id;   
        $insertaComentario->save();

        return response()->json ([
            "Insertar Comentario",
        ],201);
    }

    public function buscar(int $id=0){

        return response()->json([
            "comentario"=> ($id == 0)? \App\Comentarios::all():\App\Comentarios::find($id)
            ],200);
    
    } 

    public function modificar(int $id, string $comentario){
        $modificarComentario = \App\Comentarios::find($id);
        $modificarComentario->comentario = $comentario;
        $modificarComentario->save();
        return response()->json([
                                  "comentario actualizado",
                                   ],200);
}

    public function eliminar(int $id){
        $eliminarComentario = \App\Comentarios::find($id);
        $eliminarComentario->delete();
        return response()->json([
                                "comentario eliminado",
                                "comentario" => \App\Comentarios::all()
                                ],200);
}
    public function comentarioPersona(int $usuario_id,int $id=null ){
        return response()->json([
        'persona'=>( $id==null)? 
        Comentarios::where('usuario_id', $usuario_id)->get():
        Comentarios::where('usuario_id', $usaurio_id)->where('id',$id)->get()
    ],200);

}
    public function comentarioPublicacion( int $pub_id, int $id=null ){
         return response()->json([
        'publicaciones'=>( $id==null)? 
        Comentarios::where('publicacion_id', $pub_id)->get():
        Comentarios::where('publicacion_id', $pub_id)->where('id',$id)->get()
    ],200);
}
    public function comentarioPublicacionPersona(int $usuario_id, int $publicacion_id, int $id=null){
        return response()->json([
        'persona'=>( $id==null)? 
        Comentarios::where('usuario_id', $usuario_id)->where('publicacion_id', $publicacion_id)->get():
        Comentarios::where('usuario_id', $usuario_id)->where('publicacion_id', $publicacion_id)->where('id',$id)->get()
    ],200);
} 
    public function todaBaseDatos(){
        return response()->json([
        'Toda la Base de Datos'=>DB::table('comentarios')
        ->join('publicaciones','publicaciones.id', '=', 'comentarios.publicacion_id')
        ->join ('personas','personas.id','=', 'comentarios.persona_id')
        ->select('comentarios.*', 'publicaciones.*','personas.*')->get()
    ],200);
} 
} 

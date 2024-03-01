<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    public function login(Request $request){
        
        $usuario = $request->usuario;
        $senha = $request->senha;

        $usuarios = Usuario::where('usuario', '=', $usuario)->where('senha', '=', $senha)->first();

        if($usuarios != null)
        {
            echo json_encode("validado");
            session_start();
            $_SESSION['usuario'] = $usuarios->usuario;
        }
        
        // if(@$usuarios->id != null){
        //     @session_start();
        //     $_SESSION['id_usuario'] = $usuarios->id;
        //     $_SESSION['nome_usuario'] = $usuarios->nome;
        //     $_SESSION['nivel_usuario'] = $usuarios->nivel;
        //     $_SESSION['cpf_usuario'] = $usuarios->cpf;
            
        //     if($_SESSION['nivel_usuario'] == 'admin'){
        //         return view('painel-admin.index');
        //     }

        //     if($_SESSION['nivel_usuario'] == 'instrutor'){
        //         return view('painel-instrutor.index');
        //     }

        //     if($_SESSION['nivel_usuario'] == 'recep'){
        //         return view('painel-recepcao.index');
        //     }
        // }else{
        //     echo "<script language='javascript'> window.alert('Dados Incorretos!') </script>";
        //     return view('index');
        // }
    }
}
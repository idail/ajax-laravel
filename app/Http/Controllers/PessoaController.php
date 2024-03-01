<?php

namespace App\Http\Controllers;

use App\Models\Pessoa;
use Illuminate\Http\Request;

class PessoaController extends Controller
{
    public function inicio()
    {
        return view("listagem_pessoas");
    }

    public function pessoas()
    {
        $registros_pessoas = Pessoa::orderby("codigo_pessoa","asc")->paginate();
        echo json_encode($registros_pessoas);
    }

    public function buscar_pessoa($codigo_recebido)
    {
        $pessoa = Pessoa::find($codigo_recebido);
        return view("alterar_pessoa",["pessoa"=>$pessoa]);
    }

    public function editar_pessoa(Request $valores)
    {
        $pessoa = Pessoa::find($valores->codigo_pessoa);
        $pessoa->nome_pessoa = $valores->nome;
        $pessoa->senha_pessoa = $valores->senha;
        $resultado = $pessoa->save();
        if($resultado)
            echo json_encode("alterado com sucesso");
    }

    public function excluir_pessoa($codigo_recebido)
    {
        $pessoa = Pessoa::find($codigo_recebido);
        $resultado = $pessoa->delete();
        if($resultado)
            echo json_encode("excluido com sucesso");
    }

    public function exibir_cadastro()
    {
        return view("criar_pessoa");
    }

    public function cadastramento(Request $valores)
    {
        $pessoa = new Pessoa();
        $pessoa->nome_pessoa = $valores->nome;
        $pessoa->senha_pessoa = $valores->senha;
        $resultado = $pessoa->save();

        if($resultado)
            echo json_encode("cadastrado com sucesso");
    }
}
@extends('template.painel')
@section('title', 'Listagem de Pessoas')
@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="row mb-3">
        <div class="col-lg-6">
            <a href="{{route('exibir_cadastro')}}" class="btn btn-primary">Cadastrar Pessoa</a>
        </div>
    </div>



    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Pessoas</h5>
            <!-- Default Table -->
            <table class="table table-responsive">
                <thead>
                    <tr>
                        <th scope="col">Nome</th>
                        <th scope="col">Senha</th>
                        <th scope="col" colspan="2">Opções</th>
                    </tr>
                </thead>
                <tbody id="registros">
                </tbody>
            </table>
            <!-- End Default Table Example -->
        </div>
    </div>





    <div class="modal fade" id="deletar" tabindice="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Deletar Registro</h5>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Deseja realmente excluir esse registro?

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <form method="POST" action="">
                        @csrf
                        @method('delete')
                        <input type="hidden" name="codigo_pessoa" id="codigo-pessoa">
                        <button type="button" class="btn btn-danger" id="exclusao">Excluir</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ URL::asset('assets/vendor/jquery/jquery.min.js') }}"></script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script> --}}
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>


    <script>
        // $(document).ready(function(e) {
        //     $("#deletar").modal("show");
        // });
    </script>

    <script>
        $(document).ready(function(e) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: "get",
                url: "{{ route('listagem_pessoas') }}",
                dataType: "json",
                success: function(retorno) {
                    debugger;

                    let recebe_tabela_pessoas = document.querySelector("#registros");

                    $("#registros").html("");
                    if (retorno.data.length > 0) {
                        for (let indice = 0; indice < retorno.data.length; indice++) {
                            recebe_tabela_pessoas.innerHTML +=
                                "<tr>" +
                                "<td>" + retorno.data[indice].nome_pessoa + "</td>" +
                                "<td>" + retorno.data[indice].senha_pessoa + "</td>" +
                                "<td><a href='edicao_pessoa/" + retorno.data[indice].codigo_pessoa +
                                "'><i class='bi bi-pencil-square fs-3' title='Editar Pessoa' style='margin-inline-end: 10%;'></i></a></td>" +
                                "<td><a href='#' title='Excluir Pessoa' onclick='exibir_modal(" +
                                retorno
                                .data[indice].codigo_pessoa +
                                ",event);'><i class='bi bi-trash fs-3' title='Excluir Pessoa'></i></a></td>"
                            "</tr>";
                        }
                        $("#registros").append(recebe_tabela_pessoas);
                    }else{
                        $("#registros").append("<tr><td colspan='3' style='text-align:center;'>Nenhum registro localizado</td></tr>")
                    }
                }
            });
        });

        function exibir_modal(codigo_recebido, e) {
            e.preventDefault();
            if (codigo_recebido != null) {
                $("#codigo-pessoa").val(codigo_recebido);
                $("#deletar").modal("show");
            }
        }

        $("#exclusao").click(function(e) {
            e.preventDefault();

            let recebe_codigo_pessoa = $("#codigo-pessoa").val();

            if (recebe_codigo_pessoa === "")
                recebe_codigo_pessoa = 0;
            else
                recebe_codigo_pessoa = recebe_codigo_pessoa;

            if (recebe_codigo_pessoa != null) {
                $.ajax({
                    type: "delete",
                    url: "{{ route('excluir', '') }}" + "/" + recebe_codigo_pessoa,
                    dataType: "json",
                    success: function(retorno) {
                        debugger;
                        if (retorno === "excluido com sucesso") {
                            $("#deletar").modal("hide");
                            $.ajax({
                                type: "get",
                                url: "{{ route('listagem_pessoas') }}",
                                dataType: "json",
                                success: function(retorno) {
                                    debugger;

                                    let recebe_tabela_pessoas = document.querySelector(
                                        "#registros");

                                    $("#registros").html("");
                                    if (retorno.data.length > 0) {
                                        for (let indice = 0; indice < retorno.data
                                            .length; indice++) {
                                            recebe_tabela_pessoas.innerHTML +=
                                                "<tr>" +
                                                "<td>" + retorno.data[indice].nome_pessoa +
                                                "</td>" +
                                                "<td>" + retorno.data[indice].senha_pessoa +
                                                "</td>" +
                                                "<td><a href='edicao_pessoa/" + retorno
                                                .data[indice].codigo_pessoa +
                                                "'><i class='bi bi-pencil-square fs-3' title='Editar Pessoa' style='margin-inline-end: 10%;'></i></a></td>" +
                                                "<td><a href='#' title='Excluir Pessoa' onclick='exibir_modal(" +
                                                retorno
                                                .data[indice].codigo_pessoa +
                                                ",event);'><i class='bi bi-trash fs-3' title='Excluir Pessoa'></i></a></td>"
                                            "</tr>";
                                        }
                                        $("#registros").append(recebe_tabela_pessoas);
                                    }
                                }
                            });
                        }
                    }
                });
            }
        });
    </script>

@endsection

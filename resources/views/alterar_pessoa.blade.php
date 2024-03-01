@extends('template.painel')
@section('title', 'Alteração de Pessoa')
@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="col-lg-12">

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Edição de Pessoa</h5>

                <!-- General Form Elements -->
                <form id="formulario-edicao-pessoa">
                    @csrf
                    {{-- @method('put') --}}
                    <div class="row mb-3">
                        <div class="col-sm-12">
                            <label for="inputText" class="col-sm-2 col-form-label">Nome</label>
                            <input type="text" class="form-control" name="nome" value="{{ $pessoa->nome_pessoa }}">
                            @error('nome')
                                <div class="alert alert-warning bg-warning border-0 alert-dismissible fade show" role="alert">
                                    {{ $message }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @enderror

                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-sm-12">
                            <label for="inputPassword" class="col-sm-2 col-form-label">Senha</label>
                            <input type="text" class="form-control" name="senha" value="{{ $pessoa->senha_pessoa }}">
                            @error('email')
                                <div class="alert alert-warning bg-warning border-0 alert-dismissible fade show" role="alert">
                                    {{ $message }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @enderror
                        </div>
                    </div>

                    <input type="hidden" name="codigo_pessoa" id="codigo-pessoa" value="{{ $pessoa->codigo_pessoa }}">

                    <div class="row mb-3">
                        <!-- <label class="col-sm-2 col-form-label">Submit Button</label> -->
                        <div class="col-lg-2">
                            <button type="button" class="btn btn-primary mb-4" id="alterar-pessoa">Alterar</button><br>
                            {{-- @if ($mensagem = session()->get('sucesso'))
                        <div class="alert alert-primary bg-primary text-light border-0 alert-dismissible fade show" role="alert">
                            {{$mensagem}}
                        </div>
                        @endif --}}
                            <div class="alert alert-primary bg-primary text-light border-0 alert-dismissible fade show" id="registro-alterado"
                                role="alert">
                                
                            </div>
                        </div>
                    </div>

                </form>

            </div>
        </div>

    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script>
        $(document).ready(function(e) {
            $("#registro-alterado").hide();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        });

        $("#alterar-pessoa").click(function(e) {
            e.preventDefault();

            let dados_formulario = $("#formulario-edicao-pessoa")[0];
            let valores_formulario = new FormData(dados_formulario);

            $.ajax({
                type: "post",
                url: "{{ route('edita_pessoa') }}",
                data: valores_formulario,
                processData: false,
                contentType: false,
                dataType: "json",
                success: function(retorno) {
                    debugger;
                    if (retorno === "alterado com sucesso") {
                        $("#registro-alterado").html("Registro alterado");
                        $("#registro-alterado").show();
                        window.location.href = "{{route('pagina_inicial')}}";
                    }
                }
            });
        });
    </script>
@endsection

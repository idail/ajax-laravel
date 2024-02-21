<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
    <form id="formulario-usuario">
        @csrf
        <div class="container justify-content-center">
            <div class="col-lg-12">
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Usuario</label>
                    <input type="text" class="form-control" id="usuario" name="usuario">
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">Senha</label>
                    <input type="text" class="form-control" id="senha" name="senha">
                </div>
                <div>
                    <button type="button" class="btn btn-primary" id="acesso">Acesso</button>
                </div>
            </div>
        </div>
    </form>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <script>
        $(document).ready(function(e) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        });

        $("#acesso").click(function(e) {
            e.preventDefault();

            debugger;
            var dados_formulario = $("#formulario-usuario")[0];
            var formulario = new FormData(dados_formulario);
            var url_destino = "{{ route('usuarios.login') }}";
            $.ajax({
                url: "{{route('usuarios.login')}}",
                type: "post",
                data: formulario,
                processData:false,
                contentType:false,
                dataType: "json",
                success: function(response) {
                    debugger;
                    console.log(response);
                }
            });
        });
    </script>
</body>

</html>

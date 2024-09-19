<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="x-ua-compatible" content="IE=edge;"/>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>

	<meta http-equiv="refresh" content="1800">
        <base target="_top"/>
        <!-- Title -->


    </head> 

    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            /* background-image: linear-gradient(45deg, cyan, yellow); */
            overflow: hidden;

        }

        div {
            background-color: rgba(0, 0, 0, 0.9);
            position: absolute;
            top: 60%;
            left: 50%;
            transform: translate(-50%, -50%);
            padding: 60px;
            padding-top: 2%;
            border-radius: 15px;
            color: white;
        }

        input {
            padding: 15px;
            border: none;
            outline: none;
            font-size: 15px;
        }

        button {
            background-color: dodgerblue;
            border: none;
            padding: 15px;
            width: 100%;
            border-radius: 10px;
            color: white;
            font-size: 15px;
        }

        button:hover {
            background-color: deepskyblue;
            cursor: pointer;
        }
    </style>

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Tela de Login</title>
        <span><img src="{{ asset('assets/images/Login_Plansul_BBB.png') }}"
                style="width: 102%; height: 100%; margin:-1%; background-repeat: no-repeat;"></span>
    </head>

    <body>
        <div style="opacity: 85%; background-color:white">
            <!-- <form class="m-t-md" id="form_login"> -->
            <h1 style="color:black">Login</h1>
            <small style="color:black" class="text-center">Mesmo usuário e senha utilizado no Portal!</small>
            <br><br>
            <!-- <input type="text" placeholder="Nome"> -->
            <input style="background-color: lightgrey; width: 88%;" type="text" class="form-control" id="matricula"
                placeholder="Ex: P000000" required>
            <br><br>
            <!-- <input type="password" placeholder="Senha"> -->
            <input style="background-color: lightgrey; width: 88%; margin-bottom: 2%;" type="password" id="senha_login"
                class="form-control" placeholder="Senha" required>
            <br>
            <small style="color:red" hidden id="login_validation" class="text-center">Usuário e/ou senha estão
                incorretos!</small>
            <br><br>
            <button id="realizar_login" style="background-color:#fc416f">Login</button>

        </div>
    </body>

    <script>
        $("#realizar_login").on("click", realizar_login) // Ao clicar no botão.
        document.addEventListener('keydown', function(event) { // Ao apertar uma tecla.
            if (event.keyCode === 13) { // Se o código da tecla for 13 (Enter) vai executar o login.
                realizar_login()
            }
        })

        function realizar_login() { // Função de login.
            $.ajax({
                method: "post",
                url: "{{ route('validarUsuario') }}",
                data: {
                    "_token": "{{ csrf_token() }}",
                    matricula: $("#matricula").val(),
                    senha: $("#senha_login").val(),
                },
                success: function(result) {
                    console.log(result);
                    var validacao = JSON.parse(result)

                    if (validacao == "nao_validado") {
                        $("#login_validation").attr("hidden", false)
                        $("#login_validation_success").attr("hidden", true)
                    } else if (validacao == "validado") {
                        window.location.href = "{{ route('home') }}"
                    }
                }
            })
        };
    </script>

</html>



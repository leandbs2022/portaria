<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seja bem vindo</title>
    <link rel="icon" type="image/x-icon" href="/img/favico.ico">
    <?php
    session_start();
    if (empty($_SESSION["estilo"])) {
        $_SESSION["estilo"] = 0;
    }
    $estilo = $_SESSION["estilo"];
    if ($estilo == 0) {
        echo '<link rel=stylesheet href=css/efeitos.css>'; //escuro 0
        echo '<style>
        body {
    background-image: url("img/tela/escuro.jpg");
    background-position: center;
    background-repeat: no-repeat;
    background-size:cover;
     ;
        }
    </style>
        ';
        $estilotitulo = 'titulo centro borda fontebranca';
    } else {

        echo '<link rel=stylesheet href=css/efeitos2.css>'; // claro 1
        echo '<style>
        body {
    background-image: url("img/tela/claro.jpg");
    background-position: center;
    background-repeat: no-repeat;
    background-size:cover;
     ;
        }
    </style>
        ';
        $estilotitulo = 'titulo centro borda fontebranca';
    }
    ?>

</head>

<body>
    <div id="rel">
        <div id="timer" class="relogio"></div><br>
    </div>
    <script>
        function startTimer(duration, display) {
            var timer = duration,
                data, dia, mes, ano;
            var titulo = document.getElementById('ccontar')
            setInterval(function() {
                let data = new Date();

                h = data.getHours()
                m = data.getMinutes()
                s = data.getSeconds()

                h = (h < 10) ? '0' + h : h
                m = (m < 10) ? '0' + m : m
                s = (s < 10) ? '0' + s : s

                let dataFormatada = h + ':' + m + ':' + s;

                display.textContent = dataFormatada;
                if (--timer < 0) {
                    timer = duration;
                    location.reload();
                }
            }, 1000);

        }
        window.onload = function() {
            var duration = 60 * 5; // Converter para segundos
            display = document.querySelector('#timer'); // selecionando o timer
            // iniciando o timer
            startTimer(duration, display);
        };
    </script>
    <section>
    <!--<h1 class="mensagem">Click no ciclo para entrar!</h1>-->
        <div class="container">
            <div class="box">
            <h1 class="relogio">Click no ciclo!</h1> 
                <div class="content">
                    <img src="img/tela/inicio.jpg">
                    <h2><p class=""><span>Click para</span>  entrar</p></h2>
                    <a href="login.php">Entre com seu login</a>
                </div>
            </div>
            
        </div>
    </section>
    <footer></footer>
</body>

</html>
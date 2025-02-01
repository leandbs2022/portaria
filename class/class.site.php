<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class site //classe - Funcões
{
//////////////////////////////////////////////Equipamento//////////////////////////////////////////////////

function add_equip($modelo,$marca,$processador,$memoria,$disco,$chipset,$pgrafico,$link_sup,$fonte,$tipo){
    if(empty($modelo) || empty($tipo)){
        echo "<script>alert('(Modelo) ou (Tipo) não foi digitado!')</script>";
    }else{
        require("./conect.php");
        $query = mysqli_query($conn, "SELECT * FROM `equipamento` WHERE modelo='$modelo'")  or die(mysqli_error($conn));
        if (mysqli_num_rows($query)) {
            echo "<script>alert('Esse registro já existe só será alterado!')</script>";
            while ($array = mysqli_fetch_row($query)) { $id_mod = $array[0];}
            $query = mysqli_query($conn,"UPDATE `equipamento` SET `modelo`='$modelo',`marca`='$marca',`processador`='$processador',`memoria`='$memoria',`disco`='$disco',`chipset`='$chipset',
            `pgrafico`='$pgrafico',`link_sup`='$link_sup',`fonte`='$fonte',`tipo`='$tipo' WHERE id_mod='$id_mod'");
        }else{
            echo "<script>alert('Dados enviado com sucesso!')</script>";
            $query = mysqli_query($conn, "INSERT INTO `equipamento`(`modelo`, `marca`, `processador`, `memoria`, `disco`, `chipset`, `pgrafico`, `link_sup`, `fonte`, `tipo`)
             VALUES ('$modelo','$marca','$processador','$memoria','$disco','$chipset','$pgrafico','$link_sup','$fonte','$tipo')");
             return $query;
        }
    } 
    }
    function alt_equip($patrimonio,$serial,$modelo,$chamado,$cliente,$situacao,$tecnico,$data){
    
    }
    function del_equip($patrimonio,$serial,$modelo,$chamado,$cliente,$situacao,$tecnico,$data){
    
    }
    function loc_equip($localizar){
     
        require "./conect.php";
        $query = mysqli_query($conn, "SELECT DISTINCT * from equipamento where modelo='$localizar'");
        if (mysqli_num_rows($query)) {
        while ($array = mysqli_fetch_row($query)) {
            $_SESSION["modelo"] = $array[1];
            $_SESSION["marca"] = $array[2];
            $_SESSION["processador"] = $array[3];
            $_SESSION["memoria"] = $array[4];
            $_SESSION["disco"] = $array[5];
            $_SESSION['chipset'] = $array[6];
            $_SESSION["pgrafico"] = $array[7];
            $_SESSION["link_sup"] = $array[8];
            $_SESSION['fonte'] = $array[9];
            $_SESSION['tipo'] = $array[10];
           
        }
        }else{
            
        }
    }
    function rel_equip($patrimonio,$serial,$modelo,$chamado,$cliente,$situacao,$tecnico,$data){
    
    }
    function verficador_coord($coordenador){
    
    }
//////////////////////////////////////////////Laudos//////////////////////////////////////////////////
function add_laudos($patrimonio,$serial,$modelo,$chamado,$cliente,$situacao,$tipo,$tecnico,$data){
if(empty($chamado) || empty($serial) ){
    echo "<script>alert('Número e Serial não foi digitado!')</script>";
}else{
    require("./conect.php");
    $query = mysqli_query($conn, "SELECT * FROM `laudos_pc` WHERE chamado='$chamado' and nserial='$serial' ")  or die(mysqli_error($conn));
    if (mysqli_num_rows($query)) {
        echo "<script>alert('Esse registro já existe!')</script>";
    }else{
        echo "<script>alert('dados enviados!')</script>";
        $query = mysqli_query($conn, "INSERT INTO `laudos_pc`(`patrimonio`, `nserial`, `modelo`, `chamado`, `cliente`, `descr`, `tipo`, `tecnico`, `data`) VALUES
         ('$patrimonio','$serial','$modelo','$chamado','$cliente','$situacao','$tipo','$tecnico','$data')");
    }
}

}

function add_laudos2($modelo,$dados2){
    if(empty($modelo) || empty($dados2) ){
        echo "<script>alert('$modelo')</script>";
    }else{
        require("./conect.php");
        $query = mysqli_query($conn, "SELECT * FROM `laudos_dados_equi` WHERE modelo='$modelo'") or die(mysqli_error($conn));
        if (mysqli_num_rows($query)) {
            echo "<script>alert('Esse registro já existe!')</script>";
        }else{
            $query = mysqli_query($conn, "INSERT INTO `laudos_dados_equi`(`modelo`, `texto`) VALUES ('$modelo','$dados2')");
             echo "<script>alert('dados enviados!')</script>";
        }
    }
}
function alt_laudos($patrimonio,$serial,$modelo,$chamado,$cliente,$situacao,$tecnico,$data){

}
function del_laudos($patrimonio,$serial,$modelo,$chamado,$cliente,$situacao,$tecnico,$data){

}
function loc_laudos($patrimonio,$serial,$modelo,$chamado,$cliente,$situacao,$tecnico,$data){
   
}
function rel_laudos($patrimonio,$serial,$modelo,$chamado,$cliente,$situacao,$tecnico,$data){

}

function gerar_laudo_pc($laudo)
    {
        require("./conect.php");
        $query = mysqli_query($conn, "SELECT * FROM laudos_pc WHERE id_lau='$laudo'") or die(mysqli_error($conn));
        if (mysqli_num_rows($query)) {
            while ($array = mysqli_fetch_row($query)) {
                $_SESSION["id_lau"] = $array[0];
                $_SESSION["patrimonio"] = $array[1];
                $_SESSION["serial"] = $array[2];
                $_SESSION["modelo"] = $array[3];
                $_SESSION["chamado"] = $array[4];
                $_SESSION['cliente'] = $array[5];
                $_SESSION["descr"] = $array[6];
                $_SESSION["tipo"] = $array[7];
                $_SESSION['tecnico'] = $array[8];
                $_SESSION["data"] = $array[9];
            }
                echo "<p><button type='button' name='tlaudo' class='btn btn-success'>Resultado gerado...</button></p>";
        } else {
            if ($ativo == 1) echo "<script>alert('Niguém encontrado com esse codigo!')</script>";
        }
    }
    //////////////////////////////////////////////Login de entrada//////////////////////////////////////////////////
    //verificação de entrada

    function login($nome, $senha)
    {
        //session_start();

        require("./conect.php");
        $query = mysqli_query($conn, "SELECT * FROM `usuarios` WHERE nome='$nome'")  or die(mysqli_error($conn));

        if (mysqli_num_rows($query)) {
            while ($array = mysqli_fetch_row($query)) {
                $cript = $array[2];
                $sen = base64_decode($cript);
                if ($senha == $sen) {
                    date_default_timezone_set('America/Sao_Paulo');
                    $_SESSION['data'] = date('d/m/Y H:i');
                    $_SESSION['nome'] = $array['1'];
                    $_SESSION['perfil'] = $array['4'];
                    $_SESSION['id_f'] = $array['0'];
                    $_SESSION['cnome'] = $array['3'];
                    $_SESSION['email'] = $array['5'];
                    $perfilb = $array['4'];
                    if ($_SESSION['perfil'] <> 1) {
                        switch ($perfilb) {
                            case '2':
                                $_SESSION['nivel'] = "Usuário comum";
                                break;
                                exit;
                            case '3':
                                $_SESSION['nivel'] = "Condernador";
                                break;
                                exit;
                            case '4':
                                $_SESSION['nivel'] = "Técnico";
                                break;
                                exit;
                            case '5':
                                $_SESSION['nivel'] = "Vigilante";
                                break;
                                exit;
                        }
                    } else {
                        $_SESSION['nivel'] = "Administrador";
                    }
                    $jaVisitou = @$_SESSION["jaVisitou"];
                    $linha = file("contador.txt");
                    if ($jaVisitou) {
                        $visitas = $linha[0];
                    } else {
                        $visitas = $linha[0];
                        $visitas += 1;
                        $cf = fopen("contador.txt", "w");
                        fputs($cf, "$visitas");
                        fclose($cf);
                        $_SESSION["jaVisitou"] = true;
                    }
                    header('Location: portaria.php');
                } else {
                    echo "<script>alert('Acesso negado tente novamente senha incorreta!')</script>";
                    echo "<script>alert('$cript')</script>";
                }
            }
            return $query;

        } else {

            echo "<script>alert('Acesso negado tente novamente nome incorreto!')</script>";
            echo "<script>alert('$cript')</script>";
        }
    }
    //verificação se esta logado
    function validar()
    {
        if ($_SESSION['perfil'] == 0) {
            header('Location: index.php');
        }
    }
    /////////////////////////////////////////Cadastro de usuarios////////////////////////////////////////////////
    function usuario_add($completo,$nome, $senha, $perfil, $email)
    {
        require("./conect.php");
        $query = mysqli_query($conn, "SELECT * FROM `usuarios` WHERE nome='$nome'");
        if (mysqli_num_rows($query)) {
            echo "<script>alert('O usuário ja existe!')</script>";
        } else {
            $cript = base64_encode($senha);
            $query = mysqli_query($conn, "INSERT INTO `usuarios`(`nome`, `senha`, `completo`, `perfil`, `email`,`estilo`,desativar) VALUES ('$nome','$cript','$completo','$perfil','$email',0,0)") or die(mysqli_error($conn));
            echo "<script>alert('o usuário criado com sucesso!')</script>";
        }
    }
    //alterar usuarios
    function usuario_alt($completo,$nome, $senha, $perfil, $email)
    {
        if (empty($nome)) {
            echo "<script>alert('Faça uma busca do usuário a ser alterado depois click em alterar!')</script>";
        } else {
            require("./conect.php");
            $query = mysqli_query($conn, "SELECT * FROM `usuarios` WHERE nome='$nome'")  or die(mysqli_error($conn));;
            if (mysqli_num_rows($query)) {
                while ($array = mysqli_fetch_row($query)) {
                    $id = $array[0];
                }
                $cript = base64_encode($senha);
                $query = mysqli_query($conn, "UPDATE `usuarios` SET `senha`='$cript',`completo`='$completo',`perfil`='$perfil',`email`='$email',`estilo`=0 WHERE id='$id'")  or die(mysqli_error($conn));
                echo "<script>alert('o usuário atualizado com sucesso!')</script>";
            } else {

                echo "<script>alert('o usuário não existe!')</script>";
            }
        }
    }

    //estilo de tela do usuarios
    function usuario_estilo($estilo, $nome)
    {
        require("./conect.php");
        $query = mysqli_query($conn, "SELECT * FROM `usuarios` WHERE nome='$nome'") or die(mysqli_error($conn));;
        if (mysqli_num_rows($query)) {
            while ($array = mysqli_fetch_row($query)) {
                $id = $array[0];
            }

            $query = mysqli_query($conn, "UPDATE `usuarios` SET `estilo`='$estilo' WHERE id='$id'") or die(mysqli_error($conn));
            $_SESSION["estilo"] =  $estilo;
        }
    }

    function load_estilo($nome)
    {
        require("./conect.php");
        $query = mysqli_query($conn, "SELECT * FROM `usuarios` WHERE nome='$nome'")  or die(mysqli_error($conn));;
        if (mysqli_num_rows($query)) {
            while ($array = mysqli_fetch_row($query)) {
                $_SESSION["estilo"] = $array[5];
            }
        }
    }
    //deleta usuarios
    function usuario_del($nome)
    {
        if (empty($nome)) {
            echo "<script>alert('Faça uma busca do usuário a ser deletado depois click em deletar!')</script>";
        } else {
            require("./conect.php");
            $query = mysqli_query($conn, "SELECT * FROM `usuarios` WHERE nome='$nome'") or die(mysqli_error($conn));;
            if (mysqli_num_rows($query)) {
                while ($array = mysqli_fetch_row($query)) {
                    $id = $array[0];
                }
                $query = mysqli_query($conn, "DELETE FROM `usuarios` WHERE id='$id'");
                echo "<script>alert('o usuário deletado com sucesso!')</script>";
            } else {

                echo "<script>alert('Verificar se usuário que deseja deleta realmente existe!')</script>";
            }
        }
    }
    //localizar usuarios
    function localizar_usuario($nome)
    {
        require("./conect.php");
        $query = mysqli_query($conn, "SELECT * FROM `usuarios` WHERE nome='$nome'")  or die(mysqli_error($conn));
        if (mysqli_num_rows($query)) {
            while ($array = mysqli_fetch_row($query)) {
                $_SESSION["completo_l"] = $array[3];
                $_SESSION["nome_l"] = $array[1];
                $_SESSION["perfil_l"] = $array[4];
                $_SESSION['email_l'] = $array[5];
            }
        } else {
            echo "<script>alert('Niguém encontrado com esse nome!')</script>";
        }
    }
    ////////////////////////////////informação importante////////////////////////////////////////////////////////////

    function visiualzar_user($user)
    {
        $count = 0;
        require("./conect.php");
        $query = mysqli_query($conn, "SELECT * FROM infor WHERE id_infor='$user'")  or die(mysqli_error($conn));
        if (mysqli_num_rows($query)) {
            $estilos[0] = "background-color: #BDBDBD;font-size:12px;color:black;font-style:bold;font-family:Roboto;
        text-align: center;";
            echo "<table style=\"width: 100%\" cellpadding=\"0\" cellspacing=\"0\" border=\"1\"><tbody><tr>
        <td style=\"$estilos[0]\">ID</td>
        <td style=\"$estilos[0]\">USUARIO</td>
        <td style=\"$estilos[0]\">RAMAL</td>
        <td style=\"$estilos[0]\">ALTERAR</td>
        <td style=\"$estilos[0]\"></td>
        </tr>";
            while ($array = mysqli_fetch_row($query)) {
                $count = $count + 1;
                if ($count % 2 == 0) {
                    $color = "#E6E6E6";
                } else {
                    $color = "white";
                }
                $estilos[1] = "background-color:{$color};font-size:11px;color:black;
            font-style:bold;font-family: Times New Roman, Times, serif;
            text-align: center;border:1 ;width: auto;";
                echo "<tr>
            <td style=\"$estilos[1]\">$array[0]</td>
            <td style=\"$estilos[1]\">$array[1]</td>
            <td style=\"$estilos[1]\">$array[2]</td>
            <td style=\"$estilos[1]\">$array[2]</td>
            </tr>";
            }
        }
    }
    function visiualzar_informacao($user)
    {
        $count = 0;
        require("./conect.php");
        $query = mysqli_query($conn, "SELECT * FROM infor WHERE depar='$user'")  or die(mysqli_error($conn));
        if (mysqli_num_rows($query)) {
            $estilos[0] = "background-color: #BDBDBD;font-size:12px;color:black;font-style:bold;font-family:Roboto;
        text-align: center;";
            echo "<table style=\"width: 50%\" cellpadding=\"0\" cellspacing=\"0\" border=\"1\"><tbody><tr>
        <td style=\"$estilos[0]\">ID</td>
        <td style=\"$estilos[0]\">USUARIO</td>
        <td style=\"$estilos[0]\">RAMAL</td>
        <td style=\"$estilos[0]\"></td>
        </tr>";
            while ($array = mysqli_fetch_row($query)) {
                $count = $count + 1;
                if ($count % 2 == 0) {
                    $color = "#E6E6E6";
                } else {
                    $color = "white";
                }
                $estilos[1] = "background-color:{$color};font-size:11px;color:black;
            font-style:bold;font-family: Times New Roman, Times, serif;
            text-align: center;border:1 ;width: auto;";
                echo "<tr>
            <td style=\"$estilos[1]\">$array[0]</td>
            <td style=\"$estilos[1]\">$array[1]</td>
            <td style=\"$estilos[1]\">$array[2]</td>

            </tr>";
            }

        }
    }

    function visiualzar_excel()
    {
        $count = 0;
        require("./conect.php");
        $query = mysqli_query($conn, "SELECT * FROM infor WHERE 1")  or die(mysqli_error($conn));
        if (mysqli_num_rows($query)) {
            echo "<h1> Lista de informações uteis</h1>";
            $estilos[0] = "background-color: #BDBDBD;font-size:18px;color:black;font-style:bold;font-family:Roboto;
        text-align: center; width: auto;";
            echo "<table style=\"width: 100%\" cellpadding=\"0\" cellspacing=\"0\" border=\"1\"><tbody><tr>
        <td style=\"$estilos[0]\">USER</td>
        <td style=\"$estilos[0]\">RAMAL</td>
        <td style=\"$estilos[0]\">DEP</td>
        <td style=\"$estilos[0]\">EMAIL</td>
        <td style=\"$estilos[0]\">OBS</td>
        <td style=\"$estilos[0]\">Visualizar</td>
        </tr>";
            while ($array = mysqli_fetch_row($query)) {
                $count = $count + 1;
                if ($count % 2 == 0) {
                    $color = "#E6E6E6";
                } else {
                    $color = "white";
                }
                $estilos[1] = "background-color:{$color};font-size:12px;color:black;
            font-style:bold;font-family: Times New Roman, Times, serif;
            text-align: center;border:1 ;width: auto;";
                echo "<tr>
            <td style=\"$estilos[1]\">$array[1]</td>
            <td style=\"$estilos[1]\">$array[2]</td>
            <td style=\"$estilos[1]\">$array[3]</td>
            <td style=\"$estilos[1]\">$array[4]</td>
            <td style=\"$estilos[1]\">$array[5]</td>
            <td style=\"$estilos[1]\"><button type=button class=btn btn-outline-secondary btn-sm data-bs-toggle=modal data-bs-target=#exampleModal1>informação</button></td>
            </tr>";
            }
        }
    }

    function add_informacao($user, $ram, $dep, $email, $descr)
    {
        echo "<script>alert('$dep')</script>";
        require("./conect.php");
        $query = mysqli_query($conn, "SELECT * FROM `infor` WHERE usuario='$user'");
        if (mysqli_num_rows($query)) {
            echo "<script>alert('Este usuário já existe!')</script>";
        } else {
            $query = mysqli_query($conn, "INSERT INTO `infor`(`usuario`, `ramal`, `depar`, `email`, `descr`) VALUES('$user','$ram','$dep','$email','$descr')") or die(mysqli_error($conn));

            echo "<script>alert('o registro criado com sucesso!A página será atualizada agora!');</script>";
        }
    }
    function alt_informacao($id, $user, $ram, $dep, $email, $descr)
    {
        require("./conect.php");
        $query = mysqli_query($conn, "SELECT DISTINCT * FROM infor WHERE id_infor='$id'")  or die(mysqli_error($conn));
        if (mysqli_num_rows($query)) {
            $query = mysqli_query($conn, "UPDATE `infor` SET `usuario`='$user',`ramal`='$ram',`depar`='$dep',`email`='$email', `descr`='$descr' WHERE id_infor='$id'")  or die(mysqli_error($conn));
            echo "<script>alert('o registro foi alterado com sucesso!');
        </script>";
        } else {
            echo "<script>alert('o registro não alterado com sucesso favor verificar!');
        </script>";
        }
    }
    function pes($user)
    {
        require("./conect.php");
        $query = mysqli_query($conn, "SELECT * FROM infor WHERE depar='$user'")  or die(mysqli_error($conn));
        if (mysqli_num_rows($query)) {
            while ($array = mysqli_fetch_row($query)) {
                $_SESSION["id_user"] = $array[0];
                $_SESSION["user_alt"] = $array[1];
                $_SESSION["ram_alt"] = $array[2];
                $_SESSION["dep_alt"] = $array[3];
                $_SESSION["email_alt"] = $array[4];
                $_SESSION['descr_alt'] = $array[5];

            }
        }
    }
    function pes1($user, $ativo)
    {
        require("./conect.php");
        $query = mysqli_query($conn, "SELECT * FROM infor WHERE id_infor='$user'") or die(mysqli_error($conn));
        if (mysqli_num_rows($query)) {
            while ($array = mysqli_fetch_row($query)) {
                $_SESSION["id_user"] = $array[0];
                $_SESSION["user_alt"] = $array[1];
                $_SESSION["ram_alt"] = $array[2];
                $_SESSION["dep_alt"] = $array[3];
                $_SESSION["email_alt"] = $array[4];
                $_SESSION['descr_alt'] = $array[5];
            }
            if ($ativo != 3) {
                echo "<p><button type='button' name='tadic' class='btn btn-success' data-bs-toggle='modal' data-bs-target='#exampleModal2'>Resultado gerado...</button></p>";
            }
        } else {
            if ($ativo == 1) echo "<script>alert('Niguém encontrado com esse codigo!')</script>";
        }
    }
    ////////////////////////////////ramais////////////////////////////////////////////////////////////

    function ramais_user($user)
    {
        $count = 0;
        require("./conect.php");
        $query = mysqli_query($conn, "SELECT * FROM ramais WHERE id_infor='$user'")  or die(mysqli_error($conn));
        if (mysqli_num_rows($query)) {
            $estilos[0] = "background-color: #BDBDBD;font-size:12px;color:black;font-style:bold;font-family:Roboto;
        text-align: center;";
            echo "<table style=\"width: 100%\" cellpadding=\"0\" cellspacing=\"0\" border=\"1\"><tbody><tr>
        <td style=\"$estilos[0]\">ID</td>
        <td style=\"$estilos[0]\">USUARIO</td>
        <td style=\"$estilos[0]\">RAMAL</td>
        <td style=\"$estilos[0]\">ALTERAR</td>
        <td style=\"$estilos[0]\"></td>
        </tr>";
            while ($array = mysqli_fetch_row($query)) {
                $count = $count + 1;
                if ($count % 2 == 0) {
                    $color = "#E6E6E6";
                } else {
                    $color = "white";
                }
                $estilos[1] = "background-color:{$color};font-size:11px;color:black;
            font-style:bold;font-family: Times New Roman, Times, serif;
            text-align: center;border:1 ;width: auto;";
                echo "<tr>
            <td style=\"$estilos[1]\">$array[0]</td>
            <td style=\"$estilos[1]\">$array[1]</td>
            <td style=\"$estilos[1]\">$array[2]</td>
            <td style=\"$estilos[1]\">$array[2]</td>
            </tr>";
            }
        }
    }
    function visiualzar_ramais($user)
    {
        $count = 0;
        require("./conect.php");
        $query = mysqli_query($conn, "SELECT * FROM ramais WHERE descr='$user'")  or die(mysqli_error($conn));
        if (mysqli_num_rows($query)) {
        $estilos[0] = "background-color: #BDBDBD;font-size:12px;color:black;font-style:bold;font-family:Roboto;
        text-align: ledt;";
        echo "<table style=\"width:35%\" cellpadding=\"0\" cellspacing=\"0\" border=\"1\"><tbody><tr>
        <td style=\"$estilos[0]\">ID</td>
        <td style=\"$estilos[0]\">USUARIO</td>
        <td style=\"$estilos[0]\">RAMAL</td>
        <td style=\"$estilos[0]\"></td>
        </tr>";
            while ($array = mysqli_fetch_row($query)) {
                $count = $count + 1;
                if ($count % 2 == 0) {
                    $color = "#E6E6E6";
                } else {
                    $color = "white";
                }
                $estilos[1] = "background-color:{$color};font-size:11px;color:black;
            font-style:bold;font-family: Times New Roman, Times, serif;
            text-align: left;border:1 ;width: auto;";
                echo "<tr>
            <td style=\"$estilos[1]\">$array[0]</td>
            <td style=\"$estilos[1]\">$array[1]</td>
            <td style=\"$estilos[1]\">$array[2]</td>

            </tr><br>";
            }

        }
    }
    function visiualzar_tables($user)
    {
        require("./conect.php");
        $count = 0 ;
        $query = mysqli_query($conn, "SELECT * FROM ramais WHERE descr='$user'")  or die(mysqli_error($conn));
        if (mysqli_num_rows($query)) {
            echo "<table id=example class=table table-striped style=width:auto>
            <thead>
                <tr>
                    <th>Código</th>
                    <th>Usuário</th>
                    <th>Ramal</th>
                </tr>
            </thead>";
            while ($array = mysqli_fetch_row($query)) {
                $id = $array[0];
                $usuarios = $array[1];
                $ramal = $array[2];
                $count = $count + 1;

           echo"
        <tbody>
            <tr>
                <td>$id</td>
                <td>$usuarios</td>
                <td>$ramal</td>
            </tr>
            </tbody>";
        }
        echo"<tfoot>
            <tr>
                <th>Quantidade: $count</th>
                <th>Usuários</th>
                <th>Ramal</th>
            </tr>
        </tfoot>
    </table>
            ";
        }
    }

    function ramais_excel()
    {
        $count = 0;
        require("./conect.php");
        $query = mysqli_query($conn, "SELECT * FROM ramais WHERE 1")  or die(mysqli_error($conn));
        if (mysqli_num_rows($query)) {
            echo "<h1> Lista de ramais</h1>";
            $estilos[0] = "background-color: #BDBDBD;font-size:18px;color:black;font-style:bold;font-family:Roboto;
        text-align: center; width: auto;";
            echo "<table style=\"width: 100%\" cellpadding=\"0\" cellspacing=\"0\" border=\"1\"><tbody><tr>
        <td style=\"$estilos[0]\">Nome</td>
        <td style=\"$estilos[0]\">Ramal</td>
        <td style=\"$estilos[0]\">Departamento</td>
        <td style=\"$estilos[0]\">E-mail</td>
        <td style=\"$estilos[0]\">Local</td>
        </tr>";
            while ($array = mysqli_fetch_row($query)) {
                $count = $count + 1;
                if ($count % 2 == 0) {
                    $color = "#E6E6E6";
                } else {
                    $color = "white";
                }
                $estilos[1] = "background-color:{$color};font-size:12px;color:black;
            font-style:bold;font-family: Times New Roman, Times, serif;
            text-align: center;border:1 ;width: auto;";
                echo "<tr>
            <td style=\"$estilos[1]\">$array[1]</td>
            <td style=\"$estilos[1]\">$array[2]</td>
            <td style=\"$estilos[1]\">$array[3]</td>
            <td style=\"$estilos[1]\">$array[4]</td>
            <td style=\"$estilos[1]\">$array[5]</td>
            </tr>";
            }
        }
    }
    function add_dep($dep, $ativa)
    {
        if (empty($dep)) {
            echo "<script>alert('verificar se os campo estão preenchidos!')</script>";
        } else {
            require("./conect.php");
            $query = mysqli_query($conn, "SELECT * FROM `dep` WHERE dep='$dep'");
            $dep = mb_strtoupper($dep);
            if (mysqli_num_rows($query)) {
                while ($array = mysqli_fetch_row($query)) {
                    $id = $array[0];
                }
                $query = mysqli_query($conn, "UPDATE `dep` SET `ativa`='$ativa' WHERE id_dep='$id'")  or die(mysqli_error($conn));
                echo "<script>alert('Este departamento já existe o registro será alterado!')</script>";
            } else {
                $query = mysqli_query($conn, "INSERT INTO `dep`(`dep`,`ativa`) VALUES('$dep','$ativa')") or die(mysqli_error($conn));
                echo "<script>alert('o registro criado com sucesso!A página será atualizada agora!');</script>";
            }
        }
    }
    function add_local($local)
    {
        if (empty($local)) {
            echo "<script>alert('verificar se os campo estão preenchidos!')</script>";
        } else {
            require("./conect.php");
            $query = mysqli_query($conn, "SELECT * FROM `locais` WHERE loc='$local'");
            $local = mb_strtoupper($local);
            if (mysqli_num_rows($query)) {
                while ($array = mysqli_fetch_row($query)) {
                    $id = $array[0];
                }
                $query = mysqli_query($conn, "UPDATE `locais` SET `loc`='$local' WHERE id_local='$id'")  or die(mysqli_error($conn));
                echo "<script>alert('Este local já existe o registro será alterado!')</script>";
            } else {
                $query = mysqli_query($conn, "INSERT INTO `locais`(`loc`) VALUES('$local')") or die(mysqli_error($conn));
                echo "<script>alert('o registro criado com sucesso!A página será atualizada agora!');</script>";
            }
        }
    }
    function alt_dep($dep, $ativa)
    {
        require("./conect.php");
        $query = mysqli_query($conn, "SELECT DISTINCT * FROM dep WHERE dep='$dep'")  or die(mysqli_error($conn));
        if (mysqli_num_rows($query)) {
            $query = mysqli_query($conn, "UPDATE `dep` SET `dep`='$dep',`ativa`='$ativa' WHERE id_dep='$id'")  or die(mysqli_error($conn));
            echo "<script>alert('o registro foi alterado com sucesso!');
        </script>";
        } else {
            echo "<script>alert('o registro não foi alterado com sucesso favor verificar!');
        </script>";
        }
    }
    function add_ramais($user, $ram, $dep, $email, $descr)
    {
        require("./conect.php");
        $query = mysqli_query($conn, "SELECT * FROM `ramais` WHERE usuario='$user'");
        if (mysqli_num_rows($query)) {
            echo "<script>alert('Este usuário já existe!')</script>";
        } else {
            $query = mysqli_query($conn, "INSERT INTO `ramais`(`usuario`, `ramal`, `depar`, `email`, `local`) VALUES('$user','$ram','$dep','$email','$descr')") or die(mysqli_error($conn));
            echo "<script>alert('o registro criado com sucesso!A página será atualizada agora!');</script>";
        }
    }
    function alt_ramais($id, $user, $ram, $dep, $email, $descr,$priv)
    {
        require("./conect.php");
        $query = mysqli_query($conn, "SELECT DISTINCT * FROM ramais WHERE id_infor='$id'")  or die(mysqli_error($conn));
        if (mysqli_num_rows($query)) {
            $query = mysqli_query($conn, "UPDATE `ramais` SET `usuario`='$user',`ramal`='$ram',`depar`='$dep',`privado`='$priv',`email`='$email',`local`='$descr' WHERE id_infor='$id'")  or die(mysqli_error($conn));
            echo "<script>alert('o registro foi alterado com sucesso!');
        </script>";
        } else {
            echo "<script>alert('o registro não foi alterado com sucesso favor verificar!');
        </script>";
        }
    }
    function pes_ramais($user)
    {
        require("./conect.php");
        $query = mysqli_query($conn, "SELECT * FROM ramais WHERE descr='$user'")  or die(mysqli_error($conn));
        if (mysqli_num_rows($query)) {
            while ($array = mysqli_fetch_row($query)) {
                $_SESSION["id_user"] = $array[0];
                $_SESSION["user_alt"] = $array[1];
                $_SESSION["ram_alt"] = $array[2];
                $_SESSION["dep_alt"] = $array[3];
                $_SESSION["email_alt"] = $array[4];
                $_SESSION['descr_alt'] = $array[5];
                $_SESSION["priv"] = $array[7];
            }
        }
    }
    function pes1_ramais($user, $ativo)
    {
        require("./conect.php");
        $query = mysqli_query($conn, "SELECT * FROM ramais WHERE id_infor='$user'") or die(mysqli_error($conn));
        if (mysqli_num_rows($query)) {
            while ($array = mysqli_fetch_row($query)) {
                $_SESSION["id_user"] = $array[0];
                $_SESSION["user_alt"] = $array[1];
                $_SESSION["ram_alt"] = $array[2];
                $_SESSION["dep_alt"] = $array[3];
                $_SESSION["email_alt"] = $array[4];
                $_SESSION['descr_alt'] = $array[5];
                $_SESSION["priv"] = $array[7];
            }
            if ($ativo != 3) {
                echo "<p><button type='button' name='tadic' class='btn btn-success' data-bs-toggle='modal' data-bs-target='#exampleModal2'>Resultado gerado...</button></p>";
            }
        } else {
            if ($ativo == 1) echo "<script>alert('Niguém encontrado com esse codigo!')</script>";
        }
    }
    ///////////////////////////////////////////////////Cadastro de link///////////////////////////////////////////////////
    function add_alt_links($link, $descr)
    {
        require("./conect.php");
        $query = mysqli_query($conn, "SELECT * FROM `links` WHERE link='$link'");
        if (mysqli_num_rows($query)) {
            echo "<script>alert('Este link já existe!')</script>";
        } else {
            $query = mysqli_query($conn, "INSERT INTO `links`(`link`,`descricao`) VALUES('$link','$descr')") or die(mysqli_error($conn));
            echo "<script>alert('o registro criado com sucesso!A página será atualizada agora!');</script>";
        }
    }

    function del_links($link_del)
    {
        require("./conect.php");
        $id_link = 0;
        $query = mysqli_query($conn, "SELECT * FROM links WHERE descricao='$link_del'")  or die(mysqli_error($conn));
        if (mysqli_num_rows($query)) {
            while ($array = mysqli_fetch_row($query)) {
                $id_link = $array[0];
            }
            $query = mysqli_query($conn, "DELETE FROM `links` WHERE id_link='$id_link '")  or die(mysqli_error($conn));
            echo "<script>alert('Registro deletado!')</script>";
        } else {
            echo "<script>alert('Nenhum registro encontrado!')</script>";
        }
    }
    function vlinks()
    {
        require("./conect.php");
        $query = mysqli_query($conn, "SELECT * FROM links WHERE 1")  or die(mysqli_error($conn));
        if (mysqli_num_rows($query)) {
            echo "<p class=borda fontebranca direita>";
            while ($array = mysqli_fetch_row($query)) {
                echo " <a class='marcatexto centro fontebranca' href={$array[1]} target=_black><img class=imgtitulo src=img/link.svg atl={$array[2]} title={$array[2]}>{$array[2]}</a> |";
            }
            echo "</p>";
        }
    }
    ///////////////////////////////////////////////////Cadastro de base///////////////////////////////////////////////////
    function base_add($idcad, $tipop, $tipos, $data, $autor, $atualdt, $link)
    {
        require("./conect.php");
        $query = mysqli_query($conn, "SELECT * FROM `base` WHERE tipo_p='$tipop'");
        if (mysqli_num_rows($query)) {
            echo "<script>alert('Este problema já existe!')</script>";
        } else {
            $idcad =  mb_strtoupper($idcad);
            $tipop =  mb_strtoupper($tipop);
           // $tipos =  mb_strtoupper($tipos);
            $autor =  mb_strtoupper($autor);
            $query = mysqli_query($conn, "INSERT INTO `base`(`id_cat`, `tipo_p`, `tipo_s`, `data`, `Autor`, `atual_dt`,`link`) VALUES('$idcad','$tipop','$tipos','$data','$autor','$atualdt','$link')") or die(mysqli_error($conn));
            echo "<script>alert('o registro criado com sucesso!A página será atualizada agora!');</script>";
        }
    }

    function base_alt($idcad, $tipop, $tipos, $atualdt, $link)
    {
        require("./conect.php");
        $tipop =  mb_strtoupper($tipop);
        //$tipos =  mb_strtoupper($tipos);
        $query = mysqli_query($conn, "UPDATE `base` SET `tipo_p`='$tipop',`tipo_s`='$tipos',`atual_dt`='$atualdt',`link`='$link' WHERE id_base='$idcad'")  or die(mysqli_error($conn));
        $_SESSION["idbase"] = 0;
        echo "<script>alert('o registro foi alterado com sucesso!');
            </script>";
        return $query;
    }

    function localizar_base($prob)
    {
        require("./conect.php");
        $query = mysqli_query($conn, "SELECT * FROM `base` WHERE id_base='$prob'")  or die(mysqli_error($conn));
        if (mysqli_num_rows($query)) {
            while ($array = mysqli_fetch_row($query)) {
                $_SESSION["problema"] = $array[2];
                $_SESSION["solucao"] = $array[3];
                $_SESSION["link"] = $array[7];
                $_SESSION["autor"] = $array[5];
                $_SESSION["dtatual"] = $array[6];
                $_SESSION["idbase"] = $array[0];
            }
        } else {
            $_SESSION["idbase"] = 0;
        }
    }
    function categoria_add($cat)
    {
        require("./conect.php");
        $query = mysqli_query($conn, "SELECT * FROM `categoria_c` WHERE cat_c='$cat'");
        if (mysqli_num_rows($query)) {
            echo "<script>alert('essa categoria já existe!')</script>";
        } else {
            $query = mysqli_query($conn, "INSERT INTO `categoria_c`(`cat_c`) VALUES ('$cat')") or die(mysqli_error($conn));
            echo "<script>alert('o registro criado com sucesso!');
            location.reload();
            </script>";
        }
    }

    function categoria_alt($cat)
    {
        require("./conect.php");
        $query = mysqli_query($conn, "SELECT * FROM `categoria_c` WHERE cat_c='$cat'");
        if (mysqli_num_rows($query)) {
            while ($array = mysqli_fetch_row($query)) {
                $categoria = $array[0];
            }
            $cad = strtoupper($cad);
            $query = mysqli_query($conn, "UPDATE `categoria_c` SET `cat_c`='$cat'  WHERE id_cat='$categoria')") or die(mysqli_error($conn));
            echo "<script>alert('o registro criado com sucesso!');
            location.reload();
            </script>";
        } else {
            echo "<script>alert('Esta categoria não existe!')</script>";
        }
    }
    /////////////////////////////////////////////////////////////////////contador de acesso//////////////////////////////////////////////////////////////////////////////////////
    function contador_ver()

    {

        $jaVisitou = @$_SESSION["jaVisitou"];

        $linha = file("contador.txt");



        if ($jaVisitou) {

            $visitas = $linha[0];
        } else {

            $visitas = $linha[0];

            $visitante = $visitas;

            $_SESSION["jaVisitou"] = true;
        }

        $result =  $visitas = number_format("$visitante", 0, "", ".");

        echo "<h6 class=fontebranca>Você é o visitante número: {$result}</6>";
    }



    function gravacode($id, $data, $code)

    {

        require("./conect.php");

        $query = mysqli_query($conn, "INSERT INTO `recuperar`(`id`, `code`, `dt`, `valido`) VALUES ('$id','$code','$data','1')") or die(mysqli_error($conn));
    }



    function EnviarMail($mensagem, $email)
    {
        require 'vendor/phpmailer/phpmailer/src/PHPMailer.php';
        require 'vendor/phpmailer/phpmailer/src/SMTP.php';
        require 'vendor/phpmailer/phpmailer/src/Exception.php';
        require 'vendor/autoload.php';

        $mail = new PHPMailer(true);
        try {
            // Configurações do servidor

            //$mail->SMTPDebug = SMTP::DEBUG_SERVER;

            $mail->isSMTP();        //Devine o uso de SMTP no envio
            $mail->SMTPDebug = 0;
            $mail->Host = 'smtp.gmail.com';
            $mail->Port = 587;
            $mail->SMTPAuth = true; //Habilita a autenticação SMTP
            $mail->Username   = 'leandbs36@gmail.com';
            $mail->Password   = 'bjdlhwlpnyjsgllo';
            $mail->FromName = 'DTI';
            // Criptografia do envio SSL também é aceito
            $mail->SMTPSecure = 'SSL';

            // Define o remetente

            $mail->setFrom('leandbs36@gmail.com');

            // Define o destinatário

            $mail->addAddress($email);

            // Conteúdo da mensagem
            $links = "https://lbstec1.websiteseguro.com/projetos/ti/recuperarsenha.php";
            $mail->isHTML(true);  // Seta o formato do e-mail para aceitar conteúdo HTML
            $mail->Subject = 'recuperar conta';
            $mail->Body    = '<html><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /></head><body> <h1>Código de recuperação<h1>' . ' Code: ' . $mensagem . '   Link: ' . $links . '</body></html>';
            $mail->AltBody = 'Código: ' . $mensagem . 'Link: ' . $links;
            // Enviar

            $mail->send();
            echo "<script>alert('A mensagem foi enviada para {$email}.')</script>";
            //header("Location:index.php");

        } catch (Exception $e) {

            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }

    function alterar_senha($senha, $code, $confirme)

    {



        if ($senha <> $confirme) {

            echo "<script>alert('A Senha não confere!Favor digite novamente.')</script>";
        } else {

            $data = Date('d-m-Y');

            require("./conect.php");

            $query = mysqli_query($conn, "SELECT * FROM `recuperar` WHERE code='$code' and dt='$data' and valido ='1'")  or die(mysqli_error($conn));;

            if (mysqli_num_rows($query)) {

                while ($array = mysqli_fetch_row($query)) {

                    $id = $array[0];
                }

                $cript = base64_encode($senha);

                $query = mysqli_query($conn, "UPDATE `usuarios` SET `senha`='$cript' WHERE id='$id'");

                $query = mysqli_query($conn, "UPDATE `recuperar` SET `valido`='0'");

                echo "<script>alert('Senha atualizada com sucesso!')</script>";

                header("Location:index.php");
            } else {

                echo "<script>alert('Código não existe ou já expirou!')</script>";
            }
        }
    }





    //////////////////////////////////Relatórios//////////////////////////////////////////////////////////

    function produtos()

    {

        require("./conect.php");

        $color = "#ffffff";

        $query = mysqli_query($conn, "SELECT * FROM produtos WHERE 1")  or die(mysqli_error($conn));;

        if (mysqli_num_rows($query)) {

            $estilos[0] = "background-color: #BDBDBD;font-size:14px;color:black;font-style:bold;font-family:Arial;

            text-align: center; width: 15%;";



            echo "<table style=\"width:auto\" cellpadding=\"0\" cellspacing=\"0\" border=\"1\"><tbody><tr>

            <td style=\"$estilos[0]\">ID</td>

            <td style=\"$estilos[0]\">PRODUTO</td>

            <td style=\"$estilos[0]\">VALOR</td>

            <td style=\"$estilos[0]\">QUANT</td>

            <td style=\"$estilos[0]\">ATUALIZAÇÃO</td>

            <td style=\"$estilos[0]\">MARCA</td>

            <td style=\"$estilos[0]\">MODELO</td>

            <td style=\"$estilos[0]\">TIPO</td>

            </tr>";



            while ($array = mysqli_fetch_row($query)) {

                $estilos[1] = "background-color:{$color};font-size:14px;color:black;

                font-style:bold;font-family: Times New Roman, Times, serif;

                text-align: center; width: auto;";

                echo "<tr>

                <td style=\"$estilos[1]\">$array[0]</td>

                <td style=\"$estilos[1]\">$array[1]</td>

                <td style=\"$estilos[1]\">$array[2]</td>

                <td style=\"$estilos[1]\">$array[3]</td>

                <td style=\"$estilos[1]\">$array[4]</td>

                <td style=\"$estilos[1]\">$array[5]</td>

                <td style=\"$estilos[1]\">$array[6]</td>

                <td style=\"$estilos[1]\">$array[7]</td>

                </tr>";
            }
        }
    }


    function clientes_excel()
    {
        require("./conect.php");
        $color = "";
        $cor = "";
        $nome = $_SESSION['impressão'];
        $pes = $_SESSION['op'];
        $count = 1;
        $number = 0;
        $n = 0;
        ////todos os usuários
        if ($pes == "Todos") {
            $query = mysqli_query($conn, "SELECT * FROM clientes WHERE 1")  or die(mysqli_error($conn));;

            if (mysqli_num_rows($query)) {

                $estilos[0] = "background-color: #BDBDBD;font-size:12px;color:black;font-style:bold;font-family:Arial;

                text-align: center; width: auto%;";



                echo "<table style=\"width: Auto\" cellpadding=\"0\" cellspacing=\"0\" border=\"1\"><tbody><tr>

                <td style=\"$estilos[0]\">ID</td>

                <td style=\"$estilos[0]\">NOME</td>

                <td style=\"$estilos[0]\">SOBRENOME</td>

                <td style=\"$estilos[0]\">ENDEREÇO</td>

                <td style=\"$estilos[0]\">LOTE</td>

                <td style=\"$estilos[0]\">ESTADO</td>

                <td style=\"$estilos[0]\">CIDADE</td>

                <td style=\"$estilos[0]\">CEP</td>

                <td style=\"$estilos[0]\">TEL</td>

                <td style=\"$estilos[0]\">CEL</td>

                <td style=\"$estilos[0]\">EMAIL</td>





                </tr>";



                while ($array = mysqli_fetch_row($query)) {

                    $estilos[1] = "background-color:{$color};font-size:12px;color:black;

                    font-style:bold;font-family: Times New Roman, Times, serif;

                    text-align: center; width: auto;";

                    echo "<tr>

                    <td style=\"$estilos[1]\">$array[0]</td>

                    <td style=\"$estilos[1]\">$array[1]</td>

                    <td style=\"$estilos[1]\">$array[2]</td>

                    <td style=\"$estilos[1]\">$array[3]</td>

                    <td style=\"$estilos[1]\">$array[14]</td>

                    <td style=\"$estilos[1]\">$array[4]</td>

                    <td style=\"$estilos[1]\">$array[5]</td>

                    <td style=\"$estilos[1]\">$array[6]</td>

                    <td style=\"$estilos[1]\">$array[7]</td>

                    <td style=\"$estilos[1]\">$array[8]</td>

                    <td style=\"$estilos[1]\">$array[10]</td>

                    </tr>";
                }
            }
        }

        ///unico usuário

        if ($pes == "Individual") {

            $query = mysqli_query($conn, "SELECT * FROM clientes WHERE nome='$nome'")  or die(mysqli_error($conn));;

            if (mysqli_num_rows($query)) {

                $estilos[0] = "background-color: #BDBDBD;font-size:12px;color:black;font-style:bold;font-family:Arial;

                text-align: center; width: auto%;";



                echo "<table style=\"width: Auto\" cellpadding=\"0\" cellspacing=\"0\" border=\"1\"><tbody><tr>

                <td style=\"$estilos[0]\">ID</td>

                <td style=\"$estilos[0]\">NOME</td>

                <td style=\"$estilos[0]\">SOBRENOME</td>

                <td style=\"$estilos[0]\">ENDEREÇO</td>

                <td style=\"$estilos[0]\">LOTE</td>

                <td style=\"$estilos[0]\">ESTADO</td>

                <td style=\"$estilos[0]\">CIDADE</td>

                <td style=\"$estilos[0]\">CEP</td>

                <td style=\"$estilos[0]\">TEL</td>

                <td style=\"$estilos[0]\">CEL</td>

                <td style=\"$estilos[0]\">EMAIL</td>





                </tr>";



                while ($array = mysqli_fetch_row($query)) {

                    $estilos[1] = "background-color:{$color};font-size:12px;color:black;

                    font-style:bold;font-family: Times New Roman, Times, serif;

                    text-align: center; width: auto;";

                    echo "<tr>

                    <td style=\"$estilos[1]\">$array[0]</td>

                    <td style=\"$estilos[1]\">$array[1]</td>

                    <td style=\"$estilos[1]\">$array[2]</td>

                    <td style=\"$estilos[1]\">$array[3]</td>

                    <td style=\"$estilos[1]\">$array[14]</td>

                    <td style=\"$estilos[1]\">$array[4]</td>

                    <td style=\"$estilos[1]\">$array[5]</td>

                    <td style=\"$estilos[1]\">$array[6]</td>

                    <td style=\"$estilos[1]\">$array[7]</td>

                    <td style=\"$estilos[1]\">$array[8]</td>

                    <td style=\"$estilos[1]\">$array[10]</td>

                    </tr>";
                }
            }
        }
    }
}
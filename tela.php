<?php

session_start();
//conexão a classes
$permissao = $_SESSION[ 'perfil' ];
require( './class/class.site.php' );
$db = new site;
$resposta = $db->validar();
$ramais_admin = '';
?>
<!DOCTYPE html>
<html lang='pt-br'>

<head>
    <meta charset='UTF-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <link href='css/tela1.css' rel='stylesheet'>
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css'>
    <script src='https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js'></script>
    <link rel='icon' type='image/x-icon' href='/img/favico.ico'>
    <script>
    function scrollToTop() {
        window.scrollTo({
            top: 100,
            behavior: 'smooth' // Remove essa linha se não quiser rolagem suave

        });
    }
    </script>

    <style>
    body {
        background-image: url('img/loginp.jpg');
        background-repeat: no-repeat;
        background-size: cover;
        background-position: center;
        background-attachment: fixed;
    }
    </style>
    <?php

$nome = $_SESSION[ 'nome' ];
$resposta = $db->load_estilo( $nome );
$estilo = $_SESSION[ 'estilo' ];
$login = '';
$entrada = '';
$usuarios = '';

if ( $nome == '' ) {
    header( 'Location: index.php' );
    exit;
}



$nivel_acesso = $_SESSION[ 'perfil' ];
if ( $nivel_acesso == 1 ) {
    $login = '#login';
    $entrada = '#entrada';
    $usuarios = 'usuarios.php';
    $acesso_livre = '#livre';
    $liberar = "#autorizar";
    $relatorios="relatorio_mensal.php";
    $relatoriosm="relatorio_manual.php";
    $target="_blank";
    $rg_alt = "#rg_alt";
}else{
    $target="";
}
$topo = '#topo';
?>
    <script src='js/script.js'></script>
    <title></title>
</head>

<body class='container' onload='scrollToTop()' action=''>

    <div class='quadro'>
        <h3 class='centro ' id="quadrado">
            <?php echo"<div class='alert alert-light title border_title'>INFORMAÇÕES DO SISTEMA</div>";
?>
        </h3>
        <a href='portaria.php'><button type="button" class="btn btn-light"> Voltar a tela principal</button></a>
        <div class='mt-md-4'>
            <div class='grid text-left'>
                <!--<div><img class = 'phptela' src = 'img/phptela.jpg' alt = 'imagem de fundo'>-->
                <div class='row'>

                    <div class='col-md-4'><a href="<?php echo $entrada; ?>" class='borda titulobar'
                            data-bs-toggle='modal' data-bs-target="<?php echo $entrada; ?>"><img class='largura'
                                src='img/tela/sem acesso.jpg' alt='' title='Acesso somente a administradores'>
                            <div class='barra_v' title='Acesso somente a administradores'>
                                <button type='button' class='btn btn-danger espaco'> Restrigir Acesso</button>
                            </div>
                        </a>
                    </div>

                    <div class='col-md-4'><a href="<?php echo $acesso_livre; ?>" class='borda titulobar'
                            data-bs-toggle='modal' data-bs-target="<?php echo $acesso_livre; ?>"><img class='largura'
                                src='img/tela/clientes.jpg' alt='' title='Acesso somente a administradores'>
                            <div class='barra' title='Acesso somente a administradores'>
                                <button type='button' class='btn btn-success espaco'>Liberar acesso</button>
                            </div>
                        </a>
                    </div>



                    <div class='col-md-4'><a href="<?php echo $login; ?>" class='borda titulobar' data-bs-toggle='modal'
                            data-bs-target="<?php echo $login; ?>"><img class='largura' src='img/access-denied.jpg'
                                alt='' title='Acesso somente a administradores'>
                            <div class='barra2' title='Acesso somente a administradores'>
                                <p>Criação de login rápida </p>
                            </div>
                        </a>
                    </div>


                    <div class='col-md-4'><a href="<?php echo $usuarios; ?>" class='borda titulobar'><img
                                class='largura' src='img/tela/acesso.jpg' alt=''
                                title='Acesso somente a administradores'>
                            <div class='barra5' title='Acesso somente a administradores'>
                                <p>Gerência de Usuários</p>
                            </div>
                        </a>
                    </div>



                    <div class='col-md-4'><a href='<?php echo $liberar; ?>' class='borda titulobar'
                            data-bs-toggle='modal' data-bs-target="<?php echo $liberar; ?>"><img class='largura'
                                src='img/portaria1.jpg' alt='' title='Autorizar entrada'>
                            <div class='barra1'>
                                Autorização de acesso
                            </div>
                        </a>
                    </div>

                    <div class='col-md-4'><a href='<?php echo $rg_alt; ?>' class='borda titulobar'
                            data-bs-toggle='modal' data-bs-target="<?php echo $rg_alt; ?>"><img class='largura'
                                src='img/tela/digitando.jpg' alt='' title='Autorizar entrada'>
                            <div class='barra8'>
                                Alteração do RG
                            </div>
                        </a>
                    </div>

                    <div class='col-md-4'><a href='#ramal' class='borda titulobar' data-bs-toggle='modal'
                            data-bs-target="#ramal">
                            <img class='largura' src='img/tela/ramais.jpg' alt='' title='cadastro de ramais'>
                            <div class='barra6'>
                                <p>Ramais Importantes</p>
                            </div>
                        </a>
                    </div>

                    <div class='col-md-4'><a href='<?php echo $relatorios; ?>' target="<?php echo $target; ?>"
                            class='borda titulobar'>
                            <img class='largura' src='img/tela/relatorio.jpg' alt='' title='Relatório mensal'>
                            <div class='barra3'>
                                Relatório Automático
                            </div>
                        </a>
                    </div>

                    <div class='col-md-4'><a href='#rmanual' class='borda titulobar' data-bs-toggle='modal'
                            data-bs-target="#rmanual">
                            <img class='largura' src='img/tela/relatorio.jpg' alt='' title='relatório Manual'>
                            <div class='barra3'>
                                <p>Relatório Manual</p>
                            </div>
                        </a>
                    </div>


                </div>
            </div>

            <div id='login' class='modal fade' tabindex='-1' role='dialog' aria-labelledby='restrigir'
                aria-hidden='true'>
                <div class='modal-dialog'>
                    <div class='modal-content'>
                        <div class='modal-header'>
                            <h1 class='modal-title fs-5' id='exampleModalLabel'>login</h1>
                            <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                        </div>
                        <div class='modal-body '>
                            <div class='alert alert-info container-fluir '>
                                <h5 class='modal-title text-sm-center ' id='addtipoModalLabel'> Login do usuário
                                </h5>
                            </div>
                            <div class='form-group row'>
                                <form action='processa_form_modal_user.php' method='POST' id='insert_form'>
                                    <div class='col-sm-10 mb-3 w-100'>

                                        <input class='form-control form-control-sm' type='text' id='ccomp' name='ccomp'
                                            value='' placeholder='Digite nome e sobrenome' required>
                                    </div>

                                    <div class='col-sm-10 mb-3 w-100'>

                                        <input class='form-control form-control-sm' type='text' id='clog' name='clog'
                                            value='' placeholder='Digite seu login' required>
                                    </div>

                                    <div class='col-sm-10 mb-3 w-100'>

                                        <input class='form-control form-control-sm' type='password' id='csenha'
                                            name='csenha' maxlength='6' value='' placeholder='Digite a senha' required>
                                    </div>

                                    <div class='col-sm-10 mb-3 w-100'>

                                        <input class='form-control form-control-sm' type='password' id='cconf'
                                            name='cconf' maxlength='6' value='' placeholder='Confirme a senha'
                                            onblur='foco()' required>
                                    </div>

                                    <div class='col-sm-10 mb-3 w-100'>
                                        <input class='form-control form-control-sm' type='email' id='cemail'
                                            name='cemail' value='' placeholder='Digite e-mail' required>
                                    </div>
                                    <div class='col-sm-10 mb-3 w-100'>
                                        <label for='' class='title_label'>Selecione o acesso:</label>
                                        <select class='form-select' name='cnivel' id='cnivel' required>
                                            <option value='0'></option>
                                            <option value='5'>Vigilante</option>
                                            <option value='1'>Administrador</option>
                                        </select>
                                    </div>
                                    <div class='col-sm-10 mb-3 w-100'>
                                        <p id='right-lab'>Desativar<input type='checkbox' name='rest' id='rest'>
                                        </p>
                                    </div>
                                    <hr>
                                    <div class='menu01 espaco'>
                                        <input type='submit' id='csalvar' name='csalvar' value='Salvar'
                                            class='alert alert-info'>
                                </form>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div id='entrada' class='modal fade' tabindex='-1' role='dialog' aria-labelledby='restrigir' aria-hidden='true'>
            <div class='modal-dialog'>
                <div class='modal-content'>
                    <div class='modal-header'>
                        <h1 class='modal-title fs-5' id='exampleModalLabel'>Restrigir</h1>
                        <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                    </div>
                    <div class='modal-body'>
                        <div class='alert alert-info container-fluir '>
                            <h5 class='modal-title text-sm-center ' id='addtipoModalLabel'> Dados do
                                bloqueio
                            </h5>
                        </div>

                        <div class='form-group row '>
                            <form action='processa_form_modal_bloquear.php' method='POST' id='insert_form'>
                                <div class='col-sm-10 mb-3 w-100'>

                                    <input class='form-control form-control-sm' type='text' id='csoli' name='csoli'
                                        value='' placeholder='Nome do solicitante' required>
                                </div>
                        </div>
                        <div class='form-group row '>
                            <div class='col-sm-10 mb-3 w-100'>

                                <input class='form-control form-control-sm' type='number' id='ctel' name='ctel' value=''
                                    placeholder='Ramal do solicitante' required>
                            </div>
                        </div>
                        <div class='form-group row '>
                            <div class='col-sm-10 mb-3 w-100'>

                                <input class='form-control form-control-sm' type='number' id='crg' name='crg' value=''
                                    placeholder='RG a ser restrigido' required>
                            </div>
                        </div>
                        <div class='form-group row'>
                            <div class='col-sm-10 mb-3 w-100'>
                                <textarea class='form-control' id='moti' name='moti' rows='3' maxlength='300'
                                    placeholder='Motivo(300)' required></textarea>
                            </div>
                        </div>

                        <div class='form-group row'>
                            <p>Bloqueados: </p>
                            <div class='col-sm-10 mb-3 w-100'>
                                <textarea class='' id='rglist' name='rglist' rows='3' maxlength='500' readonly>
                                                <?php
                                                    require( './conect.php' );
                                                    $query = mysqli_query( $conn, 'SELECT * FROM `restrigir` WHERE autorizado=0' ) or die( mysqli_error( $conn ) );
                                                    if ( mysqli_num_rows( $query ) ) {
                                                        while ( $array = mysqli_fetch_row( $query ) ) {
                                                            $id = $array[ 3 ];
                                                            echo "$id";
                                                        }
                                                    }
                                                    ?>
                                                </textarea>
                            </div>

                        </div>
                        <hr>
                        <div class='menu01 '>
                            <input type='submit' id='rnovo' name='rnovo' value='Salvar' class='alert alert-info espaco'>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id='rg_alt' class='modal fade' tabindex='-1' role='dialog' aria-labelledby='restrigir_livre'
            aria-hidden='true'>
            <div class='modal-dialog'>
                <div class='modal-content'>
                    <div class='modal-header'>
                        <h1 class='modal-title fs-5' id='exampleModalLabel'>Registro Geral </h1>
                        <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                    </div>
                    <div class='modal-body'>
                        <div class='alert alert-info container-fluir '>
                            <h5 class='modal-title text-sm-center ' id='addtipoModalLabel'> Alterar Dados do
                                RG
                            </h5>
                        </div>

                        <div class='form-group row '>
                            <div class='col-sm-10 mb-3 w-100'>
                                <form action='processa_form_modal_rg.php' method='POST' id='insert_form'>
                                    <input class='form-control form-control-sm' type='number' id='lrgalt' name='lrgalt'
                                        value='' placeholder='RG que deve ser alterado' required>
                            </div>
                        </div>

                        <div class='form-group row '>
                            <div class='col-sm-10 mb-3 w-100'>
                                <form action='processa_form_modal_rg.php' method='POST' id='insert_form'>
                                    <input class='form-control form-control-sm' type='number' id='crgalt' name='crgalt'
                                        value='' placeholder='RG que deve ser inserido' required>
                            </div>
                        </div>
                        <hr>
                        <div class='menu01 '>
                            <input type='submit' id='rgnovo' name='rgnovo' value='Salvar'
                                class='alert alert-info espaco'>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id='rmanual' class='modal fade' tabindex='-1' role='dialog' aria-labelledby='restrigir_livre'
            aria-hidden='true'>
            <div class='modal-dialog'>
                <div class='modal-content'>
                    <div class='modal-header'>
                        <h1 class='modal-title fs-5' id='exampleModalLabel'>Relatório</h1>
                        <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                    </div>
                    <div class='modal-body'>
                        <div class='alert alert-info container-fluir '>
                            <h5 class='modal-title text-sm-center ' id='addtipoModalLabel'> Relatório Manual
                            </h5>
                        </div>

                        <div class='form-group row '>
                            <div class='col-sm-10 mb-3 w-100'>
                                <form action='relatorio_manual.php' method='POST' id='insert_form'>
                                    <input class='form-control form-control-sm' type='date' id='rminicio'
                                        name='rminicio' value='' placeholder='Data início' required>
                            </div>
                        </div>

                        <div class='form-group row '>
                            <div class='col-sm-10 mb-3 w-100'>
                                <form action='relatorio_manual.php' method='POST' id='insert_form'>
                                    <input class='form-control form-control-sm' type='date' id='rmfinal' name='rmfinal'
                                        value='' placeholder='Data final' required>
                            </div>
                        </div>
                        <hr>
                        <div class='menu01 '>
                            <input type='submit' id='rmnovo' name='rmnovo' value='gerar'
                                class='alert alert-info espaco'>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div id='livre' class='modal fade' tabindex='-1' role='dialog' aria-labelledby='restrigir_livre'
            aria-hidden='true'>
            <div class='modal-dialog'>
                <div class='modal-content'>
                    <div class='modal-header'>
                        <h1 class='modal-title fs-5' id='exampleModalLabel'>Liberar acesso</h1>
                        <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                    </div>
                    <div class='modal-body'>
                        <div class='alert alert-info container-fluir '>
                            <h5 class='modal-title text-sm-center ' id='addtipoModalLabel'> Dados do
                                bloqueio
                            </h5>
                        </div>

                        <div class='form-group row '>
                            <div class='col-sm-10 mb-3 w-100'>
                                <form action='processa_form_modal_liberar.php' method='POST' id='insert_form'>
                                    <input class='form-control form-control-sm' type='number' id='crgl' name='crgl'
                                        value='' placeholder='RG a ser liberado' required>
                            </div>
                        </div>
                        <div class='form-group row'>
                            <div class='col-sm-10 mb-3 w-100'>
                                <textarea class='form-control' id='lmoti' name='lmoti' rows='3' maxlength='500'
                                    placeholder='Motivo da liberação' required></textarea>
                            </div>
                        </div>

                        <hr>
                        <div class='menu01 '>
                            <input type='submit' id='lnovo' name='lnovo' value='Salvar' class='alert alert-info espaco'>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id='ramal' class='modal fade' tabindex='-1' role='dialog' aria-labelledby='ramal' aria-hidden='true'>
            <div class='modal-dialog'>
                <div class='modal-content'>
                    <div class='modal-header'>
                        <h1 class='modal-title fs-5' id='exampleModalLabel'>Ramais</h1>
                        <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                    </div>
                    <div class='modal-body'>
                        <div class='alert alert-info container-fluir '>
                            <h5 class='modal-title text-sm-center ' id='addtipoModalLabel'> Ramais importante </h5>
                        </div>

                        <div class='form-group row '>
                            <div class='col-sm-10 mb-3 w-100'>
                                <form action='processa_form_modal_ramal.php' method='POST' id='insert_form'>
                                    <input class='form-control form-control-sm' type='text' id='nome' name='nome'
                                        value='' placeholder='Digite o nome' required>
                            </div>
                        </div>

                        <div class='form-group row '>
                            <div class='col-sm-10 mb-3 w-100'>
                                <form action='' method='POST' id='insert_form'>
                                    <input class='form-control form-control-sm' type='number' id='ramal' name='ramal'
                                        value='' placeholder='Digite o ramal' required>
                            </div>
                        </div>
                        <hr>
                        <div class='menu01 '>
                            <input type='submit' id='rnovo' name='rnovo' value='Salvar' class='alert alert-info espaco'>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id='autorizar' class='modal fade' tabindex='-1' role='dialog' aria-labelledby='ramal' aria-hidden='true'>
            <div class='modal-dialog'>
                <div class='modal-content'>
                    <div class='modal-header'>
                        <h1 class='modal-title fs-5' id='exampleModalLabel'>Autorização</h1>
                        <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                    </div>
                    <div class='modal-body'>
                        <div class='alert alert-info container-fluir '>
                            <h5 class='modal-title text-sm-center ' id='addtipoModalLabel'>Autorização de acesso</h5>
                        </div>

                        <div class='form-group row '>
                            <div class='col-sm-10 mb-3 w-100'>
                                <form action='processa_form_modal_autorizar.php' method='POST' id='insert_form'>
                                    <input class='form-control form-control-sm' type='text' id='anome' name='anome'
                                        value='' placeholder='Digite o nome' required>
                            </div>
                        </div>

                        <div class='form-group row '>
                            <div class='col-sm-10 mb-3 w-100'>
                                <form action='' method='POST' id='insert_form'>
                                    <input class='form-control form-control-sm' type='text' id='acpf' name='acpf'
                                        value='' placeholder='Digite o cpf' required>
                            </div>
                        </div>

                        <div class='form-group row '>
                            <div class='col-sm-10 mb-3 w-100'>
                                <form action='' method='POST' id='insert_form'>
                                    <input class='form-control form-control-sm' type='text' id='arg' name='arg' value=''
                                        placeholder='Digite o rg' required>
                            </div>
                        </div>
                        <div class='form-group row '>
                            <div class='col-sm-10 mb-3 w-100'>
                                <form action='' method='POST' id='insert_form'>
                                    <select name="cmbrg" id="cmbrg" required>
                                        <option></option>
                                        <option>AC</option>
                                        <option>AL</option>
                                        <option>AP</option>
                                        <option>AM</option>
                                        <option>BA</option>
                                        <option>CE</option>
                                        <option>DF</option>
                                        <option>ES</option>
                                        <option>GO</option>
                                        <option>MA</option>
                                        <option>MT</option>
                                        <option>MS</option>
                                        <option>MG</option>
                                        <option>PA</option>
                                        <option>PB</option>
                                        <option>PR</option>
                                        <option>PI</option>
                                        <option>RJ</option>
                                        <option>RN</option>
                                        <option>RS</option>
                                        <option>RO</option>
                                        <option>RR</option>
                                        <option>SC</option>
                                        <option>SP</option>
                                        <option>SE</option>
                                        <option>TO</option>
                                    </select>
                            </div>
                        </div>
                        <div class='form-group row '>
                            <div class='col-sm-10 mb-3 w-100'>
                                <form action='' method='POST' id='insert_form'>
                                    <label for="">Data da liberação</label><input class='form-control form-control-sm'
                                        type='date' id='adata' name='adata' value='' placeholder='' required>
                            </div>
                        </div>

                        <div class='form-group row '>
                            <div class='col-sm-10 mb-3 w-100'>
                                <form action='' method='POST' id='insert_form'>
                                    <div class='col-sm-10 mb-3 w-100'>
                                        <textarea class='form-control' id='amoti' name='amoti' rows='3' maxlength='300'
                                            placeholder='Motivo da liberação(300)' required></textarea>
                                    </div>
                            </div>
                        </div>

                        <hr>
                        <div class='menu01 '>
                            <input type='submit' id='anovo' name='anovo' value='Salvar' class='alert alert-info espaco'>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <p id='topo'></p>
</body>

</html>
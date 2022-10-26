<?php
    session_start();

    // se existir na sessao a variavel com o array associativo resultado da selecao
    if (isset($_SESSION['resultadoConsultaAlunos'])) {
        // se o array conter registros, recupera o valor 
        if (count($_SESSION['resultadoConsultaAlunos']) > 0) {
            $resultadoConsultaAlunos = $_SESSION['resultadoConsultaAlunos'];
        }
        unset($_SESSION['resultadoConsultaAlunos']);
    }
    
    // se existir na sessao a variavel com a turma selecionada
    if (isset($_SESSION['numeroTurmaSelecionada'])) {
        // recupera o valor da turma para selecionar na caixa de selecao
        $numeroTurmaSelecionada = $_SESSION['numeroTurmaSelecionada'];
    }
    
    // variaveis de acesso ao BD
    $host = 'localhost';
    $dbUsuario = 'root';
    $dbSenha = '';
    $dbSchema = 'escola';

    // conectar o BD
    $dbConexao = mysqli_connect($host, $dbUsuario, $dbSenha, $dbSchema);
    if (mysqli_connect_error()) { // verifica se a conexao com o bd foi bem sucedida
        $msgBD = mysqli_connect_error();
        echo "Falha na conexao com o BD: $msgBD";
        exit();
    }

    // sucesso na conexao
    // recupera as turmas
    $comandoSQL = "select turmas.numero as numeroTurma, 
                          concat('Turma ', 
                                 lpad(turmas.numero, 4, '0'), 
                                 ' - ', 
                                 turmas.horarioAula ) as nomeTurma
                   from turmas;";

    // executa o comando SQL e recupera o retorno da execucao
    $resultadoConsultaTurmas = mysqli_query($dbConexao, $comandoSQL);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PHP - Exercícios</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css"
        integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    
    <!-- <script src="js/aula17.js" defer></script> -->
    <link href="../css/meu-estilo.css" rel="stylesheet">

</head>

<body>

    <!-- seu codigo comeca aqui -->

    <header class="container px-0">

        <nav class="navbar navbar-expand-lg navbar-light bg-light px-0">

            <!-- logo -->
            <div>
                <a class="navbar-brand mx-auto">
                    <img src="../img/php_96.png">
                </a>
            </div>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#mynavbar"
                aria-controls="conteudoNavbarSuportado" aria-expanded="false" aria-label="Navegação Alternativa">
                Menu <span class="navbar-toggler-icon"></span>
            </button>

            <!-- menu -->
            <div class="collapse navbar-collapse justify-content-end" id="mynavbar">
                <div class="navbar-nav">
                    <a href="../escola.php" class="nav-link">Início</a>
                    <a href="cadastroTurma.php" class="nav-link">Cadastrar</a>
                    <a href="listarTurmas.php" class="nav-link">Listar</a>
                    <a href="registroAusencia.php" class="nav-link">Registrar Ausência</a>
                </div>
            </div>
        </nav>

        <!-- verifica se ha alguma mensagem de retorno e apresenta alerta -->
        <?php
            if (isset($_SESSION['mensagemRetorno']) != NULL) {
               $mensagemAlerta = $_SESSION['mensagemRetorno'];     
        ?>

            <div class="row">
                <div class="col">
                    <div class="alert alert-success alert-dismissible" role="alert">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <?=$mensagemAlerta?>
                    </div>
                </div>
            </div>

        <?php
                unset($_SESSION['mensagemRetorno']);
            }
        ?>

    </header>

    <main class="container m-2 w-75 mx-auto my-font-family">

        <div class="row">
            <div class="col text-center m-0">
                <h2 class="mt-2 mb-5 my-h2">Registro de Ausências</h2>
            </div>
        </div>

        <!-- formulario para escolher a turma -->
        <form name="frmDefinirTurma" id="idFrmDefinirTurma" action="consultarAlunos.php" method="post" class="my-label-color-purple">
            
            <!-- montagem do combo com as turmas cadastradas que tenha aluno -->
            <div class="form-group">
                <label for="idTurma">Turma</label>
                <select class="form-control" id="idTurma" name="numeroTurma">
                    <option value="0">Selecione...</option>

                    <?php 
                        while ( $linha = mysqli_fetch_array($resultadoConsultaTurmas) ) {
                            $numeroTurma = $linha['numeroTurma'];
                            $nomeTurma = $linha['nomeTurma'];

                            if ($numeroTurma == $numeroTurmaSelecionada) {
                    ?>
                            
                                <option value=<?=$numeroTurma?> selected><?=$nomeTurma?></option>

                    <?php 
                            } else {
                    ?>
                                <option value=<?=$numeroTurma?>><?=$nomeTurma?></option>

                    <?php
                            }
                        }

                        // fecha o objeto query
                        if ( is_object($resultadoConsultaTurmas) ) {
                            mysqli_free_result($resultadoConsultaTurmas);
                        }

                        // fecha a conexao com o BD
                        mysqli_close($dbConexao);
                    ?>

                </select>
            </div>

            <div class="form-group my-4 text-center">
                <input type="button" value="Limpar" class="btn btn-primary btn-md" id="idLimparTurmas">
                <input type="submit" value="Consultar" class="btn btn-primary btn-md">
            </div>

        </form>

        <?php
            if (isset($resultadoConsultaAlunos)) {
        ?>
        
            <!-- formulario HTML para registrar ausencia de alunos de uma turma -->
            <form name="frmRegistrarAusencia" action="registrarAusencia.php" method="post" class="my-label-color-purple">

                <!-- utiliza um input "hidden" para armazerar a turma escolhida inicialmente -->
                <input type="hidden" name="numeroTurmaSelecionada" value=<?=$_SESSION['numeroTurmaSelecionada']?>>

                <!-- montagem do combo com os tipos de atividade -->
                <div class="form-group">
                    <label for="idAlunoTurma">Aluno da Turma</label>
                    <select class="form-control" id="idAlunoTurma" name="matriculaAluno">
                        <option value=0>Selecione...</option>

                <?php 
                    foreach( $resultadoConsultaAlunos as $linha ) {
                        $matriculaAluno = $linha['matricula'];
                        $nomeAluno = $linha['nome'];
                ?>
                        
                        <option value=<?=$matriculaAluno?>><?=$nomeAluno?></option>

                <?php
                    }
                ?>

                    </select>
                </div>


                <div class="form-group">
                    <label for="idDataAusencia" class="col-form-label">Data da Ausência</label>
                    <input class="form-control" type="date" id="idDataAusencia" name="dataAusencia" required>
                </div>

                <div class="form-group my-4 text-center">
                    <input type="reset" value="Limpar" class="btn btn-primary btn-md">
                    <input type="submit" value="Registrar" class="btn btn-primary btn-md">
                </div>

            </form>

        <?php
            }

            unset($resultadoConsultaAlunos);
        ?>

    </main>

    <footer class="container text-center">
        <div class="row border-top border-primary bg-light">
            <div class="col font text-primary copyright">
                <p>&copy; Copyright Pmg Web</p>
            </div>
        </div>
    </footer>

    <!-- seu codigo termina aqui -->

    <!-- Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous">
    </script>


    <!-- acoes e validacoes sobre os formularios -->
    <script type="text/javascript">
        let vFrmDefinirTurma = document.querySelector('form[name="frmDefinirTurma"]');
        vFrmDefinirTurma.onsubmit = validarTurmaSelecionada;
        
        let btnIdLimparTurmas = document.getElementById("idLimparTurmas");
        btnIdLimparTurmas.onclick = limparFrmDefinirTurma;

        // verifica se o elemento do tipo formulario para a selecao de aluno esta no documento HTML
        // neste caso, permitir remove-lo quando o botao "Limpar" do formulario da turma for clicado
        if (document.querySelector('form[name="frmRegistrarAusencia"]')) {
            let vFrmRegistrarAusencia = document.querySelector('form[name="frmRegistrarAusencia"]');
            vFrmRegistrarAusencia.onsubmit = validarAlunoSelecionado;
        }

        // No formulario de selecao da turma, nao é permitido executar o submit para a opcao "Selecione" 
        function validarTurmaSelecionada() {
            let turmaSelecionada = document.getElementById('idTurma').value;
            if ( parseInt(turmaSelecionada) == 0) {
                alert("Selecione uma Turma!");
                return false;
            }
        }

        // No formulario de selecao de aluno da turma, nao é permitido executar o submit para a opcao "Selecione" 
        function validarAlunoSelecionado() {
            let alunoSelecionado = document.getElementById('idAlunoTurma').value;
            if ( parseInt(alunoSelecionado) == 0) {
                alert("Selecione uma dos alunos da Turma!");
                return false;
            }
        }

        // remove do HTML o elemento form onde sera informado o aluno que faltou e sua data
        // caso 
        function limparFrmDefinirTurma() {
            
            // procura o formulario FrmRegistrarAusencia e remove do HTML se existir
            if (document.querySelector('form[name="frmRegistrarAusencia"]')) {
                let vFrmRegistrarAusencia = document.querySelector('form[name="frmRegistrarAusencia"]');
                vFrmRegistrarAusencia.remove();
            }

            // retorna o valor original da caixa de selecao de Turma
            document.getElementById('idTurma').selectedIndex = 0;
        }
    </script>



</body>

</html>
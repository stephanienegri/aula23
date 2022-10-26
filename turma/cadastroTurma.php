<?php

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
    // recupera os tipos de atividade
    $comandoSQL = "select * from tiposAtividade;";

    // executa o comando SQL e recupera o retorno da execucao
    $resultadoConsultaTipoAtividade = mysqli_query($dbConexao, $comandoSQL);

    // recupera os instrutores
    // $comandoSQL = "select id, nome from instrutores;";
    $comandoSQL = "select id, nome from instrutores 
                   where instrutores.id not in (
                      select distinct idInstrutor from turmas
                   );";
     

    // executa o comando SQL e recupera o retorno da execucao
    $resultadoConsultaInstrutor = mysqli_query($dbConexao, $comandoSQL);

    // recupera os alunos
    $comandoSQL = "select matricula, nome from alunos;";

    // executa o comando SQL e recupera o retorno da execucao
    $resultadoConsultaAluno = mysqli_query($dbConexao, $comandoSQL);

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

    <!--
        <div class="row">
            <div class="col">
                <div class="alert alert-success alert-dismissible" role="alert">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                </div>
            </div>
        </div>
    -->

    </header>

    <main class="container m-2 w-75 mx-auto my-font-family">

        <div class="row">
            <div class="col text-center m-0">
                <h2 class="mt-2 mb-5 my-h2">Cadastro de Turmas</h2>
            </div>
        </div>

        <!-- formulario HTML -->
        <form name="frmCadastrarTurma" action="cadastrarTurma.php" method="post" class="my-label-color-purple">

            <div class="form-group">
                <label for="idHorarioAula" class="col-form-label">Horário da Aula</label>
                <input class="form-control" type="time" id="idHorarioAula" name="horarioAula" required>
            </div>

            <div class="form-group">
                <label for='idDuracaoAula'>Duração da Aula em horas</label>
                <input class="form-control" type='number' id='idDuracaoAula' name='duracaoAula' required>
            </div>

            <div class="form-group">
                <label for='idDataInicial'>Data de Início</label>
                <input class="form-control" type='date' id='idDataInicial' name='dataInicial' required>
            </div>

            <!-- montagem do combo com os tipos de atividade -->
            <div class="form-group">
                <label for="idTipoAtividade">Tipo de Atividade</label>
                <select class="form-control" id="idTipoAtividade" name="tipoAtividade">
                    <option value=0>Selecione...</option>

            <?php 
                while ( $linha = mysqli_fetch_array($resultadoConsultaTipoAtividade) ) {
                    $codigo = $linha['codigo'];
                    $descricao = $linha['descricao'];
            ?>
                    
                    <option value=<?=$codigo?>><?=$descricao?></option>

            <?php
                }

                // fecha o objeto query
                if ( is_object($resultadoConsultaTipoAtividade) ) {
                    mysqli_free_result($resultadoConsultaTipoAtividade);
                }
            ?>

                </select>
            </div>


            <!-- montagem do combo com os instrutores -->
            <div class="form-group">
                <label for="idInstrutor">Instrutor</label>
                <select class="form-control" id="idInstrutor" name="idInstrutor">
                    <option value=0>Selecione...</option>

            <?php 
                while ( $linha = mysqli_fetch_array($resultadoConsultaInstrutor) ) {
                    $idInstrutor = $linha['id'];
                    $nomeInstrutor = $linha['nome'];
            ?>
                    
                    <option value=<?=$idInstrutor?>><?=$nomeInstrutor?></option>

            <?php
                }

                // fecha o objeto query
                if ( is_object($resultadoConsultaInstrutor) ) {
                    mysqli_free_result($resultadoConsultaInstrutor);
                }
            ?>

                </select>
            </div>

            <!-- montagem do combo com os alunos -->
            <div class="form-group">
                <label for="idAluno">Aluno Monitor</label>
                <select class="form-control" id="idAluno" name="matriculaAlunoMonitor">
                    <option value=0>Selecione...</option>

            <?php 
                while ( $linha = mysqli_fetch_array($resultadoConsultaAluno) ) {
                    $matriculaAluno = $linha['matricula'];
                    $nomeAluno = $linha['nome'];
            ?>
                    
                    <option value=<?=$matriculaAluno?>><?=$nomeAluno?></option>

            <?php
                }

                // fecha o objeto query
                if ( is_object($resultadoConsultaAluno) ) {
                    mysqli_free_result($resultadoConsultaAluno);
                }

                // fechar a conexao
                mysqli_close($dbConexao);

            ?>

                </select>
            </div>

            <div class="form-group my-4 text-center">
                <input type="reset" value="Limpar" class="btn btn-primary btn-md">
                <input type="submit" value="Cadastrar" class="btn btn-primary btn-md">
            </div>

        </form>

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

</body>

</html>
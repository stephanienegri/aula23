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
    // insert into tiposatividade (descricao) values ('Programador Web');
    $comandoSQL = "select * from titulos;";

    // executa o comando SQL e recupera o retorno da execucao
    $resultadoConsulta = mysqli_query($dbConexao, $comandoSQL);

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
                    <a href="#" class="nav-link">Cadastrar</a>
                    <a href="listarInstrutores.php" class="nav-link">Listar</a>
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
                <h2 class="mt-2 mb-5 my-h2">Cadastro de Instrutores</h2>
            </div>
        </div>

        <!-- formulario HTML -->
        <form name="frmCadastrarInstrutor" action="cadastrarInstrutor.php" method="post" class="my-label-color-purple">

            <div class="form-group">
                <label for="idNomeInstrutor" class="col-form-label">Nome do Instrutor</label>
                <input class="form-control" type="text" id="idNomeInstrutor" name="nome" placeholder="Informe o nome do instrutor" maxlength="70" required>
            </div>

            <div class="form-group">
                <label for='idRg'>RG</label>
                <input class="form-control" type='text' id='idRg' name='rg' placeholder="Informe o RG" maxlength="45" required>
            </div>

            <div class="form-group">
                <label for='idDataNascimento'>Data de Nascimento</label>
                <input class="form-control" type='date' id='idDataNascimento' name='dataNascimento' required>
            </div>

            <div class="form-group row">
                <div class="col-sm-6">
                    <label for='idDdd'>DDD</label>
                    <input class="form-control" type='ddd' id='idDataNascimento' name='ddd' maxlength="3" required>
                </div>
                <div class="col-sm-6">
                    <label for='idTelefone'>Telefone</label>
                    <input class="form-control" type='text' id='idTelefone' name='telefone' maxlength="9" required>
                </div>
            </div>

            <div class="form-group">
                <label for="idTitulo">Título do Professor</label>
                <select class="form-control" id="idTitulo" name="codigoTitulo">
                    <option value=0>Selecione...</option>

            <?php 
                while ( $linha = mysqli_fetch_array($resultadoConsulta) ) {
                    $codigo = $linha['codigo'];
                    $descricao = $linha['descricao'];
            ?>
                    
                    <option value=<?=$codigo?>><?=$descricao?></option>

            <?php
                }

                // fecha o objeto query
                if ( is_object($resultadoConsulta) ) {
                    mysqli_free_result($resultadoConsulta);
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
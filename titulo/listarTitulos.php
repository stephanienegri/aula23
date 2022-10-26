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
                    <a href="#" class="nav-link">Listar</a>
                    <a href="excluirTitulos.php" class="nav-link">Excluir</a>
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

    <main class="container m-2 mx-auto my-font-family">

        <div class="row">
            <div class="col text-center m-0">
                <h2 class="mt-2 mb-5 my-h2">Lista de Títulos</h2>
            </div>
        </div>

        <!-- tabela responsiva -->
        <div class="table-responsive">

            <!-- classes para tabela (Bootstrap) , tabela sem borda, conteudo alinhado ao centro, ... , width: auto -->
            <table class="table
                        table-borderless
                        text-center
                        my-table-hover
                        my-table-image
                        my-table-td-first-child
                        my-table-border-bottom
                        my-table-th
                        w-100">

                <!-- cabecalho -->
                <thead>
                    <!-- linhas -->
                    <tr>
                        <!-- colunas cabecalho -->
                        <th>Código</th>
                        <th>Descrição</th>
                    </tr>
                </thead>

                <!-- linhas -->
                <?php 
                    while ( $linha = mysqli_fetch_array($resultadoConsulta) ) {
                        $codigo = $linha['codigo'];
                        $descricao = $linha['descricao'];
                ?>
                
                    <tr>                
                        <td> <?=$codigo?> </td>
                        <td> <?=$descricao?> </td>
                    </tr>
                
                <?php
                    }

                    // fecha o objeto query
                    if ( is_object($resultadoConsulta) ) {
                        mysqli_free_result($resultadoConsulta);
                    }

                    // fechar a conexao
                    mysqli_close($dbConexao);

                ?>

            </table>
        
        </div>

    </main>

    <footer class="container text-center">
        <div class="row border-top border-primary bg-light">
            <div class="col font text-primary copyright">
                <p>&copy; Copyright Pmg Web</p>
            </div>
        </div>
    </footer>
    
    <!-- fim do codigo HTML -->

  <!-- Bootstrap -->
  <!-- insira este conteudo do Bootstrap aqui, antes do fechamento do "body" -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
    integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous">
  </script>

</body>

</html>
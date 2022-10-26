<?php

    // cria uma sessao HTTP
    session_start();

    // variaveis de acesso ao BD
    $host = 'localhost';
    $dbUsuario = 'root';
    $dbSenha = '';
    $dbSchema = 'escola';

    // variaveis do formulario de entrada de dados
    $descricaoTitulo = $_POST['descricao'];
    
    // conectar o BD
    $dbConexao = mysqli_connect($host, $dbUsuario, $dbSenha, $dbSchema);
    if (mysqli_connect_error()) { // verifica se a conexao com o bd foi bem sucedida
        $msgBD = mysqli_connect_error();
        echo "Falha na conexao com o BD: $msgBD";
        exit();
    }

    // sucesso na conexao
    // insert into tiposatividade (descricao) values ('Programador Web');
    $comandoSQL = "insert into titulos (descricao) values ('$descricaoTitulo')";

    // executa o comando SQL e recupera o retorno da execucao
    $resultadoConsulta = mysqli_query($dbConexao, $comandoSQL);

    // fechar a conexao
    mysqli_close($dbConexao);

    // avalia se a execucao do comando SQL foi feita com sucesso
    if ($resultadoConsulta) {
        $mensagemRetorno = "Título [$descricaoTitulo] inserido com sucesso";
    } else {
        $mensagemRetorno = "Falha ao cadastrar Título [$descricaoTitulo]";
    }

    // echo $mensagemRetorno;
    
    // armazenei a mensagem de retorno na sessao
    $_SESSION['mensagemRetorno'] = $mensagemRetorno;

    // redireciono para a pagina "cadastroTitulo.php"
    header("location: cadastroTitulos.php");

    
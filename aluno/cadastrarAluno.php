<?php
    // variaveis de acesso ao BD
    $host = 'localhost';
    $dbUsuario = 'root';
    $dbSenha = '';
    $dbSchema = 'escola';

    // variaveis do formulario de entrada de dados
    $nomeAluno = $_POST['nome'];
    $dataInicial = $_POST['dataInicial'];
    
    // conectar o BD
    $dbConexao = mysqli_connect($host, $dbUsuario, $dbSenha, $dbSchema);
    if (mysqli_connect_error()) { // verifica se a conexao com o bd foi bem sucedida
        $msgBD = mysqli_connect_error();
        echo "Falha na conexao com o BD: $msgBD";
        exit();
    }

    // sucesso na conexao
    // insert into alunos (nome, dataInicial) values ('Marcos Ferreira', '2021-10-01');
    $comandoSQL = "insert into alunos (nome, dataInicial) values ('$nomeAluno', '$dataInicial')";

    // executa o comando SQL e recupera o retorno da execucao
    $resultadoConsulta = mysqli_query($dbConexao, $comandoSQL);

    // fechar a conexao
    mysqli_close($dbConexao);

    // avalia se a execucao do comando SQL foi feita com sucesso
    if ($resultadoConsulta) {
        $mensagemRetorno = "Aluno [$nomeAluno] inserido com sucesso";
    } else {
        $mensagemRetorno = "Falha ao cadastrar Aluno [$nomeAluno]";
    }

    echo $mensagemRetorno;

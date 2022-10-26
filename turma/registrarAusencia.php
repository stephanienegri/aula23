<?php

session_start();

// variaveis de acesso ao BD
$host = 'localhost';
$dbUsuario = 'root';
$dbSenha = '';
$dbSchema = 'escola';

// variaveis do formulario de entrada de dados
$numeroTurmaSelecionada = intval($_POST['numeroTurmaSelecionada']);
$matriculaAluno = intval($_POST['matriculaAluno']);
$dataAusencia = $_POST['dataAusencia'];

// conectar o BD
$dbConexao = mysqli_connect($host, $dbUsuario, $dbSenha, $dbSchema);
if (mysqli_connect_error()) { // verifica se a conexao com o bd foi bem sucedida
    $msgBD = mysqli_connect_error();
    echo "Falha na conexao com o BD: $msgBD";
    exit();
}

 // sucesso na conexao
$comandoSQL = "insert into ausencias (numeroTurma, matriculaAluno, dataAusencia)
               values ($numeroTurmaSelecionada, $matriculaAluno, '$dataAusencia');";

// executa o comando SQL e recupera o retorno da execucao
$resultadoConsulta = mysqli_query($dbConexao, $comandoSQL);

// fechar a conexao
mysqli_close($dbConexao);

// avalia se a execucao do comando SQL foi feita com sucesso
if ($resultadoConsulta) {
    $mensagemRetorno = "Ausência para a matricula [$matriculaAluno] da Turma [$numeroTurmaSelecionada] registrada com sucesso";
} else {
    $mensagemRetorno = "Falha ao registrar ausência para a matricula [$matriculaAluno] da Turma [$numeroTurmaSelecionada]";
}

// armazena na sessao a turma e escolhida e a mensagem de retorno para tratar no retorno a pagina RegistroAusencia
$_SESSION['numeroTurmaSelecionada'] = $numeroTurmaSelecionada;
$_SESSION['mensagemRetorno'] = $mensagemRetorno;

// redireciona a execucao para a pagina "RegistrarAusencia.php"
header('location: registroAusencia.php');

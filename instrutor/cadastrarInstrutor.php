<?php
// variaveis de acesso ao BD
$host = 'localhost';
$dbUsuario = 'root';
$dbSenha = '';
$dbSchema = 'escola';

// variaveis do formulario de entrada de dados
$nomeInstrutor = $_POST['nome'];
$rg = $_POST['rg'];
$dataNascimento = $_POST['dataNascimento'];
$ddd = $_POST['ddd'];
$telefone = $_POST['telefone'];
$codigoTitulo = $_POST['codigoTitulo'];

// conectar o BD
$dbConexao = mysqli_connect($host, $dbUsuario, $dbSenha, $dbSchema);
if (mysqli_connect_error()) { // verifica se a conexao com o bd foi bem sucedida
    $msgBD = mysqli_connect_error();
    echo "Falha na conexao com o BD: $msgBD";
    exit();
}

 // sucesso na conexao
$comandoSQL = "insert into instrutores (rg, nome, dataNascimento, telefone, ddd, codigoTitulo) value ('$rg', '$nomeInstrutor', '$dataNascimento', '$telefone', '$ddd', $codigoTitulo)";

// executa o comando SQL e recupera o retorno da execucao
$resultadoConsulta = mysqli_query($dbConexao, $comandoSQL);

// fechar a conexao
mysqli_close($dbConexao);

// avalia se a execucao do comando SQL foi feita com sucesso
if ($resultadoConsulta) {
    $mensagemRetorno = "Instrutor [$nomeInstrutor] inserido com sucesso";
} else {
    $mensagemRetorno = "Falha ao cadastrar Instrutor [$nomeInstrutor]";
}

echo $mensagemRetorno;
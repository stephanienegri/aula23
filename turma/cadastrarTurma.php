<?php
// variaveis de acesso ao BD
$host = 'localhost';
$dbUsuario = 'root';
$dbSenha = '';
$dbSchema = 'escola';

// variaveis do formulario de entrada de dados
$horarioAula = $_POST['horarioAula'];
$duracaoAula = $_POST['duracaoAula'];
$dataInicial = $_POST['dataInicial'];
$tipoAtividade = $_POST['tipoAtividade'];
$idInstrutor = $_POST['idInstrutor'];
$matriculaMonitor = $_POST['matriculaAlunoMonitor'];

// conectar o BD
$dbConexao = mysqli_connect($host, $dbUsuario, $dbSenha, $dbSchema);
if (mysqli_connect_error()) { // verifica se a conexao com o bd foi bem sucedida
    $msgBD = mysqli_connect_error();
    echo "Falha na conexao com o BD: $msgBD";
    exit();
}

 // sucesso na conexao
$comandoSQL = "insert into turmas (horarioAula, duracaoAula, dataInicial, 
                                   codigoTipoAtividade, matriculaMonitor,
                                   idInstrutor)
               values ('$horarioAula', $duracaoAula, '$dataInicial',
                        $tipoAtividade, $matriculaMonitor, $idInstrutor);";

// executa o comando SQL e recupera o retorno da execucao
$resultadoConsulta = mysqli_query($dbConexao, $comandoSQL);

// fechar a conexao
mysqli_close($dbConexao);

// avalia se a execucao do comando SQL foi feita com sucesso
if ($resultadoConsulta) {
    $mensagemRetorno = "Turma inserida com sucesso";
} else {
    $mensagemRetorno = "Falha ao cadastrar Turma";
}

echo $mensagemRetorno;
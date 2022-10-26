<?php

session_start();

// variaveis de acesso ao BD
$host = 'localhost';
$dbUsuario = 'root';
$dbSenha = '';
$dbSchema = 'escola';

// recuperar numero da Turma proveniente do formulario "frmDefinirTurma"
$numeroTurmaSelecionada = $_POST['numeroTurma'];

// armazena na sessao a turma escolhida para tratar no retorno a pagina RegistroAusencia
$_SESSION['numeroTurmaSelecionada'] = $numeroTurma;

// conectar o BD
$dbConexao = mysqli_connect($host, $dbUsuario, $dbSenha, $dbSchema);
if (mysqli_connect_error()) {
   $msgBD = mysqli_connect_error();
   header($_SERVER['SERVER_PROTOCOL'] . "Falha na conexao com o BD: $msgBD", true, 500); /* HTTP CODE 500 */
   die($mensagemErro);
}

$comandoSQL = "select alunos.matricula, alunos.nome 
               from turmas 
               inner join turmas_alunos 
                  on turmas.numero = turmas_alunos.numeroTurma 
               inner join alunos 
                  on turmas_alunos.matriculaAluno = alunos.matricula 
               where turmas.numero = $numeroTurmaSelecionada;"; 

// executa comando SQL
$resultadoConsultaAlunos = mysqli_query($dbConexao, $comandoSQL);

// verifica se a consulta teve resultado
if (mysqli_num_rows($resultadoConsultaAlunos) > 0)  {

   // armazena o resultado da consulta na sessao
   $_SESSION['resultadoConsultaAlunos'] = mysqli_fetch_all($resultadoConsultaAlunos, MYSQLI_ASSOC);

} else {

   // gera mensagem de retorno para avisar que não foi encontrado aluno cadastrado para a turma selecionada
   $_SESSION['mensagemRetorno'] = "Não foram encontrados alunos cadastrados para a turma [$numeroTurmaSelecionada]";

}

// libera da memoria o objeto com o resultado da consulta
mysqli_free_result($resultadoConsultaAlunos);

// fecha a conexao com o BD
mysqli_close($dbConexao);

// redireciona a execucao para a pagina "RegistrarAusencia.php"
header('location: registroAusencia.php');


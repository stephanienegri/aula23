<!DOCTYPE html>
<html lang="pt-BR">
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
                    <a href="listarTiposAtividade.php" class="nav-link">Listar</a>
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

        <div class="container text-center border-bottom border-primary text-center bg-light">    
            <div class="row mt-5">
                <div class="col">
                    <h1>Cadastro de Tipos de Atividade</h1>
                </div>  
            </div>
        </div>
    </header>
    

    <main class="container m-2 w-75 mx-auto">
        <form action="cadastrarTiposAtividade.php" method="POST" name="frmCadastrarTiposAtividade" id="idFrmCadastrarTiposAtividade">
            <div class="form-group">
                <label for='idDescricao'>Descrição</label>
                <input class="form-control" type='text' id='idDescricao' name='descricao' placeholder='Informe a descrição' required>
            </div>
            <div class='form-group text-center'>
                <input type='reset'  value='Limpar' class='btn btn-primary btn-md'>
                <input type='submit' value='Cadastrar' class='btn btn-primary btn-md' id="btnCadastrarTiposAtividade">
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
    <!-- insira este conteudo do Bootstrap aqui, antes do fechamento do <body> -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous">
    </script>
    
</body>
</html>
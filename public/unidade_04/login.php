<?php require_once("../../conexao/conexao.php")?>
<?php
        //iniciar a sessão, deve-se colocar em todas as paginas que possuirem variaveis de sessão
        session_start();

    //verificando se os dados estão sendo repassados para as variaveis
    if(isset($_POST["usuario"])){
        $usuario = $_POST["usuario"];
        $senha =  $_POST["senha"];

        //filtrando no BD
        $login = "select * from clientes where usuario = ";
        $login .= "'{$usuario}' and senha = '{$senha}'";

        //executando pesquisa no banco
        $acesso = mysqli_query($conecta, $login);

        //testando erro

        if( !$acesso ) die("Falha na conexão");

        //verificar se o login está correto ou não

        $informacao = mysqli_fetch_assoc($acesso);
        
        //testando se o filtro deu certo, ou se voltou vazio
        if( empty($informacao) ){
            $mensagem =  "Login sem sucesso";
        }else{
            //iniciando a variavel de sessao
            $_SESSION["user_portal"] = $informacao["clienteID"];
            Header("location: listagem.php");
        }

    }


   
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="_css/estilo.css">
    <link rel="stylesheet" href="_css/login.css">
    <title>Document</title>
</head>
<body>
    <?php include_once("_incluir/topo.php");?>
    
    <main>
        <div id="janela_login">
        <h2>Tela de Login</h2>
            <form action="login.php" method="post">
                <input type="text" name="usuario" placeholder="Usuário">
                <input type="password" name="senha" placeholder="Senha">
                <input type="submit" name="login" value="Login">

                <?php
                //o login não apareceu no filtro acima
                if( isset($mensagem)){ ?>
                    <p><?php echo $mensagem ?></p>
                <?php }?>

            </form>
        </div>
    </main>


    <?php include_once("_incluir/rodape.php");?>
</body>
</html>
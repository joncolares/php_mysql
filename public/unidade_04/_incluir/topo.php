<? require_once("../../conexao/conexao.php")?>
    <link rel="stylesheet" href="../_css/estilo.css">
<header>
    <div id="header_central">
        <?php
    
        //Verificando se a sessao está aberta
            if(isset($_SESSION["user_portal"])){
                $user = $_SESSION["user_portal"];
                //consulta ao banco
                $saudacao = "select nomecompleto from clientes where clienteID= '{$user}'";

                $saudacao_login = mysqli_query($conecta, $saudacao);
               
                if(!$saudacao_login) die("Falha na conexão");
                //Saudação login

                $saudacao_login = mysqli_fetch_assoc($saudacao_login); //traz a listagem dos camposa da tabela cliente
                $nome = $saudacao_login["nomecompleto"]; // pegando so o nome do cliente
            ?>
            
            <div id="header_saudacao">
            <h5>Bem vindo, <?php echo $nome?> - 
            <a href="sair.php">Sair</a>    
            </h5>
            </div>
        
        <?php 
            }?>

        <img src="assets/logo_andes.gif">
        <img src="assets/text_bnwcoffee.gif">
    </div>
</header>
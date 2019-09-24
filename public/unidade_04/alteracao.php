<?php require_once("../../conexao/conexao.php");?>
<?php
    //verificar se ja foi iniciado
        if(isset($_POST["nometransportadora"])){
            $nome = utf8_decode($_POST["nometransportadora"]);
            $endereco = utf8_decode($_POST["endereco"]);
            $cidade = utf8_decode($_POST["cidade"]);
            $estado = $_POST["estados"];
            $cep = $_POST["cep"];
            $cnpj = $_POST["cnpj"];
            $telefone = $_POST["telefone"];
            $tID = $_POST["transportadoraID"];
            

            //objeto para alteração
            $alterar = "update transportadoras set nometransportadora = '{$nome}', ";
            $alterar .= "endereco = '{$endereco}', ";
            $alterar .= "cidade = '{$cidade}', ";
            $alterar .= "estadoID = '{$estado}', ";
            $alterar .= "cep = '{$cep}', ";
            $alterar .= "cnpj = '{$cnpj}', ";
            $alterar .= "telefone = '{$telefone}' ";
            $alterar .= "where transportadoraID = '{$tID}'";

            $operacao_alterar = mysqli_query($conecta, $alterar);
            if(!$operacao_alterar){
                die("Falha na Conexão");
            }else{
                header("location: listagem_transportadoras.php");
            }


        }


    //consulta a tabela de transportadoras
    $transportadoras = "select * from transportadoras ";
    //verificando se esta configurada
    if(isset($_GET["codigo"])){
        $id = $_GET["codigo"];
        $transportadoras .= "where transportadoraID = {$id}";
    }else{
        $transportadoras .= "where transportadoraID = 1";
    }

    $conexao_transportadoras = mysqli_query($conecta, $transportadoras);
    if(!$conexao_transportadoras)die("Falha na conexão");
    //listagem das transportadoras
    $info_transportadoras = mysqli_fetch_assoc($conexao_transportadoras);
    if(!$info_transportadoras) die("falha na conexão");
    //consulta aos estados
    $estado = "select * from estados ";
    $con_estado = mysqli_query($conecta, $estado);
    if(!$con_estado)die("falha na conexão");  

?>


<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="_css/estilo.css">
    <link rel="stylesheet" href="_css/alteracao.css">
    <title>Document</title>
</head>
<body>
    <?php include_once("_incluir/topo.php");?>
    
    <main>
        <div id="janela_formulario">
            <form action="alteracao.php" method="post">
            <h2>Alteração de Transportadoras</h2>
            <label for="nometransportadora">Nome Transportadora</label>
            <input type="text" value="<?php echo utf8_encode($info_transportadoras["nometransportadora"]);?>" name="nometransportadora" id="nometransportadora">

            <label for="endereco">Endereço</label>
            <input type="text" value="<?php echo utf8_encode($info_transportadoras["endereco"]);?>" name="endereco" id="endereco">

            <label for="cidade">Cidade</label>
            <input type="text" value="<?php echo utf8_encode($info_transportadoras["cidade"]);?>" name="cidade" id="cidade">

            <label for="estados">Estados</label>
            <select name="estados" id="estados">
                <?php 
                    $meuestado = $info_transportadoras["estadoID"];
                    while($linha = mysqli_fetch_assoc($con_estado)){
                        $estado_atual = $linha["estadoID"];
                        if($meuestado == $estado_atual){
                ?>
                <option value=" <?php echo ($linha["estadoID"])?>" selected><?php echo utf8_encode($linha["nome"])?></option>
                
                <?php }else{?>
                  
                    <option value=" <?php echo ($linha["estadoID"])?>" ><?php echo utf8_encode($linha["nome"])?></option>
                <?php }
                        }
                ?>
            </select>

            <label for="cep">CEP</label>
            <input type="text" value="<?php echo utf8_encode($info_transportadoras["cep"]);?>" name="cep" id="cep">

            <label for="telefone">Telefone</label>
            <input type="text" value="<?php echo utf8_encode($info_transportadoras["telefone"]);?>" name="telefone" id="telefone">

            <label for="cnpj">CNPJ</label>
            <input type="text" value="<?php echo utf8_encode($info_transportadoras["cnpj"]);?>" name="cnpj" id="cnpj">

            <input type="text" value="<?php echo $info_transportadoras["transportadoraID"];?>" name="transportadoraID" >

            <input type="submit" value="Confirmar Alteração">
            </form>
        </div>
    </main>

    <?php include_once("_incluir/rodape.php");?>
</body>
</html>
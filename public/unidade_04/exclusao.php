<?php require_once("../../conexao/conexao.php")?>
<?php
    if(isset($_POST["nometransportadora"])){
        $id = $_POST["transportadoraID"];

        $etr = "delete from transportadoras where transportadoraID = {$id} ";
        $con_exclusao = mysqli_query($conecta, $etr);
        if(!$con_exclusao) {die("Falha na exclusão do registro");
        }else{
            header("location: listagem_transportadoras.php");
        }

    }


    $tre = "select * from transportadoras ";
    if(isset($_GET["codigo"])){
        $id = $_GET["codigo"];
        $tre .= "where transportadoraID = {$id} ";
    }
    $con_transportadoras = mysqli_query($conecta, $tre);
    if(!$con_transportadoras) die("Falha na conexão");
    $info_transportadoras = mysqli_fetch_assoc($con_transportadoras);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="_css/estilo.css">
    <link rel="stylesheet" href="_css/alteracao.css">

</head>
<body>
    <?php include_once("_incluir/topo.php");?>

    <main>
        <div id="janela_formulario">
            <form action="exclusao.php" method="post">
            <h2>Exclusão de Transportadoras</h2>
            <label for="nometransportadora">Nome Transportadora</label>
            <input type="text" value="<?php echo utf8_encode($info_transportadoras["nometransportadora"]);?>" name="nometransportadora" id="nometransportadora">

            <label for="endereco">Endereço</label>
            <input type="text" value="<?php echo utf8_encode($info_transportadoras["endereco"]);?>" name="endereco" id="endereco">

            <label for="cidade">Cidade</label>
            <input type="text" value="<?php echo utf8_encode($info_transportadoras["cidade"]);?>" name="cidade" id="cidade">

            <input type="hidden" value="<?php echo $info_transportadoras["transportadoraID"];?>" name="transportadoraID" >

            <input type="submit" value="Confirmar Exclusão">
            </form>
        </div>
    </main>


    <?php include_once("_incluir/rodape.php");?>
</body>
</html>
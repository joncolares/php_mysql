<?php require_once("../../conexao/conexao.php"); ?>

<?php
    //consulta no banco de dados
    $produto = "Select produtoID, nomeproduto, tempoentrega, precounitario, imagempequena ";
    $produto .= "from produtos";
    //Execuntado a consulta
    $resultado = mysqli_query($conecta, $produto);
    if(!$resultado) die("falha na conexão");
?>

<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Curso PHP FUNDAMENTAL</title>
        
        <!-- estilo -->
        <link href="_css/estilo.css" rel="stylesheet">
    </head>

    <body>
       <?php include_once ("_incluir/topo.php")?>
        
        <main>  
            <?php
                while($linha = mysqli_fetch_assoc($resultado)){
            ?>
                <ul>
                    <li><?php echo $linha["nomeproduto"]?></li>
                    <li><?php echo $linha["precounitario"] ?></li>
                    <li><?php echo $linha["tempoentrega"]?></li>

                </ul>
            <?php
                }
            ?>
        </main>

        <?php include_once("_incluir/rodape.php") ?>
    </body>
</html>

<?php
    // Fechar conexao
    mysqli_close($conecta);
?>
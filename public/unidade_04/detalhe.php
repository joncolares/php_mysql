<?php require_once("../../conexao/conexao.php"); ?>
<?php
    //Verifica se foi iniciada/ Configurada.
    if( isset($_GET["codigo"]) ){
    $produto_id = $_GET["codigo"];
    }else{
        //Quando não encontra, direciona para a pagina inicial
        Header("Location: inicial.php");
    }

    //consulta ao banco de dados
    $consulta = "Select * From produtos where produtoID = {$produto_id}";
    //Executa a consulta
    $detalhe = mysqli_query($conecta, $consulta);

    //testa erro
    if(!$detalhe){
        die("Falha na conexão");
    }else{
        $dados_detalhe = mysqli_fetch_assoc($detalhe);

        $produtoID = $dados_detalhe["produtoID"];
        $nomeproduto = $dados_detalhe["nomeproduto"];
        $descricao = $dados_detalhe["descricao"];
        $codigobarra = $dados_detalhe["codigobarra"];
        $tempoentrega = $dados_detalhe["tempoentrega"];
        $precorevenda = $dados_detalhe["precorevenda"];
        $precounitario = $dados_detalhe["precounitario"];
        $estoque = $dados_detalhe["estoque"];
        $imagemgrande = $dados_detalhe["imagemgrande"];


    }
?>


<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="_css/style.css">
    <link rel="stylesheet" href="_css/produto_detalhe.css">
</head>
<body>
    <?php include_once("_incluir/topo.php"); ?>
    <main>
        <div id="detalhe_produto">
            <ul>
                <li class="imagem"><img src="<?php echo $imagemgrande ?>"></li>
                <li><h2><?php echo $nomeproduto ?></h2></li>
                <li><b>Descrição: <?php echo $descricao ?></b></li>
                <li><b>Código de Barra: <?php echo $codigobarra ?></b></li>
                <li><b>Tempo de Entrega: <?php echo $tempoentrega ?></b></li>
                <li><b>Preço Unitário: <?php echo "R$ " .number_format($precounitario,2,",",".") ?></b></li>
                <li><b>Preço Revenda: <?php echo "R$ " .number_format($precorevenda,2,",",".") ?></b></li>
                <li><b>Estoque: <?php echo $estoque ?></b></li>
            </ul>
        
        </div>    
            
    </main>

    <?php include_once("_incluir/rodape.php"); ?>
</body>
</html>
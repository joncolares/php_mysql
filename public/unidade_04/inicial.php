<?php require_once("../../conexao/conexao.php"); ?>

<?php
    //determinar localidade
    setlocale(LC_ALL, 'pt_BR');

    //consulta no banco de dados
    $produto = "Select produtoID, nomeproduto, tempoentrega, precounitario, imagempequena ";
    $produto .= "from produtos";
    //Criando o filtro
    if(isset($_GET["produto"])){
        $nomeproduto = $_GET["produto"];
        $produto .= " where nomeproduto LIKE '%{$nomeproduto}%' ";

    }
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
        <link href="_css/produtos.css" rel="stylesheet">
        <link rel="stylesheet" href="_css/produto_pesquisa.css">
    </head>

    <body>
       <?php include_once ("_incluir/topo.php")?>
        
        <main>  
            <div id="janela_pesquisa">
                <form action="inicial.php" method="get">
                    <input type="text" name="produto" placeholder="Pesquisar">
                    <input type="image" name="pesquisa" src="assets/botao_search.png">

                </form>
            </div>


            <div id="listagem_produtos">
                <?php
                    while($linha = mysqli_fetch_assoc($resultado)){
                ?>
                    <ul>
                        <li class="imagem">
                            <a href="detalhe.php?codigo=<?php echo $linha['produtoID']?>">
                               <img src="<?php echo $linha["imagempequena"]?>" >
                            </a>
                        </li>
                        <li><h3><?php echo $linha["nomeproduto"]?></h3></li>
                        <li>Preço Unitário: <?php echo  $linha["precounitario"] ?></li>
                        <li>Tempo de Entrega: <?php echo $linha["tempoentrega"]?></li>

                    </ul>
                <?php
                    }
                ?>

            </div>
        </main>

        <?php include_once("_incluir/rodape.php") ?>
    </body>
</html>

<?php
    // Fechar conexao
    mysqli_close($conecta);
?>
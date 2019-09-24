<?php require_once('../../conexao/conexao.php')?>
<?php
   /*teste de envio, verifica se todas as informações estão funcionando

    if(isset($_POST["nometransportadora"])){
        print_r($_POST);
    }*/

    //inserido no banco
   if(isset($_POST["nometransportadora"])){
        $nome = utf8_decode($_POST["nometransportadora"]);
        $endereco = utf8_decode($_POST["endereco"]);
        $telefone = utf8_decode($_POST["telefone"]);
        $cidade = utf8_decode($_POST["cidade"]);
        $estado = utf8_decode($_POST["estados"]);
        $cep = utf8_decode($_POST["cep"]);
        $cnpj = utf8_decode($_POST["cnpj"]);

        $inserir = "insert into transportadoras (nometransportadora, endereco, telefone, cidade, estadoID, cep, cnpj) ";
        $inserir .= "values ('$nome','$endereco', '$telefone', '$cidade', $estado, '$cep', '$cnpj')";

        $operacao_inserir = mysqli_query($conecta, $inserir);
        if(!$operacao_inserir) die("Erro ao inserir no Banco");
     
    }

    //iniciar a sessão, deve-se colocar em todas as paginas que possuirem variaveis de sessão
    session_start();
    $select = "select * from estados";
    $lista_estados = mysqli_query($conecta, $select);
    if(!$lista_estados) die("Falha na conexão com o banco de dados");

?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="_css/crud.css">
    <link rel="stylesheet" href="_css/estilo.css">
</head>
<body>
    <?php include_once("_incluir/topo.php");?>

    <main>
        <div id="janela_formulario">
            <form action="crud_transportadora.php" method="post">
                <input type="text" name="nometransportadora" placeholder="Transportadora">
                <input type="text" name="endereco" placeholder="Endereço">
                <input type="text" name="telefone" placeholder="Telefone">
                <input type="text" name="cidade" placeholder="Cidade">
                <select name="estados">
                <?php
                    while($linha = mysqli_fetch_assoc($lista_estados)){
                ?>
                    <option value="<?php echo ($linha['estadoID']);?>" ><?php echo utf8_encode($linha["nome"]);?></option>
                <?php
                     }
                ?>
                </select>
                <input type="text" name="cep" placeholder="CEP">
                <input type="text" name="cnpj" placeholder="CNPJ">
                <input type="submit" value="Inserir">

            </form>

        </div>

    </main>

    <?php include_once("_incluir/rodape.php");?>
</body>
</html>
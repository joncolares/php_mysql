<?php
    //abrindo conexão
    $conecta = mysqli_connect("localhost","root","","andes");
    //Verificando conexão
    if( mysqli_connect_errno()) die("Conexão Falhou". mysqli_connect_errno());
?>
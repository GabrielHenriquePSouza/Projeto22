<?php

include("conectadb.php");

session_start();

$nomeusuario = $_SESSION['nomeusuario'];




#JÁ LISTA OS USUARIOS DO MEU BANCO

$sql = "SELECT * FROM clientes WHERE cli_ativo ='s'";

$retorno = mysqli_query($link, $sql);




#JÁ FORÇA TRAZER NA VARIÁVEL ATIVO

$ativo = 's';




#COLETA O BOTÃO DE POST

if ($link) {
    $sql = "SELECT * FROM clientes WHERE cli_ativo = 's'";
    $retorno = mysqli_query($link, $sql);

    $ativo = 's';

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $ativo = $_POST['ativo'];

        if ($ativo == 's') {
            $sql = "SELECT * FROM clientes WHERE cli_ativo = 's'";
            $retorno = mysqli_query($link, $sql);
        } else {
            $sql = "SELECT * FROM clientes WHERE cli_ativo = 'n'";
            $retorno = mysqli_query($link, $sql);
        }
    }

    // Resto do código...

} else {
    echo "Falha na conexão com o banco de dados.";
}
?>




<!DOCTYPE html>

<html lang="pt br">




<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="./css/estiloadm.css">
    <title>MENU ADMINISTRATIVO</title>

</head>




<body>

    <div>

        <ul class="menu">

            <li><a href="cadastrausuario.php">CADASTRA USUARIO</a></li>

            <li><a href="cadastracliente.php">CADASTRA CLIENTE</a></li>

            <li><a href="cadastraproduto.php">CADASTRA PRODUTO</a></li>

            <li><a href="listausuario.php">LISTA USUARIO</a></li>

            <li><a href="listacliente.php">LISTA CLIENTE</a></li>

            <li><a href="listaproduto.php">LISTA PRODUTO</a></li>

            <li class="menuloja"><a href="./areacliente/loja.php">LOJA</a></li>

            <?php

            #ABERTO O PHP PARA VALIDAR SE A SESSÂO DO USUARIO ESTÁ ABERTA

            #SE SESSÃO ABERTA, FECHA O PHP PARA USAR ELEMENTOS HTML

            if ($nomeusuario != null) {

            ?>

                <!-- USO DO ELEMENTO HTML COM O PHP INTERNO -->

                <li class="profile">OLÁ <?= strtoupper($nomeusuario) ?></li>

            <?php

                #ABERTURA DE OUTRO PHP CASO FALSE

            } else {

                echo "<script>window.alert('USUARIO NÃO AUTENTICADO');window.location.href='login.php';</script>";
            }

            #FIM DO PHP PARA CONTINUAR MEU HTML

            ?>

        </ul>

    </div>




    <!-- AQUI LISTA OS USUARIOS DO BANCO-->

    <div id="background">

        <form action="listacliente.php" method="post">

            <input type="radio" name="ativo" class="radio" value="s" required onclick="submit()" <?= $ativo == 's' ? "checked" : "" ?>>ATIVOS




            <input type="radio" name="ativo" class="radio" value="n" required onclick="submit()" <?= $ativo == 'n' ? "checked" : "" ?>>INATIVOS




        </form>




        <div class="container">

            <table border="1">

                <tr>

                    <th>CPF</th>

                    <th>NOME</th>

                    <th>DATA DE NASCIMENTO</th>

                    <th>TELEFONE</th>

                    <th>LOGRADOURO</th>

                    <th>NUMERO</th>

                    <th>CIDADE</th>

                    <th>ALTERAR DADOS</th>

                    <th>ATIVO?</th>

                </tr>

                <!-- BRUXARIA EM PHP -->

                <?php

                while ($tbl = mysqli_fetch_array($retorno)) {

                ?>

                    <tr>

                        <td><?= $tbl[1] ?></td> <!-- TRAZ SOMENTE A COLUNA ! DO BANCO [CPF] -->

                        <td><?= $tbl[2] ?></td> <!-- TRAZ SOMENTE A COLUNA ! DO BANCO [NOME] -->

                        <td><?= $tbl[4] ?></td> <!-- TRAZ SOMENTE A COLUNA ! DO BANCO [DATA DE NASCIMENTO] -->

                        <td><?= $tbl[5] ?></td> <!-- TRAZ SOMENTE A COLUNA ! DO BANCO [TELEFONE] -->

                        <td><?= $tbl[6] ?></td> <!-- TRAZ SOMENTE A COLUNA ! DO BANCO [LOGRADOURO] -->

                        <td><?= $tbl[7] ?></td> <!-- TRAZ SOMENTE A COLUNA ! DO BANCO [NUMERO] -->

                        <td><?= $tbl[8] ?></td> <!-- TRAZ SOMENTE A COLUNA ! DO BANCO [CIDADE] -->

                        <td><a href="alteracliente.php?id= <?= $tbl[0] ?>">

                                <input type="button" value="ALTERAR DADOS"></a></td><!--CRIANDO UM BOTÃO ALTERAR PASSANDO O ID DO USUARIO VIA GET-->

                        <td><?= $check = ($tbl[9] == 's') ? "SIM" : "NÃO" ?></td><!-- VALIDA S OU N E ESCREVE "SIM" E "NÃO-->

                    </tr>

                <?php

                }

                ?>

            </table>

        </div>





    </div>

</body>




</html>
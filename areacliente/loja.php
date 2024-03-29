<?php
include("../conectadb.php");

session_start();

$sql = "SELECT * FROM produtos WHERE pro_ativo = 's'";
$retorno = mysqli_query($link, $sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/loja.css">
    <title>LOJA</title>
</head>
<body>
    <header>
        <nav>
            <ul class="menu">
                <li><a href="loja.php">HOME</a></li><!-- BOTÃO HOME -->
                <li><a href="#">PRODUTOS</a></li>

                <!-- VALIDA SE CLIENTE LOGOU -->
                <?php
                if (isset($_SESSION['idcliente'])):
                ?>
                    <form class="formmenu" action="logout.php" method="post">
                        <h3 class="menuright2">
                            Olá <?= $_SESSION['nomecliente']; ?>
                        </h3>
                        <li class="menu-right"><a href="perfil.php?id=<?= $sessao_idcliente ?>">PERFIL</a></li>
                        <li class="menu-right"><a href="logout.php">LOGOUT</a></li>
                    </form>
                <?php else: ?>
                    <form class="formmenu">
                        <li class="menu-right"><a href="logincliente.php" style="float: right">LOGIN</a></li>
                        <li class="menu-right"><a href="../cadastracliente.php">CADASTRAR</a></li>
                    </form>
                <?php endif; ?>
            </ul>
        </nav>
    </header>
    <!-- CORPO DA LOJA -->
    <div class="conteudo">
        <?php
        while ($tbl = mysqli_fetch_array($retorno)) {
        ?>
        <div class="card">
                <!-- COLETA IMAGEM DO PRODUTO -->
                <img src="data:image/jpeg;base64, <?= $tbl[7] ?>" style="width: 300px; height:300px;">
                <!-- NOME DO PRODUTO -->
                <h1 class="tituloprod"><?= $tbl[1] ?></h1>
                <!-- PREÇO DO PRODUTO -->
                <p class="tituloprod"><?= number_format($tbl[5],2,',','.')?></p>
                <!-- DESCRIÇÃO PRODUTO -->
                <p><?= $tbl[2] ?></p>

                <!-- BOTÃO ADD PRODUTO NO CARRINHO -->
                <p><a class="botao" href="verproduto.php?id=<?= $tbl[0] ?>"><input type="button" class="botao" value="VISUALIZAR DETALHES"></a></p>
            </div>
            <?php
        }
        ?>
    </div>
</body>

</html>

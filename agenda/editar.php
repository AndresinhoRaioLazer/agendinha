<?php

    require 'controlador_agenda.php';
    $contato = editarContato($_GET['id']);
?>

<!doctype html>
<html lang="en">
<head>
    <style>
        h3{
            color: darkblue;
        }
        form{
            text-align: center;
        }
    </style>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

    <form method="post" action="controlador_agenda.php?acao=editar">
        <h3>Id</h3>
        <input name="id"       type="text"   value="<?= $contato['id']?>"><br>
        <h3>Nome</h3>
        <input name="nome"     type="text"   value="<?= $contato['nome']?>"><br>
        <h3>E-mail</h3>
        <input name="email"   type="e-mail" value="<?= $contato['email']?>"><br>
        <h3>Telefone</h3>
        <input name="telefone" type="text"   value="<?= $contato['telefone']?>"><br><br>
        <input type="submit" value="Editar" >
    </form>

</body>
</html>
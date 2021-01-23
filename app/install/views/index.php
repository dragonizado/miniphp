<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Instalador de dg app</title>
</head>
<style>
    form>input {
        display: block;
        margin-bottom: 8px;
        padding: 8px;
        height: 16px;
        border-radius: 4px;
        border: 1px solid silver;
    }

    form>button.success {
        background-color: #fcfcfc;
        color: #fff;
    }

    form>button.info {
        background-color: #fcfcfc;
        color: #fff;
    }

    form>button.info {
        background-color: #fcfcfc;
        color: #fff;
    }

    .btn {
        padding: 4px 9px;
        border-radius: 4px;

    }

    .btn-success {
        background-color: #fff;
        color: black;
    }
</style>

<body>
    <div style="width:100%;">
        <h1 style="text-align: center;">Configurar la base de datos</h1>
    </div>
    <?php
        if (!is_null($mensajes)) {
            echo "<p>$mensajes</p>";
            $mensajes = null;
        }
    ?>

    <center>
        <form action="" method="post">
            <input type="hidden" name="frm_checkdb">

            <input type="text" name="app_name" value="DG App" placeholder="Nombre de la aplicacion" required>
            <input type="text" name="db_host" placeholder="Host de la base de datos" value="localhost" required>
            <input type="text" name="db_name" placeholder="Nombre de la base de datos" required>
            <input type="text" name="db_username" value="root" placeholder="Usuario de la base de datos" required>
            <input type="text" name="db_password" placeholder="Contraseña de la base de datos">
            <button>Verificar</button>
        </form>
    </center>
</body>

</html>
<!DOCTYPE html>

<html>

<head>
    <title>Prijava</title>
    <link rel="stylesheet" type="text/css" href="static/css/style.css">
</head>

<body>

     <form action="<?= BASE_URL . "login" ?>" method="post">
        <h2>PRIJAVA</h2>

        <?php if (isset($_GET['error'])) { ?>
            <p class="error"><?php echo $_GET['error']; ?></p>
        <?php } ?>

        <label>User Name</label>
        <input type="text" name="email" placeholder="Elektronski naslov"><br>
        <label>Password</label>
        <input type="password" name="geslo" placeholder="Geslo"><br> 
        <button type="submit">Prijava</button>
     </form>

</body>

</html>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #84aff0;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .logo-container {
            text-align: center;
            margin: 20px 0;
        }

        .logo {
            max-width: 30000px;
            height: 600;
            margin-bottom: 20px;
        }

        .container {
            max-width: 500px;
            margin: 20px auto;
            padding: 30px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            color: #3474e6;
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            color: #333;
            font-weight: bold;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        button {
            width: 100%;
            padding: 12px;
            background-color: #3474e6;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background-color: #2461cc;
        }

        a {
            color: #3474e6;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        .error {
            color: black;
            text-align: center;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="logo-container">
        <img src="img/susdigital.png" alt="Logo SUS" class="logo">
    </div>
    
    <div class="container">
        <h2>Login</h2>
        <form action="verificar_usuario.php" method="POST" autocomplete="off">
            <input type="text" name="cpf" placeholder="CPF" required>
            <input type="password" name="senha" placeholder="Senha" required>

            <?php if (isset($erro)) : ?>
                <p class="error"><?php echo $erro; ?></p>
            <?php endif; ?>
                
            <button type="submit">Entrar</button>
        </form>

        
        <p style="text-align:center;">
            <a href="index.html">Voltar</a>
        </p>
    </div>
</body>
</html>
<?php
# Connect to the database
$conn = mysqli_connect('localhost', 'root', '', 'seguranca01');

# Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    # Use bcrypt to hash the password
    $password = password_hash($password, PASSWORD_BCRYPT);

    # Query the database
    $sql = "INSERT INTO users (name, email, password, role) VALUES ('$name', '$email', '$password', '$role')";
    $result = mysqli_query($conn, $sql);

    # Check if the user was registered
    if ($result) {
        # Loga o usuário na sessão e redireciona para a página de admin
        session_start();
        $_SESSION['email'] = $email;
        header('Location: /admin');
    } else {
        echo 'Error registering the user';
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f1f1f1;
        }

        .register-container {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            width: 300px;
        }

        h2 {
            margin-bottom: 20px;
            text-align: center;
        }

        label {
            display: block;
            margin-bottom: 8px;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"],
        select {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        input[type="submit"] {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 4px;
            background-color: #007bff;
            color: white;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <div class="register-container">
        <h2>Registro</h2>
        <form action="/register.php" method="POST">
            <label for="name">Nome</label>
            <input type="text" id="name" name="name" required>

            <label for="email">Email</label>
            <input type="email" id="email" name="email" required>

            <label for="password">Senha</label>
            <input type="password" id="password" name="password" required>

            <label for="role">Cargo</label>
            <select id="role" name="role" required>
                <option value="">Selecione...</option>
                <option value="financeiro">Financeiro</option>
                <option value="ti">TI</option>
            </select>

            <input type="submit" value="Registrar">
        </form>
    </div>
</body>

</html>
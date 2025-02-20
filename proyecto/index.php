<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proyecto</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .navbar {
            background-color: #333;
            overflow: hidden;
        }

        .navbar a {
            float: left;
            display: block;
            color: #f2f2f2;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
        }

        .navbar a:hover {
            background-color: #ddd;
            color: black;
        }

        .sidebar {
            height: 100%;
            width: 200px;
            position: fixed;
            top: 0;
            left: 0;
            background-color: #111;
            padding-top: 20px;
        }

        .sidebar button {
            display: block;
            background-color: #111;
            color: white;
            padding: 16px;
            text-align: left;
            border: none;
            width: 100%;
            cursor: pointer;
            outline: none;
        }

        .sidebar button:hover {
            background-color: #575757;
        }

        .content {
            margin-left: 200px;
            padding: 20px;
        }

        .search-box {
            margin-bottom: 20px;
        }

        .search-box input[type="text"] {
            width: 80%;
            padding: 10px;
            font-size: 16px;
        }

        .search-box button {
            padding: 10px;
            font-size: 16px;
        }
    </style>
</head>

<body>
    <div class="navbar">
        <a href="#home">Inicio</a>
        <a href="#services">Servicios</a>
        <a href="#contact">Contacto</a>
    </div>

    <div class="sidebar">
        <button>Botón 1</button>
        <button>Botón 2</button>
        <button>Botón 3</button>
    </div>

    <div class="content">
        <div class="search-box">
            <input type="text" placeholder="Buscar...">
            <button>Buscar</button>
        </div>
        <h1>Bienvenido a nuestro proyecto</h1>
        <p>Este es el contenido principal de la página.</p>
    </div>
</body>

</html>
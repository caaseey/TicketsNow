<?php
if (!isset($_GET['q']) || trim($_GET['q']) === '') {
    header("Location: ../../");
    exit();
}

$busqueda = strtolower(trim($_GET['q']));

$conciertos = [
    'bruno mars' => 'bruno_mars.php',
    'twice' => 'twice.php',
    'the weeknd' => 'the_weeknd.php',
    'sza' => 'sza.php',
    'aespa' => 'aespa.php',
    'imagine dragons' => 'imagine_dragons.php',
    'ado' => 'ado.php',
    'ksi' => 'ksi.php',
    'eladio carrión' => 'eladio_carrion.php',
    'marca registrada' => 'marca_registrada.php',
    'aurora' => 'aurora.php',
    'omar courtz' => 'omar_courtz.php',
    'acdc' => 'acdc.php',
    'kendrick lamar' => 'kendrick_lamar.php',
    'yoasobi' => 'yoasobi.php',
    'swingrowers' => 'swingrowers.php',
    'keshi' => 'keshi.php',
    'laufey' => 'laufey.php',
    'cuarteto de nos' => 'cuarteto_de_nos.php',
];

$resultado = null;
foreach ($conciertos as $nombre => $ruta) {
    if (substr($nombre, 0, strlen($busqueda)) === $busqueda) {
        $resultado = $ruta;
        break;
    }
}

if ($resultado) {
    header("Location: concerts/" . $resultado);
    exit();
} else {
?>
    <!DOCTYPE html>
    <html lang="es">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Concierto no encontrado | Tickets Now</title>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="index.css">
        <style>
            body {
                margin: 0;
                padding: 0;
                font-family: 'Poppins', sans-serif;
                background-color: #0f0f0f;
                color: #fff;
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
                height: 100vh;
                text-align: center;
            }

            img {
                width: 200px;
                margin-bottom: 2rem;
            }

            h1 {
                font-size: 2.5rem;
                margin-bottom: 1rem;
            }

            p {
                font-size: 1.1rem;
                color: #aaa;
            }

            .info {
                margin-top: 2rem;
                font-size: 0.9rem;
                color: #666;
            }

            :root {
                --blue: rgba(80, 118, 135, 1);
                --light: rgba(248, 245, 231, 1);
                --dark: rgba(51, 51, 51, 1);
            }

            .btn-volver {
                margin-top: 2rem;
                padding: 0.7rem 1.5rem;
                font-size: 1rem;
                background-color: var(--blue);
                border: none;
                border-radius: 5px;
                color: white;
                cursor: pointer;
                text-decoration: none;
                transition: background-color 0.3s;
            }

            .btn-volver:hover {
                background-color: rgba(60, 95, 110, 1);
            }
        </style>
    </head>

    <body>
        <img src="../../media/img/interfaces/logo.png" alt="Tickets Now">
        <h1>No se encontró el concierto</h1>
        <p>No hemos podido encontrar ningún concierto con ese nombre. 🎤</p>
        <div class="info">Intenta buscar otro artista o revisa la ortografía.</div>
        <a class="btn-volver" href="../../../view">Volver al inicio</a>
    </body>

    </html>
<?php
}

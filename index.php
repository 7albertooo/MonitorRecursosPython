<?php
session_start();

function sanear($dato)
{
    return htmlspecialchars(trim($dato));
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $accion = $_POST['accion'] ?? 'estado';


    if($accion === 'desconectar'){
        unset($_SESSION['datos']);
        unset($_SESSION['datos_limpios']);
        session_destroy();
    }

    if ($accion === 'estado') {

        $datos = [
            "ip" => sanear($_POST['ip'] ?? ''),
            "usuario" => sanear($_POST['user'] ?? ''),
            "password" => sanear($_POST['password'] ?? '')
        ];



        if (!empty($datos)) {
            $_SESSION['datos'] = $datos;
        }
    }


    $endpoint = ($accion === 'estado') ? "estado" : "orden?accion=$accion";


    if (!empty($_SESSION['datos'])) {
        $options = [
            "http" => [
                "header"  => "Content-type: application/json",
                "method"  => "POST",
                "content" => json_encode($_SESSION['datos'])
            ]
        ];

        $context = stream_context_create($options);

        $resultado = file_get_contents(
            "http://127.0.0.1:8000/$endpoint",
            false,
            $context
        );

        $_SESSION['datos_limpios'] = json_decode($resultado, true);
    }
}

include_once "vista.php";

<?php

function sanear($dato){
    return htmlspecialchars(trim($dato));
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {


    $datos = [
        "ip" => sanear($_POST['ip'] ?? ''),
        "usuario" => sanear($_POST['user'] ?? ''),
        "password" => sanear($_POST['password'] ?? '')
    ];

    if (!empty($datos)) {
        $options = [
            "http" => [
                "header"  => "Content-type: application/json",
                "method"  => "POST",
                "content" => json_encode($datos)
            ]
        ];

        $context = stream_context_create($options);

        $resultado = file_get_contents(
            "https://monitorrecursospython.onrender.com/estado",
            false,
            $context
        );

        $datos_limpios = json_decode($resultado, true);
    }
}

include_once "vista.php";
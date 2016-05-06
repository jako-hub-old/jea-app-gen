<?php echo "<?php\n"; ?>
# Se importan las librerias base js y css
Sistema::apl()->mRecursos->registrarJQuery(); 
Sistema::apl()->mRecursos->registrarBootstrap3();
Sistema::apl()->mRecursos->registrarAwesomeFont();
?>
<!DOCTYPE HTML>
<html>
    <head>
        <title><?php echo "<?php echo Sistema::apl()->nombre; ?>"; ?></title>
        <meta charset="<?php echo "<?php echo Sistema::apl()->charset; ?>"; ?>">
    </head>
    <body>
        <?php echo "<?php \$this->complemento('!siscoms.bootstrap3.CBNav',"?> [
            'brand' => Sistema::apl()->nombre,
            'elementos' => [
                ['texto' => 'Inicio', 'url' => ['principal/inicio']],
                ['texto' => 'Acerca', 'url' => ['principal/acerca']],
                ['texto' => 'Contacto', 'url' => ['principal/contacto']],
                [
                    'texto' => (Sistema::apl()->usuario->esVisitante? 'Iniciar sesión' : 'Cerrar sesión'),
                    'url' => ['principal/' . (Sistema::apl()->usuario->esVisitante? 'entrar' : 'salir')]
                ], 
            ],
        ]); ?>
        <div class="container">
        <?php echo "<?php echo \$this->contenido; ?>\n"?>
        </div>
    </body>
</html>
<?php 
//var_dump(Sistema::apl()->mRecursos->getUrlRecursos());exit();
Sistema::apl()->mRecursos->registrarJQuery();
Sistema::apl()->mRecursos->registrarBootstrap3();
Sistema::apl()->mRecursos->registrarSelect2();
Sistema::apl()->mRecursos->registrarRecursoCSS([
    'url' => Sistema::apl()->mRecursos->getUrlRecursos() . "comun/css/personalizados.css",
    'alias' => "personalizados",
], false);
?>
<!DOCTYPE html>
<html>
    <head>
        <title><?php echo Sistema::apl()->nombre; ?></title>
        <meta charset="<?php echo Sistema::apl()->charset; ?>" />
    </head>
    <body>
        <?php echo $this->contenido; ?>
    </body>
</html>
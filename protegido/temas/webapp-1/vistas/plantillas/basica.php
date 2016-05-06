<?php 
# Se importan las librerias base js y css
Sistema::apl()->mRecursos->registrarJQuery(); 
Sistema::apl()->mRecursos->registrarBootstrap3();
Sistema::apl()->mRecursos->registrarAwesomeFont();
Sistema::apl()->mRecursos->registrarRecursoCSS([
    'url' => Sistema::apl()->tema->getUrlBase() . '/css/estilos-tema.css',
    'alias' => 'estilos-tema',
]);
Sistema::apl()->mRecursos->registrarRecursoJS([
    'url' => Sistema::apl()->tema->getUrlBase() . '/plugins/chartjs/Chart.js',
    'alias' => 'open-source-js-chart',
]);

?>
<!DOCTYPE HTML>
<html>
    <head>
        <title><?php echo Sistema::apl()->nombre; ?></title>
        <meta charset="<?php echo Sistema::apl()->charset; ?>">
    </head>
    <body>        
        <div class="container-fluid">            
            <div class="col-md-2">
                <?php $this->complemento('!siscoms.bootstrap3.CBNavBarLateral', [
                    'brand' => Sistema::apl()->nombre, 
                    'tipo' => 'dark',
                    'form' => true,
                    'elementos' => [
                        ['texto' => CBoot::fa('cube') . ' inicio', 'url' => ['principal/inicio']],
                        ['texto' => CBoot::fa('cube') . ' Acerca', 'url' => ['principal/acerca']],
                        ['texto' => CBoot::fa('cube') . ' Contacto', 'url' => ['principal/contacto']],
                    ]
                ]); ?>
            </div>
            <div class="col-md-10">
                <div class="row">
                    <?php $this->complemento('!siscoms.bootstrap3.CBNav', [
                        'brand' => Sistema::apl()->nombre,
                        'fixed' => 'top',
                        'tipo' => 'inverse',
                        'elementos' => [
                        ],
                        'menuDerecha' => [
                            ['texto' => CBoot::fa('bell'), 'url' => '#'],
                            ['texto' => CBoot::fa('globe'), 'url' => '#'],
                            ['texto' => CBoot::fa('envelope'), 'url' => '#'],
                            ['texto' => 'Usuario', 'elementos' => [
                                [
                                    'texto' => (Sistema::apl()->usuario->esVisitante? 'Iniciar sesión' : 'Cerrar sesión'),
                                    'url' => ['principal/' . (Sistema::apl()->usuario->esVisitante? 'entrar' : 'salir')]
                                ], 
                            ]],
                        ],
                        'form' => [
                            'ubicacion' => 'right',
                            'campos' => [
                                CBoot::textAddOn('', ['pos' => CBoot::fa('search'), 'placeholder' => 'Ingrese una palabra clave...'])
                            ]
                        ]
                    ]); ?>
                </div>
                <div class="main-content">
                    <fieldset>
                        <legend><?php echo $this->tituloPagina; ?></legend>
                        <div class="row">
                            <div class="col-md-10">
                                <ol class="breadcrumb">
                                    <li><a href="#">Inicio</a></li>
                                    <li><a href="#">Interior 1</a></li>
                                </ol>
                            </div>
                            <div class="col-md-2 text-right">
                                <a href="#"><i class="fa fa-question-circle wa-help-icon"></i></a>
                                <a href="#"><i class="fa fa-cogs wa-help-icon"></i></a>
                            </div>
                        </div>
                        <?php echo $this->contenido; ?>
                    </fieldset>
                </div>
            </div>
        </div>
    </body>
</html>
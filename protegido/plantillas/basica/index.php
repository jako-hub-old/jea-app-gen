<?php echo "<?php\n"; ?>
$sistema = dirname(__FILE__) . '<?php echo $this->nuevaRutaSistema; ?>Sistema.php';
$configuraciones = dirname(__FILE__) . '/protegido/configuraciones/apl.php';

require_once $sistema;
Sistema::crearAplicacion($configuraciones)->iniciar();
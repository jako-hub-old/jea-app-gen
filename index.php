<?php
$configuraciones = dirname(__FILE__) . '/protegido/configuraciones/apl.php';
$sitema = dirname(__FILE__) . '/../sistema/Sistema.php';

require_once $sitema;

Sistema::crearAplicacion($configuraciones)->iniciar();


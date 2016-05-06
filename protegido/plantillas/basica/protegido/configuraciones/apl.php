
<?php echo "<?php\n "?>

return [
    'nombre' => '<?php echo $this->nombreApl; ?>',
    'charset' => 'utf-8',
    'modoProduccion' => false,
    <?php if($this->tema !== ""): ?>
    'tema' => <?php echo "'$this->tema'"?>,
    <?php endif; ?>
    'importar' => [
        '!aplicacion.modelos',
    ],
    'modulos' => [
        /* Comenta el generador de código al entrar en modo producción
        'codegen' => [
            'ruta' => '!web.modulos.codegen',
            'clase' => 'codeGen',
            'controladorPorDefecto' => 'generador',
            'usuario' => 'admin',
            'clave' => 'admin',
        ],
        */
    ],
    'componentes' => [
        'usuario' => [
            'ruta' => '!aplicacion.componentes',
            'clase' => 'ComUsuario',
            'usr' => 'admin',
            'clv' => 'admin',
        ]
    ],
    
    'extensiones' => [
        
    ],
];
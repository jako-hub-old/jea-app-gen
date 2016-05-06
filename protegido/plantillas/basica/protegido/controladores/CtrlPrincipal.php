<?php echo "<?php\n"; ?>

class CtrlPrincipal extends CControlador{
    
    public function accionInicio(){
        $this->mostrarVista('inicio');
    }

    public function accionAcerca(){
    	$this->mostrarVista("acerca");
    }

    public function accionContacto(){
    	$this->mostrarVista("contacto");
    }

    public function accionEntrar(){
        if(!Sistema::apl()->usuario->esVisitante){
            $this->redireccionar('inicio');
        }
        
        if(isset($this->_p['login-usr']) && isset($this->_p['login-pwd'])){
            $comUsuario = new ComUsuario($this->_p['login-usr'], $this->_p['login-pwd']);
            $comUsuario->cargarConfiguracion();
            if($comUsuario->autenticar()){
                Sistema::apl()->usuario->iniciarSesion($comUsuario->usuario, $comUsuario->usuario);
                $this->redireccionar('inicio');
            }
        }
        
    	$this->mostrarVista("entrar");
    }

    public function accionSalir(){
        if(!Sistema::apl()->usuario->esVisitante){
            Sistema::apl()->usuario->cerrarSesion();
            $this->redireccionar("entrar");
        }
    	$this->redireccionar("inicio");
    }    
    
}

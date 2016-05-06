<?php

class CtrlPrincipal extends CControlador{
    private $rutaBase = "";
    private $nombreApl = "";
    private $nuevaRutaSistema = "";
    private $accionActual;
    private $tema;
    
    public function iniciar() {
        if($this->accion->ID != "entrar" && Sistema::apl()->usuario->esVisitante){
            $this->redireccionar("entrar");
        }
        parent::iniciar();
    }    
    
    public function inicializar() {
        $this->rutaBase = Sistema::apl()->mRutas->getRaizServidor();
    }
    
    /**
     * Esta función nos muestra la vista de inicio del generador de aplicaciones
     */
    public function accionInicio(){
        # si se está tratando de crear una aplicación via ajax
        if(isset($this->_p['ajx-rqust']) && isset($this->_p['create-app'])){
            $this->crearApp();
        }
        # si se está consultando la imagen de un tema
        if(isset($this->_p['ajx-rqst']) && isset($this->_p['get-theme-img'])){
            $this->vistaPreviaTema($this->_p['img-name']);
        }

        $this->mostrarVista('inicio', [
            'nombreApp' => 'webapp1',
            'rutaBase' => $this->rutaBase,
            'temas' => $this->getTemas(),
        ]);
    }    
    
    /**
     * Esta función permite cargar la imagen de un tema
     * @param string $tema
     */
    public function accionImagenTema($tema){
        $rutaImagen = Sistema::resolverRuta("!aplicacion.temas.$tema") . DS . "pic.png";
        if(file_exists($rutaImagen)){
            $img = @imagecreatefrompng($rutaImagen);
            header("Content-type: image/png");
            imagepng($img);
            imagedestroy($img);
        }        
    }
    
    /**
     * Esta función permite obtener los temas disponibles 
     */
    private function getTemas(){
        $rutaTemas = Sistema::resolverRuta("!aplicacion.temas");        
        $carpetas = scandir($rutaTemas);   
        $temas = [];
        foreach($carpetas AS $carpeta){
            if($carpeta == '.' || $carpeta == '..'){ continue; }
            $temas[$carpeta] = ucfirst($carpeta);
        }
        return $temas;
    }
    
    /**
     * Esta función crea una aplicación web
     */
    private function crearApp(){
        header('Content-Type: application/json');
        
        $plantilla = 'basica';
        $this->tema = $this->_p['theme'];        
        $ruta = str_replace(' ', '_', $this->_p['path']);
        $this->nombreApl = $this->_p['name'];
        $dirApp = $this->_p['dir_name'];
        
        $servidor = Sistema::apl()->mRutas->getDominio();
        $url = $servidor . preg_replace("/\/{2,}/", '/', '/' . $ruta . '/' . $dirApp);        
        # validamos que el directorio base de la aplicación exista
        $rutaBaseAp = $this->prepararRuta($ruta);
        $appExistente = file_exists($rutaBaseAp . $dirApp);

        if(!file_exists($rutaBaseAp . $dirApp)){
            mkdir($rutaBaseAp . $dirApp);
        }
        
        $rutaFuente = Sistema::resolverRuta("!aplicacion.plantillas.$plantilla");
        $rutaDestino = realpath($this->rutaBase . DS . $ruta . DS . $dirApp);
        $this->nuevaRutaSistema = $this->getRutaSistema($rutaDestino);
        $error = false;
        $msg = "";
        if($appExistente){
            $error = true;
            $msg = "Ya existe una aplicación con ese nombre.";
        } else {
            $this->crearDirectorios($rutaFuente, $rutaDestino);
            $this->crearTema($rutaDestino);            
            $msg = "Se se generó correctamente la aplicación, " . 
                CHtml::e('a', "haz click aquí para ver tu aplicación", ['href'=>$url, 'target' => '_blank']);
        }
        
        
        echo json_encode([
            'error' => $error,
            'msg' => $msg,
        ]);
        
        Sistema::fin();
    }
    
    private function crearTema($rutaApl){
        if($this->tema == ""){
            return false;
        }
        $rutaDes = $rutaApl . DS . "publico" . DS . "temas" . DS . $this->tema;
        $rutaFuente = Sistema::resolverRuta("!aplicacion.temas") . DS . $this->tema;
        # si no existe  la carpeta del tema la creamos
        if(!file_exists($rutaDes)){
            mkdir($rutaDes);
        }
        
        $this->copiarArchivosTema($rutaFuente, $rutaDes);
    }
    
    private function copiarArchivosTema($rutaFuente, $rutaDestino){
        $directorios = scandir($rutaFuente);
        foreach($directorios AS $dir){
            if(($dir == '.' || $dir == '..')){
                continue;
            }
            
            # si es un directorio y no existe en el destino lo creamos
            if(is_dir($rutaFuente . DS . $dir) && !file_exists($rutaDestino . DS . $dir)){
                mkdir($rutaDestino . DS . $dir);
            }            
            
            if(is_dir($rutaFuente . DS . $dir)){
                $this->copiarArchivosTema($rutaFuente . DS . $dir, $rutaDestino . DS . $dir);                
            }
            
            if(is_file($rutaFuente . DS . $dir)){
                copy($rutaFuente . DS . $dir, $rutaDestino . DS . $dir);
            }
        }
    }
    
    private function prepararRuta($ruta){
        $partes = explode('/', $ruta);
        $rutaBase = $this->rutaBase;
        foreach($partes AS $dir){
            if(!file_exists($rutaBase . $dir)){
                mkdir($rutaBase . $dir);
            }
            $rutaBase .= $dir . '/';
        }
        return realpath($rutaBase) . DS;
    }
    
    private function getRutaSistema($ruta){
        $sis = Sistema::getUbicacion();
        $servidor = realpath(Sistema::apl()->mRutas->getRaizServidor());
        $pasos = '';
        $salir = false;
        $rutaSistema = str_replace($servidor . DS, '', $sis); 
        $totalCarpetas = count(explode('/', str_replace('\\', '/', $ruta)));
        
        for($i = 0; $i < $totalCarpetas; $i ++){         
            if($ruta . DS . "sistema" == $sis){
                $rutaSistema = "/" . $pasos . "sistema/";
                break;
            } else if($ruta  == $servidor){
                $rutaSistema = "/" . $pasos . str_replace('\\', '/', $rutaSistema) . "/";
                break;
            }else {
                $pasos .= '../';
            }            
            $ruta = realpath($ruta . '/../');
        }
        return $rutaSistema;        
    }
    
    private function crearDirectorios($rutaFuente, $rutaDes){
        
        $dirs = scandir($rutaFuente);
        foreach ($dirs AS $dir) {
            if($dir == '.' || $dir == '..') { continue; }
            
            if(is_dir($rutaFuente . DS . $dir) && !file_exists($rutaDes . DS . $dir)){
                mkdir($rutaDes . DS . $dir);
                $this->crearDirectorios($rutaFuente . DS . $dir, $rutaDes . DS . $dir);
            } else if (is_dir($rutaFuente . DS . $dir) && file_exists($rutaDes . DS . $dir)){
                $this->crearDirectorios($rutaFuente . DS . $dir, $rutaDes . DS . $dir);
            } else if (is_file($rutaFuente . DS . $dir)){
                $this->crearArchivo($rutaFuente . DS . $dir, $rutaDes . DS . $dir);
            } else { continue; }
        }
    }
    
    private function crearArchivo($rutaFuente, $rutaDes){
        ob_start();
        include $rutaFuente;
        $contenido = ob_get_clean();        
        $handler = fopen($rutaDes, 'w');
        fwrite($handler, $contenido);
        return fclose($handler);
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
        
        $this->mostrarVista('entrar');
    }
    
    public function accionSalir(){
        if(!Sistema::apl()->usuario->esVisitante){
            Sistema::apl()->usuario->cerrarSesion();
            $this->redireccionar("entrar");
        }
        $this->redireccionar('inicio');
    }
}

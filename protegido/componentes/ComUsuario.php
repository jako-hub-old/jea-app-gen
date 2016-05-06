<?php

class ComUsuario extends CComponenteUsuario{
    public $_usr;
    public $_clv;
                
    public function autenticar() {
        if($this->usuario === $this->_usr && $this->clave === $this->_clv){
            $this->error = false;
        } else {
            $this->error = true;
        }
        return !$this->error;
    }
}

<div class="col-sm-offset-3 col-sm-6">
    <div class="panel panel-default panel-login">
        <div class="panel-heading text-center">
            <h3>Iniciar sesión en AppGen</h3>
        </div>
        <div class="panel-body">        
            <?php 
            $form = new CBForm(['id' => 'login']);
            $form->abrir();
            
            echo CBoot::textAddOn('', ['pre' => CBoot::fa('user'),'group' => true, 'placeholder' => 'Ingrese su nombre de usuario', 'autofocus' => true, 'name' => 'login-usr']);
            echo CBoot::passwordAddOn('', ['pre' => CBoot::fa('lock'), 'group' => true, 'placeholder' => 'Ingrese su contraseña', 'autofocus' => true, 'name' => 'login-pwd']);
            echo CBoot::boton('Iniciar sesión', 'success', ['class' => 'btn-block']);
            $form->cerrar();
            ?>
        </div>
    </div>
</div>
<fieldset>
	<legend>Contacto</legend>
	<div class="col-sm-6">
		<?php echo "<?php \n"; ?>
		$form = new CBForm([
				"id" => "form-contact",
			]);
		$form->abrir();
		echo CBoot::text('', ['group' => true, 'label' => 'Nombres']);
		echo CBoot::text('', ['group' => true, 'label' => 'Email']);
		echo CBoot::textArea('', ['group' => true, 'label' => 'Descripción']);		
		 ?>
		<div class="form-group">
			<div class="col-sm-offset-6 col-sm-6">				
				<?php echo "<?php echo CBoot::boton('Enviar ' . CBoot::fa('send'), 'success btn-block'); ?>"; ?>
			</div>
		</div>
		 <?php echo "<?php \$form->cerrar(); ?>"; ?>
	</div>
</fieldset>
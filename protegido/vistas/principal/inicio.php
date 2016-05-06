<div class="col-sm-offset-1 col-sm-10">
    <div class="col-sm-7">
        <div class="panel panel-default">
            <div class="panel-body">                
                <?php                 
                echo CBoot::text($nombreApp, ['label'=>'Nombre de la aplicación', 'id'=>'app-name','name' => 'app-name', 'group' => true, 'autofocus' => true]);
                echo CBoot::textAddOn('', ['label'=>'Ubicación de la aplicación', 'pos'=> '/' .CHtml::e('span', $nombreApp, ['id' => 'app-name-hidden']), 'pre'=>  CHtml::e('span', $rutaBase, ['class' => 'text-danger']), 'id'=>'app-ruta','name' => 'app-name', 'group' => true, 'autofocus' => true]);
                echo CBoot::select('', $temas, ['label'=>'Elija el tema de la aplicación', 'id'=>'slc-theme', 'group' => true, 'defecto' => 'Sin tema']);                
                ?>
                <div class="form-group">
                    <?php echo CBoot::botonS('Crear aplicación ' . CBoot::fa("pencil-square"), ['id'=>'create-btn', 'class' => 'btn-block']); ?>
                </div>
                <div class="form-group">
                    <?php echo CHtml::link("Salir " . CBoot::fa("sign-out"), ['principal/salir'], ['class' => 'btn btn-default btn-block']); ?>
                </div>
            </div>
        </div>        
        <div class="alert alert-success" id="alert-msg" style="display: none;">
            
        </div>
    </div>
    <div id="preview-theme" class="col-sm-5">
        <fieldset>
            <legend>Vista previa de la aplicación</legend>
            <div class="thumbnail">
                <img width="100%" src="<?php echo Sistema::apl()->urlBase; ?>/publico/imagenes/sin-tema.png">
            </div>
        </fieldset>
    </div>
</div>

<script>
    jQuery(function(){
        jQuery("#create-btn").click(function(){
            createApp();
        });
        
        jQuery("#app-name").keyup(function(e){                       
            jQuery("#app-name-hidden").html(replaceAccents(jQuery(this).val()));
        });
        
        jQuery("#slc-theme").change(function(){
            loadThemeImg(jQuery(this).val());
        });
    });
    
    function loadThemeImg(img){
        var url = "<?php  echo Sistema::apl()->urlBase; ?>";
        var empty = "";
        if(img === ""){
            url += "publico/imagenes/sin-tema.png";
        } else {
            url += "?r=principal/imagenTema&t=" + img;
        }
        jQuery("#preview-theme img").attr("src", url);
    }
    
    function replaceAccents(appName){
        appName = appName.replace(/[ÁÀ]/g, "A");
        appName = appName.replace(/[áà]/g, "a");
        appName = appName.replace(/[ÉÈ]/g, "E");
        appName = appName.replace(/[éè]/g, "e");
        appName = appName.replace(/[ÍÌ]/g, "I");
        appName = appName.replace(/[íì]/g, "i");
        appName = appName.replace(/[ÓÒ]/g, "O");
        appName = appName.replace(/[óò]/g, "o");
        appName = appName.replace(/[ÚÙ]/g, "U");
        appName = appName.replace(/[úù]/g, "u");        
        appName = appName.replace(/ /g, '_');
        return appName;
    }
    
    function createApp(){
        jQuery.ajax({
            'type' : 'post',
            'url' : '<?php Sistema::apl()->crearUrl(['principal/inicio']); ?>',
            'data' : {
                'ajx-rqust' : true,
                'create-app' : true,
                'name' : jQuery("#app-name").val(),
                'path' : replaceAccents(jQuery("#app-ruta").val()),
                'theme' : jQuery("#slc-theme").val(),
                'dir_name' : jQuery("#app-name-hidden").text(),
            }, 
            success: function(obj){
                var alertMsg = jQuery("#alert-msg");
                if(obj.error){    
                    alertMsg.removeClass("alert-success");
                    alertMsg.addClass("alert-danger")
                    setTimeout(function(){
                        alertMsg.slideUp();
                    }, 5000);
                    jQuery("#app-name").focus().select();
                } else {
                    alertMsg.removeClass("alert-danger");
                    alertMsg.addClass("alert-success");
                }
                alertMsg.html(obj.msg).slideDown();
            }
        });
    }
</script>
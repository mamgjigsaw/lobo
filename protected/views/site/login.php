<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>LOBO</title>

<link href="loginResources/css/fuentes.css" rel="stylesheet" type="text/css" />
<link href="loginResources/css/index.css" rel="stylesheet" type="text/css" />

<style type="text/css">
  .manito{
    cursor: pointer;
  }
</style>

<script type="text/javascript">

	$(function(){

  	$("#btnSubmit").on("click", submit);
    $("#txtPass").on("keypress", keypress);

     function keypress(e){
      if(e.which == 13){
         $("#login-form").submit();  
      }
     }

    function submit(){
      $("#login-form").submit();
    }
	});

</script>
</head>

<body>
<div id="contenido">
<div id="cuadro_logo">
	<div id="cuadro_login"> 

		<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'login-form',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>

        <span>INGRESE SUS CREDENCIALES</span>
        
		<?php echo $form->textField($model,'username', array('id'=>'txtUsuario')); ?>
		<?php echo $form->error($model,'username'); ?>

        <?php echo $form->passwordField($model,'password', array('id'=>'txtPass')); ?>
		<?php echo $form->error($model,'password'); ?>
        
         <span>¿ OLVIDÓ SU CONTRASEÑA ?</span>
        
        <div id="btnAceptarCredenciales"> 
          <span id="btnSubmit" class="manito"> ACEPTAR<br/>CREDENCIALES</span>
          
          </div>
       </div>
	<?php $this->endWidget(); ?>
	
    <span id="spnBuild">Build 1.0</br>
    All rights reserved</br>
    CreativoCorp S.A
    </span>
</div>


<div id="cuadro_bienvenido"> 
	<span id="spnBienvenido">Bienvenido a</span>
    <span id="spnLobo">LOBO</span>
    <span id="spnVersion">ver Alpha</span>
    <span id="spnForCoirsa">Workforce Management<br/>
    for COIRSA
    </span>
    <span id="spnCreativo">by CreativoCorp</span>   
    
</div>
</div>
<footer>
La marca "Lobo Workforce Management"® y el logotipo del lobo son marcas registradas de Creativo Corp S.A..</br>
Todos los derechos reservados © 2014 | Diseño y Desarrollo creativocorp.com
</footer>

</body>
</html>

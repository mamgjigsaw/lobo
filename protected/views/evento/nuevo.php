<style>
	.letra{
		font-size:24px;
	}

	.esconder{
		display: none;
	}

	.mostrar{
		display: inline;
	}
</style>

<script type="text/javascript">
   var step = 1;
   var countRow = 1;
   var arregloMateriales = [];

   $(document).on("keypress",".codigo", function(e){

   	if(e.which == 13){
   		var elemento = e.target.id;
	   	var id = elemento.substring(9);

	    var valorCodigo = $("#txtCodigo"+id).val();
	   	if(valorCodigo != ""){
	   		$.ajax({
			    type: 'POST',
			    url: '<?php echo Yii::app()->request->baseUrl;?>/evento/getNameProductByCodigo?params='+ valorCodigo,
			    //data: $(),//{ 'searchPhrase' => searchBox.value },
			    success: function(data, textStatus, jqXHR) {
			    	if(data == ""){
			    		alert("No hay producto!!");

			    	}else{
			    		$("#txtNombreProd"+id).val(data.nombre);
			    	}	    	

			    },
			    //ASOCIACION DE MUNICIPIOS DE
			    dataType: 'json'
			});

	   	}

   	}
   	
   });

   $(document).on("ready", function(){
   	  if(step == 1){

   	  	$("#btnAtras").addClass("esconder");
   	  }

      $("#btnSiguiente").on("click", gotoSiguiente);
   	  $("#btnAtras").on("click", gotoAtras);
   	  $("#btnAddMateriales").on("click", addMaterial);

   });

   function gotoSiguiente(){
   	   save();
   	  /*if(step == 1){
   	  	if($("#txtName").val() == ""){
   	  		alert("Llene el nombre, por favor");
   	  	}else{   	  		
   	  		$("#btnAtras").removeClass("esconder").addClass("mostrar");
   	  		$("#linkfecha").click();
   	  	}
   	  }*/

   }

   function gotoAtras(){

   }

   function addMaterial(){
   	var cadena = "<tr id='row"+ countRow +"'><td>"+ countRow +"</td><td><input id='txtUnidades"+ countRow +"' type='text' /></td><td><input id='txtCodigo"+ countRow +"' class='codigo' type='text' /></td>";
   	cadena += "<td><input id='txtNombreProd"+ countRow +"' type='text' /></td><td><input id='txtBodega"+ countRow +"'type='text' /></td>";
   	cadena += "<td><button id='btnAddRow"+ countRow +"' type='button' onClick='addRow("+ countRow +");' class='btn btn-link'>Guardar</button><label>|<label/><button id='btnEliminarRow"+ countRow +"' type='button' onClick='deleteRow("+ countRow +");' class='btn btn-link btnEliminarRow'>Cancelar</button></td></tr>";

   	$("#tblBodyMateriales").append(cadena);
   	++countRow;
   }

   function addRow(params){
   	var arreglo = [];

   	if($("#txtCodigo"+params).val() == "" || $("#txtNombreProd"+params).val() == "" || $("#txtUnidades"+params).val() == "" || $("#txtBodega"+params).val() == ""){

   	}else{
   		arreglo.push($("#txtCodigo"+params).val());
	    arreglo.push($("#txtNombreProd"+params).val());
	   	arreglo.push($("#txtUnidades"+params).val());
	   	arreglo.push($("#txtBodega"+params).val());

	   	arregloMateriales.push(arreglo);

	   	console.log(arregloMateriales);

	    var cadena = "<td>"+ params +"</td><td>"+ $("#txtUnidades"+params).val() +"</td><td>"+ $("#txtCodigo"+params).val() +"</td>";
	   	cadena += "<td>"+ $("#txtNombreProd"+params).val() +"</td><td>"+ $("#txtBodega"+params).val() +"</td>";
	   	cadena += "<td><button id='btnEditRow"+ countRow +"' type='button' onClick='editRow("+ countRow +");' class='btn btn-link'>Editar</button></td>";

	   	$("#row"+params).html(cadena);

   	}
    
    
   }

   function deleteRow(params){
   	$("#row"+params).remove();
   	--countRow;
   	
   }

   function editRow(){

   }

   function save(){

   	$.ajax({
        type: 'POST',
        url: '<?php echo Yii::app()->request->baseUrl;?>/evento/save',
        data: { 'nombre': $("#txtName").val(),'nombre_cliente': $("#txtCliente").val(),'numero_telefono': $("#txtTelefono").val(),'direccion': $("#txtDireccion").val(),'fecha_facturacion': $("#txtFechaFacturacion").val(),'numero_factura': '2563','nombre_vendedor': $("#txtNombreVendedor").val(),'tipo_evento': $("#txtTipoEvento").val(),'observacion': 'ja ja','materiales': arregloMateriales},
        success: function(data, textStatus, jqXHR) {

           alert(data);

        },
        //ASOCIACION DE MUNICIPIOS DE
        dataType: 'json'
    });


   }
</script>

<div class="row">
	<input type="button" value="Cancelar y Regresar" class="pull-right btn btn-danger" />
</div>

<div class="row">
	<!-- Nav tabs -->
	<ul class="nav nav-pills nav-justified">
	  <li class="active"><a href="#crearEvento" data-toggle="tab">Creando Nuevo Evento</a></li>
	  <li><a id="linkfecha" href="#fechaEquipo" data-toggle="tab">Fecha y Equipo</a></li>
	  <li><a id="linkMateriales" href="#materiales" data-toggle="tab">Materiales</a></li>
	  <li><a href="#validar" data-toggle="tab">Validar/Asignar Evento</a></li>
	  <li><a class="glyphicon glyphicon-floppy-disk " href="#guardar" data-toggle="tab"></a></li>
	</ul>


	<!-- Tab panes -->
	<div class="tab-content">
	  <div class="tab-pane in active" id="crearEvento">
		</br>
		<form class="form-horizontal" role="form">
		  <div class="form-group has-feedback">
			<label class="control-label col-sm-2" for="txtName">Buscar Nombre de Evento que mejor 
	describe la actividad a realizar</label>
			<div class="col-sm-3">
			  <input type="text" class="form-control" id="txtName">
			  <span class="glyphicon glyphicon-search form-control-feedback"></span>
			</div>
		  </div>
		</form>
	  </div><!--Terminar el tab de crearEvento-->
	  <div class="tab-pane" id="fechaEquipo">
	  	</br>

	  	<div class="row">
		  <div class="col-md-4">
		  	Ref: # FA 000123
		  	
		  		<div class="form-group">
		  			<label for="txtCategoria" >Categoria</label>
		  			
		  			<select id="txtTipoEvento" class="form-control">
					  <option value="1">instalacion</option>
					  <option value="2">mantenimiento</option>
					  <option value="3">reparacion</option>					  
					</select>

		  		</div>
		  		<div class="form-group">
		  			<label for="txtCliente" >Cliente</label>
		  			<input id="txtCliente" type="text" class="form-control" />
		  		</div>
		  		<div class="form-group">
		  			<label for="txtTelefono" >Telefono</label>
		  			<input id="txtTelefono" type="text" class="form-control" />
		  		</div>
		  		<div class="form-group">
		  			<label for="txtDireccion" >Direccion</label>
		  			<textarea id="txtDireccion" class="form-control" rows="3"></textarea>
		  		</div>
		  		<div class="form-group">
		  			<label for="txtFechaFacturacion" >Fecha Facturacion</label>
		  			<input id="txtFechaFacturacion" type="text" class="form-control" />
		  		</div>
		  		<div class="form-group">
		  			<label for="txtNombreVendedor" >Nombre del vendedor</label>
		  			<input id="txtNombreVendedor" type="text" class="form-control" />
		  		</div>
		  	

		  </div>
		  <div class="col-md-4">fecha</div>
		  <div class="col-md-4">agenda</div>
		</div>
	  </div><!--Terminar el tab de fechaEquipo-->
	  <div class="tab-pane" id="materiales">
	  </br>
	  	<div class="row">	  		
	  		<table class="table table-striped">
	  			<thead>
	  				<tr>
		  				<th>No.</th>
		  				<th>Unidades</th>
		  				<th>Codigo</th>
		  				<th>Nombre</th>
		  				<th>Bodega</th>
		  				<th>Editar</th>
		  			</tr>
	  			</thead>
	  			<tbody id="tblBodyMateriales">
	  				
	  			</tbody>	  			
	  		</table>
	  	</div>
	  	<div class="row">
	  		<input id="btnAddMateriales" type="button" value="Agregar Material +" class="btn btn-primary" />
	  	</div>
	  </div><!--Terminar el tab de materiales-->
	  <div class="tab-pane" id="validar">validar</div><!--Terminar el tab de validar-->
	  <div class="tab-pane" id="guardar">guardar</div><!--Terminar el tab de guardar-->
	</div>

</div>
</br>
<div class="row">
	<input id="btnAtras" type="button" value="Atras" class="left btn btn-success" />
	<input id="btnSiguiente" type="button" value="Siguiente" class="right btn btn-success" />
</div>

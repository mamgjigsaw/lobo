<style type="text/css">
	.modalClass{
		width: 100px;
	}
</style>
<script type="text/javascript">
var countRow = 1;
var firstTimeSupervisor = 0;

$(document).on("ready", function(){
	$("#btnAddSupervisor").on("click", addSupervisor);

	//events tabss
	$("#divSupervisores").on("click", clickSupervisor);

	//modalSuccess
	$("#btnOk").on("click", clickOkModal);
});

function addSupervisor(){
	var cadena = "<tr id='row"+ countRow +"'><td><input id='txtNombre"+ countRow +"' type='text' /></td><td><input id='txtCodigo"+ countRow +"' class='codigo' type='text' /></td>";   	
   	cadena += "<td><button id='btnAddRow"+ countRow +"' type='button' onClick='addRow(0,"+ countRow +",1);' class='btn btn-link'>Guardar</button><label>|<label/><button id='btnEliminarRow"+ countRow +"' type='button' onClick='deleteRow("+ countRow +", 1, 0);' class='btn btn-link btnEliminarRow'>Cancelar</button></td></tr>";

   	$("#tblBodySupervisores").append(cadena);
   	++countRow;  
}

function deleteRow(posicion, origen, id){

	if(origen == 1){
		$("#row"+posicion).remove();
	}else{		
		var cadena = "<td><label style='font-weight:normal;' id='txtNombre"+ posicion +"' >"+ $("#txtNombre"+posicion).val() +"</label></td><td><label style='font-weight:normal;' id='txtCodigo"+ posicion +"'>"+ $("#txtCodigo"+posicion).val() +"</label></td>";   	
	   	cadena += "<td><button id='btnEditRow"+ posicion +"' type='button' onClick='editRow("+ id +","+ posicion +");' class='btn btn-link'>Edit</button><label>|<label/><button id='btnQRRow"+ posicion +"' type='button' onClick='qrRow("+ id +","+ posicion +");' class='btn btn-link btnEliminarRow'>QR</button></td>";

	   	$("#row"+posicion).html(cadena);		   	
	}
}

function addRow(id,params,option){
	var nombre = $("#txtNombre"+params).val();
	var codigo = $("#txtCodigo"+params).val();
	if(nombre == ""  || codigo == ""){

	}else{

		if(option == 1){	
			
		   	$.ajax({
		        type: 'POST',
		        url: '<?php echo Yii::app()->request->baseUrl;?>/agentes/saveAgente',
		        data: { 'id':id,'nombre': nombre,'codigo': codigo,'option': '1','tipo':'2'},
		        success: function(data, textStatus, jqXHR) {
		        	var cadena = "<td><label style='font-weight:normal;' id='txtNombre"+ params +"' >"+ nombre +"</label></td><td><label style='font-weight:normal;' id='txtCodigo"+ params +"'>"+ codigo +"</label></td>";   	
				   	cadena += "<td><button id='btnEditRow"+ params +"' type='button' onClick='editRow("+ data +","+ params +");' class='btn btn-link'>Edit</button><label>|<label/><button id='btnQRRow"+ params +"' type='button' onClick='qrRow("+ data +","+ params +");' class='btn btn-link btnEliminarRow'>QR</button></td>";

				   	$("#row"+params).html(cadena);	

		        },
		        //ASOCIACION DE MUNICIPIOS DE
		        dataType: 'json'
		    });

		}else{
		   	$.ajax({
		        type: 'POST',
		        url: '<?php echo Yii::app()->request->baseUrl;?>/agentes/saveAgente',
		        data: { 'id':id,'nombre': nombre,'codigo': codigo,'option': '2','tipo':'2'},
		        success: function(data, textStatus, jqXHR) {
		        	var cadena = "<td><label style='font-weight:normal;' id='txtNombre"+ params +"' >"+ $("#txtNombre"+params).val() +"</label></td><td><label style='font-weight:normal;' id='txtCodigo"+ params +"'>"+ $("#txtCodigo"+params).val() +"</label></td>";   	
				   	cadena += "<td><button id='btnEditRow"+ params +"' type='button' onClick='editRow("+ id +","+ params +");' class='btn btn-link'>Edit</button><label>|<label/><button id='btnQRRow"+ params +"' type='button' onClick='qrRow("+ id +","+ params +");' class='btn btn-link btnEliminarRow'>QR</button></td>";

				   	$("#row"+params).html(cadena);	

		        },
		        //ASOCIACION DE MUNICIPIOS DE
		        dataType: 'json'
		    });
		}


	}
	
}

function editRow(id,params){
	var cadena = "<td><input id='txtNombre"+ params +"' type='text' value='"+ $("#txtNombre"+params).html() +"' /></td><td><input id='txtCodigo"+ params +"' class='codigo' type='text' value='"+ $("#txtCodigo"+params).html() +"' /></td>";   	
   	cadena += "<td><button id='btnAddRow"+ params +"' type='button' onClick='addRow("+ id +","+ params +",2);' class='btn btn-link'>Guardar</button><label>|<label/><button id='btnEliminarRow"+ params +"' type='button' onClick='deleteRow("+ params +", 2,"+ id +");' class='btn btn-link btnEliminarRow'>Cancelar</button></td>";

   	$("#row"+params).html(cadena);	
} 

function qrRow(id,params){

	$.ajax({
        type: 'POST',
        url: '<?php echo Yii::app()->request->baseUrl;?>/agentes/getDireccionImagen',
        data: { 'id':id},
        success: function(data, textStatus, jqXHR) {
        	  
        	  var cadena = "<img src='"+ data +"' alt='Smiley face' height='232' width='232'>";
			  $("#message").html(cadena);
			  //$("#modalSuccess").removeClass("modalClass").addClass("modalClass");
			  $("#modalSuccess").modal("show")       	

        },
        //ASOCIACION DE MUNICIPIOS DE
        dataType: 'json'
    }); 
}

function clickOkModal(){
	$("#modalSuccess").modal("hide");
}

//click tabs
function clickSupervisor(){

	if(firstTimeSupervisor == 0){
		$.ajax({
	        type: 'POST',
	        url: '<?php echo Yii::app()->request->baseUrl;?>/agentes/getSupervisores',      
	        success: function(data, textStatus, jqXHR) {
	        	_.each(data, function(item) {
	        		
	        		var cadena = "<tr id='row"+ countRow +"'><td><label style='font-weight:normal;' id='txtNombre"+ countRow +"' >"+ item[1] +"</label></td><td><label style='font-weight:normal;' id='txtCodigo"+ countRow +"'>"+ item[2] +"</label></td>";   	
					cadena += "<td><button id='btnEditRow"+ countRow +"' type='button' onClick='editRow("+ item[0] +","+ countRow +");' class='btn btn-link'>Edit</button><label>|<label/><button id='btnQRRow"+ countRow +"' type='button' onClick='qrRow("+ item[0] +","+ countRow +");' class='btn btn-link btnEliminarRow'>QR</button></td></tr>";
	        		$("#tblBodySupervisores").append(cadena);      
	        		++countRow;           
	            });        	

	            firstTimeSupervisor = 1;

	        },
	        //ASOCIACION DE MUNICIPIOS DE
	        dataType: 'json'
	    });    
	}
	
}
</script>

<ul class="nav nav-pills nav-justified">
	  <li class="active"><a href="#instaladores" data-toggle="tab">Instaladores</a></li>
	  <li><a href="#supervisores" id="divSupervisores" data-toggle="tab">Supervisores</a></li>
	  <li><a href="#conductores" data-toggle="tab">Conductores</a></li>
	  <li><a href="#bodega" data-toggle="tab">Bodega</a></li>
	  
	</ul>


	<!-- Tab panes -->
	<div class="tab-content">
	  <div class="tab-pane in active" id="instaladores">
		crear
	
	  </div><!--Terminar el tab de instaladores-->
	  <div class="tab-pane" id="supervisores">
	  	<div class="row">	  	
	  		<table class="table table-striped">
		  		<thead>
		  			<tr>
		  				<th>Nombre</th>
		  				<th>Codigo Acceso</th>
		  				<th>Opciones</th>
		  			</tr>
		  		</thead>
		  		<tbody id="tblBodySupervisores">	  			
		  		</tbody>
		  	</table>
	  	</div>
	  	<div class="row">
	  		<input id="btnAddSupervisor" type="button" value="Agregar Supervisor +" class="btn btn-primary" />
	  	</div>

	  </div><!--Terminar el tab de supervisores-->
	  <div class="tab-pane" id="conductores">

	  </div><!--Terminar el tab de conductores-->
	  <div class="tab-pane" id="bodega">

	  </div><!--Terminar el tab de bodega-->
	</div>

	<div id="modalSuccess" class="modal fade">
	  <div class="modal-dialog">s
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	        <h4 id="modalTitle" class="modal-title">Codigo QR</h4>
	      </div>
	      <div class="modal-body">
	        <p id="message"></p>
	      </div>
	      <div class="modal-footer">
	        <button id="btnOk" type="button" class="btn btn-default" >Ok</button>
	      </div>
	    </div><!-- /.modal-content -->
	  </div><!-- /.modal-dialog -->
	</div><!-- /.modal -->


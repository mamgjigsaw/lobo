<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/calendar/calendar.css">

<style type="text/css">
	.btn-twitter {
		padding-left: 30px;
		background: rgba(0, 0, 0, 0) url(https://platform.twitter.com/widgets/images/btn.27237bab4db188ca749164efd38861b0.png) -20px 6px no-repeat;
		background-position: -20px 11px !important;
	}
	.btn-twitter:hover {
		background-position:  -20px -18px !important;
	}
</style>
<div class="row">
	<h5>Ordenes vs Eventos</h5>
	<div class="pull-right row">
		<input type="button" class="btn btn-success" value="Agregar un Nuevo Evento" />
	</div>
	
	<div class="row">
		<table class="table">
			<thead>
				<tr>
					<th>Fecha</th>
					<th>Nombre</hd>
					<th>Factura<htd>
					<th>Tipo</tdh
				</tr>
			</thead>
			<tbody>
				<?php foreach ($model as $data): ?>          
				<tr>
					<td><?php echo $data->fecha_facturacion;?></td>
					<td><?php echo $data->nombre_cliente;?></td>
					<td><?php echo $data->numero_factura;?></td>
					<td><?php 
					    if($data->tipo_evento == 1){
					    	echo "Instalacion";
					    }else if($data->tipo_evento == 2){
					    	echo "Mantenimiento";
					    }else{
					    	echo "Reparacion";
					    }

					?></td>
				</tr>
				<?php endforeach; ?> 
			</tbody>
		</table>		
	</div>
</div> 
<div class="row">
	<h5>Indicadores</h5>
</div>
<div class="row">
	<h5>Calendario/Eventos</h5>
	<div class="row">

		<div class="pull-right form-inline">
			<div class="btn-group">
				<button class="btn btn-primary" data-calendar-nav="prev"><< Anterior</button>
				<button class="btn" data-calendar-nav="today">Hoy</button>
				<button class="btn btn-primary" data-calendar-nav="next">Proximo >></button>
			</div>
			<div class="btn-group">
				<button class="btn btn-warning" data-calendar-view="year">Año</button>
				<button class="btn btn-warning active" data-calendar-view="month">Mes</button>
				<button class="btn btn-warning" data-calendar-view="week">Semana</button>
				<button class="btn btn-warning" data-calendar-view="day">Dia</button>
			</div>
		</div>

	</div>

	<div class="row">
		<div class="span9">
			<div id="calendar"></div>
		</div>
		
	</div>

	<div class="clearfix"></div>

	</br>
	<div class="modal hide fade" id="events-modal">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			<h3>Event</h3>
		</div>
		<div class="modal-body" style="height: 400px">
		</div>
		<div class="modal-footer">
			<a href="#" data-dismiss="modal" class="btn">Close</a>
		</div>
	</div>

	<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/calendar/jstimezonedetect/jstz.min.js"></script>
	<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/calendar/language/nl-NL.js"></script>
	<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/calendar/language/fr-FR.js"></script>
	<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/calendar/language/de-DE.js"></script>
	<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/calendar/language/el-GR.js"></script>
	<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/calendar/language/it-IT.js"></script>
	<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/calendar/language/pl-PL.js"></script>
	<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/calendar/language/pt-BR.js"></script>
	<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/calendar/language/es-MX.js"></script>
	<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/calendar/language/es-ES.js"></script>
	<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/calendar/language/ru-RU.js"></script>
	<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/calendar/language/sv-SE.js"></script>
  <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/calendar/language/zh-CN.js"></script>
  <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/calendar/language/cs-CZ.js"></script>
	<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/calendar/calendar.js"></script>
	<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/calendar/app.js"></script>

	<script type="text/javascript">
		var disqus_shortname = 'bootstrapcalendar'; // required: replace example with your forum shortname
		(function() {
			var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
			dsq.src = '//' + disqus_shortname + '.disqus.com/embed.js';
			(document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
		})();
	</script>
</div>
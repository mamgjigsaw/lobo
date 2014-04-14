<?php

/**
 * This is the model class for table "evento".
 *
 * The followings are the available columns in table 'evento':
 * @property integer $idevento
 * @property string $nombre
 * @property string $nombre_cliente
 * @property string $numero_telefono
 * @property string $direccion
 * @property string $fecha_facturacion
 * @property string $numero_factura
 * @property string $nombre_vendedor
 * @property integer $tipo_evento
 * @property string $observacion
 * @property string $imagen_firma
 *
 * The followings are the available model relations:
 * @property DetalleEquipo[] $detalleEquipos
 * @property DetalleProducto[] $detalleProductos
 * @property DetalleQuipofisico[] $detalleQuipofisicos
 */
class Evento extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'evento';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idevento', 'required'),
			array('idevento, tipo_evento', 'numerical', 'integerOnly'=>true),
			array('nombre', 'length', 'max'=>150),
			array('nombre_cliente, nombre_vendedor', 'length', 'max'=>100),
			array('numero_telefono', 'length', 'max'=>10),
			array('direccion, imagen_firma', 'length', 'max'=>200),
			array('numero_factura, observacion', 'length', 'max'=>45),
			array('fecha_facturacion', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('idevento, nombre, nombre_cliente, numero_telefono, direccion, fecha_facturacion, numero_factura, nombre_vendedor, tipo_evento, observacion, imagen_firma', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'detalleEquipos' => array(self::HAS_MANY, 'DetalleEquipo', 'idevento'),
			'detalleProductos' => array(self::HAS_MANY, 'DetalleProducto', 'idevento'),
			'detalleQuipofisicos' => array(self::HAS_MANY, 'DetalleQuipofisico', 'idevento'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idevento' => 'Idevento',
			'nombre' => 'Nombre',
			'nombre_cliente' => 'Nombre Cliente',
			'numero_telefono' => 'Numero Telefono',
			'direccion' => 'Direccion',
			'fecha_facturacion' => 'Fecha Facturacion',
			'numero_factura' => 'Numero Factura',
			'nombre_vendedor' => 'Nombre Vendedor',
			'tipo_evento' => 'Tipo Evento',
			'observacion' => 'Observacion',
			'imagen_firma' => 'Imagen Firma',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('idevento',$this->idevento);
		$criteria->compare('nombre',$this->nombre,true);
		$criteria->compare('nombre_cliente',$this->nombre_cliente,true);
		$criteria->compare('numero_telefono',$this->numero_telefono,true);
		$criteria->compare('direccion',$this->direccion,true);
		$criteria->compare('fecha_facturacion',$this->fecha_facturacion,true);
		$criteria->compare('numero_factura',$this->numero_factura,true);
		$criteria->compare('nombre_vendedor',$this->nombre_vendedor,true);
		$criteria->compare('tipo_evento',$this->tipo_evento);
		$criteria->compare('observacion',$this->observacion,true);
		$criteria->compare('imagen_firma',$this->imagen_firma,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Evento the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}

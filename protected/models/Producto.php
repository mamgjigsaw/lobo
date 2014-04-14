<?php

/**
 * This is the model class for table "producto".
 *
 * The followings are the available columns in table 'producto':
 * @property integer $idproducto
 * @property string $codigo_detalle_producto
 * @property string $codigo_sistema_producto
 * @property integer $tipo
 * @property string $nombre_producto
 *
 * The followings are the available model relations:
 * @property DetalleEquipoProducto[] $detalleEquipoProductos
 * @property DetalleProducto[] $detalleProductos
 */
class Producto extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'producto';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('tipo', 'numerical', 'integerOnly'=>true),
			array('codigo_detalle_producto, codigo_sistema_producto', 'length', 'max'=>45),
			array('nombre_producto', 'length', 'max'=>200),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('idproducto, codigo_detalle_producto, codigo_sistema_producto, tipo, nombre_producto', 'safe', 'on'=>'search'),
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
			'detalleEquipoProductos' => array(self::HAS_MANY, 'DetalleEquipoProducto', 'iddetalle_producto'),
			'detalleProductos' => array(self::HAS_MANY, 'DetalleProducto', 'idproducto'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idproducto' => 'Idproducto',
			'codigo_detalle_producto' => 'Codigo Detalle Producto',
			'codigo_sistema_producto' => 'Codigo Sistema Producto',
			'tipo' => 'Tipo',
			'nombre_producto' => 'Nombre Producto',
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

		$criteria->compare('idproducto',$this->idproducto);
		$criteria->compare('codigo_detalle_producto',$this->codigo_detalle_producto,true);
		$criteria->compare('codigo_sistema_producto',$this->codigo_sistema_producto,true);
		$criteria->compare('tipo',$this->tipo);
		$criteria->compare('nombre_producto',$this->nombre_producto,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Producto the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}

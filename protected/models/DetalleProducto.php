<?php

/**
 * This is the model class for table "detalle_producto".
 *
 * The followings are the available columns in table 'detalle_producto':
 * @property integer $iddetalle_producto
 * @property integer $idevento
 * @property integer $idproducto
 * @property integer $unidades_recibidas
 * @property integer $unidades_utilizadas
 * @property string $bodega
 *
 * The followings are the available model relations:
 * @property Producto $idproducto0
 * @property Evento $idevento0
 */
class DetalleProducto extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'detalle_producto';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idevento, idproducto, unidades_recibidas, unidades_utilizadas', 'numerical', 'integerOnly'=>true),
			array('bodega', 'length', 'max'=>10),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('iddetalle_producto, idevento, idproducto, unidades_recibidas, unidades_utilizadas, bodega', 'safe', 'on'=>'search'),
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
			'idproducto0' => array(self::BELONGS_TO, 'Producto', 'idproducto'),
			'idevento0' => array(self::BELONGS_TO, 'Evento', 'idevento'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'iddetalle_producto' => 'Iddetalle Producto',
			'idevento' => 'Idevento',
			'idproducto' => 'Idproducto',
			'unidades_recibidas' => 'Unidades Recibidas',
			'unidades_utilizadas' => 'Unidades Utilizadas',
			'bodega' => 'Bodega',
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

		$criteria->compare('iddetalle_producto',$this->iddetalle_producto);
		$criteria->compare('idevento',$this->idevento);
		$criteria->compare('idproducto',$this->idproducto);
		$criteria->compare('unidades_recibidas',$this->unidades_recibidas);
		$criteria->compare('unidades_utilizadas',$this->unidades_utilizadas);
		$criteria->compare('bodega',$this->bodega,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return DetalleProducto the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}

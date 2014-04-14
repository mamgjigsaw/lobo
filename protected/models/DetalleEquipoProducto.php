<?php

/**
 * This is the model class for table "detalle_equipo_producto".
 *
 * The followings are the available columns in table 'detalle_equipo_producto':
 * @property integer $iddetalle_equipo_producto
 * @property integer $iddetalle_equipo
 * @property integer $iddetalle_producto
 *
 * The followings are the available model relations:
 * @property DetalleEquipo $iddetalleEquipo
 * @property Producto $iddetalleProducto
 */
class DetalleEquipoProducto extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'detalle_equipo_producto';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('iddetalle_equipo, iddetalle_producto', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('iddetalle_equipo_producto, iddetalle_equipo, iddetalle_producto', 'safe', 'on'=>'search'),
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
			'iddetalleEquipo' => array(self::BELONGS_TO, 'DetalleEquipo', 'iddetalle_equipo'),
			'iddetalleProducto' => array(self::BELONGS_TO, 'Producto', 'iddetalle_producto'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'iddetalle_equipo_producto' => 'Iddetalle Equipo Producto',
			'iddetalle_equipo' => 'Iddetalle Equipo',
			'iddetalle_producto' => 'Iddetalle Producto',
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

		$criteria->compare('iddetalle_equipo_producto',$this->iddetalle_equipo_producto);
		$criteria->compare('iddetalle_equipo',$this->iddetalle_equipo);
		$criteria->compare('iddetalle_producto',$this->iddetalle_producto);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return DetalleEquipoProducto the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}

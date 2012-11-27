<?php

/**
 * This is the model class for table "reservations".
 *
 * The followings are the available columns in table 'reservations':
 * @property integer $id
 * @property integer $userId
 * @property string $startTime
 * @property string $endTime
 * @property integer $skyTimeId
 *
 * The followings are the available model relations:
 * @property SkyTimes $skyTime
 * @property Users $user
 */
class Reservations extends MauiModel
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Reservations the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'reservations';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('userId, startTime, endTime, skyTimeId', 'required'),
			array('userId, skyTimeId', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, userId, startTime, endTime, skyTimeId', 'safe', 'on'=>'search'),
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
			'skyTime' => array(self::BELONGS_TO, 'SkyTimes', 'skyTimeId'),
			'user' => array(self::BELONGS_TO, 'Users', 'userId'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'userId' => 'User',
			'startTime' => 'Start Time',
			'endTime' => 'End Time',
			'skyTimeId' => 'Sky Time',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('userId',$this->userId);
		$criteria->compare('startTime',$this->startTime,true);
		$criteria->compare('endTime',$this->endTime,true);
		$criteria->compare('skyTimeId',$this->skyTimeId);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public static function getByTime($start, $end)
	{
	  $criteria = Reservations::model()->getDbCriteria();
	  $criteria->addCondition("startTime >= :startTime");
    $params[':startTime'] = $start;
    $criteria->addCondition("endTime <= :endTime");
    $params[':endTime'] = $end;
    $criteria->params = $params;
    $criteria->order = 'startTime';

    $reservations = Reservations::model()->findAll($criteria);
    
    return $reservations;
	}
	
	public static function existsForTime($start, $end)
	{
	  $models = self::getByTime($start, $end);
	  if (!empty($models)) {
	    return true;
	  }
	  return false;
	}

}




<?php

namespace thienhungho\WarehouseManagement\modules\WarehouseBase\base;

use thienhungho\EmployeeManagement\modules\EmployeeBase\Employee;
use \thienhungho\SupplierManagement\models\Supplier;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;

/**
 * This is the base model class for table "{{%warehouse_voucher}}".
 *
 * @property integer $id
 * @property string $name
 * @property integer $warehouse_id
 * @property integer $employee_id
 * @property integer $supplier_id
 * @property string $note
 * @property string $date
 * @property integer $is_locked
 * @property string $status
 * @property string $type
 * @property string $created_at
 * @property string $updated_at
 * @property integer $created_by
 * @property integer $updated_by
 *
 * @property \thienhungho\WarehouseManagement\modules\WarehouseBase\Employee $employee
 * @property \thienhungho\WarehouseManagement\modules\WarehouseBase\Supplier $supplier
 * @property \thienhungho\WarehouseManagement\modules\WarehouseBase\Warehouse $warehouse
 */
class WarehouseVoucher extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;


    /**
    * This function helps \mootensai\relation\RelationTrait runs faster
    * @return array relation names of this model
    */
    public function relationNames()
    {
        return [
            'employee',
            'supplier',
            'warehouse',
            'warehouseVoucherItems',
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'warehouse_id', 'employee_id', 'supplier_id', 'supplier_total_price', 'is_locked'], 'required'],
            [['warehouse_id', 'employee_id', 'supplier_id', 'created_by', 'updated_by'], 'integer'],
            [['supplier_total_price', 'total_price'], 'number'],
            [['note'], 'string'],
            [['is_locked', 'date', 'created_at', 'updated_at'], 'safe'],
            [['name', 'status', 'type'], 'string', 'max' => 255],
            [['name'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%warehouse_voucher}}';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'warehouse_id' => Yii::t('app', 'Warehouse ID'),
            'employee_id' => Yii::t('app', 'Employee ID'),
            'supplier_id' => Yii::t('app', 'Supplier ID'),
            'supplier_total_price' => Yii::t('app', 'Supplier Total Price'),
            'total_price' => Yii::t('app', 'Total Price'),
            'note' => Yii::t('app', 'Note'),
            'date' => Yii::t('app', 'Date'),
            'is_locked' => Yii::t('app', 'Is Locked'),
            'status' => Yii::t('app', 'Status'),
            'type' => Yii::t('app', 'Type'),
            'attachments' => Yii::t('app', 'Attachments'),
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEmployee()
    {
        return $this->hasOne(Employee::className(), ['id' => 'employee_id']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSupplier()
    {
        return $this->hasOne(Supplier::className(), ['id' => 'supplier_id']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWarehouse()
    {
        return $this->hasOne(\thienhungho\WarehouseManagement\modules\WarehouseBase\Warehouse::className(), ['id' => 'warehouse_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWarehouseVoucherItems()
    {
        return $this->hasMany(\thienhungho\WarehouseManagement\modules\WarehouseBase\WarehouseVoucherItems::className(), ['warehouse_voucher' => 'id']);
    }
    
    /**
     * @inheritdoc
     * @return array mixed
     */
    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
                'value' => new \yii\db\Expression('NOW()'),
            ],
            'blameable' => [
                'class' => BlameableBehavior::className(),
                'createdByAttribute' => 'created_by',
                'updatedByAttribute' => 'updated_by',
            ],
        ];
    }


    /**
     * @inheritdoc
     * @return \thienhungho\WarehouseManagement\modules\WarehouseBase\query\WarehouseVoucherQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \thienhungho\WarehouseManagement\modules\WarehouseBase\query\WarehouseVoucherQuery(get_called_class());
    }
}

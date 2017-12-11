<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "role".
 *
 * @property string $id
 * @property string $description
 *
 * @property User[] $users
 */
class Role extends \yii\db\ActiveRecord
{
    const ROLE_ADMIN = "ROLE_ADMIN";
    const ROLE_CUSTOMER = "ROLE_CUSTOMER";

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'role';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'description'], 'required'],
            [['description'], 'string'],
            [['id'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'description' => 'Description',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::className(), ['role' => 'id']);
    }
}

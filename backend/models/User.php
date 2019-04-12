<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $username
 * @property string $auth_key
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property string $cmnd
 * @property string $attributes
 * @property int $role_id
 * @property int $isActive
 * @property int $created_at
 * @property int $updated_at
 * @property int $isDeleted
 * @property int $deletedUserId
 * @property int $deletedTime
 */
class User extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'auth_key', 'password_hash', 'email', 'cmnd', 'role_id', 'created_at', 'updated_at'], 'required'],
            [['attributes'], 'string'],
            [['role_id', 'isActive', 'created_at', 'updated_at', 'isDeleted', 'deletedUserId', 'deletedTime'], 'integer'],
            [['username', 'password_hash', 'password_reset_token'], 'string', 'max' => 255],
            [['auth_key'], 'string', 'max' => 32],
            [['email'], 'string', 'max' => 50],
            [['cmnd'], 'string', 'max' => 12],
            [['username'], 'unique'],
            [['email'], 'unique'],
            [['cmnd'], 'unique'],
            [['password_reset_token'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'auth_key' => 'Auth Key',
            'password_hash' => 'Password Hash',
            'password_reset_token' => 'Password Reset Token',
            'email' => 'Email',
            'cmnd' => 'Cmnd',
            'attributes' => 'Attributes',
            'role_id' => 'Role ID',
            'isActive' => 'Is Active',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'isDeleted' => 'Is Deleted',
            'deletedUserId' => 'Deleted User ID',
            'deletedTime' => 'Deleted Time',
        ];
    }
}

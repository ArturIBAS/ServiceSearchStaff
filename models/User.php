<?php

namespace app\models;

use Yii;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "visitor".
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property int $isAdmin
 */
class User extends \yii\db\ActiveRecord implements IdentityInterface
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'visitor';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['isAdmin'], 'default', 'value' => null],
            [['isAdmin'], 'integer'],
            [['name', 'email', 'password'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'email' => 'Email',
            'password' => 'Password',
            'isAdmin' => 'Is Admin',
        ];
    }


    public static function findIdentity($id)
    {
        return User::findOne($id);
    }


    public static function findIdentityByAccessToken($token, $type = null)
    {
        // TODO
    }

    public function getId()
    {
        return $this->id;
        // TODO: Implement getId() method.
    }


    public function getAuthKey()
    {
        // TODO: Implement getAuthKey() method.
    }

    public function validateAuthKey($authKey)
    {
        // TODO: Implement validateAuthKey() method.
    }

    public function findByUsername($username)
    {
        return User::find()->where(['name'=>$username])->one();
    }

    public function validatePassword($password)
    {
        return ($this->password==$password) ? true : false;
    }

    public function create()
    {
        return $this->save(false);
    }
}

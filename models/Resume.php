<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "resume".
 *
 * @property int $id
 * @property string $name
 * @property string $surname
 * @property string $patronymic
 * @property string $text
 * @property string $email
 * @property string $phone
 * @property string $file
 * @property int $visitor_id
 * @property int $category_id
 * @property mixed category
 */
class Resume extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'resume';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['text'], 'string'],
            [['visitor_id', 'category_id'], 'default', 'value' => null],
            [['visitor_id', 'category_id'], 'integer'],
            [['name', 'surname', 'patronymic', 'email', 'phone', 'file'], 'string', 'max' => 255],
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
            'surname' => 'Surname',
            'patronymic' => 'Patronymic',
            'text' => 'Text',
            'email' => 'Email',
            'phone' => 'Phone',
            'file' => 'File',
            'visitor_id' => 'Visitor ID',
            'category_id' => 'Category ID',
        ];
    }

    public function getImage()
    {
        if($this->file){
            return '/uploads/'.$this->file;
        }
        return 'empty.png';
    }

    public function saveImage($filename)//Сохраняет название картинки в базу
    {
        $this->file=$filename;
        return $this->save(false);
    }

    public function deleteFile()
    {
        $file=new Image();
        $file->deleteCurrentFile($this->file);
    }

    public function beforeDelete()
    {
        $this->deleteFile();
        return parent::beforeDelete();
    }

    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id'=>'category_id']);
    }

    public function saveCategory($category_id)
    {
        $category=Category::findOne($category_id);
        if($category != null){
            $this->link('category', $category);
            return true;
        }
    }

    public function saveResume()
    {
        $this->visitor_id=Yii::$app->user->id;
        return  $this->save();
    }

    public function getUser()
    {
        return $this->hasOne(User::className(), ['id'=>'visitor_id']);
    }


}

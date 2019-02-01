<?php

namespace app\models;
use yii\web\UploadedFile;
use Yii;
use yii\base\Model;

class Image extends Model
{

    public $image;

    public function rules()
    {
        return [
            [['imageFile'], 'file', 'extensions' => 'png, jpg'],
        ];
    }

    public function upload(UploadedFile $file, $currentFile)//загрузить новый файл на сервер, если другого файла в модели нет, или удаляет старый и загружает новый файл
    {

        $this->image=$file;

        //if($this->validate()){
           $this->deleteCurrentFile($currentFile);
            return $this->saveFile();
       // }

    }

    public function saveFile()//сохраняет файл по указанному пути
    {
        $filename=$this->generateFileName();
        $this->image->saveAs($this->getPath().$filename);
        return $filename;
    }

    public function getPath()//возвращает путь к папке со всеми файлами
    {
        return Yii::getAlias('@web').'uploads/';
    }

    public function generateFileName()//генерирует уникальное имя файла
    {
        return strtolower(md5(uniqid($this->image->name))).'.'.$this->image->extension;
    }

    public function deleteCurrentFile($currentFile)//удаляет текущий файл для модели Резюме
    {
        if($this->fileExists($this->getPath().$currentFile))
        {
            unlink($this->getPath().$currentFile);
        }
    }

    public function fileExists($currentFile)//проверяет, существует ли файл
    {
            if(!empty($currentFile) && $currentFile!=null){
                return file_exists($this->getPath().$currentFile);
            }
    }
}
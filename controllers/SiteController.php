<?php

namespace app\controllers;

use app\models\Category;
use app\models\Image;
use app\models\Resume;
use Yii;
use yii\data\Pagination;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use yii\web\UploadedFile;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $query=Resume::find();
        $count=$query->count();
        $pagination=new Pagination(['totalCount'=>$count, 'pageSize'=>1]);
        $resumes=$query->offset($pagination->offset)
        ->limit($pagination->limit)
        ->all();

        $categories=Category::find()->all();

        return $this->render('index', [
            'resumes'=>$resumes,
            'pagination'=>$pagination,
            'categories' =>$categories,
        ]);
    }
    

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }


    public function actionView($id)
    {
        $resume=Resume::findOne($id);
        $categories=Category::find()->all();
        return $this->render('single', [
            'resume'=>$resume,
            'categories' =>$categories,
        ]);
    }

    public function actionCategory($id)
    {
        $query=Resume::find()->where(['category_id'=>$id]);
        $categories=Category::find()->all();
        $count=$query->count();
        $pagination=new Pagination(['totalCount'=>$count, 'pageSize'=>6]);
        $resumes=$query->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

        return $this->render('category', [
            'resumes'=>$resumes,
            'pagination'=>$pagination,
            'categories'=>$categories,
        ]);
    }

    public function actionEntry()
    {
        $model=new Resume();
        if($model->load(Yii::$app->request->post()) && $model->validate()){//Yii::$app->request->isPost){//$model->load(Yii::$app->request->post()) && $model->validate()){
            $imageFile=UploadedFile::getInstance($model,'imageFile');
            $model->upload($imageFile);

            return $this->render('entry-confirm', ['model' => $model]);
        }else {
            return $this->render('entry', ['model' => $model]);
        }
    }
}

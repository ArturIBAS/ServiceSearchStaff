<?php

namespace app\controllers;

use app\models\Image;
use app\models\Category;
use Yii;
use yii\data\Pagination;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use yii\web\UploadedFile;
use app\models\Resume;
use app\models\ResumeSearch;

/**
 * ResumeController implements the CRUD actions for Resume model.
 */
class ResumeController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Resume models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ResumeSearch();
        $dataProvider = $searchModel->searchById(Yii::$app->request->queryParams);

            return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);

    }

//    public function actionsIndex()
//    {
//        $query=Resume::find()->where(['id' => Yii::$app->user->id]);
//        $count=$query->count();
//        $pagination=new Pagination(['totalCount'=>$count, 'pageSize'=>1]);
//        $resumes=$query->offset($pagination->offset)
//            ->limit($pagination->limit)
//            ->all();
//
//        $categories=Category::find()->all();
//
//        return $this->render('index', [
//            'resumes'=>$resumes,
//            'pagination'=>$pagination,
//            'categories' =>$categories,
//        ]);
//    }

    /**
     * Displays a single Resume model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Resume model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Resume();
        if ($model->load(Yii::$app->request->post()) && $model->saveResume()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Resume model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->saveResume()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Resume model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        return $this->redirect(['index']);
    }

    /**
     * Finds the Resume model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Resume the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Resume::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionSetImage($id)//Загружает картинку на сервер по данному id
    {
        $model=new Image();

        if(Yii::$app->request->isPost){
            $resume=$this->findModel($id);
            $file = UploadedFile::getInstance($model, 'image');

            if($resume->saveImage($model->upload($file, $resume->file))){
                $resume->getUser();
                return $this->redirect(['view', 'id'=>$resume->id]);
            }
        }
        return $this->render('image', ['model' => $model]);
    }

    public function actionSetCategory($id)//Определяет категорию объявления
    {
        $resume=$this->findModel($id);
        $selectedCategory = ($resume->category) ? $resume->category->id : 7;
        $categories=ArrayHelper::map(Category::find()->all(),'id','title');

        if(Yii::$app->request->isPost) {
            $category = Yii::$app->request->post('category');
            if ($resume->saveCategory($category)) {
                $resume->getCategory();
                $resume->getUser();
                return $this->redirect(['view', 'id' => $resume->id]);
            }
        }

        return $this->render('category', [
            'resume' =>$resume,
            'selectedCategory'=>$selectedCategory,
            'categories'=>$categories
        ]);
    }
}

<?php

namespace frontend\controllers;

use common\search\JournalUserManagerSearch;
use frontend\components\BaseAuthController;
use Yii;
use common\models\Journal;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * JournalController implements the CRUD actions for Journal model.
 */
class JournalController extends BaseAuthController
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                    'delete-post' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Journal models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new JournalUserManagerSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Journal model.
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
     * Creates a new Journal model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Journal();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }
        Yii::warning($model->errors);


        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Journal model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionDelete($id)
    {
        $data = $this->findModel($id);

        if (!count($data->publications)) {
            $data->delete();
            return $this->redirect(['index']);
        }
        return $this->render('prepare_delete', [
            'data' => $data,
        ]);
    }

    public function actionDeletePost($id)
    {
        $data = $this->findModel($id);
        $data->delete();
        return $this->redirect(['index']);
    }


    /**
     * @param $id
     * @return array|Journal|null
     * @throws NotFoundHttpException
     */
    protected function findModel($id)
    {
        if (($model = Journal::find()->onlyOwner()->byId($id)->one()) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}

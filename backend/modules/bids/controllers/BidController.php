<?php

namespace app\modules\bids\controllers;

use common\models\Bid;
use common\models\Product;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\HttpException;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * BidController implements the CRUD actions for Bid model.
 */
class BidController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors(): array
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::class,
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Bid models.
     *
     * @return string
     */
    public function actionIndex(): string
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Bid::find(),
            'pagination' => [
                'pageSize' => 10
            ],
            'sort' => [
                'defaultOrder' => [
                    'id' => SORT_DESC,
                ]
            ],

        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Bid model.
     *
     * @param int $id
     *
     * @return string
     * @throws \yii\web\NotFoundHttpException
     * @author Виталий Москвин <foreach@mail.ru>
     */
    public function actionView(int $id): string
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Updates an existing Bid model.
     *
     * @param int $id
     *
     * @return string|\yii\web\Response
     * @throws \yii\web\NotFoundHttpException
     * @author Виталий Москвин <foreach@mail.ru>
     */
    public function actionUpdate(int $id)
    {
        $products = Product::find()->all();

        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'products' => ArrayHelper::map($products, 'id', 'title')
        ]);
    }

    /**
     * Deletes an existing Bid model.
     *
     * @param int $id
     *
     * @return \yii\web\Response
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     * @throws \yii\web\NotFoundHttpException
     * @author Виталий Москвин <foreach@mail.ru>
     */
    public function actionDelete(int $id): \yii\web\Response
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Присвоить статус - принята
     *
     * @param int $id
     *
     * @return \yii\web\Response
     * @throws \yii\web\HttpException
     * @throws \yii\web\NotFoundHttpException
     * @author Виталий Москвин <foreach@mail.ru>
     */
    public function actionApply(int $id): \yii\web\Response
    {
        $model = $this->findModel($id);

        $model->status = Bid::STATUS_APPLY;

        try {
            $model->save();
        } catch(\Throwable $e) {
            throw new HttpException(422, $e->getMessage());
        }

        return $this->redirect(['index']);
    }

    /**
     * Присвоить статус - отказано
     *
     * @param int $id
     *
     * @return \yii\web\Response
     * @throws \yii\web\HttpException
     * @throws \yii\web\NotFoundHttpException
     * @author Виталий Москвин <foreach@mail.ru>
     */
    public function actionReject(int $id): \yii\web\Response
    {
        $model = $this->findModel($id);

        $model->status = Bid::STATUS_REJECT;

        try {
            $model->save();
        } catch(\Throwable $e) {
            throw new HttpException(422, $e->getMessage());
        }

        return $this->redirect(['index']);
    }

    /**
     * Присвоить статус - брак
     *
     * @param int $id
     *
     * @return \yii\web\Response
     * @throws \yii\web\HttpException
     * @throws \yii\web\NotFoundHttpException
     * @author Виталий Москвин <foreach@mail.ru>
     */
    public function actionDefect(int $id): \yii\web\Response
    {
        $model = $this->findModel($id);

        $model->status = Bid::STATUS_DEFECT;

        try {
            $model->save();
        } catch(\Throwable $e) {
            throw new HttpException(422, $e->getMessage());
        }

        return $this->redirect(['index']);
    }

    /**
     * Finds the Bid model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     *
     * @param int $id ID
     *
     * @return Bid the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel(int $id): Bid
    {
        if (($model = Bid::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}

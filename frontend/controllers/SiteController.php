<?php

namespace frontend\controllers;

use common\models\Product;
use frontend\models\BidForm;
use Yii;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use frontend\models\ContactForm;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function actions(): array
    {
        return [
            'error' => [
                'class' => \yii\web\ErrorAction::class,
            ],
            'captcha' => [
                'class' => \yii\captcha\CaptchaAction::class,
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string|\yii\web\Response
     */
    public function actionIndex()
    {
        $products = Product::find()->all();

        $model = new BidForm();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->send()) {
                Yii::$app->session->setFlash('success', 'Спасибо за вашу заявку. Мы свяжемся с вами позже.');
            } else {
                Yii::$app->session->setFlash('error', 'Произошла ошибка при отправке заявки.');
            }

            return $this->refresh();
        }

        return $this->render('index', [
            'model' => $model,
            'products' => ArrayHelper::map($products, 'id', 'title')
        ]);
    }

    /**
     * Displays contact page.
     *
     * @return string|\yii\web\Response
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending your message.');
            }

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
    public function actionAbout(): string
    {
        return $this->render('about');
    }
}

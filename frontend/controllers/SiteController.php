<?php
namespace frontend\controllers;

use common\models\BadWords;
use common\models\Chat;
use Yii;
use yii\base\InvalidParamException;
use common\models\Message;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use common\models\User;
use yii\helpers\Json;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
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
     * @inheritdoc
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
     * @return mixed
     */
    public function actionIndex()
    {
        $chats = '';
        $badWords = [];
        if(!Yii::$app->user->isGuest) {
            $chats = Chat::find()
                ->where(['user_1' => Yii::$app->user->identity->id])
                ->orWhere(['user_2' => Yii::$app->user->identity->id])
                ->all();

            if(Yii::$app->user->identity->user_type == Yii::$app->params['user.userTypeUser']) {
                foreach (BadWords::find()->select('word')->each(30) as $item) {
                    $badWords[] = trim($item->word);
                }
            }
        } else {
            $this->redirect(['site/login']);
        }

        // Get users for autocomplete
        $users = User::find()
            ->select(['name as value', 'id as name' , 'id as id'])
            ->where(['status'=>1,'is_deleted'=>0])
            ->asArray()
            ->all();

        return $this->render('index', [
            'users' => $users,
            'chats' => $chats,
            'badWords' => $badWords
        ]);
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays design page.
     *
     * @return mixed
     */
    public function actionDesign()
    {
        $this->layout = false;
        return $this->render('design');
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for email provided.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password was saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }

    /**
     * @throws \yii\base\ExitException
     */
    public function actionCreateChat()
    {
        if(Yii::$app->request->post())
        {
            $chat = new Chat();
            $chat->user_1 = Yii::$app->user->identity->id;
            $chat->user_2 = Yii::$app->request->post()['user_2'];
            $chat->channel = 'chat_'.$chat->user_1."_".$chat->user_2;
            if($chat->save()) {
                echo json_encode([
                    'status' => 'success',
                    'channel' => $chat->channel,
                    'user_2' => $chat->user2->name,
                ]);
                Yii::$app->end();
            }
            echo json_encode([
                'status' => 'fail'
            ]);
            Yii::$app->end();

        }
    }

    /**
     * @throws \yii\base\ExitException
     */
    public function actionSendMessage()
    {
        if(Yii::$app->request->post())
        {
            $channel = Yii::$app->request->post()['channel'];
            $chat = Chat::find()
                ->where(['channel' => $channel])
                ->one();

            if($chat) {
                $message = new Message();
                $message->chat_id = $chat->id;
                $message->message = Yii::$app->request->post()['message'];
                $message->sender_id = Yii::$app->user->identity->id;
                $message->receiver_id = Yii::$app->request->post()['receiver_id'];
                if($message->save()) {
                    return Yii::$app->redis->executeCommand('PUBLISH', [
                        'channel' => 'chat',
                        'message' => Json::encode(['channel' => $channel, 'message' => $message->message, 'me' => Yii::$app->user->identity->id])
                    ]);
                }
            }
        }
        echo json_encode([
            'status' => 'fail'
        ]);
        Yii::$app->end();
    }

    public function actionLoadMessage()
    {
        if(Yii::$app->request->post()) {
            $chat = Chat::find()
                ->where(['channel' => Yii::$app->request->post()['channel']])
                ->one();

            $messages = Message::find()
                ->where(['chat_id' => $chat->id])
                ->limit(10)
                ->orderBy(['id' => SORT_DESC])
                ->all();

            $array = [];
            if($messages) {
                foreach ($messages as $message) {
                    if($message->sender_id == Yii::$app->user->identity->id) {
                        $array[]['me'] = $message->message;
                    } else {
                        $array[]['you'] = $message->message;
                    }
                }
            }
            echo json_encode([
                'status' => 'success',
                'data' => array_reverse($array)
            ]);
            Yii::$app->end();
        }
        echo json_encode([
            'status' => 'fail',
        ]);
        Yii::$app->end();
    }
}

<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;
use yii\db\Expression;

/**
 * This is the model class for table "chat".
 *
 * @property integer $id
 * @property string $channel
 * @property integer $user_1
 * @property integer $user_2
 * @property string $created_date
 * @property string $modified_date
 *
 * @property User $user2
 * @property User $user1
 * @property Message[] $messages
 */
class Chat extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'chat';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['channel', 'user_1', 'user_2'], 'required'],
            [['user_1', 'user_2'], 'integer'],
            [['created_date', 'modified_date'], 'safe'],
            [['channel'], 'string', 'max' => 255],
            [['user_2'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_2' => 'id']],
            [['user_1'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_1' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => 'yii\behaviors\TimestampBehavior',
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_date', 'modified_date'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['modified_date'],
                ],
                'value' => new Expression('NOW()'),
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'channel' => 'Channel',
            'user_1' => 'User 1',
            'user_2' => 'User 2',
            'created_date' => 'Created Date',
            'modified_date' => 'Modified Date',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser2()
    {
        return $this->hasOne(User::className(), ['id' => 'user_2']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser1()
    {
        return $this->hasOne(User::className(), ['id' => 'user_1']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMessages()
    {
        return $this->hasMany(Message::className(), ['chat_id' => 'id']);
    }
}

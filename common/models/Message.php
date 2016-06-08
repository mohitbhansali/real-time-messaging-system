<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "message".
 *
 * @property integer $id
 * @property integer $chat_id
 * @property integer $sender_id
 * @property integer $receiver_id
 * @property string $message
 *
 * @property User $receiver
 * @property Chat $chat
 * @property User $sender
 */
class Message extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'message';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['chat_id', 'sender_id', 'receiver_id', 'message'], 'required'],
            [['chat_id', 'sender_id', 'receiver_id'], 'integer'],
            [['message'], 'string', 'max' => 255],
            [['receiver_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['receiver_id' => 'id']],
            [['chat_id'], 'exist', 'skipOnError' => true, 'targetClass' => Chat::className(), 'targetAttribute' => ['chat_id' => 'id']],
            [['sender_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['sender_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'chat_id' => 'Chat ID',
            'sender_id' => 'Sender ID',
            'receiver_id' => 'Receiver ID',
            'message' => 'Message',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReceiver()
    {
        return $this->hasOne(User::className(), ['id' => 'receiver_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getChat()
    {
        return $this->hasOne(Chat::className(), ['id' => 'chat_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSender()
    {
        return $this->hasOne(User::className(), ['id' => 'sender_id']);
    }
}

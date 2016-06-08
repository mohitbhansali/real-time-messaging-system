<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "bad_words".
 *
 * @property integer $id
 * @property string $word
 * @property string $replacement
 */
class BadWords extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bad_words';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['word'], 'required'],
            [['word', 'replacement'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'word' => 'Word',
            'replacement' => 'Replacement',
        ];
    }
}

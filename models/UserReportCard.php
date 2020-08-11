<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user_report_card".
 *
 * @property integer $id
 * @property integer $quiz_id
 * @property integer $user_id
 * @property integer $coins_earned
 * @property string $score
 * @property string $time_spent
 * @property integer $correct
 * @property integer $wrong
 * @property integer $unanswered
 * @property string $accuracy
 * @property integer $attempts
 * @property string $created_at
 * @property string $updated_at
 * @property string $del_status
 *
 * @property Quiz $quiz
 * @property AppUser $user
 */
class UserReportCard extends \app\components\Model
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_report_card';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['quiz_id', 'user_id', 'score', 'time_spent', 'correct', 'wrong', 'unanswered'], 'required'],
            [['quiz_id', 'user_id', 'coins_earned', 'correct', 'wrong', 'unanswered', 'attempts'], 'integer'],
            [['score', 'accuracy'], 'number'],
            [['created_at', 'updated_at'], 'safe'],
            [['del_status'], 'string'],
            [['time_spent'], 'string', 'max' => 255],
            [['quiz_id'], 'exist', 'skipOnError' => true, 'targetClass' => Quiz::className(), 'targetAttribute' => ['quiz_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => AppUser::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'quiz_id' => 'Quiz ID',
            'user_id' => 'User ID',
            'coins_earned' => 'Coins Earned',
            'score' => 'Score',
            'time_spent' => 'Time Spent',
            'correct' => 'Correct',
            'wrong' => 'Wrong',
            'unanswered' => 'Unanswered',
            'accuracy' => 'Accuracy',
            'attempts' => 'Attempts',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'del_status' => 'Del Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getQuiz()
    {
        return $this->hasOne(Quiz::className(), ['id' => 'quiz_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(AppUser::className(), ['id' => 'user_id']);
    }
}

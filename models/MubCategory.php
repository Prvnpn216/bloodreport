<?php

namespace app\models;

use Yii;
use app\helpers\HtmlHelper;

/**
 * This is the model class for table "mub_category".
 *
 * @property integer $id
 * @property string $category_name
 * @property string $category_slug
 * @property string $status
 * @property integer $related_category
 * @property string $created_at
 * @property string $updated_at
 * @property string $del_status
 *
 * @property Doubts[] $doubts
 * @property MubCategory $relatedCategory
 * @property MubCategory[] $mubCategories
 * @property Quiz[] $quizzes
 * @property QuizQuestion[] $quizQuestions
 */
class MubCategory extends \app\components\Model
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'mub_category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['category_name', 'category_slug'], 'required'],
            [['status', 'del_status'], 'string'],
            [['related_category'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['category_name'], 'string', 'max' => 64],
            [['category_slug'], 'string', 'max' => 50],
            [['related_category'], 'exist', 'skipOnError' => true, 'targetClass' => MubCategory::className(), 'targetAttribute' => ['related_category' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'category_name' => 'Category Name',
            'category_slug' => 'Category Slug',
            'status' => 'Status',
            'related_category' => 'Related Category',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'del_status' => 'Del Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDoubts()
    {
        return $this->hasMany(Doubts::className(), ['category_id' => 'id'])->where(['del_status' => '0']);
    }

    public function beforeValidate()
    {
        $this->category_slug = HtmlHelper::slugify($this->category_name);
        return parent::beforeValidate();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRelatedCategory()
    {
        return $this->hasOne(MubCategory::className(), ['id' => 'related_category'])->where(['del_status' => '0']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMubCategories()
    {
        return $this->hasMany(MubCategory::className(), ['related_category' => 'id'])->where(['del_status' => '0']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getQuizzes()
    {
        return $this->hasMany(Quiz::className(), ['category_id' => 'id'])->where(['del_status' => '0']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getQuizQuestions()
    {
        return $this->hasMany(QuizQuestion::className(), ['category_id' => 'id'])->where(['del_status' => '0']);
    }
}

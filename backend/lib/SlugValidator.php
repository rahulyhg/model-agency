<?php
/**
 * Yii2 Slug Validator
 */
namespace backend\lib;

use herroffizier\yii2tv\TranslitValidator;
use URLify;
use yii\db\BaseActiveRecord;
use yii\validators\UniqueValidator;

class SlugValidator extends TranslitValidator
{
    public $ensureUnique = true;

    public $uniqueValidator = [];

    public $uniqueSlugGenerator;
    /**
     * @inheritdoc
     */
    public function validateAttribute($model, $attribute)
    {
        // Do not overwrite non-empty values and do not parse empty values.
        if ($model->$attribute || !$model->{$this->sourceAttribute}) {
            return;
        }

        $value = URLify::downcode($model->{$this->sourceAttribute});

        if ($this->lowercase) {
            $value = strtolower($value);
        }

        if ($this->forUrl) {
            $value = $this->prepareForUrl($value);
        }



        $model->$attribute = $this->ensureUnique ? $this->makeUnique($model, $attribute, $value) : $value;;
    }

    /**
     * This method is called by [[getValue]] when [[ensureUnique]] is true to generate the unique slug.
     * Calls [[generateUniqueSlug]] until generated slug is unique and returns it.
     * @param BaseActiveRecord $model
     * @param string $attribute attribute name
     * @param string $slug basic slug value
     * @return string unique slug
     * @see getValue
     * @see generateUniqueSlug
     * @since 2.0.7
     */
    protected function makeUnique($model, $attribute, $slug)
    {
        $uniqueSlug = $slug;
        $iteration = 0;
        while (!$this->validateSlug($model, $attribute, $uniqueSlug)) {
            $iteration++;
            $uniqueSlug = $this->generateUniqueSlug($slug, $iteration, $model);
        }
        return $uniqueSlug;
    }

    /**
     * Checks if given slug value is unique.
     * @param BaseActiveRecord $model
     * @param string $attribute attribute name
     * @param string $slug slug value
     * @return boolean whether slug is unique.
     */
    protected function validateSlug($model, $attribute, $slug)
    {
        /* @var $validator UniqueValidator */
        /* @var $model BaseActiveRecord */
        $validator = \Yii::createObject(array_merge(
            [
                'class' => UniqueValidator::className(),
            ],
            $this->uniqueValidator
        ));

        $model = clone $model;
        $model->clearErrors();
        $model->{$attribute} = $slug;

        $validator->validateAttribute($model, $attribute);
        return !$model->hasErrors();
    }

    /**
     * Generates slug using configured callback or increment of iteration.
     * @param string $baseSlug base slug value
     * @param integer $iteration iteration number
     * @param BaseActiveRecord $model
     * @return string new slug value
     * @throws \yii\base\InvalidConfigException
     */
    protected function generateUniqueSlug($baseSlug, $iteration, $model)
    {
        if (is_callable($this->uniqueSlugGenerator)) {
            return call_user_func($this->uniqueSlugGenerator, $baseSlug, $iteration, $model);
        }
        return $baseSlug . '-' . ($iteration + 1);
    }
}

<?php
namespace backend\widgets\activeForm;

use yii\helpers\Html;

class ActiveField extends \yii\widgets\ActiveField
{
    public $template = "{label} {hint}\n{input}\n{error}";

    public function hint($content, $options = [])
    {
        if ($content === false) {
            $this->parts['{hint}'] = '';
            return $this;
        }

        $options = array_merge($this->hintOptions, $options);
        if ($content !== null) {
            $options['hint'] = $content;
        }

        $hintContent = $this->model->getAttributeHint(str_replace('[0]', '', $this->attribute));// TODO исправить костыль с str_replace!!!
        if( $hintContent ) {
            $this->parts['{hint}'] = Html::tag('i', '', [
                'class' => 'fa fa-question-circle tooltips',
                'data-container' => 'body',
                'data-placement' => 'right',
                'data-original-title' => $hintContent,
            ]);
        } else {
            $this->parts['{hint}'] = '';
        }

        return $this;
    }
}
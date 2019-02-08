<?php

namespace modules\mod\lib;

use yii\helpers\ArrayHelper;
use yii\helpers\Html;

class ActiveField extends \yii\widgets\ActiveField
{
  public $titleOptions = [
    'class' => 'b-field__title'
  ];

  protected $iconClass = 'b-field__icon b-field__icon_focus-first';

  public $options = [
    'tag' => 'div',
    'double' => false, // is it double field
    'class' => 'b-field'
  ];

  public $template = "{label}\n{title}\n{wrap}\n{input}\n{icon}\n{/wrap}\n{/label}\n{hint}\n{error}";

  public $inputOptions = ['class' => 'b-field__input'];

  public $errorOptions = ['class' => 'b-field__help'];

  public $labelOptions = ['class' => 'b-field__label'];

  public $hintOptions = ['class' => 'b-field__hint'];

  public function begin()
  {
    if ($this->form->enableClientScript) {
      $clientOptions = $this->getClientOptions();
      if (!empty($clientOptions)) {
        $this->form->attributes[] = $clientOptions;
      }
    }

    $inputID = $this->getInputId();
    $attribute = Html::getAttributeName($this->attribute);
    $options = $this->options;
    $class = isset($options['class']) ? (array)$options['class'] : [];
    $class[] = 'b-field';
    $class[] = "field-$inputID";
    if ($this->model->isAttributeRequired($attribute)) {
      $class[] = $this->form->requiredCssClass;
    }
    $options['class'] = implode(' ', $class);
    if ($this->form->validationStateOn === ActiveForm::VALIDATION_STATE_ON_CONTAINER) {
      $this->addErrorClassIfNeeded($options);
    }
    $tag = ArrayHelper::remove($options, 'tag', 'div');

    return Html::beginTag($tag, $options);
  }

  public function render($content = null)
  {
    if ($content === null) {
      if (!isset($this->parts['{icon}'])) {
        $this->icon();
      }
      if (!isset($this->parts['{title}'])) {
        $this->title();
      }
      if (!isset($this->parts['{input}'])) {
        $this->textInput();
      }
      if (!isset($this->parts['{label}'])) {
        $this->label();
      }
      if (!isset($this->parts['{error}'])) {
        $this->error();
      }
      if (!isset($this->parts['{hint}'])) {
        $this->hint(null);
      }
      $content = strtr($this->template, $this->parts);
    } elseif (!is_string($content)) {
      $content = call_user_func($content, $this);
    }

    return $this->begin() . "\n" . $content . "\n" . $this->end();
  }

  public function label($label = null, $options = [])
  {
    if ($label === false) {
      $this->parts['{label}'] = '';
      return $this;
    }
    $this->parts['{label}'] = Html::beginTag('label', $this->labelOptions);
    $this->parts['{/label}'] = Html::endTag('label');
    return $this;
  }

  public function icon($class = '', $options = [])
  {
    if (!$class) {
      $this->parts['{icon}'] = '';
      $this->parts['{wrap}'] = '';
      $this->parts['{/wrap}'] = '';
      return $this;
    }
    $this->inputOptions['class'] .= ' b-field__input_icon';
    $class = $this->iconClass . ' ' . $class;
    $this->parts['{icon}'] = Html::tag('i', '', ['class' => $class]);

    // Если есть иконка, необходимо обернуть input и i в обертку .b-field__wrap
    $this->parts['{wrap}'] = Html::beginTag('div', ['class' => 'b-field__wrap']);
    $this->parts['{/wrap}'] = Html::endTag('div');

    return $this;
  }

  public function title($title = '', $options = [])
  {
    if ($title === false) {
      $this->parts['{title}'] = '';
      return $this;
    }
    $this->parts['{title}'] = Html::tag(
      'span',
      $title ?: $this->model->getAttributeLabel($this->attribute),
      ArrayHelper::merge($this->titleOptions, $options)
    );
    return $this;
  }

  public function textInput($options = [])
  {
    $options = array_merge($this->inputOptions, $options);

    if ($this->form->validationStateOn === ActiveForm::VALIDATION_STATE_ON_INPUT) {
      $this->addErrorClassIfNeeded($options);
    }

    $this->addAriaAttributes($options);
    $this->adjustLabelFor($options);
    $this->parts['{input}'] = Html::activeTextInput($this->model, $this->attribute, $options);

    if($this->options['double'] === true) {
      $this->parts['{input}'] .= Html::activeTextInput($this->model, $this->attribute, $options);
    }

    return $this;
  }
}
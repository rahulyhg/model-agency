<?php
namespace common\widgets;

use Yii;
use yii\helpers\Html;

/**
 * Alert widget renders a message from session flash. All flash messages are displayed
 * in the sequence they were assigned using setFlash. You can set message as following:
 *
 * ```php
 * Yii::$app->session->setFlash('error', 'This is the message');
 * Yii::$app->session->setFlash('success', 'This is the message');
 * Yii::$app->session->setFlash('info', 'This is the message');
 * ```
 *
 * Multiple messages could be set as follows:
 *
 * ```php
 * Yii::$app->session->setFlash('error', ['Error 1', 'Error 2']);
 * ```
 *
 * @author Kartik Visweswaran <kartikv2@gmail.com>
 * @author Alexander Makarov <sam@rmcreative.ru>
 */
class Alert extends \yii\bootstrap\Widget
{
    /**
     * @var array the alert types configuration for the flash messages.
     * This array is setup as $key => $value, where:
     * - key: the name of the session flash variable
     * - value: the bootstrap alert type (i.e. danger, success, info, warning)
     */
    public $alertTypes = [
        'error'   => 'b-alert_danger',
        'danger'  => 'b-alert_danger',
        'success' => 'b-alert_success',
        'info'    => 'b-alert_info',
        'warning' => 'b-alert_warning'
    ];
    /**
     * @var array the options for rendering the close button tag.
     * Array will be passed to [[\yii\bootstrap\Alert::closeButton]].
     */
    public $closeButton = [];


    /**
     * {@inheritdoc}
     */
    public function run()
    {
        $session = Yii::$app->session;
        $flashes = $session->getAllFlashes();
        $appendClass = isset($this->options['class']) ? 'b-alert ' . $this->options['class'] : 'b-alert';

        foreach ($flashes as $type => $flash) {
            if (!isset($this->alertTypes[$type])) {
                continue;
            }

            foreach ((array) $flash as $i => $message) {
              $msgElement = Html::tag('div', $message, ['class' => 'b-alert__message']);
              $closeElement = Html::tag('div', Html::tag('i', '', ['class' => 'fas fa-times']), ['class' => 'b-alert__close']);
                echo Html::tag('div', $msgElement . $closeElement, [
                  'class' => $appendClass . " {$this->alertTypes[$type]}"
                ]);
            }

            $session->removeFlash($type);
        }
    }
}

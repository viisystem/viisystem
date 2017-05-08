<?php
namespace vii\widgets;

use yii\authclient\widgets\AuthChoice;
use yii\helpers\Html;

/**
 * MyAuthChoice widgets custom of AuthChoice
 */
class MyAuthChoice extends AuthChoice
{
	public $containerItemOption = [];

    /**
     * @inheritdoc
     */
    protected function renderMainContent()
    {
        $items = [];
        foreach ($this->getClients() as $externalService) {
            $items[] = Html::tag('li', $this->clientLink($externalService));
        }
        return Html::tag('ul', implode('', $items), $this->containerItemOption);
    }

    /**
     * @inheritdoc
     */
    public function clientLink($client, $text = null, array $htmlOptions = [])
    {
		$clientName = $this->renameClient($client);

        $viewOptions = $client->getViewOptions();
        if (empty($viewOptions['widget'])) {
            if (!isset($htmlOptions['class'])) {
                $htmlOptions['class'] = "rounded-x social_" . $clientName;
            }
            if (!isset($htmlOptions['title'])) {
                $htmlOptions['title'] = $client->getTitle();
            }
            if (!isset($htmlOptions['data-original-title'])) {
                $htmlOptions['data-original-title'] = $client->getTitle();
            }
            Html::addCssClass($htmlOptions, ['widget' => 'auth-link']);

            if ($this->popupMode) {
                if (isset($viewOptions['popupWidth'])) {
                    $htmlOptions['data-popup-width'] = $viewOptions['popupWidth'];
                }
                if (isset($viewOptions['popupHeight'])) {
                    $htmlOptions['data-popup-height'] = $viewOptions['popupHeight'];
                }
            }
            return Html::a('', $this->createClientUrl($client), $htmlOptions);
        }

        $widgetConfig = $viewOptions['widget'];
        if (!isset($widgetConfig['class'])) {
            throw new InvalidConfigException('Widget config "class" parameter is missing');
        }
        /* @var $widgetClass Widget */
        $widgetClass = $widgetConfig['class'];
        if (!(is_subclass_of($widgetClass, \yii\authclient\widgets\AuthChoiceItem::className()))) {
            throw new InvalidConfigException('Item widget class must be subclass of "' . AuthChoiceItem::className() . '"');
        }
        unset($widgetConfig['class']);
        $widgetConfig['client'] = $client;
        $widgetConfig['authChoice'] = $this;
        return $widgetClass::widget($widgetConfig);
    }

    private function renameClient($client) {
    	$clientName = null;
    	switch ($client->getName()) {
    		case 'google':
    			$clientName = 'googleplus';
    			break;
    		default:
    			$clientName = $client->getName();
    			break;
    	}

    	return $clientName;
    }
}
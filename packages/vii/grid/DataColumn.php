<?php

namespace vii\grid;

use Yii;
use yii\base\Model;
use vii\helpers\Html;

use vii\widgets\Select;


class DataColumn extends \yii\grid\DataColumn
{

    protected function renderFilterCellContent()
    {
        if (is_string($this->filter)) {
            return $this->filter;
        }

        $model = $this->grid->filterModel;

        if ($this->filter !== false && $model instanceof Model && $this->attribute !== null && $model->isAttributeActive($this->attribute)) {
            if ($model->hasErrors($this->attribute)) {
                Html::addCssClass($this->filterOptions, 'has-error');
                $error = ' ' . Html::error($model, $this->attribute, $this->grid->filterErrorOptions);
            } else {
                $error = '';
            }
            if (is_array($this->filter)) {
                $options = array_merge(['prompt' => ''], $this->filterInputOptions);
                return Select::widget([
                    'model' => $model,
                    'attribute' => $this->attribute,
                    'data' => $this->filter,
                    'options' => $options
                ]) . $error;
                //return Html::activeDropDownList($model, $this->attribute, $this->filter, $options) . $error;

            } else {
                return Html::activeTextInput($model, $this->attribute, $this->filterInputOptions) . $error;
            }
        } else {
            return parent::renderFilterCellContent();
        }
    }

    /**
     * Renders a data cell.
     * @param mixed $model the data model being rendered
     * @param mixed $key the key associated with the data model
     * @param integer $index the zero-based index of the data item among the item array returned by [[GridView::dataProvider]].
     * @return string the rendering result
     */
    public function renderDataCell($model, $key, $index)
    {
        if ($this->contentOptions instanceof \Closure) {
            $options = call_user_func($this->contentOptions, $model, $key, $index, $this);
        } else {
            $options = $this->contentOptions;
        }

        $options['data-label'] = $this->getHeaderCellLabel();
        return Html::tag('td', $this->renderDataCellContent($model, $key, $index), $options);
    }

}

<?php
namespace vii\grid;

use yii\widgets\LinkPager;
use yii\helpers\Html;

class MyLinkPager extends LinkPager {

	/**
     * Executes the widget.
     * This overrides the parent implementation by displaying the generated page buttons.
     */
    public function run()
    {
        if ($this->registerLinkTags) {
            $this->registerLinkTags();
        }
        echo $this->renderPageButtons();
    }

    /**
     * Renders the page buttons.
     * @return string the rendering result
     */
    protected function renderPageButtons()
    {
        $pageCount = $this->pagination->getPageCount();
        if ($pageCount < 2 && $this->hideOnSinglePage) {
            return '';
        }

        $buttons = [];
        $currentPage = $this->pagination->getPage();

		list($beginPage,$endPage)=$this->getPageRange();

		// prev page
		if ($this->prevPageLabel !== false) {
            if (($page = $currentPage - 1) < 0) {
                $page = 0;
            }
            $buttons[] = $this->renderPageButton($this->prevPageLabel, $page, $this->prevPageCssClass, false, false);
        }

		// internal pages
		$buttons[] = $this->renderPageButtonNumber($currentPage + 1 . ' of ' . $pageCount, $currentPage, $this->pageCssClass, false, $currentPage);
		
		// next page
        if ($this->nextPageLabel !== false) {
            if (($page = $currentPage + 1) >= $pageCount - 1) {
                $page = $pageCount - 1;
            }
            $buttons[] = $this->renderPageButton($this->nextPageLabel, $page, $this->nextPageCssClass, $currentPage >= $pageCount - 1, false);
        }

        
        return Html::tag('ul', implode("\n", $buttons), $this->options);
    }

    protected function renderPageButtonNumber($label, $page, $class, $disabled, $active)
    {
        $options = ['class' => empty($class) ? $this->pageCssClass : $class];
        if ($active) {
            Html::addCssClass($options, $this->activePageCssClass);
        }
        if ($disabled) {
            Html::addCssClass($options, $this->disabledPageCssClass);
            $tag = ArrayHelper::remove($this->disabledListItemSubTagOptions, 'tag', 'span');

            return Html::tag('li', Html::tag($tag, $label, $this->disabledListItemSubTagOptions), $options);
        }
        $linkOptions = $this->linkOptions;
        $linkOptions['data-page'] = $page;

        return Html::tag('li', $label, $options);
    }

}

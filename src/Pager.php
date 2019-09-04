<?php
/**
 * @link      http://www.activemedia.uz/
 * @copyright Copyright (c) 2019. ActiveMedia Solutions LLC
 * @author    Rustam Mamadaminov <rmamdaminov@gmail.com>
 */

namespace frontend\components;


use yii\base\InvalidConfigException;
use yii\base\Widget;
use yii\data\Pagination;
use yii\helpers\Html;
use yii\helpers\Url;

class Pager extends Widget
{
    /**
     * @var Pagination
     */
    public $pagination;
    public $buttonText;
    public $emptyText;
    public $perLoad;
    public $loadParam = 'load';
    public $options = [];
    public $hideOnSinglePage = true;

    public function init()
    {
        parent::init();
        if ($this->pagination === null) {
            throw new InvalidConfigException('The "pagination" property must be set.');
        }
        if (empty($this->buttonText)) {
            throw new InvalidConfigException('The "buttonText" property must be set.');
        }
        if (empty($this->emptyText)) {
            throw new InvalidConfigException('The "emptyText" property must be set.');
        }
        if (empty($this->perLoad)) {
            $this->perLoad = $this->pagination->getPageSize();
        }
        Html::removeCssClass($this->options, 'pagination');
        Html::addCssClass($this->options, 'btn-small');
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

        $page = $this->perLoad + $this->pagination->getPageSize();
        $options = $this->options;
        return Html::a($this->buttonText, Url::current([$this->loadParam => $page]), $options);
    }


}
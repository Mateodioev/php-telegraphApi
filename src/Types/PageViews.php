<?php

namespace Mateodioev\TelegrahApi\Types;

class PageViews extends abstractType
{
    /**
     * @var int Number of page views for the target page.
     */
    public int $views;

    public function setViews(int $views): PageViews
    {
        $this->views = $views;
        return $this;
    }
}
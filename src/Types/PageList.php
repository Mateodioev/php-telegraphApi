<?php

namespace Mateodioev\TelegrahApi\Types;

class PageList extends abstractType
{
    /**
     * @var int Total number of pages belonging to the target Telegraph account.
     */
    public int $total_count;

    /**
     * @var Page[] Requested pages of the target Telegraph account.
     */
    public array $pages = [];

    public function setTotalCount(int $total_count): PageList
    {
        $this->total_count = $total_count;
        return $this;
    }

    public function setPages(array $pages): PageList
    {
        $this->pages = $pages;
        return $this;
    }
}
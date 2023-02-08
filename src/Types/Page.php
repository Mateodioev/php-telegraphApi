<?php

namespace Mateodioev\TelegraphApi\Types;

class Page extends abstractType
{
    /**
     * @var string Path to the page.
     */
    public string $path;

    /**
     * @var string URL of the page.
     */
    public string $url;

    /**
     * @var string Title of the page.
     */
    public string $title;

    /**
     * @var string Description of the page
     */
    public string $description;

    /**
     * @var ?string Optional. Name of the author, displayed below the title.
     */
    public string|null $author_name = self::DEFAULT_PARAM;

    /**
     * @var ?string Optional. Profile link, opened when users click on the author's name below the title.  Can be any link, not necessarily to a Telegram profile or channel.
     */
    public string|null $author_url = self::DEFAULT_PARAM;

    /**
     * @var ?string Optional. Image URL of the page.
     */
    public string|null $image_url = self::DEFAULT_PARAM;

    /**
     * @var NodeElement[]|string|null Optional. Content of the page.
     */
    public ?array $content = self::DEFAULT_PARAM;

    /**
     * @var int Number of page views for the page.
     */
    public int $views;

    /**
     * @var ?bool Optional. Only returned if access_token passed. True, if the target Telegraph account can edit the page.
     */
    public ?bool $can_edit = false;

    public function setPath(string $path): Page
    {
        $this->path = $path;
        return $this;
    }

    public function setUrl(string $url): Page
    {
        $this->url = $url;
        return $this;
    }

    public function setTitle(string $title): Page
    {
        $this->title = $title;
        return $this;
    }

    public function setDescription(string $description): Page
    {
        $this->description = $description;
        return $this;
    }

    public function setAuthorName(?string $author_name): Page
    {
        $this->author_name = $author_name;
        return $this;
    }

    public function setAuthorUrl(?string $author_url): Page
    {
        $this->author_url = $author_url;
        return $this;
    }

    public function setImageUrl(?string $image_url): Page
    {
        $this->image_url = $image_url;
        return $this;
    }

    public function setContent(array|string|null $content): Page
    {
        $this->content = $content;
        return $this;
    }

    public function setViews(int $views): Page
    {
        $this->views = $views;
        return $this;
    }

    public function setCanEdit(?bool $can_edit): Page
    {
        $this->can_edit = $can_edit;
        return $this;
    }
}
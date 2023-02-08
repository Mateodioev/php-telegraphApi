<?php

namespace Mateodioev\TelegraphApi\Types;

class NodeElement extends abstractType
{
    /**
     * @var string Name of the DOM element. Available tags: a, aside, b, blockquote, br, code, em, figcaption, figure, h3, h4, hr, i, iframe, img, li, ol, p, pre, s, strong, u, ul, video.
     */
    public string $tag;

    /**
     * @var ?array Optional. Attributes of the DOM element. Key of object represents name of attribute, value represents value of attribute. Available attributes: href, src.
     */
    public ?array $attrs = self::DEFAULT_PARAM;

    /**
     * @var NodeElement[]|string|null Optional. List of child nodes for the DOM element.
     */
    public array|null|string $children = self::DEFAULT_PARAM;

    public function setTag(string $tag): NodeElement
    {
        $this->tag = $tag;
        return $this;
    }

    public function setAttrs(?array $attrs): NodeElement
    {
        $this->attrs = $attrs;
        return $this;
    }

    public function setChildren(array|string|null $children): NodeElement
    {
        $this->children = $children;
        return $this;
    }
}
<?php

namespace Mateodioev\TelegrahApi\Types;

class Account extends abstractType
{
    public string $short_name = '';
    public string $author_name = '';
    public string $author_url = '';
    public ?string $access_token = self::DEFAULT_PARAM;
    public ?string $auth_url = self::DEFAULT_PARAM;
    public ?int $page_count = self::DEFAULT_PARAM;

    public function setShortName(string $short_name): Account
    {
        $this->short_name = $short_name;
        return $this;
    }

    public function setAuthorName(string $author_name): Account
    {
        $this->author_name = $author_name;
        return $this;
    }

    public function setAuthorUrl(string $author_url): Account
    {
        $this->author_url = $author_url;
        return $this;
    }

    public function setAccessToken(?string $access_token): Account
    {
        $this->access_token = $access_token;
        return $this;
    }

    public function setAuthUrl(?string $auth_url): Account
    {
        $this->auth_url = $auth_url;
        return $this;
    }

    public function setPageCount(?int $page_count): Account
    {
        $this->page_count = $page_count;
        return $this;
    }
}
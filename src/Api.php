<?php

namespace Mateodioev\TelegraphApi;

use Mateodioev\Json\JSON;
use Mateodioev\Json\JsonDecodeException;
use Mateodioev\Request\Request;
use Mateodioev\TelegraphApi\Types\Account;
use Mateodioev\TelegraphApi\Types\Page;
use Mateodioev\Utils\Arrays;
use Mateodioev\Utils\Exceptions\RequestException;

class Api
{
    public const BASE_URL = 'https://api.telegra.ph/%s';

    /**
     * Use this method to create a new Telegraph account.
     * @param string $short_name Required. Account name, helps users with several accounts remember which they are currently using. Displayed to the user above the "Edit/Publish" button on Telegra.ph, other users don't see this name.
     * @param string|null $author_name Default author name used when creating new articles.
     * @param string|null $author_url Default profile link, opened when users click on the author's name below the title. Can be any link, not necessarily to a Telegram profile or channel.
     * @see https://telegra.ph/api#createAccount
     * @throws JsonDecodeException
     */
    public function createAccount(string $short_name, ?string $author_name = null, ?string $author_url = null): Account
    {
        $payload = $this->getPayload(compact('short_name', 'author_name', 'author_url'));

        $res = $this->send(Request::POST($this->getUrl('createAccount'), $payload));
        return $this->decode($res, Account::class);
    }

    /**
     * Use this method to update information about a Telegraph account. Pass only the parameters that you want to edit
     * @param string $access_token Required. Access token of the Telegraph account.
     * @param string|null $short_name New account name.
     * @param string|null $author_name New default author name used when creating new articles.
     * @param string|null $author_url New default profile link, opened when users click on the author's name below the title. Can be any link, not necessarily to a Telegram profile or channel.
     * @return Account Object with the default fields.
     * @see https://telegra.ph/api#editAccountInfo
     * @throws JsonDecodeException
     */
    public function editAccountInfo(string $access_token, ?string $short_name = null, ?string $author_name = null, ?string $author_url = null): Account
    {
        $payload = $this->getPayload(compact('access_token', 'short_name', 'author_name', 'author_url'));

        $response = $this->send(Request::POST($this->getUrl('editAccountInfo'), $payload));
        return $this->decode($response, Account::class);
    }

    /**
     * Use this method to get information about a Telegraph account.
     * @param string $access_token Required. Access token of the Telegraph account.
     * @param array $fields List of account fields to return. Available fields: short_name, author_name, author_url, auth_url, page_count.
     * @see https://telegra.ph/api#getAccountInfo
     * @throws JsonDecodeException
     */
    public function getAccountInfo(string $access_token, array $fields = ['short_name', 'author_name', 'author_url']): Account
    {
        $payload = $this->getPayload(compact('access_token', 'fields'));

        $response = $this->send(Request::POST($this->getUrl('getAccountInfo'), $payload));
        return $this->decode($response, Account::class);
    }

    /**
     * Use this method to revoke access_token and generate a new one, for example, if the user would like to reset all connected sessions, or you have reasons to believe the token was compromised.
     * @param string $access_token Required. Access token of the Telegraph account.
     * @see https://telegra.ph/api#revokeAccessToken
     * @throws JsonDecodeException
     */
    public function revokeAccessToken(string $access_token): Account
    {
        $response = $this->send(Request::POST($this->getUrl('revokeAccessToken'), compact('access_token')));
        return $this->decode($response, Account::class);
    }

    /**
     * Use this method to create a new Telegraph page.
     * @param string $access_token Required. Access token of the Telegraph account.
     * @param string $title Required. Page title.
     * @param string|null $author_name Author name, displayed below the article's title.
     * @param string|null $author_url Profile link, opened when users click on the author's name below the title. Can be any link, not necessarily to a Telegram profile or channel.
     * @param array $content Required. Content of the page.
     * @param bool $return_content If true, a content field will be returned in the Page object
     * @return Page
     * @see https://telegra.ph/api#createPage
     * @throws JsonDecodeException
     */
    public function createPage(string $access_token, string $title, array $content, ?string $author_name= null, ?string $author_url = null, bool $return_content = false): Page
    {
        $payload = $this->getPayload(compact('access_token', 'title', 'author_name', 'author_url', 'content', 'return_content'));
        $payload['content'] = json_encode($payload['content']);

        $response = $this->send(Request::POST($this->getUrl('createPage'), $payload));
        return $this->decode($response, Page::class);
    }

    /**
     * @throws TelegraphException
     */
    private function send(Request $request): array
    {
        try {
            return json_decode($request->run()->getBody(), true);
        } catch (RequestException $e) {
            throw new TelegraphException('Fail to send request. ' . $e->getMessage());
        }
    }

    /**
     * Generate URL
     */
    private function getUrl(string $method): string
    {
        return sprintf(self::BASE_URL, $method);
    }

    private function getPayload(array $payload): array
    {
        Arrays::DeleteEmptyKeys($payload);
        return $payload;
    }

    /**
     * @throws JsonDecodeException
     */
    private function decode(array $info, string $class): mixed
    {
        if (!$info['ok']) {
            throw new TelegraphException($info['error']);
        }

        try {
            return JSON::decodeInClass(json_encode($info['result']), $class);
        } catch (\ReflectionException $e) {
            throw new TelegraphException($e->getMessage());
        }
    }
}
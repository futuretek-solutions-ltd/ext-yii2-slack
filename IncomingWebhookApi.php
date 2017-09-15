<?php

namespace futuretek\slack;

use futuretek\slack\classes\ChatPostMessage;
use futuretek\slack\classes\SlackResponse;
use yii\base\Object;
use yii\helpers\Url;
use yii\web\Application;

/**
 * Incoming Webhooks are a simple way to post messages from external sources into Slack.
 * They make use of normal HTTP requests with a JSON payload that includes the message text
 * and some options. Message
 *
 * Attachments can also be used in Incoming Webhooks to display richly-formatted messages
 * that stand out from regular chat messages.
 *
 * Sample usage:
 * ```
 * $hook = new IncomingWebhookApi([
 *      'url' => 'https://hooks.slack.com/services/T00000000/B00000000/XXXXXXXXXXXXXXXXXXXXXXXX',
 * ]);
 * ```
 *
 * @package futuretek\slack
 * @author  Lukas Cerny <lukas.cerny@futuretek.cz>
 * @license Apache-2.0
 * @link    http://www.futuretek.cz
 */
class IncomingWebhookApi extends Object
{
    /**
     * @var string Webhook URL
     */
    public $url;

    /**
     * Send message via incoming webhook
     *
     * @param ChatPostMessage $payload
     * @return SlackResponse
     */
    public function send(ChatPostMessage $payload)
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_USERAGENT, 'FTS-Slack-Client');
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_MAXREDIRS, 10);
        curl_setopt($curl, CURLOPT_REFERER, (\Yii::$app instanceof Application ? Url::base() : ''));
        curl_setopt($curl, CURLOPT_HTTPHEADER, ['Content-Type: application/json; charset=utf-8']);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_URL, $this->url);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $payload->serialize());

        $response = curl_exec($curl);
        $obj = new SlackResponse();
        $obj->hasErrors = 200 !== (int)curl_getinfo($curl, CURLINFO_HTTP_CODE);
        $obj->error = $response;

        return $obj;
    }
}
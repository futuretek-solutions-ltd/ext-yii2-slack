<?php

namespace futuretek\slack\classes;

use yii\helpers\Json;

/**
 * Class ChatPostMessage
 *
 * @package futuretek\slack\classes
 * @author  Lukas Cerny <lukas.cerny@futuretek.cz>
 * @license Apache-2.0
 * @link    http://www.futuretek.cz
 */
class ChatPostMessage
{
    /**
     * @var string The channel to send the message to.
     * Can be a public channel, private group, IM channel, encoded ID, or a name.
     */
    public $channel;

    /**
     * @var string Actual message to send.
     * @see https://api.slack.com/docs/formatting for an explanation of formatting.
     */
    public $text;

    /**
     * @var string Name of bot that will send the message (can be any name you want).
     */
    public $username;

    /**
     * @var bool Pass message as authorized user
     */
    public $asUser;

    /**
     * Sets the emoji to use as the icon for this message (overrides icon URL).
     * You can use one of Slack's emoji's or upload your own.
     *
     * @see https://{YOURSLACKTEAMHERE}.slack.com/customize/emoji
     * @var string|null $iconEmoji Emoji to use as the icon for this message (overrides icon URL).
     */
    public $iconEmoji;

    /**
     * @var string URL to an image to use as the icon for this message.
     */
    public $iconUrl;

    /**
     * By default links to media are unfurled, but links to text content are not.
     * For more information on the differences and how to control this, see the the unfurling documentation.
     *
     * @see https://api.slack.com/docs/unfurling
     *
     * @var bool
     */
    public $unfurlLinks;

    /**
     * @var bool $unfurlMedia Pass false to disable unfurling of media content.
     * @see https://api.slack.com/docs/unfurling
     */
    public $unfurlMedia;

    /**
     * @var bool Set to true to automatically find and link channel names and usernames in the message.
     */
    public $linkNames;

    /**
     * @var string Change how messages are treated.
     * @see https://api.slack.com/docs/formatting
     */
    public $parse;

    /**
     * @var bool By default bot message text will be formatted, but attachments are not.
     * To disable formatting on a non-user message, set the mrkdwn property to false.
     */
    public $mrkdwn;

    /**
     * @var Attachment[]
     */
    public $attachments;

    /**
     * Serialize object
     *
     * @return string
     * @throws \yii\base\InvalidParamException
     */
    public function serialize()
    {
        if (strpos($this->iconEmoji, ':') !== 0) {
            $this->iconEmoji = sprintf(':%s:', $this->iconEmoji);
        }

        $attachments = [];
        foreach ($this->attachments as $attachment) {
            $attachments[] = $attachment->serialize();
        }

        return Json::encode([
            'channel' => $this->channel,
            'text' => $this->text,
            'username' => $this->username,
            'as_user' => $this->asUser,
            'icon_emoji' => $this->iconEmoji,
            'icon_url' => $this->iconUrl,
            'unfurl_links' => $this->unfurlLinks,
            'unfurl_media' => $this->unfurlMedia,
            'link_names' => $this->linkNames,
            'parse' => $this->parse,
            'attachments' => $attachments,
            'mrkdwn' => $this->mrkdwn,
        ]);
    }
}
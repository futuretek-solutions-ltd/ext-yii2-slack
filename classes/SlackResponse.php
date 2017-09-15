<?php

namespace futuretek\slack\classes;

/**
 * Class SlackResponse
 *
 * @package futuretek\slack\classes
 * @author  Lukas Cerny <lukas.cerny@futuretek.cz>
 * @license Apache-2.0
 * @link    http://www.futuretek.cz
 */
class SlackResponse
{
    /**
     * @var bool If set to true, error has occurred while performing the request
     */
    public $hasErrors;

    /**
     * @var string Error code
     */
    public $error;

    /**
     * Get error message by it's code
     *
     * @param $code string Error code
     * @return string Error message
     */
    public static function getErrorMessage($code)
    {
        switch ($code) {
            case 'invalid_payload':
                return \Yii::t('fts-yii2-slack', 'The data sent in your request cannot be understood as presented; verify your content body matches your content type and is structurally valid.');
            case 'user_not_found':
                return \Yii::t('fts-yii2-slack', 'The user used in your request does not actually exist.');
            case 'action_prohibited':
                return \Yii::t('fts-yii2-slack', 'The team associated with your request has some kind of restriction on the webhook posting in this context.');
            case 'channel_not_found':
                return \Yii::t('fts-yii2-slack', 'The channel associated with your request does not exist.');
            case 'channel_is_archived':
                return \Yii::t('fts-yii2-slack', 'The channel has been archived and doesn\'t accept further messages, even from your incoming webhook.');
            case 'rollup_error':
                return \Yii::t('fts-yii2-slack', 'Something strange and unusual happened that was likely not your fault at all.');
            case 'posting_to_general_channel_denied':
                return \Yii::t('fts-yii2-slack', 'Posting to the "#general" channel for this team is 1) restricted or 2) the creator of the same incoming webhook is not authorized to post there.');
            case 'too_many_attachments':
                return \Yii::t('fts-yii2-slack', 'A message can have a maximum of 100 attachments associated with it.');
            default:
                return \Yii::t('fts-yii2-slack', 'Unknown error occurred.');
        }
    }
}
Yii2 Slack Integration
======================

Object oriented integration to Slack Incoming WebHooks

Usage
-----

For detailed documentation see PhpDocs

```
//Create attachment
$attachment = new Attachment();
$attachment->fallback = $attachment->preText;
$attachment->title = 'Issue was resolved';
$attachment->color = Attachment::COLOR_GOOD;
$attachment->titleLink = 'http://some.url/';
$attachment->authorName = 'Issue tracker';
$attachment->authorLink = Url::to(['/'], true);

//Create some attachment fields
$field = new AttachmentField();
$field->title = 'Priority';
$field->value = 'Critical';
$field->short = true;
$attachment->fields[] = $field;

$field = new AttachmentField();
$field->title = 'Status';
$field->value = 'Resolved';
$field->short = true;
$attachment->fields[] = $field;

//Create message
$message = new ChatPostMessage();
$message->attachments[] = $attachment;
$message->iconEmoji = 'headphones2';
$message->linkNames = true;
$message->username = 'Issue tracker';
$payload->channel = '#general';

//Init Webhook and send message
$client = new IncomingWebhookApi(['url' => Yii::$app->params['slack.webhook.url']]);
$response = $client->send($message);

//Check for errors
if ($response->hasErrors) {
    Yii::warning(SlackResponse::getErrorMessage($response->error), 'slack');
}
```

<?php

namespace futuretek\slack\classes;

/**
 * Class Attachment
 *
 * @package futuretek\slack\classes
 * @author  Lukas Cerny <lukas.cerny@futuretek.cz>
 * @license Apache-2.0
 * @link    http://www.futuretek.cz
 */
class Attachment
{
    const COLOR_GOOD = 'good';
    const COLOR_WARNING = 'warning';
    const COLOR_DANGER = 'danger';

    /**
     * @var string The title is displayed as larger, bold text near the top of a message attachment.
     */
    public $title;

    /**
     * @var string By passing a valid URL in the title_link parameter (optional), the title text will be hyperlinked.
     */
    public $titleLink;

    /**
     * @var string A valid URL to an image file that will be displayed inside a message attachment. We currently
     * support the following formats: GIF, JPEG, PNG, and BMP. Large images will be resized to a maximum width
     * of 400px or a maximum height of 500px, while still maintaining the original aspect ratio.
     */
    public $imageUrl;

    /**
     * @var string A valid URL to an image file that will be displayed as a thumbnail on the right side of a message
     * attachment. We currently support the following formats: GIF, JPEG, PNG, and BMP. The thumbnail's longest
     * dimension will be scaled down to 75px while maintaining the aspect ratio of the image. The filesize of the
     * image must also be less than 500 KB. For best results, please use images that are already 75px by 75px.
     */
    public $thumbUrl;


    /**
     * @var string Small text used to display the author's name.
     */
    public $authorName;

    /**
     * @var string A valid URL that will hyperlink the author_name text mentioned above.
     * Will only work if author_name is present.
     */
    public $authorLink;

    /**
     * @var string A valid URL that displays a small 16x16px image to the left of the author_name text.
     * Will only work if author_name is present.
     */
    public $authorIcon;

    /**
     * @var string Optional text that should appear above the formatted data.
     */
    public $preText;

    /**
     * @var string This is the main text in a message attachment, and can contain standard message markup.
     * The content will automatically collapse if it contains 700+ characters or 5+ linebreaks, and will
     * display a "Show more..." link to expand the content. Links posted in the text field will not unfurl.
     */
    public $text;

    /**
     * @var string Can either be one of 'good', 'warning', 'danger', or any hex color code
     */
    public $color;

    /**
     * @var string Required text summary of the attachment that is shown by clients that understand attachments
     * but choose not to show them.
     */
    public $fallback;

    /**
     * @var string Add some brief text to help contextualize and identify an attachment. Limited to 300 characters,
     * and may be truncated further when displayed to users in environments with limited screen real estate.
     */
    public $footer;

    /**
     * @var string To render a small icon beside your footer text, provide a publicly accessible URL string in the
     * footer_icon field. You must also provide a footer for the field to be recognized. We'll render what you
     * provide at 16px by 16px. It's best to use an image that is similarly sized.
     */
    public $footerIcon;

    /**
     * @var int Does your attachment relate to something happening at a specific time? By providing the ts field
     * with an integer value in "epoch time", the attachment will display an additional timestamp value as part
     * of the attachment's footer. Use ts when referencing articles or happenings. Your message will have its
     * own timestamp when published.
     */
    public $ts;

    /**
     * @var AttachmentField[]
     */
    public $fields;

    /**
     * @var array Valid values for mrkdwn_in are: ["pretext", "text", "fields"].
     * Setting "fields" will enable markup formatting for the value of each field.
     */
    public $mrkdwnIn;

    /**
     * Serialize object
     *
     * @return array
     */
    public function serialize()
    {
        $fields = [];
        foreach ($this->fields as $field) {
            $fields[] = $field->serialize();
        }

        return [
            'title' => $this->title,
            'title_link' => $this->titleLink,
            'image_url' => $this->imageUrl,
            'thumb_url' => $this->thumbUrl,
            'author_name' => $this->authorName,
            'author_link' => $this->authorLink,
            'author_icon' => $this->authorIcon,
            'pretext' => $this->preText,
            'text' => $this->text,
            'color' => $this->color,
            'fallback' => $this->fallback,
            'footer' => $this->footer,
            'footer_icon' => $this->footerIcon,
            'ts' => $this->ts,
            'mrkdwn_in' => $this->mrkdwnIn,
            'fields' => $fields,
        ];
    }
}
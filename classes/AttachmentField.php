<?php

namespace futuretek\slack\classes;

/**
 * Class AttachmentField
 *
 * @package futuretek\slack\classes
 * @author  Lukas Cerny <lukas.cerny@futuretek.cz>
 * @license Apache-2.0
 * @link    http://www.futuretek.cz
 */
class AttachmentField
{
    /**
     * @var string Shown as a bold heading above the value text. It cannot contain markup and will be escaped for you.
     */
    public $title;

    /**
     * @var string The text value of the field. It may contain standard message markup and must be escaped as normal.
     * May be multi-line.
     */
    public $value;

    /**
     * @var bool An optional flag indicating whether the value is short enough to be displayed side-by-side with other values.
     */
    public $short = true;

    /**
     * Serialize object
     *
     * @return array
     */
    public function serialize()
    {
        return [
            'title' => $this->title,
            'value' => $this->value,
            'short' => $this->short,
        ];
    }
}
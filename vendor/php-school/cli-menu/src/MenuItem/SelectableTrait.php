<?php

namespace PhpSchool\CliMenu\MenuItem;

use PhpSchool\CliMenu\MenuStyle;
use PhpSchool\CliMenu\Util\StringUtil;

/**
 * Class SelectableTrait
 *
 * @package PhpSchool\CliMenu\MenuItem
 * @author Michael Woodward <mikeymike.mw@gmail.com>
 */
trait SelectableTrait
{
    /**
     * @var string
     */
    private $text;

    /**
     * @var bool
     */
    private $showItemExtra = false;

    /**
     * The output text for the item
     *
     * @param MenuStyle $style
     * @param bool $selected
     * @return array
     */
    public function getRows(MenuStyle $style, $selected = false)
    {
        $marker = sprintf("%s ", $style->getMarker($selected));

        $length = $style->getDisplaysExtra()
            ? $style->getContentWidth() - (mb_strlen($style->getItemExtra()) + 2)
            : $style->getContentWidth();

        $rows = explode(
            "\n",
            StringUtil::wordwrap(
                sprintf('%s%s', $marker, $this->text),
                $length,
                sprintf("\n%s", str_repeat(' ', mb_strlen($marker)))
            )
        );

        return array_map(function ($row, $key) use ($style, $marker, $length) {
            if ($key === 0) {
                return $this->showItemExtra
                    ? sprintf('%s%s  %s', $row, str_repeat(' ', $length - mb_strlen($row)), $style->getItemExtra())
                    : $row;
            }

            return $row;
        }, $rows, array_keys($rows));
    }

    /**
     * Can the item be selected
     *
     * @return bool
     */
    public function canSelect()
    {
        return true;
    }

    /**
     * @return bool
     */
    public function showsItemExtra()
    {
        return $this->showItemExtra;
    }
}

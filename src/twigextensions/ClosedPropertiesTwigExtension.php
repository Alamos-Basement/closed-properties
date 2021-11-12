<?php
/**
 * Closed Properties plugin for Craft CMS 3.x
 *
 * A upgrade from a custom plugin written in craft2
 *
 * @link      https://github.com/torreyj
 * @copyright Copyright (c) 2021 torreyj
 */

namespace alamosbasement\closedproperties\twigextensions;

use alamosbasement\closedproperties\ClosedProperties;

use Craft;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;

/**
 * Twig can be extended in many ways; you can add extra tags, filters, tests, operators,
 * global variables, and functions. You can even extend the parser itself with
 * node visitors.
 *
 * http://twig.sensiolabs.org/doc/advanced.html
 *
 * @author    torreyj
 * @package   ClosedProperties
 * @since     1.0.0
 */
class ClosedPropertiesTwigExtension extends AbstractExtension
{
    // Public Methods
    // =========================================================================

    /**
     * Returns the name of the extension.
     *
     * @return string The extension name
     */
    public function getName()
    {
        return 'ClosedProperties';
    }

    /**
     * Returns an array of Twig filters, used in Twig templates via:
     *
     *      {{ 'something' | someFilter }}
     *
     * @return array
     */
    public function getFilters()
    {
        return [
            new TwigFilter('findPhotoById', [$this, 'findPhotoById']),
            new TwigFilter('force_to_int', fn ($value) => intval($value)),
        ];
    }

    /**
     * Returns an array of Twig functions, used in Twig templates via:
     *
     *      {% set this = someFunction('something') %}
     *
    * @return array
     */
    public function getFunctions()
    {
        return [
            new TwigFunction('someFunction', [$this, 'someInternalFunction']),
        ];
    }

    /**
     * Our function called via Twig; it can do anything you want
     *
     * @param null $text
     *
     * @return string
     */
    public function someInternalFunction($text = null)
    {
        $result = $text . " in the way";

        return $result;
    }

    public function findPhotoById($photos, $id)
    {
      foreach($photos as $key => $val) {
        if ($val["id"] === $id)
          return $val;
      }
    }
}

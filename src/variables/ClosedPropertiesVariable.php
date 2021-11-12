<?php
/**
 * Closed Properties plugin for Craft CMS 3.x
 *
 * A upgrade from a custom plugin written in craft2
 *
 * @link      https://github.com/torreyj
 * @copyright Copyright (c) 2021 torreyj
 */

namespace alamosbasement\closedproperties\variables;

use alamosbasement\closedproperties\ClosedProperties;

use Craft;

/**
 * Closed Properties Variable
 *
 * Craft allows plugins to provide their own template variables, accessible from
 * the {{ craft }} global variable (e.g. {{ craft.closedProperties }}).
 *
 * https://craftcms.com/docs/plugins/variables
 *
 * @author    torreyj
 * @package   ClosedProperties
 * @since     1.0.0
 */
class ClosedPropertiesVariable
{
    // Public Methods
    // =========================================================================

    /**
     * Whatever you want to output to a Twig template can go into a Variable method.
     * You can have as many variable functions as you want.  From any Twig template,
     * call it like this:
     *
     *     {{ craft.closedProperties.exampleVariable }}
     *
     * Or, if your variable requires parameters from Twig:
     *
     *     {{ craft.closedProperties.exampleVariable(twigValue) }}
     *
     * @param null $optional
     * @return string
     */
    public function exampleVariable($optional = null)
    {
    //     $result = "And away we go to the Twig template...";
    //     if ($optional) {
    //         $result = "I'm feeling optional today...";
    //     }
    //     return $result;

        $result = ClosedProperties::$plugin->closedPropertiesService->exampleService();
        return $result;
     }


    public function getAll()
    {
        //return craft()->closedProperties->getAllClosedProperties();
        $result = ClosedProperties::$plugin->closedPropertiesService->getAllClosedProperties();
        return $result;
    }

    public function getSelected()
    {
        //return craft()->closedProperties->getSelectedClosedProperties();
        $result = ClosedProperties::$plugin->closedPropertiesService->getSelectedClosedProperties();
        return $result;
    }
}

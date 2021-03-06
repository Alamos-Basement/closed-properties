<?php
/**
 * Closed Properties plugin for Craft CMS 3.x
 *
 * A upgrade from a custom plugin written in craft2
 *
 * @link      https://github.com/torreyj
 * @copyright Copyright (c) 2021 torreyj
 */

namespace alamosbasement\closedproperties\models;

use alamosbasement\closedproperties\ClosedProperties;

use Craft;
use craft\base\Model;

/**
 * ClosedPropertiesClosedPropertiesModel Model
 *
 * Models are containers for data. Just about every time information is passed
 * between services, controllers, and templates in Craft, it’s passed via a model.
 *
 * https://craftcms.com/docs/plugins/models
 *
 * @author    torreyj
 * @package   ClosedProperties
 * @since     1.0.0
 */
class ClosedPropertiesClosedPropertiesModel extends Model
{
    // Public Properties
    // =========================================================================

    /**
     * Some model attribute
     *
     * @var string
     */
    //public $someAttribute = 'Some Default';
    protected $propId = 0;
    protected $photos = '';
    protected $order = 0;

    // Public Methods
    // =========================================================================

    /**
     * Returns the validation rules for attributes.
     *
     * Validation rules are used by [[validate()]] to check if attribute values are valid.
     * Child classes may override this method to declare different validation rules.
     *
     * More info: http://www.yiiframework.com/doc-2.0/guide-input-validation.html
     *
     * @return array
     */
    public function rules()
    {
        return [
            ['someAttribute', 'string'],
            ['someAttribute', 'default', 'value' => 'Some Default'],
        ];
    }

    //craft2 function updated
    // protected function defineAttributes()
    // {
    //     return [
    //           'propId' => AttributeType::Number,
    //           'photos' => AttributeType::String,
    //           'order' => AttributeType::Number,
    //     ];
    // }
}

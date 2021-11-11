<?php
/**
 * Closed Properties plugin for Craft CMS 3.x
 *
 * A upgrade from a custom plugin written in craft2
 *
 * @link      https://github.com/torreyj
 * @copyright Copyright (c) 2021 torreyj
 */

namespace alamosbasement\closedproperties\services;

use alamosbasement\closedproperties\ClosedProperties;
use alamosbasement\closedproperties\records\ClosedPropertiesRecord;

use Craft;
use craft\base\Component;
use craft\db\Query;
use craft\db\ActiveQueryInterface;

/**
 * ClosedPropertiesService Service
 *
 * All of your plugin’s business logic should go in services, including saving data,
 * retrieving data, etc. They provide APIs that your controllers, template variables,
 * and other plugins can interact with.
 *
 * https://craftcms.com/docs/plugins/services
 *
 * @author    torreyj
 * @package   ClosedProperties
 * @since     1.0.0
 */
class ClosedPropertiesService extends Component
{
    // Public Methods
    // =========================================================================

    /**
     * This function can literally be anything you want, and you can have as many service
     * functions as you want
     *
     * From any other plugin file, call it like this:
     *
     *     ClosedProperties::$plugin->closedPropertiesService->exampleService()
     *
     * @return mixed
     */
    public function exampleService()
    {
        $result = 'something';

        return $result;
    }

      // Get all closed properties for use in JS
      public function getAllClosedProperties()
      {
        $allProperties = json_decode(file_get_contents("../web/data/properties-sorted.json"), true);
        $closedProperties = array_filter($allProperties, function($property) {
          return $property['sale_deal_status_id'] == 3;
        });
        
        return $closedProperties;
      }

      // Get selected closed properties from database
      public function getSelectedClosedProperties()
      {
        //$selectedProperties = ClosedPropertiesRecord::model()->findAll(array());
        $selectedProperties = (new Query())
            ->from(['{{%closedproperties}}'])
            ->all();
        usort($selectedProperties, function($a, $b) {
          return $a['order'] - $b['order'];
        });

        // Decode JSON array of photo IDs
        array_map(function($val) {
          $val['photos'] = json_decode($val['photos']);
          return $val;
        }, $selectedProperties);

        return $selectedProperties;
      }

      // Save property
      public function save($model)
      {
        //$existingRecord = ClosedPropertiesRecord::model()->findByAttributes(array('propId' => $model->propId));

        $existingRecord = ClosedPropertiesRecord::find()
           ->where(['propId' => $model['propId']])
           ->one();

        if ($existingRecord) {
          $existingRecord->setAttribute('photos', $model['photos']);
          $existingRecord->save();
        } else {
          $property = new ClosedPropertiesRecord();
          $property->setAttribute('propId', $model['propId']);
          $property->setAttribute('photos', $model['photos']);
          $property->setAttribute('order', $model['order']);

          $command = Craft::$app->db->createCommand()->insert('{{%closedproperties}}', $property);
          $command->execute();
        }
      }

      // Remove property
      public function remove($id)
      {
        //$existingRecord = ClosedPropertiesRecord::model()->findByAttributes(array('propId' => $id));
        $existingRecord = ClosedPropertiesRecord::find()
           ->where(['propId' => $id])
           ->one();
        if ($existingRecord) {
          $pk = $existingRecord['id'];
          //$existingRecord->deleteByPk($pk);
          $command = Craft::$app->db->createCommand()->delete('{{%closedproperties}}', 'id = :primaryKey', [':primaryKey' => $pk]);
          $command->execute();
        }
      }

      // Reorder properties
      public function reorder($order)
      {
        for($i = 0; $i < count($order); $i++) {
          //$record = ClosedPropertiesRecord::model()->findByAttributes(array('propId' => $order[$i]));
          $record = ClosedPropertiesRecord::find()->where(['propId' => $order[$i]])->one();
          if ($record) {
            $record->setAttribute('order', $i);
            $record->save();
          }
        }
      }

}

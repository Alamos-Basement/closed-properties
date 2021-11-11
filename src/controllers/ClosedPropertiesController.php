<?php
/**
 * Closed Properties plugin for Craft CMS 3.x
 *
 * A upgrade from a custom plugin written in craft2
 *
 * @link      https://github.com/torreyj
 * @copyright Copyright (c) 2021 torreyj
 */

namespace alamosbasement\closedproperties\controllers;

use alamosbasement\closedproperties\ClosedProperties;

use Craft;
use craft\web\Controller;
use alamosbasement\closedproperties\models\ClosedPropertiesClosedPropertiesModel;

/**
 * ClosedProperties Controller
 *
 * Generally speaking, controllers are the middlemen between the front end of
 * the CP/website and your plugin’s services. They contain action methods which
 * handle individual tasks.
 *
 * A common pattern used throughout Craft involves a controller action gathering
 * post data, saving it on a model, passing the model off to a service, and then
 * responding to the request appropriately depending on the service method’s response.
 *
 * Action methods begin with the prefix “action”, followed by a description of what
 * the method does (for example, actionSaveIngredient()).
 *
 * https://craftcms.com/docs/plugins/controllers
 *
 * @author    torreyj
 * @package   ClosedProperties
 * @since     1.0.0
 */
class ClosedPropertiesController extends Controller
{

    // Protected Properties
    // =========================================================================

    /**
     * @var    bool|array Allows anonymous access to this controller's actions.
     *         The actions must be in 'kebab-case'
     * @access protected
     */
    protected $allowAnonymous = ['index', 'do-something'];

    // Public Methods
    // =========================================================================

    /**
     * Handle a request going to our plugin's index action URL,
     * e.g.: actions/closed-properties/closed-properties
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $result = 'Welcome to the ClosedPropertiesController actionIndex() method';

        return $result;
    }

    /**
     * Handle a request going to our plugin's actionDoSomething URL,
     * e.g.: actions/closed-properties/closed-properties/do-something
     *
     * @return mixed
     */
    public function actionDoSomething()
    {
        $result = 'Welcome to the ClosedPropertiesController actionDoSomething() method';

        return $result;
    }


    public function actionSave()
    {
        $this->requirePostRequest();

        $id = Craft::$app->getRequest()->getBodyParam('propId');
        $photos = Craft::$app->getRequest()->getBodyParam('photos');

        $propertyModel = new ClosedPropertiesClosedPropertiesModel;
        //$propertyModel = $propertyModel->setAttributes(['propId' => $id, 'photos' => $photos, 'order' => 2]);

        $propertyModel['propId'] = $id;
        $propertyModel['photos'] = $photos;
        $propertyModel['order'] = 3; // put it at the end

        $result = ClosedProperties::$plugin->closedPropertiesService->save($propertyModel);
        return $result;
    }

    public function actionRemove()
    {
        $this->requirePostRequest();

        $id = craft()->request->getPost('propId');

        craft()->closedProperties->remove($id);
    }

    public function actionReorder()
    {
        $this->requirePostRequest();

        $order = json_decode(craft()->request->getPost('order'));

        craft()->closedProperties->reorder($order);
    }
}

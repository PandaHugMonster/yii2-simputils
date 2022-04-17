<?php

namespace spaf\simputils\yii\traits;

use spaf\simputils\yii\base\InlineAction;
use Yii;

trait ControllerExtensionTrait {

	public function createAction($id) {
		if ($id === '') {
			$id = $this->defaultAction;
		}

		$actionMap = $this->actions();
		if (isset($actionMap[$id])) {
			return Yii::createObject($actionMap[$id], [$id, $this]);
		}

		if (preg_match('/^(?:[a-z0-9_]+-)*[a-z0-9_]+$/', $id)) {
			$methodName = 'action' . str_replace(' ', '', ucwords(str_replace('-', ' ', $id)));
			if (method_exists($this, $methodName)) {
				$method = new \ReflectionMethod($this, $methodName);
				if ($method->isPublic() && $method->getName() === $methodName) {
					return new InlineAction($id, $this, $methodName);
				}
			}
		}

		return null;
	}

}

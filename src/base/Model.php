<?php

namespace spaf\simputils\yii\base;

use spaf\simputils\traits\SimpleObjectTrait;

class Model extends \yii\base\Model {
	use SimpleObjectTrait;

	public function toArray(array $fields = [], array $expand = [], $recursive = true) {
		// FIX  Maybe should be improved
		return $this->_toArray($recursive, false, []);
	}

}

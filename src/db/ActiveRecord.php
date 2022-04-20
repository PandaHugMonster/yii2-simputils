<?php

namespace spaf\simputils\yii\db;

use spaf\simputils\traits\SimpleObjectTrait;

class ActiveRecord extends \yii\db\ActiveRecord {
	use SimpleObjectTrait;

	public function toArray(array $fields = [], array $expand = [], $recursive = true) {
		// FIX  Maybe should be improved
		return $this->_toArray($recursive, false, []);
	}

}

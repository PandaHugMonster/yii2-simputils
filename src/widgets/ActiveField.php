<?php

namespace spaf\simputils\yii\widgets;

use spaf\simputils\traits\SimpleObjectTrait;

class ActiveField extends \yii\widgets\ActiveField {
	use SimpleObjectTrait;

	public function __toString() {
		return parent::__toString(); // TODO: Change the autogenerated stub
	}

}

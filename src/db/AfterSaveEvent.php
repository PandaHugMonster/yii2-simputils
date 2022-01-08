<?php

namespace spaf\simputils\yii\db;

use spaf\simputils\traits\SimpleObjectTrait;

class AfterSaveEvent extends \yii\db\AfterSaveEvent {
	use SimpleObjectTrait;

}

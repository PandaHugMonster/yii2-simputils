<?php

namespace spaf\simputils\yii\mutex;

use spaf\simputils\traits\SimpleObjectTrait;

class PgsqlMutex extends \yii\mutex\PgsqlMutex {
	use SimpleObjectTrait;

}

<?php

namespace spaf\simputils\yii\components;

use spaf\simputils\generic\SubAppInitConfig;

class SelfSubAppInitConfig extends SubAppInitConfig {

	const SELF_NAME = 'yii2-simputils';

	public ?string $name = self::SELF_NAME;

}

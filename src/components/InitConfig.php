<?php


namespace spaf\yii\simputils\components;



class InitConfig extends \spaf\simputils\models\InitConfig {

	public function __construct(mixed ...$params) {
		$this->redefinitions = [
			DateTime::redefComponentName() => DateTime::class,
		];
		parent::__construct(...$params);
	}

}

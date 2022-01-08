<?php


namespace spaf\simputils\yii\components;



use Closure;

class InitConfig extends \spaf\simputils\models\InitConfig {

	public function __construct(?array $args = null) {
		$this->redefinitions = [
			static::REDEF_DATE_TIME => DateTime::class,
			static::REDEF_PR => Closure::fromCallable([SimpUtilsYii2DebugVarDumper::class, 'pr']),
			static::REDEF_PD => Closure::fromCallable([SimpUtilsYii2DebugVarDumper::class, 'pd']),
		];

		parent::__construct($args);
	}

}

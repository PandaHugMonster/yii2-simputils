<?php


namespace spaf\simputils\yii\components;



use Closure;
use spaf\simputils\FS;
use function realpath;

class InitConfig extends \spaf\simputils\models\InitConfig {

	public function __construct(?array $args = null) {
		// NOTE Because the whole InitConfig is being for "app" name, and we want to
		//      make sure that lib code_root and working_dir would be registered as well
		//      this is why we registering additional SubAppInitConfig.
		$self_config = new SelfSubAppInitConfig([
			'code_root' => realpath(__DIR__.'/../..'),
			'working_dir' => realpath(__DIR__.'/..'),
		]);
		$this->init_blocks[] = $self_config;

		$this->redefinitions = [
			static::REDEF_DATE_TIME => DateTime::class,
			static::REDEF_PR => Closure::fromCallable([SimpUtilsYii2DebugVarDumper::class, 'pr']),
			static::REDEF_PD => Closure::fromCallable([SimpUtilsYii2DebugVarDumper::class, 'pd']),
		];

		parent::__construct($args);
	}

	static function yiiDefinitions() {
		return require FS::data(['internal-configs', 'definitions.php'], 'yii2-simputils');
	}

}

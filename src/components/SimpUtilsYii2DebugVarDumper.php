<?php /** @noinspection ALL */


namespace spaf\simputils\yii\components;


use spaf\simputils\PHP;
use Yii;
use yii\helpers\VarDumper;
use function defined;
use const YII_ENV_PROD;

/**
 * This is not a helper, please do not use it. It's an internal component of yii2-simputils
 *
 *
 * @package spaf\yii\simputils\helpers
 */
class SimpUtilsYii2DebugVarDumper {

	/** @var int $depth Depth of printing out for VarDumper */
	public static $depth = 10;
	/** @var bool $highlight To use html highlight or not, if not set, it will be identified automatically */
	public static ?bool $highlight = null;
	/** @var bool $isDisabled Is PleaseDie functionality disabled */
	public static $isDisabled = false;
	/** @var bool $isPreventedOutputOnProd To prevent the printing out on production env (die will still happen, but no output.
	 * If you need to ignore the PleaseDie functionality at all on prod - use "isDisabled" field)
	 */
	public static $isPreventedOutputOnProd = true;

	/**
	 * Method `pr()` that uses VarDumper
	 *
	 * This method is being used to replace original `pr()` mechanisms.
	 *
	 * @param ...$data
	 *
	 */
	public static function pr(...$data) {
		if (!static::$isDisabled) {
			if (!static::$isPreventedOutputOnProd || (defined('YII_ENV') && !YII_ENV_PROD) || !defined('YII_ENV')) {
				$highlight = static::$highlight ?? !PHP::isCLI();
				foreach ($data as $item) {
					VarDumper::dump($item, static::$depth, $highlight);
					echo "\n";
				}
			}
		}
	}

	public static function pd(...$data) {
		if (!static::$isDisabled) {
			static::pr(...$data);
			\Yii::$app->end();
		}
	}

}

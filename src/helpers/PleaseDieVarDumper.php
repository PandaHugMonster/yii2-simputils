<?php /** @noinspection ALL */


namespace spaf\yii\simputils\helpers;


use Yii;
use yii\helpers\VarDumper;

/**
 * Class PleaseDieVarDumper
 * @package spaf\yii\simputils\helpers
 */
class PleaseDieVarDumper {

	/** @var int $depth Depth of printing out for VarDumper */
	public static $depth = 10;
	/** @var bool $highlight To use html highlight or not */
	public static $highlight = true;
	/** @var bool $isDisabled Is PleaseDie functionality disabled */
	public static $isDisabled = false;
	/** @var bool $isPreventedOutputOnProd To prevent the printing out on production env (die will still happen, but no output.
	 * If you need to ignore the PleaseDie functionality at all on prod - use "isDisabled" field)
	 */
	public static $isPreventedOutputOnProd = true;

	/**
	 * Method PleaseDie that uses VarDumper
	 *
	 * This method is being used to replace original pd() mechanisms.
	 *
	 * @param ...$data
	 *
	 * @throws \yii\base\ExitException
	 */
	public static function pd(...$data) {
		if (!static::$isDisabled) {
			if (!$preventOutputOnProd || !YII_ENV_PROD) {
				VarDumper::dump($data, static::$depth, static::$highlight);
			}
			Yii::$app->end();
		}
	}

}
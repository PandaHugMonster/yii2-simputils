<?php /** @noinspection ALL */


namespace spaf\yii\simputils\helpers;


use Yii;
use yii\helpers\VarDumper;

/**
 * Class PleaseDieVarDumper
 * @package spaf\yii\simputils\helpers
 */
class PleaseDieVarDumper {

	public static $depth = 10;
	public static $highlight = true;

	public static function pd(...$data) {
		VarDumper::dump($data, static::$depth, static::$highlight);
		Yii::$app->end();
	}

}
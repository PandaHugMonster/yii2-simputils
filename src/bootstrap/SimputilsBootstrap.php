<?php /** @noinspection ALL */


namespace spaf\yii\simputils\bootstrap;


use Closure;
use spaf\simputils\Settings;
use spaf\yii\simputils\helpers\PleaseDieVarDumper;
use yii\base\BootstrapInterface;

/**
 * Class SimputilsBootstrap
 * @package spaf\yii\simputils\bootstrap
 */
class SimputilsBootstrap implements BootstrapInterface {


	/** @var int $pdDepth Specify the required depth for VarDumper */
	public $pdDepth = 10;
	/** @var ?boolean $pdHighlight Specify highlight true or false (or use "isConsole" instead) */
	public $pdHighlight = null;
	/** @var bool $isConsole Adjust configs if needed for console output (partly can be affected by "pdHighlight") */
	public $isConsole = false;

	/**
	 * @inheritDoc
	 */
	public function bootstrap($app) {
		$highlight = is_null($this->pdHighlight)?!$this->isConsole:$this->pdHighlight;

		PleaseDieVarDumper::$depth = $this->pdDepth;
		PleaseDieVarDumper::$highlight = $highlight;

		Settings::redefine_pd(Closure::fromCallable([PleaseDieVarDumper::class, 'pd']));
	}
}
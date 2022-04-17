#!/bin/env php
<?php

use spaf\simputils\components\filters\DirExtFilter;
use spaf\simputils\components\filters\OnlyFilesFilter;
use spaf\simputils\PHP;
use function spaf\simputils\basic\dr;
use function spaf\simputils\basic\pd;

require_once '../vendor/autoload.php';

PHP::init();

$code_dir = dr('../src');

$files = $code_dir->walk(true, new DirExtFilter(extensions: 'php'), new OnlyFilesFilter);

$out_code = "<?php return [\n";

foreach ($files as $item) {
	if (
		str_contains($item->name_full, 'internal-configs')
		|| "{$item->name}.{$item->extension}" === 'basic.php'
	){
		continue;
	}
	$res = str_replace(
		'/',
		'\\',
		$item->format($code_dir->name_full, include_ext: false)
	);

	$prefix_yii = 'yii\\';
	$prefix_sut = 'spaf\\simputils\\';


	$out_code .= "\t'{$prefix_yii}{$res}' => '{$prefix_sut}{$prefix_yii}{$res}',\n";
}
$out_code .= "];\n";

// FIX  Overwriting is commented out for safety reasons.
//      Should be improved when console args will be implemented
//fl($code_dir->name_full.'/internal-configs/definitions.php')->content = $out_code;

pd($out_code);

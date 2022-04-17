<?php

namespace spaf\simputils\yii;

use Yii;

/**
 * Shortcut for "Yii::$app->user->can()"
 *
 * @param string $permissionName
 * @param array $params
 * @param bool $allowCaching
 *
 * @return bool
 * @see \yii\web\User::can()
 */
function can(string $permissionName, array $params = [], bool $allowCaching = true): bool {
	return Yii::$app->user->can($permissionName, $params, $allowCaching);
}

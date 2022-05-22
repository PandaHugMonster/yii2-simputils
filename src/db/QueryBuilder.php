<?php

namespace spaf\simputils\yii\db;

use spaf\simputils\models\DateTime;
use spaf\simputils\traits\SimpleObjectTrait;

class QueryBuilder extends \yii\db\QueryBuilder {
	use SimpleObjectTrait;

	public function update($table, $columns, $condition, &$params) {

		foreach ($columns as $key => $val) {
			if ($val instanceof DateTime) {
				$columns[$key] = $val->for_system;
			}
		}
		foreach ($params as $key => $val) {
			if ($val instanceof DateTime) {
				$params[$key] = $val->for_system;
			}
		}

		return parent::update($table, $columns, $condition, $params);
	}

}

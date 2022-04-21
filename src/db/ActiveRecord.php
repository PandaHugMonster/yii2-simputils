<?php

namespace spaf\simputils\yii\db;

use spaf\simputils\traits\SimpleObjectTrait;
use function array_flip;
use function is_null;

class ActiveRecord extends \yii\db\ActiveRecord {
	use SimpleObjectTrait;

	/**
	 * SimpUtils Normalizer/Validator functionality
	 *
	 * @return array
	 */
	protected static function attributesPreNorming() {
		return [];
	}

	public static function populateRecord($record, $row) {
		parent::populateRecord($record, $row);
		$columns = array_flip($record->attributes());
		$normalizers = static::attributesPreNorming();
		foreach ($row as $name => $value) {
			$normalizer = $normalizers[$name] ?? null;
			if (isset($columns[$name]) && isset($normalizer)) {
				/** @var ActiveRecord $record */
				$record->setAttribute($name, !is_null($value)
					?$normalizer::process($value)
					:$value);
			}
		}
	}

	public function toArray(array $fields = [], array $expand = [], $recursive = true) {
		// FIX  Maybe should be improved
		return $this->_toArray($recursive, false, []);
	}

}

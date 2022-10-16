<?php

namespace spaf\simputils\yii\db;

use ReflectionProperty;
use spaf\simputils\traits\SimpleObjectTrait;
use function array_flip;
use function array_key_exists;
use function is_null;

abstract class BaseActiveRecord extends \yii\db\BaseActiveRecord {
	use SimpleObjectTrait;

	/**
	 * SimpUtils Normalizer/Validator functionality
	 *
	 * @return array
	 */
	protected static function attributesPreNorming() {
		return [];
	}

	public function __set($name, $value) {
		$normalizer = static::attributesPreNorming()[$name] ?? null;
		$prop_relations_dependencies = new ReflectionProperty(
			'\yii\db\BaseActiveRecord', '_relationsDependencies'
		);
		$prop_relations_dependencies->setAccessible(true);
		$prop_attributes = new ReflectionProperty(
			'\yii\db\BaseActiveRecord', '_attributes'
		);
		$prop_attributes->setAccessible(true);

		if ($this->hasAttribute($name)) {
			if (
				!empty($prop_relations_dependencies->getValue($this)[$name])
				&& (!array_key_exists($name, $prop_attributes->getValue($this)) || $prop_attributes->getValue($this)[$name] !== $value)
			) {
				$this->resetDependentRelations($name);
			}
			$this->setAttribute($name, !is_null($value) && !is_null($normalizer)
				?$normalizer::process($value)
				:$value);
		} else {
			parent::__set($name, $value);
		}
		$prop_relations_dependencies->setAccessible(false);
		$prop_attributes->setAccessible(false);
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

}

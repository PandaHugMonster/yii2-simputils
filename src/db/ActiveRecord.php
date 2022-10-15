<?php

namespace spaf\simputils\yii\db;

use ReflectionProperty;
use spaf\simputils\models\DateTime;
use spaf\simputils\traits\SimpleObjectTrait;
use function array_fill_keys;
use function array_flip;
use function array_key_exists;
use function array_keys;
use function is_null;

class ActiveRecord extends \yii\db\ActiveRecord {
	use SimpleObjectTrait;

	protected function insertInternal($attributes = null) {
		if (!$this->beforeSave(true)) {
			return false;
		}
		$values = $this->getDirtyAttributes($attributes);
		foreach ($values as $col => $val) {
			if ($val instanceof DateTime) {
				$values[$col] = $val->for_system;
			}
		}
		if (($primaryKeys = static::getDb()->schema->insert(static::tableName(), $values)) === false) {
			return false;
		}
		foreach ($primaryKeys as $name => $value) {
			$id = static::getTableSchema()->columns[$name]->phpTypecast($value);
			$this->setAttribute($name, $id);
			$values[$name] = $id;
		}

		$changedAttributes = array_fill_keys(array_keys($values), null);
		$this->setOldAttributes($values);
		$this->afterSave(true, $changedAttributes);

		return true;
	}

	public static function updateAll($attributes, $condition = '', $params = []) {
		foreach ($attributes as $col => $val) {
			if ($val instanceof DateTime) {
				$attributes[$col] = $val->for_system;
			}
		}
		foreach ($params as $col => $val) {
			if ($val instanceof DateTime) {
				$params[$col] = $val->for_system;
			}
		}
		$command = static::getDb()->createCommand();
		$command->update(static::tableName(), $attributes, $condition, $params);
		return $command->execute();
	}

	/**
	 * SimpUtils Normalizer/Validator functionality
	 *
	 * @return array
	 */
	protected static function attributesPreNorming() {
		return [];
	}

	private $_relationsDependencies = [];
	private $_related = [];

	private function resetDependentRelations($attribute) {
		foreach ($this->_relationsDependencies[$attribute] as $relation) {
			unset($this->_related[$relation]);
		}
		unset($this->_relationsDependencies[$attribute]);
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

	public function toArray(array $fields = [], array $expand = [], $recursive = true) {
		// FIX  Maybe should be improved
		return $this->_toArray($recursive, false, []);
	}

}

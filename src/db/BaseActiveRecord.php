<?php

namespace spaf\simputils\yii\db;

use spaf\simputils\traits\SimpleObjectTrait;

abstract class BaseActiveRecord extends \yii\db\BaseActiveRecord {
	use SimpleObjectTrait;

	protected $_attributes = [];
	/**
	 * @var array|null old attribute values indexed by attribute names.
	 * This is `null` if the record [[isNewRecord|is new]].
	 */
	protected $_oldAttributes;
	/**
	 * @var array related models indexed by the relation names
	 */
	protected $_related = [];
	/**
	 * @var array relation names indexed by their link attributes
	 */
	protected $_relationsDependencies = [];
}

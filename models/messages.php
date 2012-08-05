<?php

class Messages_model extends Model {

	public function init() {
		$this->className  = $this->getClassName(get_class());
  }
}

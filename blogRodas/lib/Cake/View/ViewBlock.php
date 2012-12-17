<?php
/**
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @since         CakePHP(tm) v2.1
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
/**
 * @package Cake.View
 */
class ViewBlock {

/**
 * Block content.  An array of blocks indexed by name.
 *
 * @var array
 */
	protected $_blocks = array();

/**
 * The active blocks being captured.
 *
 * @var array
 */
	protected $_active = array();

/**
  * @param string $name The name of the block to capture for.
 * @return void
 */
	public function start($name) {
		$this->_active[] = $name;
		ob_start();
	}

/**
 * End a capturing block. The compliment to ViewBlock::start()
 *
 * @return void
 * @see ViewBlock::start()
 */
	public function end() {
		if (!empty($this->_active)) {
			$active = end($this->_active);
			$content = ob_get_clean();
			if (!isset($this->_blocks[$active])) {
				$this->_blocks[$active] = '';
			}
			$this->_blocks[$active] .= $content;
			array_pop($this->_active);
		}
	}

/**
 * @param string $name Name of the block
 * @param string $value The content for the block.
 * @return void
 * @throws CakeException when you use non-string values.
 */
	public function append($name, $value = null) {
		if (isset($value)) {
			if (!is_string($value)) {
				throw new CakeException(__d('cake_dev', '$value must be a string.'));
			}
			if (!isset($this->_blocks[$name])) {
				$this->_blocks[$name] = '';
			}
			$this->_blocks[$name] .= $value;
		} else {
			$this->start($name);
		}
	}

/**
 * Set the content for a block.  This will overwrite any
 * existing content.
 *
 * @param string $name Name of the block
 * @param string $value The content for the block.
 * @return void
 * @throws CakeException when you use non-string values.
 */
	public function set($name, $value) {
		if (!is_string($value)) {
			throw new CakeException(__d('cake_dev', 'Blocks can only contain strings.'));
		}
		$this->_blocks[$name] = $value;
	}

/**
 * Get the content for a block.
 *
 * @param string $name Name of the block
 * @return The block content or '' if the block does not exist.
 */
	public function get($name) {
		if (!isset($this->_blocks[$name])) {
			return '';
		}
		return $this->_blocks[$name];
	}

/**
 * Get the names of all the existing blocks.
 *
 * @return array An array containing the blocks.
 */
	public function keys() {
		return array_keys($this->_blocks);
	}

/**
 * Get the name of the currently open block.
 *
 * @return mixed Either null or the name of the last open block.
 */
	public function active() {
		return end($this->_active);
	}

/**
 * Get the names of the unclosed/active blocks.
 *
 * @return array An array of unclosed blocks.
 */
	public function unclosed() {
		return $this->_active;
	}

}

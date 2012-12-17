<?php
/**
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       Cake.Console.Templates.default.classes
 * @since         CakePHP(tm) v 1.3
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
?>
<?php echo '<?php' . "\n"; ?>
/**
 * <?php echo $model; ?>Fixture
 *
 */
class <?php echo $model; ?>Fixture extends CakeTestFixture {

<?php if ($table): ?>
/**
 * Table name
 *
 * @var string
 */
	public $table = '<?php echo $table; ?>';

<?php endif; ?>
<?php if ($import): ?>
/**
 * Import
 *
 * @var array
 */
	public $import = <?php echo $import; ?>;

<?php endif; ?>
<?php if ($schema): ?>
/**
 * Fields
 *
 * @var array
 */
	public $fields = <?php echo $schema; ?>;

<?php endif; ?>
<?php if ($records): ?>
/**
 * Records
 *
 * @var array
 */
	public $records = <?php echo $records; ?>;

<?php endif; ?>
}

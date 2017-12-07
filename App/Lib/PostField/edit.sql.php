<?php

$defaultvalue = isset($_POST['setting']['defaultvalue']) ? $_POST['setting']['defaultvalue'] : '';
$comment = isset($_POST['info']['comment']) ? addslashes($_POST['info']['comment']) : '';
$minnumber = isset($_POST['setting']['minnumber']) ? $_POST['setting']['minnumber'] : 1;
$decimaldigits = isset($_POST['setting']['decimaldigits']) ? $_POST['setting']['decimaldigits'] : '';

switch($field_type) {
	case 'varchar':
		if(!$maxlength) $maxlength = 255;
		$maxlength = min($maxlength, 255);
		$fieldtype = $issystem ? 'CHAR' : 'VARCHAR';

		$sql = "ALTER TABLE `$tablename` CHANGE `$oldfield` `$field` $fieldtype( $maxlength ) NOT NULL DEFAULT '$defaultvalue' COMMENT '{$comment}'";
		$this->db->execute($sql);
	break;

	case 'tinyint':
		$minnumber = intval($minnumber);
		$defaultvalue = intval($defaultvalue);
		$this->db->execute("ALTER TABLE `$tablename` CHANGE `$oldfield` `$field` TINYINT ".($minnumber >= 0 ? 'UNSIGNED' : '')." NOT NULL DEFAULT '$defaultvalue' COMMENT '{$comment}'");
	break;

	case 'number':
		$minnumber = intval($minnumber);
		$defaultvalue = $decimaldigits == 0 ? intval($defaultvalue) : floatval($defaultvalue);
		$sql = "ALTER TABLE `$tablename` CHANGE `$oldfield` `$field` ".($decimaldigits == 0 ? 'INT' : 'FLOAT')." ".($minnumber >= 0 ? 'UNSIGNED' : '')." NOT NULL DEFAULT '$defaultvalue' COMMENT '{$comment}'";
		$this->db->execute($sql);
	break;

	case 'smallint':
		$minnumber = intval($minnumber);
		$defaultvalue = intval($defaultvalue);
		$this->db->execute("ALTER TABLE `$tablename` CHANGE `$oldfield` `$field` SMALLINT ".($minnumber >= 0 ? 'UNSIGNED' : '')." NOT NULL DEFAULT '$defaultvalue' COMMENT '{$comment}'");
	break;

	case 'mediumint':
		$minnumber = intval($minnumber);
		$defaultvalue = intval($defaultvalue);
		$this->db->execute("ALTER TABLE `$tablename` CHANGE `$oldfield` `$field` MEDIUMINT ".($minnumber >= 0 ? 'UNSIGNED' : '')." NOT NULL DEFAULT '$defaultvalue' COMMENT '{$comment}'");
	break;


	case 'int':
		$minnumber = intval($minnumber);
		$defaultvalue = intval($defaultvalue);
		$this->db->execute("ALTER TABLE `$tablename` CHANGE `$oldfield` `$field` INT ".($minnumber >= 0 ? 'UNSIGNED' : '')." NOT NULL DEFAULT '$defaultvalue' COMMENT '{$comment}'");
	break;

	case 'mediumtext':
		$this->db->execute("ALTER TABLE `$tablename` CHANGE `$oldfield` `$field` MEDIUMTEXT NOT NULL COMMENT '{$comment}'");
	break;

	case 'text':
		$this->db->execute("ALTER TABLE `$tablename` CHANGE `$oldfield` `$field` TEXT NOT NULL COMMENT '{$comment}'");
	break;

	case 'date':
		$this->db->execute("ALTER TABLE `$tablename` CHANGE `$oldfield` `$field` DATE NOT NULL '". empty($defaultvalue) ? '1970-01-01' : $defaultvalue ."' COMMENT '{$comment}'");
	break;

	case 'datetime':
		$this->db->execute("ALTER TABLE `$tablename` CHANGE `$oldfield` `$field` DATETIME NULL '". empty($defaultvalue) ? '1970-01-01 08:00:01' : $defaultvalue ."' COMMENT '{$comment}'");
	break;

	case 'timestamp':
		$this->db->execute("ALTER TABLE `$tablename` CHANGE `$oldfield` `$field` TIMESTAMP NOT NULL '". empty($defaultvalue) ? '1970-01-01 08:00:01' : $defaultvalue ."' COMMENT '{$comment}'");
	break;

	case 'readpoint':
		$defaultvalue = intval($defaultvalue);
		$this->db->execute("ALTER TABLE `$tablename` CHANGE `$oldfield` `$field` smallint(5) unsigned NOT NULL default '$defaultvalue' COMMENT '{$comment}'");
	break;

}
?>
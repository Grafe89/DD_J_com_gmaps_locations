<?php
/**
 * @version    1-1-0-0 // Y-m-d 2017-03-08
 * @author     HR IT-Solutions Florian Häusler https://www.hr-it-solutions.com
 * @copyright  Copyright (C) 2011 - 2017 Didldu e.K. | HR IT-Solutions
 * @license    http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
**/

defined('_JEXEC') or die;

class DD_GMaps_LocationsTableLocation extends JTable
{

	public function __construct($table, $key, JDatabaseDriver $db)
	{
		parent::__construct($table, $key, $db);
	}

	public function bind($src, $ignore = array())
	{
		return parent::bind($src, $ignore); // TODO: Change the autogenerated stub
	}

	public function store($updateNulls = false)
	{
		return parent::store($updateNulls); // TODO: Change the autogenerated stub
	}
	
}
<?php
/**
*
* @package Usermap v1.2.5
* @copyright (c) 2020 - 2024 Mike-on-Tour
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace mot\usermap\includes;

class functions_usermap
{
	const MOT_USERMAP_MOVE_UP = 1;
	const MOT_USERMAP_MOVE_DOWN = 2;
	const MOT_USERMAP_POI_NONECHARS = ['"', "'", ';', ':', '#', '*', '´', '`', '/', '(', ')', '{', '}', '[', ']', '=', '!', '?', '§', '$', '%', '&'];

	/** @var \phpbb\db\driver\driver_interface */
	protected $db;

	/** @var string mot.usermap.tables.usermap_layers */
	protected $mot_usermap_layer_table;

	public function __construct(\phpbb\db\driver\driver_interface $db, $mot_usermap_layer_table)
	{
		$this->db = $db;
		$this->usermap_layer_table = $mot_usermap_layer_table;
	}


	/*
	 * Generate back link for main controller
	 * @param	$u_action
	 *		$language	language variable
	 *
	 * @return	string
	 */
	public function usermap_back_link($u_action, $lang_str)
	{
		return '<br><br><a href="' . $u_action . '">&laquo; ' . $lang_str . '</a>';
	}

	/*
	* Searches a given directory for all files (no subdirectories)
	*
	* @params	string	$dir	contaioning the path to the directory to search in_array
	*
	* @return	array		the names of all files found as array of strings
	*/
	public function get_icons($dir)
	{
		$return = [];
		$path = scandir($dir);

		foreach ($path as $element)
		{
			if (is_file ($dir . '/' . $element))
			{
				$return[] = $element;
			}
		}

		return $return;
	}

	/*
	* Gets the current maximum number of layers within a certan layer type
	*
	* @params	int	$type	number of the desired layer type
	*
	* @return	int			total number of current layers
	*/
	public function get_layer_count($type)
	{
		$count_query = "SELECT COUNT(layer_id) AS 'layer_count' FROM " . $this->usermap_layer_table . "
						WHERE layer_type = " . (int) $type;
		$result = $this->db->sql_query($count_query);
		$layer_count = $this->db->sql_fetchfield('layer_count');
		$this->db->sql_freeresult($result);
		return $layer_count;
	}

	/*
	* Moves all layers beneath a given position one position up
	*
	* @params	int		$id		layer_id of the layer to be deleted
	*		int		$type	layer_type from the layers table
	*		int		$position	current position of the layer to be deleted
	*
	* @return	nil
	*/
	public function delete_layer($id, $type, $position)
	{
		// Set all positions following the given one to one position less (move them all up)
		$sql = 'UPDATE ' . $this->usermap_layer_table . '
				SET layer_position = layer_position - 1
				WHERE layer_position > ' . (int) $position . '
				AND layer_type = ' . (int) $type;
		$this->db->sql_query($sql);
		// Now we can delete the layer identified by its id
		$sql = 'DELETE FROM ' . $this->usermap_layer_table . '
				WHERE layer_id = ' . (int) $id;
		$this->db->sql_query($sql);
	}

	/*
	* Moves a layer in the ACP layers tab one position up or down
	*
	* @params	int		$id		layer_id from the layers table
	*		int		$type	layer_type from the layers table
	*		int		$position	the layer's current position
	*		string	$direction	either 'up' od 'down'
	*
	* @return	nil
	*/
	public function move_layer_vertically($id, $type, $position, $direction)
	{
		if ($direction == self::MOT_USERMAP_MOVE_UP)
		{
			$new_position = $position - 1;
		}
		if ($direction == self::MOT_USERMAP_MOVE_DOWN)
		{
			$new_position = $position + 1;
		}
		$sql = 'SELECT layer_id FROM ' . $this->usermap_layer_table . '
				WHERE layer_position = ' . (int) $new_position . '
				AND layer_type = ' . (int) $type;
		$result = $this->db->sql_query($sql);
		$id_up = $this->db->sql_fetchrow($result);
		$this->db->sql_freeresult($result);

		// Set new position for selected layer
		$sql = 'UPDATE ' . $this->usermap_layer_table . '
				SET layer_position = ' . $new_position . '
				WHERE layer_id = ' . (int) $id;
		$this->db->sql_query($sql);

		// Set new position for the layer currently above
		$sql = 'UPDATE ' . $this->usermap_layer_table . '
				SET layer_position = ' . $position . '
				WHERE layer_id = ' . (int) $id_up['layer_id'];
		$this->db->sql_query($sql);
	}

	/*
	* Gets all sub-directories within the given directory
	*
	* @params	string	$dir		the directory within to search
	*
	* @return	array		$return	array with all sub-directories within $dir without '/.' and '/..'
	*/
	public function dir_counter($dir)
	{
		$return = [];
		$path = scandir($dir);

		foreach ($path as $element)
		{
			if ($element != '.' && $element != '..' && is_dir ($dir.'/'.$element))
			{
				$return[] = $element;
			}
		}

		return $return;
	}
}

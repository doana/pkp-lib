<?php

/**
 * @file controllers/grid/files/LibraryFileGridCellProvider.inc.php
 *
 * Copyright (c) 2014 Simon Fraser University Library
 * Copyright (c) 2003-2014 John Willinsky
 * Distributed under the GNU GPL v2. For full terms see the file docs/COPYING.
 *
 * @class LibraryFileGridCellProvider
 * @ingroup controllers_grid_settings_library
 *
 * @brief Subclass for a LibraryFile grid column's cell provider
 */

import('lib.pkp.classes.controllers.grid.GridCellProvider');

class LibraryFileGridCellProvider extends GridCellProvider {
	/**
	 * Constructor
	 */
	function LibraryFileGridCellProvider() {
		parent::GridCellProvider();
	}

	/**
	 * Extracts variables for a given column from a data element
	 * so that they may be assigned to template before rendering.
	 * @param $row GridRow
	 * @param $column GridColumn
	 * @return array
	 */
	function getTemplateVarsFromRowColumn($row, $column) {
		$element =& $row->getData();
		$columnId = $column->getId();
		assert(is_a($element, 'DataObject') && !empty($columnId));
		switch ($columnId) {
			case 'files':
				// handled by our link action.
				return array('label' => '');
		}
	}

	/**
	 * Get cell actions associated with this row/column combination
	 * @param $row GridRow
	 * @param $column GridColumn
	 * @return array an array of LinkAction instances
	 */
	function getCellActions($request, $row, $column, $position = GRID_ACTION_POSITION_DEFAULT) {

		$columnId = $column->getId();
		$element = $row->getData();

		$cellActions = array();

		switch ($columnId) {
			case 'files':
				assert(is_a($element, 'LibraryFile'));
				// Create the cell action to download a file.
				import('lib.pkp.controllers.api.file.linkAction.DownloadLibraryFileLinkAction');
				$cellActions[] = new DownloadLibraryFileLinkAction($request, $element);
		}

		return $cellActions;
	}
}


?>

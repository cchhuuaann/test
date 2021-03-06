<?php
/* -----------------------------------------------------------------------------------------
   VamCart - http://vamcart.com
   -----------------------------------------------------------------------------------------
   Copyright (c) 2011 VamSoft Ltd.
   License - http://vamcart.com/license.html
   ---------------------------------------------------------------------------------------*/

echo $this->Admin->ShowPageHeaderStart($current_crumb, 'tags.png');

echo '<table class="contentTable">';

echo $this->Html->tableHeaders(array( __('Title'),'&nbsp;'));

foreach($files AS $tag)
{

	if(($tag[0] == 'function') || ($tag[0] == 'block'))
	{
		if((isset($tag['template']))&&($tag['template'] == 1))
			$import_link = "";
			//$import_link = $this->Html->image('admin/icons/import.png');
		else
			$import_link = "";
		
		echo $this->Admin->TableCells(array(
			$this->Html->link($tag[1],'/tags/admin_view/' . $tag[0] . '/' . $tag[1]),
			$import_link
		));
	}
}

echo '</table>';

echo $this->Admin->linkButton(__('Add module'), '/tags/admin_add/', 'add.png', array('escape' => false, 'class' => 'button'));

echo $this->Admin->ShowPageHeaderEnd();

?>
<?php
/* -----------------------------------------------------------------------------------------
   VamCart - http://vamcart.com
   -----------------------------------------------------------------------------------------
   Copyright (c) 2011 VamSoft Ltd.
   License - http://vamcart.com/license.html
   ---------------------------------------------------------------------------------------*/

echo $this->Html->script('selectall', array('inline' => false));

echo $this->Admin->ShowPageHeaderStart($current_crumb, 'user-tags.png');

echo $this->Form->create('UserTag', array('action' => '/UserTags/admin_modify_selected/', 'url' => '/UserTags/admin_modify_selected/'));

echo '<table class="contentTable">';
echo $this->Html->tableHeaders(array( __('Title'), __('Call (Template Placeholder)'), __('Action'), '<input type="checkbox" onclick="checkAll(this)" />'));

foreach ($user_tags AS $UserTag)
{
	echo $this->Admin->TableCells(
		  array(
			$this->Html->link($UserTag['UserTag']['name'],'/user_tags/admin_edit/' . $UserTag['UserTag']['id']),
			'{user_tag alias=\'' . $UserTag['UserTag']['alias'] . '\'}',
			array($this->Admin->ActionButton('edit','/user_tags/admin_edit/' . $UserTag['UserTag']['id'],__('Edit')) . $this->Admin->ActionButton('delete','/user_tags/admin_delete/' . $UserTag['UserTag']['id'],__('Delete')), array('align'=>'center')),
			array($this->Form->checkbox('modify][', array('value' => $UserTag['UserTag']['id'])), array('align'=>'center'))
		   ));
}
echo '</table>';

echo $this->Admin->ActionBar(array('delete'=>__('Delete')));
echo $this->Form->end(); 

echo $this->Admin->ShowPageHeaderEnd();

?>
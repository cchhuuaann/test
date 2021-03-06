<?php
/* -----------------------------------------------------------------------------------------
   VamCart - http://vamcart.com
   -----------------------------------------------------------------------------------------
   Copyright (c) 2011 VamSoft Ltd.
   License - http://vamcart.com/license.html
   ---------------------------------------------------------------------------------------*/

echo $this->Admin->ShowPageHeaderStart($current_crumb, 'defined.png');

echo '<table class="contentTable">';
echo $this->Html->tableHeaders(array( __('Title'), __('Call (Template Placeholder)'),__('Action')));

foreach ($defined_languages AS $defined_language)
{
	echo $this->Admin->TableCells(
		  array(
			$this->Html->link($defined_language['DefinedLanguage']['key'],'/defined_languages/admin_edit/' . $defined_language['DefinedLanguage']['key']),
			'{lang}' . $defined_language['DefinedLanguage']['key'] . '{/lang}',
			array($this->Admin->ActionButton('edit','/defined_languages/admin_edit/' . $defined_language['DefinedLanguage']['key'],__('Edit')) . $this->Admin->ActionButton('delete','/defined_languages/admin_delete/' . $defined_language['DefinedLanguage']['key'],__('Delete')), array('align'=>'center'))
		   ));
}
echo '</table>';
echo $this->Admin->EmptyResults($defined_languages);

echo $this->Admin->CreateNewLink();
echo $this->Admin->CreateExportLink();
echo $this->Admin->CreateImportLink();

echo $this->Admin->ShowPageHeaderEnd();

?>
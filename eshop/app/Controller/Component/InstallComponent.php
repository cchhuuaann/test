<?php 
/* -----------------------------------------------------------------------------------------
   VamCart - http://vamcart.com
   -----------------------------------------------------------------------------------------
   Copyright (c) 2011 VamSoft Ltd.
   License - http://vamcart.com/license.html
   ---------------------------------------------------------------------------------------*/

class InstallComponent extends Object 
{
    public $components = array('Session','Smarty');

	public function beforeFilter ()
	{
	}

	public function initialize(Controller $controller) {
	}
    
	public function startup(Controller $controller) {
	}

	public function shutdown(Controller $controller) {
	}
    
	public function beforeRender(Controller $controller){
	}

	public function beforeRedirect(Controller $controller){
	}

	public function getVersion ()
	{
		$version = file_get_contents(WWW_ROOT . 'version.txt');
		return $version;
	}
	
    public function begin_install ()
    {

    }
	
	
	
}
?>
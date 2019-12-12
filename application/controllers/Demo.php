<?php 

class Demo extends Admin_Controller 
{
	public function datatable($value='')
	{
		$this->data=array();
		$this->render_template('category/datatable', $this->data);
	}
}




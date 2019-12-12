<?php
class Csv_import_model extends CI_Model
{
	function select()
	{
		$this->db->order_by('id', 'DESC');
		$query = $this->db->get('products');
		return $query;
	}

	function is_present($pro_code)
	{
		return $this->db->get_where('products', array('product_code =' => $pro_code))->num_rows();
		//return $query;
	}

	function insert($data)
	{
	   // print_r($data);exit;
		$this->db->insert_batch('products',$data);

		return 1;
	}

	function update($data)
	{
		$this->db->update_batch('products',$data,'id');

		return 1;
	}

	function isDuplicate_product($data)
	{
		foreach ($data as $row) {
			$pro_code=$row['product_code'];
			if($this->is_present($pro_code)>0){$dup_pro_code[]=$pro_code;}}
		if(empty($dup_pro_code)){return true;}else{return false;}
	}
}

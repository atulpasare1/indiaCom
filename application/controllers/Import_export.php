<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Import_export extends CI_Controller {

function __construct()
{
   
    parent::__construct();
    $this->load->database();

    $this->load->library('cart');
    $this->load->model('Csv_import_model');
    //$this->load->model('hd_cart');
}

function index()
{
     header("Access-Control-Allow-Origin: *");

                                $this->load->database();
                    $this->load->model('hd_model');
                    header("Access-Control-Allow-Origin: *");
                    $data = array();
                    $this->template->set('title', 'Bulk Product Import');
                    $this->template->load('default_layout', 'contents' , 'admin/csv/view_csv', $data);
 
}

public function demo_csv_ghya()
{
                      $this->load->dbutil();
                      $this->load->database();
                    extract($_GET);
                      $query = "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE `TABLE_SCHEMA`='smile_final' AND  TABLE_NAME = '$data'";
                      $result = $this->db->query($query);
                      $res= $result->result();                         
                      foreach($res as $data){$colum[]= $data->COLUMN_NAME; }                 
                      header('Content-Type: text/csv');
                      header('Content-Disposition: attachment; filename="sample.csv"');
                      $fp = fopen('php://output', 'wb'); 
                      fputcsv($fp,$colum);
                      fclose($fp);
                     
                     
       
  }

   public function import()
    {
    
        $this->load->library('Csvimport');
        $file_data = $this->csvimport->get_array($_FILES["csv_file"]["tmp_name"]);
        
        $data=array();
        foreach($file_data as $row)
        {     
            if($row['is_new_arrival']=='Yes' ||$row['is_bestseller']=='Yes' ||$row['is_trending_item']=='Yes' ||$row['is_mostly_viewed']=='Yes' ||$row['is_most_discounted']=='Yes'){
               $is_item=1;
            }else{
               $is_item=0;
            }
            
            if($row['status']=='Active'){
                $status=1;
            }else{
                $status=0;
            }
            
            $data[] = array(
                'product_code'=>  isset($row["product_code"]) ? $row["product_code"] : '' ,
                'product_name' =>  isset($row["product_name"]) ? $row["product_name"] : '' ,
                'product_subcat'     =>  isset($row["product_subcat"]) ? $row["product_subcat"] : '' ,
                'product_childcat'     =>  isset($row["product_childcat"]) ? $row["product_childcat"] : '' ,
                'short_description'=>  isset($row["short_description"]) ? $row["short_description"] : '' ,
                'description' =>  isset($row["description"]) ? $row["description"] : '' ,
                'avail_since'     =>  isset($row["avail_since"]) ? $row["avail_since"] : '' ,
                'in_stock'     =>  isset($row["in_stock"]) ? $row["in_stock"] : 0 ,
                'cus_order_min_qty'=>  isset($row["cus_order_min_qty"]) ? $row["cus_order_min_qty"] : 0 ,
                'cus_order_max_qty' =>  isset($row["cus_order_max_qty"]) ? $row["cus_order_max_qty"] : 0 ,
                'whs_order_max_qty'     =>  isset($row["whs_order_max_qty"]) ? $row["whs_order_max_qty"] : 0 ,
                'shk_order_min_qty'     =>  isset($row["shk_order_min_qty"]) ? $row["shk_order_min_qty"] : 0 ,
                'shk_order_max_qty' => isset($row["shk_order_max_qty"]) ? $row["shk_order_max_qty"] : 0 ,
                'product_weight' => isset($row["product_weight"]) ? $row["product_weight"] : 0 ,
                'product_height' => isset($row["product_height"]) ? $row["product_height"] : 0 ,
                'product_length' => isset($row["product_length"]) ? $row["product_length"] : 0 ,
                'box_length' => isset($row["box_length"]) ? $row["box_length"] : 0 ,
                'box_height' => isset($row["box_height"]) ? $row["box_height"] : 0 ,
                'box_width' => isset($row["box_width"]) ? $row["box_width"] : 0 ,
               
                'purchase_price' => isset($row["purchase_price"]) ? $row["purchase_price"] : 0 ,
                'items_in_box' => isset($row["items_in_box"]) ? $row["items_in_box"] : '' ,
                'mrp'          => isset($row["mrp"]) ? $row["mrp"] : 0 ,
                'cus_price' => isset($row["cus_price"]) ? $row["cus_price"] : 0 ,
                'whs_price' => isset($row["whs_price"]) ? $row["whs_price"] : 0 ,
                'shk_price' => isset($row["shk_price"]) ? $row["shk_price"] : 0 ,
                 'whs_mrp_tax_in' => isset($row["whs_mrp_tax_in"]) ? $row["whs_mrp_tax_in"] : 0 ,
                'shk_mrp_tax_in' => isset($row["shk_mrp_tax_in"]) ? $row["shk_mrp_tax_in"] : 0 ,
                'cus_mrp_tax_in' => isset($row["cus_mrp_tax_in"]) ? $row["cus_mrp_tax_in"] : 0 ,
                'tax_id' => isset($row["tax_id"]) ? $row["tax_id"] : '' ,
                'product_discount' => isset($row["product_discount"]) ? $row["product_discount"] : 0 ,
                'seo_title' => isset($row["seo_title"]) ? $row["seo_title"] : '' ,
                'seo_description' => isset($row["seo_description"]) ? $row["seo_description"] : '' ,
                'seo_keyword'=> isset($row["seo_keyword"]) ? $row["seo_keyword"] : '' ,
                'primary_img' => isset($row["primary_img"]) ? $row["primary_img"] : '' ,
                'add_img1' => isset($row["add_img1"]) ? $row["add_img1"] : '' ,
                'add_img2' => isset($row["add_img2"]) ? $row["add_img2"] : '' ,
                'add_img3' => isset($row["add_img3"]) ? $row["add_img3"] : '' ,
                'add_img4' => isset($row["add_img4"]) ? $row["add_img4"] : '' ,
                'is_new_arrival' => $is_item ,
                'add_img4' => $is_item,
                'is_bestseller' => $is_item ,
                'is_trending_item' => $is_item ,
                'is_mostly_viewed' => $is_item ,
                'is_most_discounted' => $is_item ,
                 'status' => $status 
                 );
        
         
        }

         $is_dupli=$this->Csv_import_model->isDuplicate_product($data);
          $is_inserted = ($is_dupli==true) ? $this->Csv_import_model->insert($data) : 'b' ;
          echo $retVal =($is_inserted=='b') ? 0 : 1 ;
       
      
    
      }
  }

?>
<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mod_collection extends CI_Model{
	private $artisan = 'artisan';
	private $artisan_album = 'artisan_album';
	private $article = 'article';
	private $article_type = 'article_type';
	private $collection = 'collection';
	private $collection_artisan = 'collection_artisan';
	private $collection_enterprise = 'collection_enterprise';
	private $collection_product = 'collection_product';
	private $enterprise = 'enterprise';
	private $enterprise_album = 'enterprise_album';
	private $product = 'product';
	private $product_album = 'product_album';
	
	function get_collection_carousel($collection_id=0, $type=NULL, $id=NULL) {
        $sql_query = "
            SELECT 
                at.article_type as article_type, p.product_id as id, p.product_name as name, pa.product_image as image
            FROM {$this->collection} AS c
            JOIN {$this->collection_product} AS cp ON cp.collection_id = c.collection_id
            JOIN {$this->product} AS p ON p.product_id = cp.product_id
            JOIN {$this->product_album} AS pa ON pa.product_id = p.product_id
            JOIN {$this->article} AS a ON a.article_id = p.article_id
            JOIN {$this->article_type} AS at ON at.article_type_id = a.article_type_id
            WHERE 
                c.collection_status = 1
				AND a.article_status = 1
                AND p.product_status = 1
                AND pa.is_primary = 1
				PRODUCT_EXCLUSION
                AND c.collection_id = {$collection_id}

            UNION ALL

            SELECT 
                at.article_type as article_type, ar.artisan_id as id, ar.artisan_name as name, aa.artisan_image as image
            FROM {$this->collection} AS c
            JOIN {$this->collection_artisan} AS ca ON ca.collection_id = c.collection_id
            JOIN {$this->artisan} AS ar ON ar.artisan_id = ca.artisan_id
            JOIN {$this->artisan_album} AS aa ON aa.artisan_id = ar.artisan_id
            JOIN {$this->article} AS a ON a.article_id = ar.article_id
            JOIN {$this->article_type} AS at ON at.article_type_id = a.article_type_id
            WHERE 
                c.collection_status = 1
				AND a.article_status = 1
                AND ar.artisan_status = 1
                AND aa.is_primary = 1
				ARTISAN_EXCLUSION
                AND c.collection_id = {$collection_id}

            UNION ALL

            SELECT 
                at.article_type as article_type, e.enterprise_id as id, e.enterprise_name as name, ea.enterprise_image as image
            FROM {$this->collection} AS c
            JOIN {$this->collection_enterprise} AS ce ON ce.collection_id = c.collection_id
            JOIN {$this->enterprise} AS e ON e.enterprise_id = ce.enterprise_id
            JOIN {$this->enterprise_album} AS ea ON ea.enterprise_id = e.enterprise_id
            JOIN {$this->article} AS a ON a.article_id = e.article_id
            JOIN {$this->article_type} AS at ON at.article_type_id = a.article_type_id
            WHERE
                c.collection_status = 1
				AND a.article_status = 1
                AND e.enterprise_status = 1
                AND ea.is_primary = 1
				ENTERPRISE_EXCLUSION
                AND c.collection_id = {$collection_id};
        ";
		
		$product_replace = "";
		$artisan_replace = "";
		$enterprise_replace = "";
		if ($type == "product" && !empty($id)) $product_replace = "AND p.product_id <> {$id}";
		if ($type == "artisan" && !empty($id)) $artisan_replace = "AND ar.artisan_id <> {$id}";
		if ($type == "enterprise" && !empty($id)) $enterprise_replace = "AND e.enterprise_id <> {$id}";
		
		$sql_query = str_replace("PRODUCT_EXCLUSION", $product_replace, $sql_query);
		$sql_query = str_replace("ARTISAN_EXCLUSION", $artisan_replace, $sql_query);
		$sql_query = str_replace("ENTERPRISE_EXCLUSION", $enterprise_replace, $sql_query);

		$this->db->cache_off();
		$query = $this->db->query($sql_query);		
		if($query->num_rows() > 0)
			return $query->result();
		
		return FALSE;
	}

    function get_collection_article_lists($collection_id=0) {

        $sql_query = "
            SELECT 
                c.date_created, c.collection_id, c.collection_name, a.article_id, a.article_title, article_image
            FROM {$this->collection} AS c
            JOIN {$this->collection_product} AS cp ON cp.collection_id = c.collection_id
            JOIN {$this->product} AS p ON p.product_id = cp.product_id
            JOIN {$this->product_album} AS pa ON pa.product_id = p.product_id
            JOIN {$this->article} AS a ON a.article_id = p.article_id
            JOIN {$this->article_type} AS at ON at.article_type_id = a.article_type_id
            WHERE 
				c.collection_status = 1
				AND a.article_status = 1
                AND pa.is_primary = 1
                AND p.product_status = 1
                AND c.collection_id = {$collection_id}

            UNION ALL

            SELECT
                c.date_created, c.collection_id, c.collection_name, a.article_id, a.article_title, article_image
            FROM {$this->collection} AS c
            JOIN {$this->collection_artisan} AS ca ON ca.collection_id = c.collection_id
            JOIN {$this->artisan} AS ar ON ar.artisan_id = ca.artisan_id
            JOIN {$this->artisan_album} AS aa ON aa.artisan_id = ar.artisan_id
            JOIN {$this->article} AS a ON a.article_id = ar.article_id
            JOIN {$this->article_type} AS at ON at.article_type_id = a.article_type_id
            WHERE 
                c.collection_status = 1
				AND a.article_status = 1
                AND aa.is_primary = 1
                AND ar.artisan_status = 1
                AND c.collection_id = {$collection_id}

            UNION ALL

            SELECT 
                c.date_created, c.collection_id, c.collection_name, a.article_id, a.article_title, article_image
            FROM {$this->collection} AS c
            JOIN {$this->collection_enterprise} AS ce ON ce.collection_id = c.collection_id
            JOIN {$this->enterprise} AS e ON e.enterprise_id = ce.enterprise_id
            JOIN {$this->enterprise_album} AS ea ON ea.enterprise_id = e.enterprise_id
            JOIN {$this->article} AS a ON a.article_id = e.article_id
            JOIN {$this->article_type} AS at ON at.article_type_id = a.article_type_id
            WHERE 
                c.collection_status = 1
			    AND a.article_status = 1
                AND ea.is_primary = 1
                AND e.enterprise_status = 1
                AND c.collection_id = {$collection_id}
			
			ORDER BY
				date_created, collection_name;
        ";

		$this->db->cache_off();
		$query = $this->db->query($sql_query);
		if($query->num_rows() > 0)
			return $query->result();

		return FALSE;
    }
		
	function get_collection_list() {
		$this->db->cache_off();
		$this->db->where('collection_status', '1');
		
		$query = $this->db->get($this->collection);		
		if($query->num_rows() > 0)
			return $query->result();
		
		return FALSE;
	}
		
	function collection_exists($collection_id, $collection_name) {
		$this->db->cache_off();		
		$this->db->select('*');
		$this->db->from($this->collection);
		$this->db->where('collection_id', $collection_id);
		$this->db->like('collection_name', $collection_name);
		
		$query = $this->db->get();		
		if($query->num_rows() > 0)
			return TRUE;
		
		return FALSE;
	}
}

<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mod_collection extends CI_Model{
	
	private $collection = 'collection';
	private $enterprise = 'enterprise';
	private $collection_enterprise = 'collection_enterprise';
	private $enterprise_album = 'enterprise_album';
	private $artisan = 'artisan';
	private $collection_artisan = 'collection_artisan';
	private $artisan_album = 'artisan_album';
	private $product = 'product';
	private $collection_product = 'collection_product';
	private $product_album = 'product_album';
	private $article = 'article';
	private $article_type = 'article_type';
	
	function getCollectionCarousel($id=NULL) {
        
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
                p.product_status = 1
                AND pa.is_primary = 1
                AND c.collection_id = {$id}

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
                ar.artisan_status = 1
                AND aa.is_primary = 1
                AND c.collection_id = {$id}

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
                e.enterprise_status = 1
                AND ea.is_primary = 1
                AND c.collection_id = {$id};
        ";

		$this->db->cache_off();
		$query = $this->db->query($sql_query);
		
		if($query->num_rows() > 0)
			return $query->result();
		
		return FALSE;
	}
	
	function getCollectionId($type=NULL, $id=NULL) {
        /*

        SELECT
            distinct(c.collection_id)
        FROM collection as c
        LEFT JOIN collection_product AS cp ON cp.collection_id = c.collection_id
        LEFT JOIN product AS p ON p.product_id = cp.product_id
        LEFT JOIN collection_artisan AS ca ON ca.collection_id = c.collection_id
        LEFT JOIN artisan AS ar ON ar.artisan_id = ca.artisan_id
        LEFT JOIN collection_enterprise AS ce ON ce.collection_id = c.collection_id
        LEFT JOIN enterprise AS e ON e.enterprise_id = ce.enterprise_id
        WHERE
            p.product_id = 1;
            ar.artisan_id = 1;
            e.enterprise_id = 1;
        */

		$this->db->cache_off();
		
		$this->db->select("{$this->collection}.collection_id as id");
		$this->db->from($this->collection);
        $this->db->join($this->collection_product, "{$this->collection_product}.collection_id = {$this->collection}.collection_id", "left");
		$this->db->join($this->product, "{$this->product}.product_id = {$this->collection_product}.product_id","left");
        $this->db->join($this->collection_artisan, "{$this->collection_artisan}.collection_id = {$this->collection}.collection_id", "left");
		$this->db->join($this->artisan, "{$this->artisan}.artisan_id = {$this->collection_artisan}.artisan_id", "left");		
        $this->db->join($this->collection_enterprise, "{$this->collection_enterprise}.collection_id = {$this->collection_enterprise}.collection_id", "left");
		$this->db->join($this->enterprise, "{$this->enterprise}.enterprise_id = {$this->collection_enterprise}.enterprise_id", "left");		

		$this->db->where("{$this->product}.product_status", 1);
		$this->db->where("{$this->artisan}.artisan_status", 1);
		$this->db->where("{$this->enterprise}.enterprise_status", 1);

        if (!is_null($id)) {
            if ($type == "product") {
                $this->db->where("{$this->product}.product_id", $id);
                $this->db->order_by("{$this->collection_product}.date_added", "DESC");
            }
            else if ($type == "artisan") {
                $this->db->where("{$this->artisan}.artisan_id", $id);
                $this->db->order_by("{$this->collection_artisan}.date_added", "DESC");
            }
            else if ($type == "enterprise") {
                $this->db->where("{$this->enterprise}.enterprise_id", $id);
                $this->db->order_by("{$this->collection_enterprise}.date_added", "DESC");
            }
		}

		$query = $this->db->get();
		
		if($query->num_rows() > 0)
			return $query->row()->id;
		
		return FALSE;
	}
	
	function getCollectionList() {
		$this->db->where('collection_status', '1');
		
		$this->db->cache_off();
		$query = $this->db->get($this->collection);
		
		if($query->num_rows() > 0)
			return $query->result();
		
		return FALSE;
	}

    function getCollectionArticleLists() {

        $sql_query = "
            SELECT 
                c.date_created, collection_name, a.article_id as id, a.article_title as title, article_image as image
            FROM {$this->collection} AS c
            JOIN {$this->collection_product} AS cp ON cp.collection_id = c.collection_id
            JOIN {$this->product} AS p ON p.product_id = cp.product_id
            JOIN {$this->product_album} AS pa ON pa.product_id = p.product_id
            JOIN {$this->article} AS a ON a.article_id = p.article_id
            JOIN {$this->article_type} AS at ON at.article_type_id = a.article_type_id
            WHERE 
                pa.is_primary = 1
                AND p.product_status = 1

            UNION ALL

            SELECT
                c.date_created, collection_name, a.article_id as id, a.article_title as title, article_image as image
            FROM {$this->collection} AS c
            JOIN {$this->collection_artisan} AS ca ON ca.collection_id = c.collection_id
            JOIN {$this->artisan} AS ar ON ar.artisan_id = ca.artisan_id
            JOIN {$this->artisan_album} AS aa ON aa.artisan_id = ar.artisan_id
            JOIN {$this->article} AS a ON a.article_id = ar.article_id
            JOIN {$this->article_type} AS at ON at.article_type_id = a.article_type_id
            WHERE 
                aa.is_primary = 1
                AND ar.artisan_status = 1

            UNION ALL

            SELECT 
                c.date_created, collection_name, a.article_id as id, a.article_title as title, article_image as image
            FROM {$this->collection} AS c
            JOIN {$this->collection_enterprise} AS ce ON ce.collection_id = c.collection_id
            JOIN {$this->enterprise} AS e ON e.enterprise_id = ce.enterprise_id
            JOIN {$this->enterprise_album} AS ea ON ea.enterprise_id = e.enterprise_id
            JOIN {$this->article} AS a ON a.article_id = e.article_id
            JOIN {$this->article_type} AS at ON at.article_type_id = a.article_type_id
            WHERE 
                ea.is_primary = 1
                AND e.enterprise_status = 1

            ORDER BY
                date_created, collection_name;
        ";

		$this->db->cache_off();
		$query = $this->db->query($sql_query);
		
		if($query->num_rows() > 0)
			return $query->result();
		
		return FALSE;
    }
}

<?php
class News_model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}
	public function get_news($id = FALSE)
	{
		if ($id === FALSE)
		{
			$query = $this->db->get('news');
			return $query->result_array();
		}

		$query = $this->db->get_where('news', array('id' => $id));
		return $query->row_array();
	}
	public function add_news()
	{
		$this->load->helper('url');

		$slug = url_title($this->input->post('title'), 'dash', TRUE);

		$data = array(
			'title' => $this->input->post('title'),
			'slug' => $slug,
			'text' => $this->input->post('text')
		);

		return $this->db->insert('news', $data);
	}
	public function delete_news($id) 
    {
        $this->db->delete('news', array('id' => $id));
    }
	public function edit($id){
		$this->db->where('id',$id);
		$query = $this->db->get('news');
		return $query->row_array();
	}
	public function update($data){
		$id = $data['id'];
		unset($data['submit']);
		$this->db->where('id',$id);
		$result = $this->db->update('news',$data);
		return $result;
	}
	
	public function record_count() {
        return $this->db->count_all("news");
    }
 
    public function fetch_news($limit, $start) {
        $this->db->limit($limit, $start);
        $query = $this->db->get("news");
 
        if ($query->num_rows() > 0) {
            return $query->result_array();;
        }
        return false;
   }
}
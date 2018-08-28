<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Weight extends CI_Controller {

	public function index()
	{
		$query = $this->db->query("SELECT	AVG(maxi) AS avmax, AVG(mini) AS avmin, AVG(varianc) AS avvar FROM weight");
		$val['dt'] = $query;
		$this->load->view('home' ,$val);
	}
	
	/*public function show_data()
	{
		$sql = $this->db->query("SELECT id, ddate, maxi, mini,varianc,'','','' FROM weight
								UNION
								SELECT '','','','','',AVG(maxi) AS avgmax, AVG(mini) AS avgmin, AVG(varianc) AS avvar FROM weight;");
		echo json_encode($sql->result());
	}*/

	public function show_data()
	{
		$sql = $this->db->query("SELECT * FROM weight");
		echo json_encode($sql->result());
	}

	public function submit(){
		$max = $this->input->post('wmax');
		$min = $this->input->post('wmin');
		$variance = $max - $min;
		$data = array('ddate' => $this->input->post('datepicker'),
					  'maxi' => $max,
					  'mini'=> $min,
					  'varianc'=>$variance);
		$this->db->insert('weight' ,$data);
	}

	public function get_date($id){
		$sql = $this->db->query("SELECT ddate FROM weight WHERE id = '$id'");
		foreach ($sql->result() as $row) {
			$arr[] = array('ddate' => $row->ddate);
		}
		$arrk = array('row'=>$arr) ;
		echo json_encode($arrk);
		//echo json_encode($sql->result());
	}
	public function get_max($id){
		$sql = $this->db->query("SELECT maxi FROM weight WHERE id = '$id'");
		echo json_encode($sql->result());
	}
	public function get_min($id){
		$sql = $this->db->query("SELECT mini FROM weight WHERE id = '$id'");
		echo json_encode($sql->result());
	}

	public function submit2($id){
		$max = $this->input->post('wmax2');
		$min = $this->input->post('wmin2');
		$variance = $max - $min;
		$data = array('ddate' => $this->input->post('datepicker2'),
					  'maxi' => $max,
					  'mini'=> $min,
					  'varianc'=>$variance);
		$this->db->where('id' ,$id);
		$this->db->update('weight' ,$data);
	}

	public function delete($id){
		$query = $this->db->query("DELETE FROM weight WHERE id='$id' ");
	}

	public function indexi()
	{
		$sql = $this->db->query("SELECT * FROM weight");
		$val['dt'] = $sql;
		$this->load->view('homey' ,$val);
	}

	public function show($id)
	{
		$query = $this->db->query("SELECT * FROM weight WHERE id = '$id' ");
		$val['dt'] = $query;
		$this->load->view('show' ,$val);
	}
}
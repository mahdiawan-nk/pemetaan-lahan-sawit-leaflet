<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 *
 * Model Pemetaan_model
 *
 * This Model for ...
 * 
 * @package		CodeIgniter
 * @category	Model
 * @author    Setiawan Jodi <jodisetiawan@fisip-untirta.ac.id>
 * @link      https://github.com/setdjod/myci-extension/
 * @param     ...
 * @return    ...
 *
 */

class Pemetaan_model extends CI_Model {

  // ------------------------------------------------------------------------
  public function show_by_id($id) {
    $this->db->where('lahan_id', $id);
    return $this->db->get('pemetaan_blok')->row_array();
  }
  public function save($data){
    return $this->db->insert('pemetaan_blok', $data);
  }

  public function update($data, $id){
    $this->db->where('lahan_id', $id);
    return $this->db->update('pemetaan_blok', $data);
  }

  // ------------------------------------------------------------------------

}

/* End of file Pemetaan_model.php */
/* Location: ./application/models/Pemetaan_model.php */
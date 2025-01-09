<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Visimisi_model extends CI_Model
{
    protected $table = 'visi_misi';
    protected $primaryKey = 'id';
    protected $fillabled = ['title', 'content'];
    public function select()
    {
        $this->db->order_by($this->primaryKey, 'ASC');
        $this->db->limit(1);
        return $this->db->get($this->table)->row();
    }

    public function update($id, $data)
    {
        $this->db->where($this->primaryKey, $id);
        return $this->db->update($this->table, $data);
    }

    public function insert($data)
    {
        return $this->db->insert($this->table, $data);
    }
}


/* End of file Visimisi_model.php and path \application\models\Visimisi_model.php */

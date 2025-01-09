<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Sejarah_model extends CI_Model
{
    protected $table = 'sejarah';

    protected $primaryKey = 'id';

    protected $fillabel = array(
        'title',
        'content'
    );

    public function __construct()
    {
        parent::__construct();
    }


    public function select()
    {
        $this->db->order_by($this->primaryKey, 'ASC');
        $this->db->limit(1);
        return $this->db->get($this->table)->row();
    }

    public function insert($data)
    {
        return $this->db->insert($this->table, $data);
    }

    public function update($id, $data)
    {
        $this->db->where($this->primaryKey, $id);
        return $this->db->update($this->table, $data);
    }
}


/* End of file Sejarah_model.php and path \application\models\Sejarah_model.php */

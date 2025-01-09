<?php 
class M_lahan extends CI_Model
{
    public function show_lahan()
    {
        $sql = $this->db->get('lahan');
        return $sql;
    }

    public function show_by_id($lahan_id)
    {
        $this->db->where('id_lahan', $lahan_id);
        $sql = $this->db->get('lahan')->row();
        return $sql;
    }

    public function insert_lahan($data)
    {
        return $this->db->insert('lahan', $data); // Make sure your table is 'users'
    }

    public function update_lahan($lahan_id, $data)
    {
        // Update the user record in the database
        $this->db->where('id_lahan', $lahan_id);
        return $this->db->update('lahan', $data);
    }

    public function delete_lahan($lahan_id)
    {
        // Delete the user record from the database
        return $this->db->delete('lahan', ['id_lahan' => $lahan_id]);
    }
}
<?php 
class M_user extends CI_Model
{
    public function show_user()
    {
        $sql = "SELECT * FROM user as u  ORDER by u.id";
        return $this->db->query($sql);
    }

    public function insert_user($data)
    {
        return $this->db->insert('user', $data); // Make sure your table is 'users'
    }

    public function update_status($user_id, $status)
    {
        // Update the user status (1 = active, 0 = inactive)
        return $this->db->update('user', ['is_aktif' => $status], ['id' => $user_id]);
    }

    public function update_user($user_id, $data)
    {
        // Update the user record in the database
        $this->db->where('id', $user_id);
        return $this->db->update('user', $data);
    }

    public function delete_user($user_id)
    {
        // Delete the user record from the database
        return $this->db->delete('user', ['id' => $user_id]);
    }
}
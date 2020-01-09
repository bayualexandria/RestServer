<?php

class Mahasiswa_model extends CI_Model 
{
    public function get($id=null)
    {
        if ($id===null) {
            
            return $this->db->get('data_mahasiswa')->result_array();
        }else {
            return $this->db->get_where('data_mahasiswa',['id'=>$id])->result_array();
        }
    }

    public function delete($id)
    {
        $this->db->delete('data_mahasiswa',['id'=>$id]);
        return $this->db->affected_rows();
    }

    public function create($data)
    {
        $this->db->insert('data_mahasiswa',$data);
        return $this->db->affected_rows();
    }

    public function update($data,$id)
    {
        $this->db->update('data_mahasiswa',$data,['id'=>$id]);
        return $this->db->affected_rows();
    }

    public function cariDataMahasiswa()
    {
        $keyword = $this->input->post('keyword', true);
        $this->db->like('nama', $keyword);
        $this->db->or_like('jurusan', $keyword);
        $this->db->or_like('nim', $keyword);
        $this->db->or_like('email', $keyword);
        return $this->db->get('mahasiswa')->result_array();
    }
}

<?php 

class M_admin extends CI_Model{	
	public $post= null;
	// model data_kategori
	function data_kategori(){		
		return $this->db->query("SELECT * FROM tb_kategori")->result_object();
	}
	
	function add_data_kategori()
	{
		return $this->db->insert('tb_kategori', ['kategori'=> $this->post['kategori'] ] );
	}
	
	function edit_data_kategori(){		
		return $this->db->query("SELECT * FROM tb_kategori WHERE id_kategori='{$this->post["id_kategori"]}' ")->result_object();
	}

	function update_data_kategori()
	{
		return $this->db->update('tb_kategori',['kategori'=>$this->post['kategori']], ['id_kategori'=>$this->post['id_kategori']]);
	}

	function delete_data_kategori()
	{
		return $this->db->delete('tb_kategori', [ 'id_kategori'=>$this->post["id_kategori"] ]);
	}
	/* end kategori produk model */

	// model produk
	function produk(){		
		return $this->db->query("
		SELECT * FROM tb_produk
			LEFT JOIN tb_kategori
				ON tb_produk.id_kategori=tb_kategori.id_kategori
		ORDER BY tb_produk.id_produk DESC
		")->result_object();
	}
	
	function store_produk()
	{
		return $this->db->insert('tb_produk', [
			'nama_produk'=> $this->post['nama_produk'],
			'deskripsi'=> $this->post['deskripsi'],
			'id_kategori'=> $this->post['id_kategori'],
			'harga'=> $this->post['harga'],
			'stok'=> $this->post['stok'],
			'gambar'=> $this->post['gambar']
		] );
	}
	
	function edit_produk(){		
		return $this->db->query("
		SELECT * FROM tb_produk
			LEFT JOIN tb_kategori
				ON tb_produk.id_kategori=tb_kategori.id_kategori
		WHERE tb_produk.id_produk='{$this->post["id_produk"]}'
		")->row();
	}

	function update_produk()
	{
		$this->data= [
			'nama_produk'=> $this->post['nama_produk'],
			'deskripsi'=> $this->post['deskripsi'],
			'id_kategori'=> $this->post['id_kategori'],
			'harga'=> $this->post['harga'],
			'stok'=> $this->post['stok']
		];
		$this->where= [
			'id_produk'=> $this->post['id_produk']
		];
		if ( ! empty($this->post['gambar']) ) {
			$this->post['gambar']= $this->post['gambar'];
		}
		return $this->db->update('tb_produk',$this->data, $this->where);
	}

	function delete_produk()
	{
		return $this->db->delete('tb_produk', [ 'id_produk'=>$this->post["id_produk"] ]);
	}
	/* end produk model */

/* ==================== Start Master Data : Admin ==================== */
	public function data_admin()
	{
		return $this->db->query("
			SELECT * FROM tb_admin
		")->result_object();
	}
	public function store_data_admin()
	{
		return $this->db->insert('tb_admin',[
			'nama'=> $this->post['nama'],
			'alamat'=> $this->post['alamat'],
			'username'=> $this->post['username'],
			'password'=> $this->post['password'],
			'no_handphone'=> $this->post['no_handphone'],
		]);
	}
	public function edit_data_admin()
	{
		return $this->db->get_where('tb_admin',['id_admin'=>$this->post['id_admin'] ])->row();
	}
	public function update_data_admin()
	{
		$data= [
			'nama'=>$this->post['nama'],
			'alamat'=>$this->post['alamat'],
			'username'=>$this->post['username'],
			'no_handphone'=>$this->post['no_handphone'],
		];
		if ( ! empty($this->post['password']) ) {
			$data['password']= $this->post['password'];
		}
		$where= ['id_admin'=>$this->post['id_admin'] ];
		return $this->db->update('tb_admin',$data,$where);
	}
	public function delete_data_admin()
	{
		return $this->db->delete('tb_admin',['id_admin'=>$this->post['id_admin'] ]);
	}
	public function cek_user()
	{
		$this->db->where('username',$this->post['username']);
		if ( ! empty( $this->post['id_admin'] ) ) {
			$this->db->where('id_admin !=',$this->post['id_admin']);
		}
		$admin= $this->db->get('tb_admin')->num_rows();
		return $admin;
	}
/* ==================== End Master Data : Admin ==================== */

	public function data_supplier()
	{
		$this->db->order_by('nama','ASC');
		return $this->db->get('tb_supplier')->result_object();
	}
	public function store_data_supplier()
	{
		$data= [
			'nama'=> $this->post['nama'],
			'alamat'=> $this->post['alamat'],
			'no_telp'=> $this->post['no_telp'],
		];
		return $this->db->insert('tb_supplier', $data);
	}
	public function edit_data_supplier()
	{
		$where=['id_supplier'=>$this->post['id_supplier']];
		return $this->db->get_where('tb_supplier',$where)->row();
	}
	public function update_data_supplier()
	{
		$data= [
			'nama'=> $this->post['nama'],
			'alamat'=> $this->post['alamat'],
			'no_telp'=> $this->post['no_telp'],
		];
		$where=['id_supplier'=>$this->post['id_supplier']];
		return $this->db->update('tb_supplier' ,$data ,$where);
	}
	public function delete_data_supplier()
	{
		$where=['id_supplier'=>$this->post['id_supplier']];
		return $this->db->delete('tb_supplier',$where);
	}
	/* end data supplier model */

	public function data_ongkir()
	{
		// $this->db->order_by('nama','ASC');
		return $this->db->get('tb_ongkir')->result_object();
	}
	public function store_data_ongkir()
	{
		$data= [
			'provinsi'=> $this->post['provinsi'],
			'kabupaten'=> $this->post['kabupaten'],
			'kota'=> $this->post['kota'],
			'biaya'=> $this->post['biaya'],
		];
		return $this->db->insert('tb_ongkir', $data);
	}
	public function edit_data_ongkir()
	{
		$where=['id_ongkir'=>$this->post['id_ongkir']];
		return $this->db->get_where('tb_ongkir',$where)->row();
	}
	public function update_data_ongkir()
	{
		$data= [
			'provinsi'=> $this->post['provinsi'],
			'kabupaten'=> $this->post['kabupaten'],
			'kota'=> $this->post['kota'],
			'biaya'=> $this->post['biaya'],
		];
		$where=['id_ongkir'=>$this->post['id_ongkir']];
		return $this->db->update('tb_ongkir', $data ,$where);
	}
	public function delete_data_ongkir()
	{
		$where=['id_ongkir'=>$this->post['id_ongkir']];
		return $this->db->delete('tb_ongkir',$where);
	}
	/* end data supplier model */
	
}
<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BukuModel;

class Buku extends BaseController
{
    protected $pm;
    private $menu;
    private $rules;
    public function __construct()
    {
        $this->pm = new BukuModel();

        $this->menu = [
            'beranda' => [
                'title' => 'Beranda',
                'link' => base_url(),
                'icon' => 'fa-solid fa-house',
                'aktif' => '',
            ],
            'siswa' => [
                'title' => 'Siswa',
                'link' => base_url() . '/siswa',
                'icon' => 'fa-solid fa-users',
                'aktif' => '',
            ],
            'pegawai' => [
                'title' => 'Pegawai',
                'link' => base_url() . '/pegawai',
                'icon' => 'fa-solid fa-user',
                'aktif' => '',
            ],
            'buku' => [
                'title' => 'Data buku',
                'link' => base_url() . '/buku',
                'icon' => 'fa-solid fa-book',
                'aktif' => 'active',
            ],
            'rak' => [
                'title' => 'Rak',
                'link' => base_url() . '/rak',
                'icon' => 'fa-solid fa-list',
                'aktif' => '',
            ],
            'peminjaman' => [
                'title' => 'Peminjaman',
                'link' => base_url() . '/peminjaman',
                'icon' => 'fa-solid fa-book',
                'aktif' => '',
            ],
            'pencarian' => [
                'title' => 'Pencarian',
                'link' => base_url() . '/pencarian',
                'icon' => 'fa-solid fa-search',
                'aktif' => '',
            ],
        ];

        $this->rules = [
            'kdbuku' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'ID buku tidak boleh kosong',
                ]
            ],
            'judul_buku' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Judul buku tidak boleh kosong',
                ]
            ],
            'pengarang' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Pengarang buku tidak boleh kosong',
                ]
            ],
            'kdrak' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Rak tidak boleh kosong',
                ]
            ],
            'status' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Status tidak boleh kosong',
                ]
            ],
        ];
    }

    public function index()
    {
        

        $breadcrumb = '<div class="col-sm-6">
                            <h1 class="m-0">Buku</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="' . base_url() . '">Beranda</a></li>
                                <li class="breadcrumb-item active">Buku</li>
                            </ol>
                        </div>';
        $data['menu'] = $this->menu;
        $data['breadcrumb'] = $breadcrumb;
        $data['title_card'] = "Data Buku";

        $query = $this->pm->find();
        $data['data_buku'] = $query;
        return view('buku/content', $data);
    }

    public function tambah()
    {
        $breadcrumb = '<div class="col-sm-6">
                            <h1 class="m-0">Buku</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="' . base_url() . '">Beranda</a></li>
                                <li class="breadcrumb-item"><a href="' . base_url() . '/buku">Buku</a></li>
                                <li class="breadcrumb-item active">Tambah Buku</li>
                            </ol>
                        </div>';
        $data['menu'] = $this->menu;
        $data['breadcrumb'] = $breadcrumb;
        $data['title_card'] = "Tambah Buku";
        $data['action'] = base_url() . '/buku/simpan';
        return view('buku/input', $data);
    }
    
    public function simpan()
    {
        if (strtolower($this->request->getMethod()) !== 'post') {
            
            return redirect()->back()->withInput();
        }

        if (!$this->validate($this->rules)){
            return redirect()->back()->withInput();
        }

         
        $dt = $this->request->getPost();
        try{
            $simpan = $this->pm->insert($dt);
            return redirect()->to('buku')->with('success', 'Data berhasil disimpan');
        } catch (\CodeIgniter\Database\Exceptions\DatabaseException $e) {

            session()->setFlashdata('error', $e->getMessage());
            return redirect()->back()->withInput();
        }

        
    }
    public function hapus($id)
    {
        if(empty($id)){
            return redirect()->back()->with('error', 'Hapus data gagal dilakukan');
        }

        try {
            $this->pm->delete($id);
            return redirect()->to('buku')->with('success', 'Data buku dengan kode '.$id.' berhasil dihapus');
        } catch (\CodeIgniter\Database\Exceptions\DatabaseException $e) {
            return redirect()->to('buku')->with('error', $e->getMessage());
        }
    }
    public function edit($id)
    {
        $breadcrumb = '<div class="col-sm-6">
                            <h1 class="m-0">Buku</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="' . base_url() . '">Beranda</a></li>
                                <li class="breadcrumb-item"><a href="' . base_url() . '/buku">Buku</a></li>
                                <li class="breadcrumb-item active">Edit Buku</li>
                            </ol>
                        </div>';
        $data['menu'] = $this->menu;
        $data['breadcrumb'] = $breadcrumb;
        $data['title_card'] = "Edit Buku";
        $data['action'] = base_url() . '/buku/update';

        $data['edit_data'] = $this->pm->find($id);
        return view('buku/input', $data);
    }

    public function update(){
        $dtEdit = $this->request->getPost();
        $param = $dtEdit['param'];
        unset($dtEdit['param']);
        unset($this->rules['password']);

        if (!$this->validate($this->rules)){
            return redirect()->back()->withInput();
        }

        if(empty($dtEdit['password'])){
            unset($dtEdit['password']);
        }

        try {
            $this->pm->update($param, $dtEdit);
            return redirect()->to('buku')->with('success', 'Data berhasil diupdate');
        } catch (\CodeIgniter\Database\Exceptions\DatabaseException $e) {
            session()->setFlashdata('error', $e->getMessage()); 
            return redirect()->back()->withInput();  
        }

    }
}

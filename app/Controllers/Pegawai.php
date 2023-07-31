<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PegawaiModel;

class Pegawai extends BaseController
{
    protected $pm;
    private $menu;
    private $rules;
    public function __construct()
    {
        $this->pm = new PegawaiModel();

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
                'aktif' => 'active',
            ],
            'buku' => [
                'title' => 'Data buku',
                'link' => base_url() . '/buku',
                'icon' => 'fa-solid fa-book',
                'aktif' => '',
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
            'kdpegawai' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'ID Pegawai tidak boleh kosong',
                ]
            ],
            'nama_pegawai' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama Pegawai tidak boleh kosong',
                ]
            ],
            'jabatan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Jabatan Pegawai tidak boleh kosong',
                ]
            ],
        ];
    }

    public function index()
    {
        

        $breadcrumb = '<div class="col-sm-6">
                            <h1 class="m-0">Pegawai</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="' . base_url() . '">Beranda</a></li>
                                <li class="breadcrumb-item active">Pegawai</li>
                            </ol>
                        </div>';
        $data['menu'] = $this->menu;
        $data['breadcrumb'] = $breadcrumb;
        $data['title_card'] = "Data Pegawai";

        $query = $this->pm->find();
        $data['data_pegawai'] = $query;
        return view('pegawai/content', $data);
    }

    public function tambah()
    {
        $breadcrumb = '<div class="col-sm-6">
                            <h1 class="m-0">Pegawai</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="' . base_url() . '">Beranda</a></li>
                                <li class="breadcrumb-item"><a href="' . base_url() . '/pegawai">Pegawai</a></li>
                                <li class="breadcrumb-item active">Tambah Pegawai</li>
                            </ol>
                        </div>';
        $data['menu'] = $this->menu;
        $data['breadcrumb'] = $breadcrumb;
        $data['title_card'] = "Tambah Pegawai";
        $data['action'] = base_url() . '/pegawai/simpan';
        return view('pegawai/input', $data);
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
            return redirect()->to('pegawai')->with('success', 'Data berhasil disimpan');
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
            return redirect()->to('pegawai')->with('success', 'Data Pegawai dengan kode '.$id.' berhasil dihapus');
        } catch (\CodeIgniter\Database\Exceptions\DatabaseException $e) {
            return redirect()->to('pegawai')->with('error', $e->getMessage());
        }
    }
    public function edit($id)
    {
        $breadcrumb = '<div class="col-sm-6">
                            <h1 class="m-0">Pegawai</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="' . base_url() . '">Beranda</a></li>
                                <li class="breadcrumb-item"><a href="' . base_url() . '/pegawai">Pegawai</a></li>
                                <li class="breadcrumb-item active">Edit Pegawai</li>
                            </ol>
                        </div>';
        $data['menu'] = $this->menu;
        $data['breadcrumb'] = $breadcrumb;
        $data['title_card'] = "Edit Pegawai";
        $data['action'] = base_url() . '/pegawai/update';

        $data['edit_data'] = $this->pm->find($id);
        return view('pegawai/input', $data);
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
            return redirect()->to('pegawai')->with('success', 'Data berhasil diupdate');
        } catch (\CodeIgniter\Database\Exceptions\DatabaseException $e) {
            session()->setFlashdata('error', $e->getMessage()); 
            return redirect()->back()->withInput();  
        }

    }
}

<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PeminjamanModel;

class Peminjaman extends BaseController
{
    protected $pm;
    private $menu;
    private $rules;
    public function __construct()
    {
        $this->pm = new PeminjamanModel();

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
                'aktif' => 'active',
            ],
            'pencarian' => [
                'title' => 'Pencarian',
                'link' => base_url() . '/pencarian',
                'icon' => 'fa-solid fa-search',
                'aktif' => '',
            ],
        ];

        $this->rules = [
            'kdpeminjaman' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'ID Peminjaman tidak boleh kosong',
                ]
            ],
            'kdsiswa' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama Siswa tidak boleh kosong',
                ]
            ],
            'kdpegawai' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama Pegawai tidak boleh kosong',
                ]
            ],
            'kdbuku' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Judul Buku tidak boleh kosong',
                ]
            ],
            'tgl_peminjaman' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tanggal Peminjaman tidak boleh kosong',
                ]
            ],
            'tgl_pengembalian' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tanggal Pengembalian tidak boleh kosong',
                ]
            ],
            'ket_telat' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Keterangan telat tidak boleh kosong',
                ]
            ],
            'ket_denda' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Keterangan denda tidak boleh kosong',
                ]
            ],
        ];
    }

    public function index()
    {
        

        $breadcrumb = '<div class="col-sm-6">
                            <h1 class="m-0">Peminjaman</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="' . base_url() . '">Beranda</a></li>
                                <li class="breadcrumb-item active">Peminjaman</li>
                            </ol>
                        </div>';
        $data['menu'] = $this->menu;
        $data['breadcrumb'] = $breadcrumb;
        $data['title_card'] = "Data Peminjaman";

        $query = $this->pm->find();
        $data['data_peminjaman'] = $query;
        return view('peminjaman/content', $data);
    }

    public function tambah()
    {
        $breadcrumb = '<div class="col-sm-6">
                            <h1 class="m-0">Peminjaman</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="' . base_url() . '">Beranda</a></li>
                                <li class="breadcrumb-item"><a href="' . base_url() . '/peminjaman">Peminjaman</a></li>
                                <li class="breadcrumb-item active">Tambah Peminjaman</li>
                            </ol>
                        </div>';
        $data['menu'] = $this->menu;
        $data['breadcrumb'] = $breadcrumb;
        $data['title_card'] = "Tambah Peminjaman";
        $data['action'] = base_url() . '/peminjaman/simpan';
        return view('peminjaman/input', $data);
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
            return redirect()->to('peminjaman')->with('success', 'Data berhasil disimpan');
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
            return redirect()->to('peminjaman')->with('success', 'Data peminjaman dengan kode '.$id.' berhasil dihapus');
        } catch (\CodeIgniter\Database\Exceptions\DatabaseException $e) {
            return redirect()->to('peminjaman')->with('error', $e->getMessage());
        }
    }
    public function edit($id)
    {
        $breadcrumb = '<div class="col-sm-6">
                            <h1 class="m-0">Peminjaman</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="' . base_url() . '">Beranda</a></li>
                                <li class="breadcrumb-item"><a href="' . base_url() . '/peminjaman">Peminjaman</a></li>
                                <li class="breadcrumb-item active">Edit Peminjaman</li>
                            </ol>
                        </div>';
        $data['menu'] = $this->menu;
        $data['breadcrumb'] = $breadcrumb;
        $data['title_card'] = "Edit Peminjaman";
        $data['action'] = base_url() . '/peminjaman/update';

        $data['edit_data'] = $this->pm->find($id);
        return view('peminjaman/input', $data);
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
            return redirect()->to('peminjaman')->with('success', 'Data berhasil diupdate');
        } catch (\CodeIgniter\Database\Exceptions\DatabaseException $e) {
            session()->setFlashdata('error', $e->getMessage()); 
            return redirect()->back()->withInput();  
        }

    }
}

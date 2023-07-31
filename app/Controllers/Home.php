<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        $menu = [
            'beranda' => [
                'title' => 'Beranda',
                'link' => base_url(),
                'icon' => 'fa-solid fa-house',
                'aktif' => 'active',
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
                'aktif' => '',
            ],
            'pencarian' => [
                'title' => 'Pencarian',
                'link' => base_url() . '/pencarian',
                'icon' => 'fa-solid fa-search',
                'aktif' => '',
            ],
        ];

        $breadcrumb = '<div class="col-sm-6">
                            <h1 class="m-0">Beranda</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item active">Beranda</li>
                            </ol>
                        </div>';
        $data['menu'] = $menu;
        $data['breadcrumb'] = $breadcrumb;
        $data['title_card'] = "Welcome to my site";
        $data['selamat_datang'] = "Selamat Datang di web pengelola buku";
        return view('template/content', $data);
    }
}

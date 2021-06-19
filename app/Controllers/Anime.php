<?php

namespace App\Controllers;

use App\Models\AnimeModel;

class Anime extends BaseController
{
    protected $animeModel;
    public function __construct()
    {
        $this->animeModel = new AnimeModel();
    }
    public function index()
    {
        $data = [
            'judul' => 'Halaman Daftar Anime',
            'anime' => $this->animeModel->getAnime()
        ];
        return view('anime/index', $data);
    }

    public function detail($slug)
    {
        $data = [
            'judul' => 'Detail Anime',
            'anime' => $this->animeModel->getAnime($slug)
        ];

        // // jika anime tidak ada di tabel
        // if (empty($data['anime'])) {
        //     throw new \CodeIgniter\Exceptions\PageNotFoundException('Judul Anime' . $slug . 'Tidak Ditemukan');
        // }

        return view('anime/detail', $data);
    }

    public function create()
    {
        $data = [
            'judul' => 'Form Tambah Data Anime',
            'validation' => \Config\Services::validation()
        ];

        return view('anime/create', $data);
    }

    public function save()
    {
        // validasi Input
        if (!$this->validate([
            'judul_anime' => [
                'rules' => 'required|is_unique[tbl_anime.judul_anime]',
                'errors' => [
                    'required' => 'Judul Anime Harus Diisi',
                    'is_unique' => 'Judul Anime Sudah Ada !!'
                ]
            ],
            'sampul' => [
                'rules' => 'max_size[sampul,2048]|is_image[sampul]|mime_in[sampul,image/jpg,image/png,image/jpeg]',
                'errors' => [
                    'max_size' => 'Ukuran Gambar terlalu Besar',
                    'is_image' => 'Yang Anda Pilih Bukan Gambar',
                    'mime_in' => 'Yang Anda Pilih Bukan Gambar',

                ]
            ]
        ])) {
            return redirect()->to('/Anime/create')->withInput();
        }

        // ambil Gambar 
        $fileSampul =  $this->request->getFile('sampul');
        // jika user tidak upload gambar
        if ($fileSampul->getError() == 4) {
            $namaSampul = 'default.png';
        } else {
            // ambil nama file sampul
            $namaSampul = $fileSampul->getRandomName();
            // pindahkan file ke folder img
            $fileSampul->move('img', $namaSampul);
        }

        $slug = url_title($this->request->getVar('judul_anime'), '-', true);
        $this->animeModel->save([
            'judul_anime' => $this->request->getVar('judul_anime'),
            'slug' => $slug,
            'penulis' => $this->request->getVar('penulis'),
            'penerbit' => $this->request->getVar('penerbit'),
            'tahun' => $this->request->getVar('tahun'),
            'sampul' => $namaSampul
        ]);

        session()->setFlashData('pesan', 'Data Berhasil Ditambahkan');

        return redirect()->to('/anime');
    }

    public function delete($id)
    {
        // cari Gambar Berdasarkan Id
        $anime = $this->animeModel->find($id);
        // cek jika file gambanrnya default
        if ($anime['sampul'] != 'default.png') {
            // hapus Gambar
            unlink('img/' . $anime['sampul']);
        }
        $this->animeModel->delete($id);
        session()->setFlashData('pesan', 'Data Berhasil DiHapus');
        return redirect()->to('/Anime');
    }

    public function edit($slug)
    {
        $data = [
            'judul' => 'Form Ubah Data Anime',
            'validation' => \Config\Services::validation(),
            'anime' => $this->animeModel->getAnime($slug)
        ];

        return view('anime/edit', $data);
    }

    public function update($id)
    {
        $animeLama = $this->animeModel->getAnime($this->request->getVar('slug'));
        if ($animeLama['judul_anime'] == $this->request->getVar('judul_anime')) {
            $rule_judul = 'required';
        } else {
            $rule_judul = 'required|is_unique[tbl_anime.judul_anime]';
        }
        // validasi Input
        if (!$this->validate([
            'judul_anime' => [
                'rules' => $rule_judul,
                'errors' => [
                    'required' => 'Judul Anime Harus Diisi',
                    'is_unique' => 'Judul Anime Sudah Ada !!'
                ]
            ],
            'sampul' => [
                'rules' => 'max_size[sampul,2048]|is_image[sampul]|mime_in[sampul,image/jpg,image/png,image/jpeg]',
                'errors' => [
                    'max_size' => 'Ukuran Gambar terlalu Besar',
                    'is_image' => 'Yang Anda Pilih Bukan Gambar',
                    'mime_in' => 'Yang Anda Pilih Bukan Gambar',

                ]
            ]
        ])) {
            return redirect()->to('/Anime/edit/' . $this->request->getVar('slug'))->withInput();
        }
        // kelola file gambar
        $fileSampul = $this->request->getFile('sampul');

        // cek gambar, apakah tetap gambar lama
        if ($fileSampul->getError() == 4) {
            $namaSampul = $this->request->getVar('sampulLama');
        } else {
            $namaSampul = $fileSampul->getRandomName();
            $fileSampul->move('img', $namaSampul);

            // hapus file lama
            unlink('img/' . $this->request->getVar('sampulLama'));
        }

        $slug = url_title($this->request->getVar('judul_anime'), '-', true);
        $this->animeModel->save([
            'id' => $id,
            'judul_anime' => $this->request->getVar('judul_anime'),
            'slug' => $slug,
            'penulis' => $this->request->getVar('penulis'),
            'penerbit' => $this->request->getVar('penerbit'),
            'tahun' => $this->request->getVar('tahun'),
            'sampul' => $namaSampul
        ]);

        session()->setFlashData('pesan', 'Data Berhasil Di Ubah');

        return redirect()->to('/anime');
    }
}

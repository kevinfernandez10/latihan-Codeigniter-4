<?php

namespace App\Models;

use CodeIgniter\Model;

class AnimeModel extends Model
{
    protected $table = 'tbl_anime';
    protected $useTimestamps = true;
    protected $allowedFields = ['judul_anime', 'slug', 'penulis', 'penerbit', 'tahun', 'sampul'];

    public function getAnime($slug = false)
    {
        if ($slug == false) {
            return $this->findAll();
        }

        return $this->where(['slug' => $slug])->first();
    }
}

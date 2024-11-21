<?php

namespace App\Models;

use CodeIgniter\Model;

class PageViewModel extends Model
{
    protected $table = 'page_views';
    protected $primaryKey = 'id';
    protected $allowedFields = ['views'];

    /**
     * Mengambil total jumlah page views.
     * 
     * @return int Jumlah total page views.
     */
    public function getTotalPageViews(): int
    {
        $result = $this->select('views')
            ->where('id', 1)
            ->first();

        log_message('debug', 'Total page views fetched: ' . json_encode($result));

        return $result ? (int)$result['views'] : 0; // Pastikan hasil dikembalikan sebagai integer.
    }

    /**
     * Menambahkan 1 ke jumlah page views.
     * 
     * @return bool Status keberhasilan update.
     */
    public function incrementPageView(): bool
    {
        // Menggunakan query builder untuk melakukan increment.
        return $this->db->table($this->table)
            ->set('views', 'views + 1', false)
            ->where('id', 1)
            ->update();
    }
}

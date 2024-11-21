<?php

namespace App\Controllers;

use App\Models\PageViewModel;

class Analytics extends BaseController
{
    protected $pageViewModel;

    public function __construct()
    {
        // Inisialisasi model
        $this->pageViewModel = new PageViewModel();
    }

    /**
     * Mendapatkan total page views
     */
    public function getPageViews()
    {
        if ($this->request->isAJAX()) {
            $totalPageViews = $this->pageViewModel->getTotalPageViews();

            $msg = [
                'success' => true,
                'total_page_views' => $totalPageViews,
            ];
        } else {
            $msg = [
                'error' => true,
                'message' => 'Invalid request method',
            ];
        }

        echo json_encode($msg);
    }

    /**
     * Menambahkan jumlah page view
     */
    public function incrementPageView()
    {
        if ($this->request->isAJAX()) {
            $this->pageViewModel->incrementPageView();
            $totalPageViews = $this->pageViewModel->getTotalPageViews();

            $msg = [
                'success' => true,
                'total_page_views' => $totalPageViews,
            ];
        } else {
            $msg = [
                'error' => true,
                'message' => 'Invalid request method',
            ];
        }

        echo json_encode($msg);
    }

    /**
     * Menampilkan total page views pada sebuah view
     */
    public function someFunction()
    {
        $totalPageViews = $this->pageViewModel->getTotalPageViews();

        return view('user/data', [
            'totalPageViews' => $totalPageViews,
        ]);
    }
}

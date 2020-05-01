<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\src\Repositories\SubscriberRepository;
use Exception;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;
use Log;

class SubscriberController extends Controller
{
    private $subscriberRepository;

    public function __construct(SubscriberRepository $subscriberRepository)
    {
        $this->subscriberRepository = $subscriberRepository;
    }

    public function index()
    {
        return view('admin.pages.subscriber.index')->with([
            'subscribers' => $this->subscriberRepository->all(),
        ]);
    }
    
        public function exportSubscribers()
    {
        try {
            $subscribers = $this->subscriberRepository->listSubscriberByOrder();

            Excel::create('DB_subscribers', function ($excel) use ($subscribers)  {
                $excel->sheet('DB_subscribers', function ($sheet) use ($subscribers){
                    $sheet->row(1, [
                        'ID', 'Email',
                    ]);

                    foreach ($subscribers as $index => $item) {
                        $sheet->row(2 + $index, [
                            $item->id,
                            $item->email,
                        ]);
                    }

                });
            })->export('xlsx');

        } catch (Exception $e) {
            Log::error($e->getMessage());
        }
    }
}

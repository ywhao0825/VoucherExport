<?php

namespace App\Repositories;

use Throwable;
use Carbon\Carbon;
use App\Models\Voucher;
use App\Jobs\GenerateVoucher;
use App\Libraries\Traits\Voucher\GenerateCode;
use Maatwebsite\Excel\Facades\Excel;
use App\Libraries\Traits\TryCatch;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class VoucherRepository {

    use GenerateCode;

    use TryCatch;

    public function generate($request) {

        return $this->tryCatch(function($response) use($request) {

            $voucherAmount = 3000000;

            $voucherArray = [];

            for ($i = 0; $i < 3000; $i++) {

                $voucherArray = [];

                GenerateVoucher::dispatch(1000);

            }

            $response->setMessage('Generate Succesfully');

        });

    }

    public function export() {

        

        $callback = function () {

            $file = fopen('php://output', 'w');

            fputcsv($file, ['Code', 'Code 2', 'Code 3']);

            $vouchers = DB::select("SELECT code FROM voucher");
            
            $chunksVoucher = array_chunk($vouchers, 1000000);

            for ($i = 0; $i < 1000000; $i++) {

                $row = [];

                foreach ($chunksVoucher as $chunk) {

                    $row[] = isset($chunk[$i]) ? $chunk[$i]->code : '';

                }

                fputcsv($file, $row);

            }

            fclose($file);
        };

        return $callback;

    }

}

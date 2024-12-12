<?php

namespace App\Jobs;

use App\Models\Voucher;
use App\Libraries\Traits\Voucher\GenerateCode;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Cache;
use Carbon\Carbon;

class GenerateVoucher implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $size;

    public function __construct($size = 1000) {
        $this->size = $size;
    }

    public function handle() {
        $vouchers = [];

        for ($i = 0; $i < $this->size; $i++) {

            $voucherCode = GenerateCode::randomCode(10);

            if(!Cache::has($voucherCode)) {

                Cache::put($voucherCode, true, now()->addMinutes(30));

                $vouchers[] = [
                    'code' => $voucherCode = GenerateCode::randomCode(10),
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ];

            }

        }

        Voucher::insert($vouchers);
    }

}
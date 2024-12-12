<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Models\Voucher;
use Illuminate\Support\Facades\DB;
use App\Libraries\Traits\APIResponse;
use Illuminate\Support\Facades\Bus;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;
use App\Repositories\VoucherRepository;
use App\Http\Requests\Voucher\GenerateAPIVoucherRequest;

class VoucherController extends Controller {

    use APIResponse;
    
    private $voucherRepository;

    public function __construct(VoucherRepository $voucherRepo) {

        $this->voucherRepository = $voucherRepo;

    }

    public function generate(GenerateAPIVoucherRequest $request) {

        $res = $this->voucherRepository->generate($request);

        return $this->returnResponse( $res );

    }
    
    public function export(Request $request) {

        $res = $this->voucherRepository->export();

        return response()->stream($res, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"voucher.csv\"",
        ]);

    }

}

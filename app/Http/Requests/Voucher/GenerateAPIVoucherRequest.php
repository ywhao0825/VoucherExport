<?php

namespace App\Http\Requests\Voucher;

use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Route;

class GenerateAPIVoucherRequest {

    public function authorize() {

        return true;

    }

    public function attributes() {

        return [
            
        ];

    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {

        return [

        ];

    }

}
?>
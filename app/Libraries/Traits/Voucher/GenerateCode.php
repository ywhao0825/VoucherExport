<?php

namespace App\Libraries\Traits\Voucher;

trait GenerateCode {

    public static function randomCode($length = 10) {

        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

        $voucherCode = '';
        for ($i = 0; $i < $length; $i++) {
            $voucherCode .= $characters[rand(0, strlen($characters) - 1)];
        }

        return $voucherCode;

    }

}

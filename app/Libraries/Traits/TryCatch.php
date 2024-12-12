<?php
namespace App\Libraries\Traits;

use Closure;
use DB;
use Exception;
use Throwable;
use App\Libraries\Helpers\Response;
use Illuminate\Support\Facades\Log;

trait TryCatch {

    public function tryCatch(Closure $callback, $exception = false, $logToChannel = null, $byPassRollback = false) {

        $response = new Response;

        $localTransaction = DB::transactionLevel() ? false : true;

        if($localTransaction) {

            DB::beginTransaction();

        }

        try {

            $result = $callback($response);

            if($localTransaction) {

                DB::commit();

            }

            $response->setData($result);

        } catch (Throwable $e) {

            if($localTransaction) {

                if(!$byPassRollback) {

                    DB::rollback();
                }
            }

            if(!empty($logToChannel)) {

                // If channel not found in logging.php, by default will log to laravel.log
                Log::channel($logToChannel)->error($e);
                Log::channel($logToChannel)->error(request() ?? 'No request captured.');
            }

            if($exception) {

                throw new Exception($e->getMessage());

            }

            $response->setError($e->getMessage());

        }

        return $response;

    }
}

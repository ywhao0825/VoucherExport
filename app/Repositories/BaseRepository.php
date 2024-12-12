<?php
namespace App\Repositories;

use Throwable;
use App\Libraries\Traits\TryCatch;

abstract class BaseRepository {

    use TryCatch;

    /**
     * Specify Model class name
     *
     * @return string
     */
    abstract public function model();

    public function findWithoutFail($id, $columns = ['*']) {

        try {

            return $this->model()::findOrFail($id, $columns);

        } catch (Throwable $e) {

            return;

        }

    }
}

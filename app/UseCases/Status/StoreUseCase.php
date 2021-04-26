<?php

namespace App\UseCases\Status;

use App\Models\Status;

class StoreUseCase
{
    public function invoke(Status $status): Status
    {
        $status->save();
        return $status;
    }
}

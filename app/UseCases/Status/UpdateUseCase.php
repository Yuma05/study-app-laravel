<?php

namespace App\UseCases\Status;

use App\Models\Status;

class UpdateUseCase
{
    public function invoke(Status $status): Status
    {
        $status->save();
        return $status;
    }
}

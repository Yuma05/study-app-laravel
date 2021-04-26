<?php

namespace App\UseCases\Status;

use App\Models\Status;

class DestroyUseCase
{
    public function invoke(int $id): int
    {
        $status = Status::find($id);
        $user_id = $status->user_id;
        $status->delete();
        return $user_id;
    }
}

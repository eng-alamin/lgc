<?php

namespace App\Services;

use App\Models\ClientStage;
use App\Models\ClientStageHistory;



class ClientStageService
{

    public static function moveStage($form,$stageId,$title,$status)
    {

        $stage = ClientStage::findOrFail($stageId);

        ClientStageHistory::create([

            'form_id'=>$form->id,

            'stage_id'=>$stageId,

            'user_id'=>auth()->id(),

            'title'=>$title,

            'status'=>$status,

            'action_time'=>now()

        ]);

        $form->update([
            'progress'=>$stage->progress_percent
        ]);

    }

}
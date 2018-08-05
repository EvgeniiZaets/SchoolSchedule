<?php

namespace app\commands;

use app\models\AcademicHours;
use app\models\Schedule;
use yii\console\Controller;
use yii\console\ExitCode;

class ScheduleController extends Controller
{
    public function actionGenerate()
    {
        if (!AcademicHours::find()->exists())
            AcademicHours::generate();

        $rows = Schedule::generate();

        echo 'Сгенерировано ' . $rows . ' уроков';
        return ExitCode::OK;
    }

}

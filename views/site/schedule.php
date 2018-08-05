<?php

/* @var $this yii\web\View */
/* @var $schoolClasses \app\models\Schedule[] */

$this->title = 'Расписание';
?>
<?php foreach ($schoolClasses as $schoolClass): ?>
    <div class="row">
        <h3><?= $schoolClass->title ?></h3>

        <div class="table-responsive">
            <table class="table">
                <thead>
                <tr>
                    <th>День</th>
                    <th>№ Урока</th>
                    <th>Урок</th>
                    <th>Преподаватель</th>
                </tr>
                </thead>
                <tbody>

                <?php foreach ($schoolClass->schedules as $schedule): ?>
                    <tr>
                        <?php if ($schedule->bell->id == 1): ?>
                            <th rowspan="<?= $schoolClass->getNumSchedulesByDay($schedule->day->id) ?>" scope="row">
                                <?= $schedule->day->title ?>
                            </th>
                        <?php endif; ?>
                        <td><?= $schedule->bell->id ?></td>
                        <td><?= $schedule->subject->title ?></td>
                        <td><?= $schedule->teacher->name ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
<?php endforeach; ?>

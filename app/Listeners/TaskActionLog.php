<?php

namespace App\Listeners;

use App\Events\TaskAction;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\Activity;
use Lang;
use App\Models\Task;

class TaskActionLog
{
    /**
     * Create the event listener.
     *
     */
    public function __construct()
    {
    }

    /**
     * Handle the event.
     *
     * @param  TaskAction  $event
     * @return void
     */
    public function handle(TaskAction $event)
    {
        switch ($event->getAction()) {
            case 'created':
                $text = __(':title создана :creator и поручена :assignee', [
                        'title' => $event->getTask()->title,
                        'creator' => $event->getTask()->creator->name,
                        'assignee' => $event->getTask()->user->name
                    ]);
                break;
            case 'updated_status':
                $text = __('Задача была завершена :username', [
                        'username' => Auth()->user()->name,
                    ]);
                break;
            case 'updated_time':
                $text = __(':username добавил новое время в задачу', [
                        'username' => Auth()->user()->name,
                    ]);
                ;
                break;
            case 'updated_assign':
                $text = __(':username назначил ответственным :assignee', [
                        'username' => Auth()->user()->name,
                        'assignee' => $event->getTask()->user->name
                    ]);
                break;
            default:
                break;
        }

        $activityinput = array_merge(
            [
                'text' => $text,
                'user_id' => Auth()->id(),
                'source_type' =>  Task::class,
                'source_id' =>  $event->getTask()->id,
                'action' => $event->getAction()
            ]
        );
        
        Activity::create($activityinput);
    }
}

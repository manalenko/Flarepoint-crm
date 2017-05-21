<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Lang;
use App\Models\Task;

class TaskActionNotification extends Notification
{
    use Queueable;


    private $task;
    private $action;

    /**
     * Create a new notification instance.
     * TaskActionNotification constructor.
     * @param $task
     * @param $action
     */
    public function __construct($task, $action)
    {
        $this->task = $task;
        $this->action = $action;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
       /* return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', 'https://laravel.com')
                    ->line('Thank you for using our application!'); */
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        switch ($this->action) {
            case 'created':
                $text = __(':title задача была создана :creator, и назначена вам', [
                    'title' =>  $this->task->title,
                    'creator' => $this->task->creator->name,
                    ]);
                break;
            case 'updated_status':
                $text = __(':title была завершена пользователем :username', [
                    'title' =>  $this->task->title,
                    'username' =>  Auth()->user()->name,
                    ]);
                break;
            case 'updated_time':
                $text = __(':username добавил новое время в задачу :title', [
                    'title' =>  $this->task->title,
                    'username' =>  Auth()->user()->name,
                    ]);
                break;
            case 'updated_assign':
                $text = __(':username назначил вам задачу', [
                    'title' =>  $this->task->title,
                    'username' =>  Auth()->user()->name,
                    ]);
                break;
            default:
                break;
        }
        return [
            'assigned_user' => $notifiable->id, //Assigned user ID
            'created_user' => $this->task->fk_user_id_created,
            'message' => $text,
            'type' =>  Task::class,
            'type_id' =>  $this->task->id,
            'url' => url('tasks/' . $this->task->id),
            'action' => $this->action
        ];
    }
}

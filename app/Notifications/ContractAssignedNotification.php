<?php

namespace App\Notifications;

use App\Http\Controllers\GeoLocationController;
use App\Models\Contract;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\NexmoMessage;
use Illuminate\Notifications\Notification;

class ContractAssignedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    private $contract;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Contract $contract)
    {
        $this->contract = $contract;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['nexmo'];
    }

    /**
     * Get the Vonage / SMS representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\NexmoMessage
     */
    public function toNexmo($notifiable)
    {
        return (new NexmoMessage)
            ->content($this->generateTextMessage());
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }

    private function generateTextMessage() :string
    {
        $msg = "You have been assigned for a new Beekeeper job! \n";

        if($this->contract->hasOptionalInfo) {
            $msg .= "Additional Information: \n";

            if ($this->contract->contact_firstname) {
                $msg .= 'Firstname: ' .$this->contract->contact_firstname ."\n";
            }
            if ($this->contract->contact_lastname) {
                $msg .= 'Lastname: '.$this->contract->contact_lastname ."\n";
            }
            if ($this->contract->contact_phone) {
                $msg .= 'Phone: '.$this->contract->contact_phone ."\n";
            }
            if ($this->contract->info) {
                $msg .= 'Info: '.$this->contract->info ."\n";
            }

        }

        $msg .= GeoLocationController::generateGoogleMapsPin($this->contract->lat, $this->contract->lon);

        return $msg;


    }
}

<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class EventChangeReportData implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $id;
    public $block;
    public $value;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($id, $block, $value)
    {
        $this->id = $id;
        $this->block = $block;
        $this->value = $value;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('ReportChannel.' . $this->id);
    }

    public function broadcastWith()
    {
        return [
            'name' => $this->block,
            'value' => $this->value,
            'id' => $this->id,
        ];
    }
}

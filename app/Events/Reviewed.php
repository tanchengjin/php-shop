<?php

namespace App\Events;

use App\Models\OrderItem;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class Reviewed
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    protected $orderItem;

    /**
     * Create a new event instance.
     * @param OrderItem $orderItem
     * @return void
     */
    public function __construct(OrderItem $orderItem)
    {
        $this->orderItem = $orderItem;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }

    /**
     * @return OrderItem
     */
    public function getOrderItem(): OrderItem
    {
        return $this->orderItem;
    }


}

<?php

namespace App\Events;

use App\Models\Option;
use App\Models\Survey;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class VoteAdded implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $votes;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(protected $id)
    {
        $survey = Survey::find($id);
        $votes = Option::where('survey_id', $survey->id)->withCount('votes')->get();
        $this->votes = collect($votes)->map(function($vote){
            return [
                'id' => $vote->id,
                'count' => $vote->votes_count
            ];
        });
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('votes_survey_id_'. $this->id);
    }
}

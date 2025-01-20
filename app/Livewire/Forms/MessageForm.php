<?php

namespace App\Livewire\Forms;

use App\Enums\ChannelTypesEnum;
use App\Models\Capsule;
use App\Models\Message;
use Livewire\Attributes\Validate;
use Livewire\Form;

class MessageForm extends Form
{

    #[Validate('required|string')]
    public string $content = '';

    #[Validate('required|array')]
    public array $channels = [ChannelTypesEnum::EMAIL];

    #[Validate('required|int')]
    public int $scheduled_days = 365;

    #[Validate('required|boolean')]
    public bool $is_public = false;

    public function store(Capsule $capsule): Message
    {
        $this->validate();

        return $capsule->messages()->create([
            'user_id' => auth()->id(),
            'content' => $this->content,
            'channels' => $this->channels,
            'scheduled_days' => $this->scheduled_days,
            'scheduled_at' => now()->addDays($this->scheduled_days),
            'is_public' => $this->is_public,
        ]);
    }
}

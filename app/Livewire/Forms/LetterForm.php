<?php

namespace App\Livewire\Forms;

use App\Enums\ChannelTypesEnum;
use App\Models\Capsule;
use App\Models\Letter;
use Livewire\Attributes\Validate;
use Livewire\Form;

class LetterForm extends Form
{
    #[Validate('required|string')]
    public string $message = '';

    #[Validate('required|array')]
    public array $channels = [ChannelTypesEnum::EMAIL];

    #[Validate('required|int')]
    public int $scheduled_days = 365;

    #[Validate('required|boolean')]
    public bool $is_public = false;

    public function store(Capsule $capsule): Letter
    {
        $this->validate();

        return $capsule->letters()->create([
            'user_id' => auth()->id(),
            'message' => $this->message,
            'channels' => $this->channels,
            'scheduled_days' => $this->scheduled_days,
            'scheduled_at' => now()->addDays($this->scheduled_days),
            'is_public' => $this->is_public,
        ]);
    }
}

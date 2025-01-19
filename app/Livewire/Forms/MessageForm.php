<?php

namespace App\Livewire\Forms;

use App\Enums\ChannelTypesEnum;
use Livewire\Attributes\Validate;
use Livewire\Form;

class MessageForm extends Form
{

    #[Validate('required|string')]
    public string $content = '';

    #[Validate('required|array')]
    public array $channels = [ChannelTypesEnum::EMAIL];

    #[Validate('required|int')]
    public int $delivery_days = 365;

    #[Validate('required|boolean')]
    public bool $is_public = false;

    public function store(): void
    {
        $this->validate();

        auth()->user()->messages()->create([
            'content' => $this->content,
            'channels' => $this->channels,
            'scheduled_at' => now()->addDays($this->delivery_days),
            'is_public' => $this->is_public,
        ]);
    }
}

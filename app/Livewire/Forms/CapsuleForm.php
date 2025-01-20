<?php

namespace App\Livewire\Forms;

use App\Enums\CapsuleStatusEnum;
use App\Models\Capsule;
use Livewire\Attributes\Validate;
use Livewire\Form;

class CapsuleForm extends Form
{
    #[Validate('required|string')]
    public string $name = '';

    #[Validate('nullable|string')]
    public string $description = '';

    #[Validate('required|int')]
    public int $scheduled_days = 365;

    #[Validate('required|boolean')]
    public bool $visibility = false;

    #[Validate('required|string')]
    public string $status = CapsuleStatusEnum::DRAFT;

    public function store(): Capsule
    {
        $this->validate();

        return auth()->user()->capsules()->create([
            'scheduled_days' => $this->scheduled_days,
            'scheduled_at' => now()->addDays($this->scheduled_days),
            'name' => $this->name,
            'description' => $this->description,
            'visibility' => $this->visibility,
            'status' => $this->status,
        ]);
    }
}

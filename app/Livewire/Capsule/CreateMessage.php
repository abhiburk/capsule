<?php

namespace App\Livewire\Capsule;

use App\Enums\CapsuleStatusEnum;
use App\Livewire\Forms\MessageForm;
use App\Models\Capsule;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]
class CreateMessage extends Component
{
    public MessageForm $form;
    public Capsule $capsule;
    public array $periods = [
        30 => '1 Month',
        30 * 6 => '6 Months',
        365 * 1 => '1 Year',
    ];

    public function mount(Capsule $capsule)
    {
        $this->capsule = $capsule;
    }

    public function message()
    {
        $this->validate();

        $this->form->store($this->capsule);

        $this->capsule->update([
            'status' => CapsuleStatusEnum::PUBLISHED,
        ]);

        return $this->redirectRoute('capsules.messages.index', $this->capsule->id);
    }

    public function render()
    {
        return view('livewire.capsule.create-message');
    }
}

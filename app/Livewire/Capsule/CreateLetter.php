<?php

namespace App\Livewire\Capsule;

use App\Enums\CapsuleStatusEnum;
use App\Livewire\Forms\LetterForm;
use App\Models\Capsule;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]
class CreateLetter extends Component
{
    public LetterForm $form;
    public Capsule $capsule;
    public array $periods = [
        30 => '1 month',
        30 * 6 => '6 months',
        365 * 1 => '1 year',
        365 * 3 => '3 years',
    ];

    public function mount(Capsule $capsule)
    {
        $this->capsule = $capsule;
    }

    public function store()
    {
        $this->form->store($this->capsule);

        $this->capsule->update([
            'status' => CapsuleStatusEnum::PUBLISHED,
        ]);

        return $this->redirectRoute('capsules.letter.index', $this->capsule->id);
    }

    public function render()
    {
        return view('livewire.capsule.create-letter');
    }
}

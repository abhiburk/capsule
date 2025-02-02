<?php

namespace App\Livewire\Capsule\Letter;

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
        365 * 5 => '5 years',
    ];

    public function mount(Capsule $capsule)
    {
        $this->capsule = $capsule;
        $this->form->recipients[] = auth()->user()->email;
    }

    public function store()
    {
        $this->form->store($this->capsule);

        $this->capsule->update([
            'status' => CapsuleStatusEnum::PUBLISHED,
        ]);

        return $this->redirectRoute('capsules.letters.index', $this->capsule->id);
    }

    public function render()
    {
        return view('livewire.capsule.letter.create-letter');
    }

    public function removeRecipient($index)
    {
        unset($this->form->recipients[$index]);
        $this->form->recipients = array_values($this->form->recipients); // Reindex array
    }

    public function addRecipient()
    {
        $this->form->recipients[] = '';
    }

    public function updatedForm($value)
    {
        if ($value === 'days') {
            $this->form->scheduled_days = 30;
        }
    }
}

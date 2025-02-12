<?php

namespace App\Livewire\Capsule\Letter;

use App\Enums\CapsuleStatusEnum;
use App\Livewire\Forms\LetterForm;
use App\Models\Capsule;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;

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

    public int $message_limit = 2000;

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

        return $this->redirectRoute('capsules.letters.index', $this->capsule->id);
    }

    public function render()
    {
        return view('livewire.capsule.letter.create-letter');
    }

    #[On('set-location')]
    public function setLocation(string $latitude, string $longitude)
    {
        $this->form->latitude = $latitude;
        $this->form->longitude = $longitude;
        $this->form->location = true;
    }

    public function resetLocation()
    {
        $this->form->latitude = null;
        $this->form->longitude = null;
        $this->form->location = false;
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

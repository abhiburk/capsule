<?php

namespace App\Livewire\Capsule;

use App\Livewire\Forms\CapsuleForm;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]
class CreateCapsule extends Component
{
    public CapsuleForm $form;

    public function create()
    {
        $this->validate();

        $capsule = $this->form->store();

        return $this->redirectRoute('capsules.show', $capsule->id);
    }

    public function render()
    {
        return view('livewire.capsule.create-capsule');
    }
}

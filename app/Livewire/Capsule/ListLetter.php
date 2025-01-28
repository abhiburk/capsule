<?php

namespace App\Livewire\Capsule;

use App\Models\Capsule;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]
class ListLetter extends Component
{
    public Capsule $capsule;

    public function mount(Capsule $capsule)
    {
        $this->capsule = $capsule;
    }

    public function render()
    {
        $letters = $this->capsule->letters()->latest()->simplePaginate(5);
        return view('livewire.capsule.list-letter', [
            'letters' => $letters
        ]);
    }
}

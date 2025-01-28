<?php

namespace App\Livewire\Capsule;

use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]
class ListCapsule extends Component
{
    public function render()
    {
        $capsules = auth()->user()->capsules()->withCount('letters')->latest()->simplePaginate(5);
        return view('livewire.capsule.list-capsule', [
            'capsules' => $capsules
        ]);
    }
}

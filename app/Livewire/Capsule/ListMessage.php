<?php

namespace App\Livewire\Capsule;

use App\Models\Capsule;
use App\Models\Message;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]
class ListMessage extends Component
{
    public Capsule $capsule;

    public function mount(Capsule $capsule)
    {
        $this->capsule = $capsule;
    }

    public function render()
    {
        $messages = Message::latest()->simplePaginate(5);
        return view('livewire.capsule.list-message', [
            'messages' => $messages
        ]);
    }
}

<?php

namespace App\Livewire\Forms;

use App\Enums\ChannelTypesEnum;
use App\Models\Capsule;
use App\Models\Letter;
use Carbon\Carbon;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Http;
use Livewire\Attributes\Validate;
use Livewire\Form;

class LetterForm extends Form
{
    #[Validate('required|string')]
    public string $message = 'Dear future me,';

    #[Validate('required|array')]
    public array $channels = [ChannelTypesEnum::EMAIL];

    #[Validate('required')]
    public string|int $scheduled_days = 30;

    #[Validate('required|boolean')]
    public bool $is_public = false;

    #[Validate('nullable|array')]
    public array $recipients = [];

    #[Validate('required')]
    public string $scheduled_type = 'days';

    #[Validate('nullable|string')]
    public string $latitude = '';

    #[Validate('nullable|string')]
    public string $longitude = '';

    #[Validate('nullable|boolean')]
    public bool $location = false;

    public function store(Capsule $capsule): Letter
    {
        $this->validate();

        $data = [
            'user_id' => auth()->id(),
            'message' => $this->message,
            'channels' => $this->channels,
            'is_public' => $this->is_public,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
        ];

        if ($this->scheduled_type == 'custom') {
            $scheduledDays = Carbon::parse($this->scheduled_days);
            if ($scheduledDays < now()->addDays(7)) {
                abort(Response::HTTP_FORBIDDEN, 'Scheduled date must be atleast 7 days ahead.');
            }

            $data['scheduled_at'] = $scheduledDays;
            $data['scheduled_days'] = now()->diffInDays($scheduledDays, true);
        } else {
            $data['scheduled_at'] = now()->addDays($this->scheduled_days);
            $data['scheduled_days'] = $this->scheduled_days;
        }

        $letter = $capsule->letters()->create($data);

        $recipients = collect($this->recipients)->map(function ($email) {
            return ['email' => $email];
        })->toArray();

        $letter->recipients()->createMany($recipients);

        if ($letter->latitude && $letter->longitude) {
            dispatch(function () use ($letter) {
                $response = Http::withUserAgent('Capsule Application/1.0')
                    ->get("https://nominatim.openstreetmap.org/reverse?format=json&lat={$letter->latitude}&lon={$letter->longitude}")
                    ->throw()
                    ->json();

                if (isset($response['address'])) {
                    $address = $response['address'];
                    if (isset($address['state']) && isset($address['country'])) {
                        $letter->update([
                            'location' => "{$address['state']}, {$address['country']}",
                        ]);
                    }
                }
            });
        }

        return $letter;
    }
}

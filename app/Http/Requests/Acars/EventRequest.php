<?php

namespace App\Http\Requests\Acars;

use App\Interfaces\FormRequest;
use App\Models\Pirep;
use Auth;

/**
 * Class EventRequest
 * @package App\Http\Requests\Acars
 */
class EventRequest extends FormRequest
{
    /**
     * @return bool
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function authorize()
    {
        $pirep = Pirep::findOrFail($this->route('pirep_id'), ['user_id']);
        return $pirep->user_id === Auth::id();
    }

    public function rules()
    {
        $rules = [
            'events'              => 'required|array',
            'events.*.event'      => 'required',
            'events.*.lat'        => 'nullable|numeric',
            'events.*.lon'        => 'nullable|numeric',
            'events.*.created_at' => 'nullable|date',
        ];

        return $rules;
    }
}

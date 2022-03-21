<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class PatientResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'identify' => $this->uuid,
            'patient' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'birth' => $this->dob,
            'gender' => $this->gender,
            'height' => $this->height,
            'weight' => $this->weight,
            'created_at' => Carbon::make($this->created_at)->format('d/m/Y'),
        ];
    }
}

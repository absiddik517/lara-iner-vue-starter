<?php

namespace App\Http\Resources\Admins\Auth;

use Illuminate\Http\Resources\Json\JsonResource;

class RoleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
      //return parent::toArray($request);
      return [
                'name'       => $this->name,
        'website'       => $this->website,
        'email'       => $this->email,
        'delete_url' => route('auth.role.delete', $this->id),
        'edit_url'   => route('auth.role.edit', $this->id),
      ];
    }
}

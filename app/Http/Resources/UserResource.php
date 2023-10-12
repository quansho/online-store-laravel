<?php

namespace App\Http\Resources;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin User
 */
class UserResource extends JsonResource
{

    public static string $plainTextToken;

    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $data = [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'roles' => $this->roles()->get()
                ->map(function ($item) {
                    return ['id' => $item->id, 'name' => $item->name];
                })->toArray(),
        ];

        if(!empty(self::$plainTextToken))
        {
            $data += [
                'token' => self::$plainTextToken
            ];
        }
        return $data;
    }

    public function setPlainTextToken($plainTextToken, $request): array
    {
        self::$plainTextToken = $plainTextToken;
        return $this->toArray($request);
    }
}

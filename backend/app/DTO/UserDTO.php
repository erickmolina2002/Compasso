<?php

namespace App\DTO;

use Illuminate\Support\Facades\Hash;

class UserDTO
{
    public string $name;
    public string $email;
    public string $password;

    public function __construct($data)
    {
        $this->name = $data['name'];
        $this->email = strtolower($data['email']);
        $this->password = Hash::make($data['password']);
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password,
        ];
    }
}

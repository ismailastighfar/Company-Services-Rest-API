<?php

namespace App\DTOs;


class ServiceDTO
{
    public ?int $id;
    public String $name;
    public String $description;
    public float $price;
    public bool $is_active;
    public string $location;
    public string $contact_email;
    public string $contact_phone;

    public function __construct(array $data)
    {
        $this->id = $data['id'] ?? null;
        $this->name = $data['name'];
        $this->description = $data['description'];
        $this->price = $data['price'];
        $this->is_active = $data['is_active'];
        $this->location = $data['location'];
        $this->contact_email = $data['contact_email'];
        $this->contact_phone = $data['contact_phone'];
    }
}


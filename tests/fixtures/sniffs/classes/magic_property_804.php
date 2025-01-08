<?php

class User
{
    public string $lastName {
        set(string $name) {
            echo __PROPERTY__; // lastName
        }
    }

    public function __construct(
        string $lastName,
    ) {
        $this->lastName = $lastName;
    }
}

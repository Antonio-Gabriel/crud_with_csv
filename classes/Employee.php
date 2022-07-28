<?php

class Employee extends Storage
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getEmployee()
    {
        return $this->storage;
    }

    public function getByName(string $name)
    {
        return array_filter(
            $this->storage,
            fn ($values) => $values["name"] === $name
        );
    }

    private function checkIfUserAlreadyExists(string $email)
    {
        return array_filter(
            $this->storage,
            fn ($values) => $values["email"] === $email
        );
    }

    public function save(string $name, string $email, string $cargo)
    {
        if (empty($name) || empty($email) || empty($cargo)) {
            return response(400, "Please, check the fields if is correct");
        }

        if ($this->checkIfUserAlreadyExists($email)) {
            return response(401, "The user already exists");
        }

        $newId = generateId($this->getEmployee());

        $payload = [$newId, $name, $email, $cargo];

        $result = $this->create($payload);

        if ($result) {
            return response(200, "User successfully created");
        }

        return response(500, "An error occurred, please try again");
    }
}

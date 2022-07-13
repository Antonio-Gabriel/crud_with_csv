<?php

class Employee extends Storage
{
    public function __construct(string $mode = "r")
    {
        parent::__construct($mode);
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
            return response(400, "Por favor preencha devicamente os campos!");
        }

        if ($this->checkIfUserAlreadyExists($email)) {
            return response(401, "O usuário informádo já existe");
        }

        $newId = generateId($this->getEmployee());

        $payload = [$newId, $name, $email, $cargo];

        $result = $this->create($payload);

        if ($result) {
            return response(200, "Usuário criado com sucesso");
        }

        return response(500, "Algo deu errado, por favor tente novamente!");
    }
}

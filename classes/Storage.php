<?php

abstract class Storage
{
    protected array $storage = [];

    public function __construct(string $mode)
    {
        $fopen = fopen(
            getStoragePath("employee.csv"),
            $mode
        );

        $this->mapDataIntoStorage($fopen);

        fclose($fopen);

        // Remove a primeira posição do array (array_shift)
        # array_shift($this->storage);
    }

    private function mapDataIntoStorage($fopen)
    {
        fgetcsv($fopen);

        while (($data = fgetcsv($fopen)) !== false) {
            array_push(
                $this->storage,
                $this->organiseData($data)
            );
        }
    }

    private function organiseData(array $data)
    {
        [$id, $name, $email, $cargo] = $data;

        return [
            "id" => $id,
            "name" => $name,
            "email" => $email,
            "cargo" => $cargo
        ];
    }

    public function create(array $payload)
    {
        $fopen = fopen(
            getStoragePath("employee.csv"),
            "a+"
        );

        if (fputcsv($fopen, $payload) !== false) {

            fclose($fopen);

            return true;
        }

        fclose($fopen);

        return false;
    }
}

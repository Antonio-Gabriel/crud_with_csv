<?php

abstract class Storage
{
    protected array $storage = [];

    public function __construct()
    {
        $this->mapDataIntoStorage();

        // Remove the first position in array (array_shift)
        # array_shift($this->storage);
    }

    #[FileOpen()]
    private function mapDataIntoStorage()
    {
        $attributes = ReflectionAbsctract::getArgs(
            scoped: self::class,
            attr: FileOpen::class,
            method: "mapDataIntoStorage"
        );

        fgetcsv($attributes->fopen);

        while (($data = fgetcsv($attributes->fopen)) !== false) {
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

    #[FileOpen(mode: "a+")]
    public function create(array $payload)
    {
        $attributes = ReflectionAbsctract::getArgs(
            scoped: self::class,
            attr: FileOpen::class,
            method: "create"
        );

        if (fputcsv($attributes->fopen, $payload) !== false) {

            return true;
        }
        
        return false;
    }
}

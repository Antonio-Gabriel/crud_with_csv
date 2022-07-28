<?php

#[Attribute]
class FileOpen
{
    public function __construct(
        public mixed $fopen = null,
        private string $mode = "r"
    ) {
        $this->fopen = fopen(
            getStoragePath("employee.csv"),
            $mode
        );
    }
  
    public function __destruct()
    {
        fclose($this->fopen);
    }
}

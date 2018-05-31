<?php
class Connection extends PDO
{
    public function __construct() {
        parent::__construct("sqlite:employee.db");
        $this->setAttribute(PDO::ATTR_ERRMODE,
                            PDO::ERRMODE_EXCEPTION);
    }
}
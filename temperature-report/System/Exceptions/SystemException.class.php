<?php

// nasljeđuje metode iz klase Exception, i napravljena je funkcija koja će prikazati iznimku, tj greskuu
class SystemException extends Exception
{
    public function __construct($message = "Test", $code = 0, $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
    public function show()
    {
        return ("Error: " . $this->getMessage() . "File: " . $this->getFile() . "Line: " . $this->getLine() . "StackTrace: "  . $this->getTraceAsString());
    }
}

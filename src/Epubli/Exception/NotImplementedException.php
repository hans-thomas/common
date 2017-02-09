<?php

namespace Epubli\Exception;

use Exception;

class NotImplementedException extends Exception
{
    public function __construct($message = "", $code = 0, Exception $previous = null)
    {
        parent::__construct("$message is not yet implemented!", $code, $previous);
    }
}

<?php

namespace Epubli\Exception;

use Exception;

class NotSupportedException extends Exception
{
    /**
     * @param string $action The action that is not supported.
     * @param int $code
     * @param Exception|null $previous
     */
    public function __construct($action, $code = 0, Exception $previous = null)
    {
        parent::__construct("$action is not supported!", $code, $previous);
    }
}

<?php

namespace Epubli\Exception;

use Exception;

class NotImplementedException extends Exception
{
    /**
     * @param string $feature The feature that is not implemented.
     * @param int $code
     * @param Exception|null $previous
     */
    public function __construct($feature, $code = 0, Exception $previous = null)
    {
        parent::__construct("$feature is not yet implemented!", $code, $previous);
    }
}

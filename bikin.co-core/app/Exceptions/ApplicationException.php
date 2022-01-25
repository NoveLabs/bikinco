<?php
    
    namespace App\Exceptions;
    
    /**
     *
     */
    class ApplicationException extends \Exception
    {
        public function responseJson()
        {
            return response()->json(
                [
                    'status'  => false,
                    'data'    => [],
                    'message' => ! empty($this->message) ? $this->message
                        : 'Not found data.',
                ],
                406);
        }
    }
<?php
<<<<<<< HEAD

namespace App\Services\Rest;

class RestMessage
=======
/*
 * This file is part of the AllScorings package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @package AllScorings
 */

namespace App\Services\Rest;

use App\Services\Contracts\RestMessageContract;

class RestMessage implements RestMessageContract
>>>>>>> core-develop
{
    protected $status;

    protected $data;

    protected $message;

    protected $errors;

    public function setStatus($status)
    {
        $this->status = $status;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function setData($data)
    {
        $this->data = $data;
    }

    public function getData()
    {
        return $this->data;
    }

<<<<<<< HEAD
    public function setMessage()
=======
    public function setMessage($message)
>>>>>>> core-develop
    {
        $this->message = $message;
    }

    public function getMessage()
    {
        return $this->message;
    }

<<<<<<< HEAD
    public function addError($error, $message)
    {
        $this->errors[$error] = $message;
=======
    public function addError($error)
    {
        $this->data['errors'][] = $error;
>>>>>>> core-develop
    }

    public function setErrors($errors)
    {
<<<<<<< HEAD
        $this->errors = $errors;
=======
        $this->data['errors'] = $errors;
>>>>>>> core-develop
    }

    public function getErrors()
    {
<<<<<<< HEAD
        return $this->errors;
    }

=======
        return $this->data['errors'];
    }
    
>>>>>>> core-develop
    public function toArray()
    {
        return [
            'status' => $this->status,
            'data' => $this->data,
            'message' => $this->message,
            'errors' => $this->errors,
        ];
    }
}

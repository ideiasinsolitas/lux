<?php
/*
 * This file is part of the AllScorings package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @package AllScorings
 */

namespace App\Services\Rest;

use Illuminate\Contracts\Support\Jsonable;
use Illuminate\Contracts\Support\Arrayable;

class Message implements Jsonable, Arrayable
{
    protected $status;

    protected $data;

    protected $message;

    public function __construct($status = "success", $data = array(), $message = "")
    {
        $this->status = $status;
        $this->data = $data;
        $this->message = $message;
    }

    public function toArray()
    {
        $data = method_exists($this->data, 'toArray') ? $this->data->toArray() : $this->data;
        return [
            'status' => $this->status,
            'data' => $data,
            'message' => $this->message
        ];
    }

    public function toJson($options = 0)
    {
        return json_encode($this->toArray(), $options);
    }

    public function __toString()
    {
        return $this->toJson();
    }
}

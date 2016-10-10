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

use Illuminate\Http\JsonResponse;

class Response extends JsonResponse
{
    const LINE_BREAK = "\n";

    public function __construct($data, $code, $messages = array())
    {
        $message = $this->processMapperMessages($messages);
        $data = $this->getResponseMessage($data, $code, $message);
        parent::__construct($data, $code);
    }

    protected function processMapperMessages($messages)
    {
        $string = "";
        if (is_array($messages) && !empty($messages)) {
            foreach ($messages as $name => $group) {
                foreach ($group as $message) {
                    $string .= $name . ": " . $message . self::LINE_BREAK;
                }
            }
        }
        return $string;
    }

    protected function getResponseMessage($data = array(), $code = 200, $message = "")
    {
        if ($code < 400) {
            $status = "success";
            if (!$message) {
                $message = "Sua requisição foi completada com sucesso.";
            }
        } else {
            $status = "error";
            if (!$message) {
                $message = $code === 404 ? "Não encontrado" : "Algo deu errado, verifique seus dados.";
            }
        }
        return new Message($status, $data, $message);
    }
}

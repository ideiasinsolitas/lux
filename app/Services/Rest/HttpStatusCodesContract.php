<?php

namespace App\Services\Rest;

/**
 * Interface for holding HTTP status code messages used in this application.
 *
 * @author Pedro Koblitz <pedrokoblitz@gmail.com>
 */
interface HttpStatusCodesContract
{
    const MESSAGE_OK = 'requisição completada com sucesso';
    const MESSAGE_CREATED = 'criado';
    const MESSAGE_NO_CONTENT = 'vazio';
    const MESSAGE_NOT_MODIFIED = 'não houve alterações';
    const MESSAGE_BAD_REQUEST = 'requisição mal formada';
    const MESSAGE_UNAUTHORIZED = 'não autorizado';
    const MESSAGE_FORBIDDEN = 'proibido';
    const MESSAGE_NOT_FOUND = 'não econtrado';
    const MESSAGE_METHOD_NOT_ALLOWED = 'método não';
    const MESSAGE_GONE = 'o recurso não está mais neste endereço';
    const MESSAGE_UNSUPORTED_MEDIA_TYPE = 'mídia não suportada';
    const MESSAGE_UNPROCESSABLE_ENTITY = 'entidade não pôde ser processada';
    const MESSAGE_TOO_MANY_REQUESTS = 'o seu ip ultrapassou o número de requisições permitidas';
    const MESSAGE_INTERNAL_SERVER_ERROR = 'erro interno do servidor';
}

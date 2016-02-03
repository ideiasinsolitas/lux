<?php

return [

    /*
    |--------------------------------------------------------------------------
    | CRUD Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used in CRUD operations throughout the
    | system.
    | Regardless where it is placed, a CRUD label can be listed here so it is easily
    | found in a intuitive way.
    |
    */

    'actions'                  => 'Ações',
    'permissions'              => [
        'name'                 => 'Nome',
        'permission'           => 'Permissão',
        'dependencies'         => 'Dependências',
        'roles'                => 'Papéis',
        'system'               => 'Sistema?',
        'total'                => 'Total de permissões',
        'users'                => 'Usuários',
        'group'                => 'Grupo',
        'group-sort'           => 'Ordenação do grupo',
        'groups'               => [
            'name'             => 'Nome do grupo',
        ],
    ],
    'roles'                    => [
        'number_of_users'      => 'Nº de Usuários',
        'permissions'          => 'Permissões',
        'role'                 => 'Papel',
        'total'                => 'Total de papéis',
        'sort'                 => 'Ordenação',
    ],
    'users'                    => [
        'confirmed'            => 'Confirmado',
        'created'              => 'Criado em',
        'delete_permanently'   => 'Deletar Permanentemente',
        'email'                => 'E-mail',
        'id'                   => 'ID',
        'last_updated'         => 'Atualizado em',
        'name'                 => 'Nome',
        'no_banned_users'      => 'Não existem usuários banidos',
        'no_deactivated_users' => 'Não existem usuários desativados',
        'no_deleted_users'     => 'Não existem usuários deletados',
        'other_permissions'    => 'Outras Permissões',
        'restore_user'         => 'Restaurar Usuário',
        'roles'                => 'Papéis',
        'total'                => 'Total de usuários',
    ],

    // GEOLOCATION
    'place' => [
        'created'              => 'Criado em',
        'name' => 'Nome',
    ],

    'address' => [
        'created'              => 'Criado em',
        'street'              => 'Logradouro',
        'number'              => 'Número',
        'zipcode'              => 'Cep',
        'district' => 'Bairro',
        'city' => 'Cidade',
    ],

    'district' => [
        'name' => 'Nome',
        'city' => 'Cidade',
    ],

    'city' => [
        'name' => 'Nome',
        'province' => 'Estado',
        'country' => 'País'
    ],

    'province' => [
        'name' => 'Nome',
        'code' => 'Código',
    ],

    'country' => [
        'name' => 'Nome',
        'code' => 'Código',
    ],

    /*
    |--------------------------------------------------------------------------
    | CRUD Language Lines outside view Files
    |--------------------------------------------------------------------------
    |
    | These lines are being marked as obsolete by the localization helper
    | because they will only be found outside view files.
    |
    */
    'activate_user_button'     => 'Ativar Usuário',
    'ban_user_button'          => 'Banir Usuário',
    'change_password_button'   => 'Alterar Senha',
    'deactivate_user_button'   => 'Desativar Usuário',
    'delete_button'            => 'Deletar',
    'edit_button'              => 'Editar',
];

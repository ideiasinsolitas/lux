<?php

namespace App\DAL\Core\Sys;

use Illuminate\Support\Facades\DB;

use App\DAL\AbstractDAO;
use App\Exceptions\GeneralException;
use App\DAL\Core\Sys\Actions\UserAction;

class UserDAO extends AbstractDAO implements UserDAOContract
{

    public function __construct()
    {
        $filters = [
            'per_page' => 20,
            'sort' => 'first_name,asc'
        ];

        parent::__construct($filters);
    }

    protected function getBuilder()
    {
        return DB::table(self::TABLE)
            ->select(
                self::TABLE . '.' . self::PK,
                self::TABLE . '.email',
                self::TABLE . '.first_name',
                self::TABLE . '.middle_name',
                self::TABLE . '.last_name',
                self::TABLE . '.display_name',
                self::TABLE . '.activity',
                self::TABLE . '.created',
                self::TABLE . '.modified',
                self::TABLE . '.deleted'
            );
    }

    protected function parseFilters(array $filters = array(), $defaults = true)
    {
        if (!empty($filters) && $defaults) {
            $filters = array_merge($this->filters, $filters);
        }
        return $this->finish($filters);
    }
}

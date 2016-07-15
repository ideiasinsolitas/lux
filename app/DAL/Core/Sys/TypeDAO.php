<?php
namespace App\DAL\Core\Sys;

use Illuminate\Support\Facades\DB;

use App\DAL\AbstractDAO;
use App\DAL\DAOTrait;
use App\Exceptions\GeneralException;
use App\DAL\Core\Sys\Actions\TypeAction;
use App\DAL\Core\Sys\Relationships\TypeRelationship;
use App\DAL\Core\Sys\Contracts\TypeDAOContract;

class TypeDAO extends AbstractDAO implements TypeDAOContract
{
    use DAOTrait, TypeAction;

    public function __construct()
    {
        $this->filters = [
            'sort' => 'name,asc'
        ];
        $this->builder = $this->getBuilder();
    }

    public function getBuilder()
    {
        return DB::table(self::TABLE)
            ->select(
                self::TABLE . '.' . self::PK,
                self::TABLE . '.name',
                self::TABLE . '.class'
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

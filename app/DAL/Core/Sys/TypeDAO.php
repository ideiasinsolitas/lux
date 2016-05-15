<?php
namespace App\DAL\Core\Sys;

use Illuminate\Support\Facades\DB;

use App\DAL\AbstractDAO;
use App\Exceptions\GeneralException;
use App\DAL\Core\Sys\Actions\TypeAction;
use App\DAL\Core\Sys\Relationships\TypeRelationship;

class TypeDAO extends AbstractDAO implements TypeDAOContract
{
    use TypeAction;

    public function __construct()
    {
        $filters = [
            'per_page' => 20,
            'sort' => 'name,asc'
        ];

        parent::__construct($filters);
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

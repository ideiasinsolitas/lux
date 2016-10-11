<?php
namespace App\DAL\Business\ProjectManagement;

use Illuminate\Support\Facades\DB;

use App\DAL\AbstractDAO;
use App\DAL\DAOTrait;
use App\Exceptions\GeneralException;
use App\DAL\Business\ProjectManagement\Contracts\TicketDAOContract;
use App\DAL\Business\ProjectManagement\Actions\TicketAction;
use App\DAL\Business\ProjectManagement\Relationships\TicketRelationship;

class TicketDAO extends AbstractDAO implements TicketDAOContract
{
    use TicketAction,
        TicketRelationship,
        DAOTrait;

    /**
     * /
     */
    public function __construct()
    {
        $this->filters = [
            'sort' => self::PK . ',desc',
        ];

        $this->builder = $this->getBuilder();
    }

    public function getBuilder()
    {
        return DB::table(self::TABLE)
            ->leftJoin('core_users AS cu1', self::TABLE . '.responsible_id', '=', 'cu1.id')
            ->leftJoin('core_users AS cu2', self::TABLE . '.customer_id', '=', 'cu2.id')
            ->leftJoin('business_projects AS bp', self::TABLE . '.project_id', '=', 'bp.id')
            ->select(
                self::TABLE . '.id',
                self::TABLE . '.responsible_id',
                'cu1.username AS responsible_username',
                'cu1.email AS responsible_email',
                'cu1.first_name AS responsible_first_name',
                self::TABLE . '.customer_id',
                'cu2.username AS customer_username',
                'cu2.email AS customer_email',
                'cu2.first_name AS customer_first_name',
                self::TABLE . '.project_id',
                'bp.name',
                'bp.description',
                self::TABLE . '.problem_url',
                self::TABLE . '.description',
                self::TABLE . '.created',
                self::TABLE . '.modified'
            );
    }

    protected function parseFilters(array $filters = array(), $defaults = true)
    {
        if ($defaults) {
            $filters = array_merge($this->filters, $filters);
        }
        
        if (isset($filters['activity'])) {
            $this->builder->where(self::TABLE . '.activity', $filters['activity']);
        }
        
        if (isset($filters['activity_greater'])) {
            $this->builder->where(self::TABLE . '.activity', '>', $filters['activity_greater']);
        }
        if (isset($filters['project_id'])) {
            $this->builder->where(self::TABLE . '.project_id', '=', $filters['project_id']);
        }
        if (isset($filters[self::PK])) {
            $this->builder->where(self::TABLE . '.id', $filters[self::PK]);
        }

        return $this->finish($filters);
    }
}

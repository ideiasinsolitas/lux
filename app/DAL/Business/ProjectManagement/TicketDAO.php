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
            ->join()
            ->join()
            ->select(
                self::TABLE . '.id',
                self::TABLE . '.responsible_id',
                self::TABLE . '.customer_id',
                self::TABLE . '.project_id',
                self::TABLE . '.problem_url',
                self::TABLE . '.description',
                self::TABLE . '.activity',
                self::TABLE . '.created',
                self::TABLE . '.modified',
                self::TABLE . '.deleted'
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

        if (isset($filters['id'])) {
            $this->builder->where(self::TABLE . '.id', $filters['id']);
        }

        return $this->finish($filters);
    }
}

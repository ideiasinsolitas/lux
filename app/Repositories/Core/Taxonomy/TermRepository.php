<?php
namespace App\Repositories\Core\Taxonomy\Term;

use App\Models\Core\Taxonomy\Term\Term;
use App\Repositories\Repository;
use App\Exceptions\GeneralException;

/**
 * Class EloquentTermRepository
 * @package App\Repositories\Term
 */
class TermRepository extends Repository
{
    /**
     * /
     */
    public function __construct()
    {
        $this->model = 'App\Models\Core\Taxonomy\Term\Term';
    }

    /**
     * @param $id
     * @param bool $withRoles
     * @return mixed
     * @throws GeneralException
     */
    public function findOrFail($id)
    {
        return Term::findOrFail($id);
    }

    /**
     * @param $per_page
     * @param string $order_by
     * @param string $sort
     * @param int $status
     * @return mixed
     */
    public function getTermsPaginated($per_page = 20, $status = 1, $order_by = 'id', $sort = 'asc')
    {
        return Term::where('status', $status)->orderBy($order_by, $sort)->paginate($per_page);
    }

    /**
     * @param $per_page
     * @return \Illuminate\Pagination\Paginator
     */
    public function getDeletedTermsPaginated($per_page = 20)
    {
        return Term::where('activity', 0)->paginate($per_page);
    }

    /**
     * @param string $order_by
     * @param string $sort
     * @return mixed
     */
    public function getAllTerms($order_by = 'id', $sort = 'asc')
    {
        return Term::orderBy($order_by, $sort)->get();
    }

    /*
     * CRUD
     */
    /**
     * /
     * @param  $input [description]
     * @return [type]         [description]
     */
    public function create($termInput, $translationInput)
    {
        $translationInput['translatable_type'] = $this->type;
        $translationInput['translatable_id'] = DB::table('core_terms')->insertGetId($termInput);
        return DB::table('core_translations')->insert($translationInput);
    }

    /**
     * /
     * @param  $input [description]
     * @return [type]         [description]
     */
    public function update($termInput, $translationInput)
    {
        $id = $termInput['id'];
        DB::table('core_terms')->update($termInput)->where('id', $id);
        DB::table('core_translations')
            ->update($translationInput)
            ->where('lang', $translationInput['lang'])
            ->where('translatable_type', $this->type)
            ->where('translatable_id', $id);
    }
}

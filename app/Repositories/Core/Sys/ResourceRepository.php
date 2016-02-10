<?php
namespace App\Repositories\Core\Sys;

use App\Models\Core\Sys\Resource;
use App\Repositories\Repository;
use App\Exceptions\GeneralException;

use App\Repositories\Common\Activity;

/**
 * Class EloquentResourceRepository
 * @package App\Repositories\Resource
 */
class ResourceRepository extends Repository
{
    use Activity,
        Builder,
        Collectable,
        Display,
        Likeable,
        Metadata,
        Nodable,
        OwnerTaggable,
        Ownership,
        Translatable,
        Tree,
        Typed,
        UserTaggable,
        Votable;

    /**
     * /
     */
    public function __construct()
    {
        $this->modelNamespace = 'App\Models\Package\Resource\Resource';
        $this->mainTable = 'publishing_resources';
        $this->type = 'Resource';
    }

    /**
     * @param $id
     * @param bool $withRoles
     * @return mixed
     * @throws GeneralException
     */
    public function findOrFail($id)
    {
        return Resource::findOrFail($id);
    }

    /**
     * @param $per_page
     * @param string $order_by
     * @param string $sort
     * @param int $status
     * @return mixed
     */
    public function getResourcesPaginated($per_page = 20, $status = 1, $order_by = 'id', $sort = 'asc')
    {
        return Resource::where('status', $status)->orderBy($order_by, $sort)->paginate($per_page);
    }

    /**
     * @param $per_page
     * @return \Illuminate\Pagination\Paginator
     */
    public function getDeletedResourcesPaginated($per_page = 20)
    {
        return Resource::where('activity', 0)->paginate($per_page);
    }

    /**
     * @param string $order_by
     * @param string $sort
     * @return mixed
     */
    public function getAllResources($order_by = 'id', $sort = 'asc')
    {
        return Resource::orderBy($order_by, $sort)->get();
    }

    /**
     * /
     * @param  Record $record [description]
     * @return [type]         [description]
     */
    public function create($resourceInput, $translationInput)
    {
        $id = DB::table('publishing_resources')->insertGetId($resourceInput);
        $translationInput['translatable_type'] = $this->modelSlug;
        $translationInput['translatable_id'] = $id;
        return DB::table('publishing_resources')->insert($translationInput);
    }

    /**
     * /
     * @param  Record $record [description]
     * @return [type]         [description]
     */
    public function update($resourceInput, $translationInput)
    {
        DB::table('publishing_resources')
            ->update($resourceInput)
            ->where('id', $resourceInput['id']);
        DB::table('core_translations')->update($translationInput)
            ->where('translatable_type', $this->modelSlug)
            ->where('translatable_id', $resourceInput['id']);
    }

    /**
     * /
     * @param  integer $page     [description]
     * @param  integer $per_page [description]
     * @param  string  $key      [description]
     * @param  string  $order    [description]
     * @param  string  $lang     [description]
     * @return [type]            [description]
     */
    public function find($per_page = 20, $order_by = 'modified', $sort = 'desc', $lang = 'pt-br')
    {
        return DB::table('publishing_resources')
            ->join('translations', function ($q) {
                $q->on('publishing_resources.id', '=', 'core_translations.translatable_id')
                    ->where('core_translations.translatable_type', '=', 'Resource');
            })
            ->join()
            ->select(
                'publishing_resources.id',
                'publishing_resources.url',
                'publishing_resources.filepath',
                'publishing_resources.filename',
                'publishing_resources.extension',
                'publishing_resources.embed',
                'publishing_resources.activity',
                'publishing_resources.created',
                'publishing_resources.modified',
                'core_translations.title',
                'core_translations.description',
                DB::raw('core_types.name AS type')
            )
            ->where('core_translations.language', $lang)
            ->where('publishing_resources.activity', '>', 0)
            ->orderBy($order_by, $sort)
            ->paginate($per_page);
    }

    /**
     * /
     * @param  [type]  $type     [description]
     * @param  integer $page     [description]
     * @param  integer $per_page [description]
     * @param  string  $key      [description]
     * @param  string  $order    [description]
     * @param  string  $lang     [description]
     * @return [type]            [description]
     */
    public function findByType($type, $per_page = 20, $order_by = 'title', $sort = 'asc', $lang = 'pt-br')
    {
        return DB::table('publishing_resources')
            ->select(
                'publishing_resources.id',
                'publishing_resources.url',
                'publishing_resources.filepath',
                'publishing_resources.filename',
                'publishing_resources.extension',
                'publishing_resources.embed',
                'publishing_resources.activity',
                'publishing_resources.created',
                'publishing_resources.modified',
                'core_translations.title',
                'core_translations.description',
                DB::raw('core_types.name AS type')
            )
            ->where('type', $type)
            ->where('core_translations.language', $lang)
            ->where('publishing_resources.activity', '>', 0)
            ->orderBy($order_by, $sort)
            ->paginate($per_page);
    }

    /**
     * /
     * @param  [type] $id   [description]
     * @param  string $lang [description]
     * @return [type]       [description]
     */
    public function show($id, $lang = 'pt-br')
    {
        $builder = DB::table('publishing_resources');
        $builder = $this->build($builder);
        return $builder
            ->select(
                'publishing_resources.id',
                'publishing_resources.url',
                'publishing_resources.filepath',
                'publishing_resources.filename',
                'publishing_resources.extension',
                'publishing_resources.embed',
                'publishing_resources.activity',
                'publishing_resources.created',
                'publishing_resources.modified',
                'core_translations.title',
                'core_translations.description',
                DB::raw('core_types.name AS type')
            )
            ->where('publishing_resources.id', $id)
            ->where('core_translations.language', $lang)
            ->where('publishing_resources.activity', '>', 0)
            ->get();
    }
}

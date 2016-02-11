<?php
namespace App\Repositories\Core\SiteBuilding\Node;

use App\Models\Package\Node\Node;
use App\Repositories\Repository;
use App\Repositories\Common\Activity;
use App\Repositories\Common\Builder;
use App\Repositories\Common\Collaborative;
use App\Repositories\Common\Display;
use App\Repositories\Common\Likeable;
use App\Repositories\Common\Metadata;
use App\Repositories\Common\OwnerTaggable;
use App\Repositories\Common\Ownership;
use App\Repositories\Common\Translatable;
use App\Repositories\Common\Tree;
use App\Repositories\Common\Typed;
use App\Repositories\Common\UserTaggable;
use App\Repositories\Common\Votable;
use App\Exceptions\GeneralException;

/**
 * Class EloquentNodeRepository
 * @package App\Repositories\Node
 */
class NodeRepository extends Repository
{
    use Activity,
        Builder,
        Collaborative,
        Display,
        Likeable,
        Metadata,
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
        $this->table = 'publishing_nodes';
        $this->type = 'Node';
    }

    /*
     * CRUD
     */
    public function findOrFail($id, $lang = 'pt-br')
    {
        return Node::findOrFail($id);
    }

    /**
     * /
     * @param  Request $request [description]
     * @return [type]         [description]
     */
    public function create($nodeInput, $translationInput)
    {
        $id = DB::table($this->table)->insertGetId($nodeInput);
        $translationInput['translatable_id'] = $id;
        $translationInput['translatable_type'] = $this->modelSlug;
        DB::table('core_translations')->insert($translationInput);
        return $id;
    }

    /**
     * /
     * @param  Request $request [description]
     * @return [type]         [description]
     */
    public function update($nodeInput, $translationInput)
    {
        DB::table($this->table)
            ->where('id', $nodeInput['id'])
            ->update($nodeInput);
        DB::table('core_translations')
            ->where('translatable_type', 'Node')
            ->where('translatable_id', $nodeInput['id'])
            ->update($translationInput);
    }

    /**
     * /
     * @param  [type] $id   [description]
     * @param  string $lang [description]
     * @return [type]       [description]
     */
    public function getNode($id, $lang = 'pt-br')
    {
        $result = DB::table($this->table)
            ->join('translations t2', 'publishing_nodes..id', '=', 'core_translations.translatable_id')
            ->join('types t3', 'publishing_nodes..type_id', '=', 't3.id')
            ->select(
                'publishing_nodes.id',
                'publishing_nodes.activity',
                'publishing_nodes.date_pub',
                'publishing_nodes.created',
                'publishing_nodes.modified',
                DB::raw('core_types.name AS type')
            )
            ->where('publishing_nodes..id', $id)
            ->where('core_translations.language', $lang)
            ->get();

        return $result;
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
    public function getNodesPaginated($per_page = 20, $status = 1, $order_by = 'id', $sort = 'asc', $lang = 'pt-br')
    {
        $builder = DB::table($this->table);
        $builder = $this->build($builder);
        return $builder
            ->select(
                'publishing_nodes.id',
                'publishing_nodes.activity',
                'publishing_nodes.date_pub',
                'publishing_nodes.created',
                'publishing_nodes.modified',
                'core_translations.slug',
                'core_translations.title',
                'core_translations.subtitle',
                'core_translations.excerpt',
                'core_translations.description',
                'core_translations.body',
                DB::raw('core_types.name AS type')
            )
            ->where('activity', '>', '0')
            ->where('language', $lang)
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
    public function getNodesByTypePaginated($type, $per_page = 12, $order_by = 'modified', $sort = 'asc', $lang = 'pt-br')
    {
        $builder = DB::table($this->table);
        $builder = $this->build($builder);
        return $builder
            ->select(
                'publishing_nodes.id',
                'publishing_nodes.activity',
                'publishing_nodes.date_pub',
                'publishing_nodes.created',
                'publishing_nodes.modified',
                'core_translations.slug',
                'core_translations.title',
                'core_translations.subtitle',
                'core_translations.excerpt',
                'core_translations.description',
                'core_translations.body',
                DB::raw('core_types.name AS type')
            )
            ->where('type', $type)
            ->where('main.activity', '>', '0')
            ->where('core_translations.language', $lang)
            ->orderBy($order_by, $sort)
            ->paginate($per_page);
    }

    /**
     * /
     * @param [type] $id [description]
     */
    public function markDraft($id)
    {
        return DB::table($this->table)->update(['status' => 3])->where('id', $id);
    }

    /**
     * /
     * @param [type] $id [description]
     */
    public function markPending($id)
    {
        return DB::table($this->table)->update(['status' => 4])->where('id', $id);
    }

    /**
     * /
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function publish($id)
    {
        return DB::table($this->table)->update(['status' => 5])->where('id', $id);
    }
}

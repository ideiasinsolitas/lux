<?php
namespace App\Repositories\Package\Node;

use App\Models\Package\Node\Node;
use App\Repositories\Repository;
use App\Exceptions\GeneralException;

/**
 * Class EloquentNodeRepository
 * @package App\Repositories\Node
 */
class NodeRepository extends Repository
{
    /**
     * /
     */
    public function __construct()
    {
        $this->modelNamespace = 'App\Models\Package\Node\Node';
        $this->mainTable = 'publishing_nodes';
        $this->modelSlug = 'Node';
    }

    /**
     * @param $id
     * @param bool $withRoles
     * @return mixed
     * @throws GeneralException
     */
    public function findOrFail($id)
    {
        return Node::findOrFail($id);
    }

    /**
     * @param string $order_by
     * @param string $sort
     * @return mixed
     */
    public function getAllNodes($order_by = 'created', $sort = 'desc')
    {
        return Node::orderBy($order_by, $sort)->get();
    }

    /**
     * @param $id
     * @return boolean|null
     * @throws GeneralException
     */
    public function delete($id)
    {

    }

    /**
     * @param $id
     * @return bool
     * @throws GeneralException
     */
    public function restore($id)
    {
        $node = $this->findOrFail($id);

        if ($node->restore()) {
            return true;
        }

        throw new GeneralException("There was a problem restoring this node. Please try again.");
    }

    /**
     * @param $id
     * @param $status
     * @return bool
     * @throws GeneralException
     */
    public function mark($id, $status)
    {
        if (auth()->id() == $id && ($status == 0 || $status == 2)) {
            throw new GeneralException("You can not do that to yourself.");
        }

        $node = $this->findOrFail($id);
        $node->status = $status;

        if ($node->save()) {
            return true;
        }

        throw new GeneralException("There was a problem updating this node. Please try again.");
    }


    /*
     * CRUD
     */
    /**
     * /
     * @param  Request $request [description]
     * @return [type]         [description]
     */
    public function create($nodeInput, $translationInput)
    {
        $id = DB::table($this->mainTable)->insertGetId($nodeInput);
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
        DB::table($this->mainTable)
                    ->where('id', $nodeInput['id'])
                    ->update($nodeInput);
        DB::table('core_translations')
                    ->where('translatable_type', 'node')
                    ->where('translatable_id', $nodeInput['id'])
                    ->update($translationInput);
    }

    /**
     * /
     * @param  [type] $id   [description]
     * @param  string $lang [description]
     * @return [type]       [description]
     */
    public function show($id, $lang = 'pt-br')
    {
        $result = DB::table($this->mainTable)
            ->join('translations t2', 't1.id', '=', 't2.translatable_id')
            ->join('types t3', 't1.type_id', '=', 't3.id')
            ->select(
                't1.id',
                't1.activity',
                't1.date_pub',
                't1.created',
                't1.modified',
                't2.slug',
                't2.title',
                't2.subtitle',
                't2.tagline',
                't2.excerpt',
                't2.body',
                't3.name AS type'
            )
            ->where('t1.id', $id)
            ->where('t2.language', $lang)
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
        return DB::table($this->mainTable)
            ->join('core_translations', function ($q) {
                $q->on('publishing_nodes.id', '=', 'core_translations.translatable_id')
                    ->where('core_translations.translatable_type', '=', 'Node');
            })
            ->join('core_types', 'publishing_nodes.type_id', 'core_types.id')
            ->select(
                'publishing_nodes.id',
                'publishing_nodes.activity',
                'publishing_nodes.date_pub',
                'publishing_nodes.created',
                'publishing_nodes.modified',
                'core_translations.slug',
                'core_translations.title',
                'core_translations.subtitle',
                'core_translations.tagline',
                'core_translations.excerpt',
                'core_translations.body',
                'core_types.name AS type'
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
        return DB::table($this->mainTable)
            ->join('core_translations', function ($q) {
                $q->on('publishing_nodes.id', '=', 'core_translations.translatable_id')
                    ->where('core_translations.translatable_type', '=', 'Node');
            })
            ->join('core_types', 'publishing_nodes.type_id', 'core_types.id')
            ->select(
                'publishing_nodes.id',
                'publishing_nodes.activity',
                'publishing_nodes.date_pub',
                'publishing_nodes.created',
                'publishing_nodes.modified',
                'core_translations.slug',
                'core_translations.title',
                'core_translations.subtitle',
                'core_translations.tagline',
                'core_translations.excerpt',
                'core_translations.body',
                'core_types.name AS type'
            )
            ->where('type', $type)
            ->where('activity', '>', '0')
            ->where('language', $lang)
            ->orderBy($order_by, $sort)
            ->paginate($per_page);
    }

    /**
     * /
     * @param [type] $id [description]
     */
    public function setDraft($id)
    {
        return DB::table($this->mainTable)->update(['status' => 0])->where('id', $id);
    }

    /**
     * /
     * @param [type] $id [description]
     */
    public function setPending($id)
    {
        return DB::table($this->mainTable)->update(['status' => 0])->where('id', $id);
    }

    /**
     * /
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function publish($id)
    {
        return DB::table($this->mainTable)->update(['status' => 0])->where('id', $id);
    }
}

<?php
namespace App\Repositories\_Component\_Package\Content;

use Illuminate\Support\Facades\DB;

use App\Models\_Component\_Package\Content\Content;
use App\Repositories\Repository;

use App\Repositories\Common\Activity;
use App\Repositories\Common\Collaborative;
use App\Repositories\Common\Collector;
use App\Repositories\Common\Commentable;
use App\Repositories\Common\Likeable;
use App\Repositories\Common\OwnerTaggable;
use App\Repositories\Common\Ownable;
use App\Repositories\Common\Typed;
use App\Repositories\Common\UserTaggable;
use App\Repositories\Common\Votable;

use App\Exceptions\GeneralException;

/**
 * Class EloquentContentRepository
 * @package App\Repositories\Content
 */
class ContentRepository extends Repository
{
    use Activity,
        Builder,
        Collaborator,
        Collectable,
        Likeable,
        OwnerTaggable,
        Ownable,
        Typed,
        UserTaggable,
        Votable;

    /**
     * /
     */
    public function __construct()
    {
        $this->table = 'publishing_contents';
        $this->type = 'Content';
    }

    /**
     * @param $input
     * @return int
     */
    public function create($input, $translationInput, $collectionInput)
    {
        return DB::table($this->table)
            ->insertGetId($input);
    }

    /**
     * @param $id
     * @param $input
     * @return mixed
     */
    public function update($id, $input, $translationInput, $collectionInput)
    {
        return DB::table($this->table)
            ->update($input)
            ->where('id', $id);
    }

    private function getBuilder()
    {
        return DB::table($this->table)
            ->join()
            ->join()
            ;
    }
}

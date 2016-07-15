<?php

namespace App\DAL\Core\Sys;

use Illuminate\Support\Facades\DB;

use App\DAL\AbstractDAO;
use App\DAL\DAOTrait;
use App\Exceptions\GeneralException;
use App\DAL\Core\Sys\Actions\UserAction;
use App\DAL\Core\Sys\Contracts\UserDAOContract;

class UserDAO extends AbstractDAO implements UserDAOContract
{
    use DAOTrait, UserAction;

    public function __construct()
    {
        $this->filters = [
            'sort' => 'first_name,asc'
        ];
        $this->builder = $this->getBuilder();
    }

    public function getBuilder()
    {
        return DB::table(self::TABLE)
            ->join(self::PROFILE_TABLE, self::PROFILE_TABLE . '.' . self::FK, '=', self::TABLE . '.' . self::PK)
            ->select(
                self::TABLE . '.' . self::PK,
                self::TABLE . '.email',
                self::PROFILE_TABLE . '.first_name',
                self::PROFILE_TABLE . '.middle_name',
                self::PROFILE_TABLE . '.last_name',
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

        if (isset($filters['activity'])) {
            $this->builder->where(self::TABLE . '.activity', $filters['activity']);
        }
        
        if (isset($filters['activity_greater'])) {
            $this->builder->where(self::TABLE . '.activity', '>', $filters['activity_greater']);
        }
        
        return $this->finish($filters);
    }

    protected function handleInput(array $input)
    {
        $userInput = ['email' => $input['email'], 'display_name' => $input['display_name'], 'activity' => $input['activity']];
        $userProfileInput = ['first_name' => $input['first_name'], 'middle_name' => $input['middle_name'], 'last_name' => $input['last_name']];
        return [$userInput, $userProfileInput];
    }

    public function insert(array $input)
    {
        list($userInput, $userProfileInput) = $this->handleInput($input);
        $user_id = DB::table(self::TABLE)->insertGetId($userInput);
        $userProfileInput[self::FK] = $user_id;
        $insertProfile = DB::table(self::PROFILE_TABLE)
            ->insert($userProfileInput);
        if ($user_id && $insertProfile) {
            return $user_id;
        }
        throw new \Exception("Error Processing Request", 1);
    }

    public function update(array $input, $pk)
    {
        if (!is_int($pk)) {
            throw new \Exception("Error Processing Request", 1);
        }
        list($userInput, $userProfileInput) = $this->handleInput($input);
        $result = DB::table(self::TABLE)
            ->where(self::PK, $pk)
            ->update($userInput);
        if (!$result) {
            throw new \Exception("Error Processing Request", 1);
        }
        return DB::table(self::PROFILE_TABLE)
            ->where(self::FK, $pk)
            ->update($userProfileInput);
    }
}

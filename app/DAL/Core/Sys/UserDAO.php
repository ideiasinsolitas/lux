<?php

namespace App\DAL\Core\Sys;

use Illuminate\Support\Facades\DB;

use App\DAL\AbstractDAO;
use App\Exceptions\GeneralException;
use App\DAL\Core\Sys\Actions\UserAction;

class UserDAO extends AbstractDAO implements UserDAOContract
{

    public function __construct()
    {
        $filters = [
            'per_page' => 20,
            'sort' => 'first_name,asc'
        ];

        parent::__construct($filters);
    }

    protected function getBuilder()
    {
        return DB::table(self::TABLE)
            ->join('core_user_profiles', 'core_user_profiles.user_id', '=', 'core_users.id')
            ->select(
                self::TABLE . '.' . self::PK,
                self::TABLE . '.email',
                'core_user_profiles.first_name',
                'core_user_profiles.middle_name',
                'core_user_profiles.last_name',
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
        $userProfileInput['user_id'] = $user_id;
        return DB::table('core_user_profiles')
            ->insert($userProfileInput);
    }

    public function update(array $input, $pk)
    {
        if (!is_int($pk)) {
            throw new \Exception("Error Processing Request", 1);
        }
        list($userInput, $userProfileInput) = $this->handleInput($input);
        DB::table(self::TABLE)
            ->where(self::PK, $pk)
            ->update($userInput);
        $userProfileInput['user_id'] = $user_id;
        return DB::table('core_user_profiles')
            ->where('user_id', $pk)
            ->update($userProfileInput);
    }
}
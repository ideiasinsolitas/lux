<?php

use Carbon\Carbon;

class ProjectSeeder extends BaseSeeder
{
    protected $current_project_id;
    protected $current_ticket_id;
    
    protected $parent_node_id;

    public function init()
    {
        $this->faker = $this->getFaker();
    }

    public function insertProject()
    {
        $project = [
            'name' => $this->faker->name,
            'description' => $this->faker->realText(),
            'activity' => 1,
            'created' => $this->faker->dateTimeThisMonth,
            'modified' => Carbon::now(),
        ];
        $node = $this->getNodeTemplate('Project');
        $node_id = DB::table('core_nodes')->insertGetId($node);
        $this->current_node_id = $node_id;
        $project['node_id'] = $node_id;
        $this->current_project_id = DB::table('business_projects')->insertGetId($project);
        return $this->current_project_id;
    }

    public function insertTicket()
    {
        $ticket = [
            'project_id' => $this->current_project_id,
            'customer_id' => 3,
            'problem_url' => $this->faker->url,
            'description' => $this->faker->realText(),
            'activity' => 1,
            'created' => $this->faker->dateTimeThisMonth,
            'modified' => Carbon::now(),
            'project_id' => $this->current_project_id
        ];
        $node = $this->getNodeTemplate('Ticket');
        $node_id = DB::table('core_nodes')->insertGetId($node);
        $this->current_node_id = $node_id;
        $ticket['node_id'] = $node_id;
        $this->current_ticket_id = DB::table('business_tickets')->insertGetId($ticket);
        return $this->current_ticket_id;
    }

    public function insertComment()
    {
        $comment = [
            'user_id' => 1,
            'comment' => $this->faker->realText(),
            'parent_id' => 0,
            'commentable_type' => 'Ticket',
            'commentable_id' => $this->current_ticket_id,
            'activity' => 1,
            'created' => $this->faker->dateTimeThisMonth,
            'modified' => Carbon::now(),
        ];
        $node = $this->getNodeTemplate('Comment');
        $node_id = DB::table('core_nodes')->insertGetId($node);
        $this->current_node_id = $node_id;
        $comment['node_id'] = $node_id;
        return DB::table('core_comments')->insertGetId($comment);
    }

    public function insertVote()
    {
        $vote = [
            'vote' => 1,
            'user_id' => 1,
            'votable_type' => 'Ticket',
            'votable_id' => $this->current_ticket_id,
            'created' => $this->faker->dateTimeThisMonth,
        ];
        return DB::table('core_votes')->insertGetId($vote);
    }

    public function run()
    {
        $this->init();
        for ($i=1; $i < 5; $i++) {
            $this->insertProject();
            $this->parent_node_id = $this->current_node_id;

            for ($a=1; $a < rand(5, 10); $a++) {
                $this->insertTicket();
                $oldNodeVal = $this->parent_node_id;
                $this->parent_node_id = $this->current_node_id;

                for ($x=1; $x < rand(3, 8); $x++) {
                    $this->insertComment();
                }
                $this->insertVote();
                $this->parent_node_id = $oldNodeVal;
            }
            $this->parent_node_id = 0;
        }
    }
}

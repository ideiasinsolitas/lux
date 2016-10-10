<?php

use Carbon\Carbon;

class ProjectSeeder extends BaseSeeder
{
    protected $current_project_id;
    protected $current_ticket_id;
    
    protected $parent_node_id;

    public function init()
    {
        $faker = new \Faker\Generator();
        $faker->addProvider(new \Faker\Provider\pt_BR\Person($faker));
        $faker->addProvider(new \Faker\Provider\pt_BR\Address($faker));
        $faker->addProvider(new \Faker\Provider\pt_BR\Company($faker));
        $faker->addProvider(new \Faker\Provider\en_US\Text($faker));
        $faker->addProvider(new \Faker\Provider\pt_BR\PhoneNumber($faker));
        $faker->addProvider(new \Faker\Provider\DateTime($faker));
        $faker->addProvider(new \Faker\Provider\Internet($faker));
        $faker->addProvider(new \Faker\Provider\Lorem($faker));

        $this->faker = $faker;
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
        $node = $this->getNodeTemplate();
        $node['class'] = 'Project';
        $node_id = DB::table('core_nodes')->insertGetId($node);
        $project['node_id'] = $node_id;
        $this->parent_node_id = $node_id;
        $this->current_project_id = DB::table('business_projects')->insertGetId($project);
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
        $node = $this->getNodeTemplate();
        $node['class'] = 'Ticket';
        $node_id = DB::table('core_nodes')->insertGetId($node);
        $ticket['node_id'] = $node_id;
        $this->parent_node_id = $node_id;
        $this->current_ticket_id = DB::table('business_tickets')->insertGetId($ticket);
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
        $node = $this->getNodeTemplate();
        $node['class'] = 'Comment';
        $node_id = DB::table('core_nodes')->insertGetId($node);
        $comment['node_id'] = $node_id;
        $this->parent_node_id = $node_id;
        DB::table('core_comments')->insert($comment);
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
        DB::table('core_votes')->insert($vote);
    }

    public function run()
    {
        $this->init();
        for ($i=1; $i < 5; $i++) {
            $this->insertProject();

            for ($a=1; $a < rand(20, 40); $a++) {
                $this->insertTicket();

                for ($x=1; $x < rand(10, 30); $x++) {
                    $this->insertComment();
                }

                $this->insertVote();
            }
        }
    }
}

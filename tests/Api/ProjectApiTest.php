<?php

namespace Testing\Api;

use Testing\TestCase;

class ProjectApiTest extends TestCase
{
    protected $project;
    protected $ticket;
    protected $comment;
    protected $vote;

    public function setUp()
    {
        parent::setUp();
        
        $this->vote = [
            'user_id' => '1',
            'vote' => '1',
            '_state' => 'CLEAN'
        ];

        $this->comment = [
            'id' => '1',
            'user_id' => '1',
            'children' => [],
            '_state' => 'CLEAN'
        ];

        $this->ticket = [
            'id' => '1',
            'comments' => [],
            'votes' => [],
            '_state' => 'CLEAN'
        ];

        $this->project = [
            'id' => '1',
            'tickets' => [],
            '_state' => 'CLEAN'
        ];
    }

    public function testIndex()
    {
        $this->json('GET', '/project')
            ->seeJson([
                'status' => 'success',
            ]);
    }

    public function testCreate()
    {
        $project = $this->project;
        $project['_state'] = "NEW";

        $this->json('POST', '/project', $project)
            ->seeJson([
                'status' => 'success'
            ]);
    }

    public function testModify()
    {
        $project = $this->project;
        $project['_state'] = "DIRTY";

        $this->json('POST', '/project', $project)
            ->seeJson([
                'status' => 'success'
            ]);
    }

    public function testShow()
    {
        $id = $this->project['id'];

        $this->json('GET', '/project/' . $id)
            ->seeJson([
                'status' => 'success',
            ]);
    }

    public function testAddTicket()
    {
        $project = $this->project;
        $ticket = $this->ticket;
        $ticket['_state'] = "NEW";
        $project['tickets'][] = $ticket;

        $this->json('POST', '/project', $project)
            ->seeJson([
                'status' => 'success'
            ]);
        
    }

    public function testUpdateTicket()
    {
        $project = $this->project;

        $this->json('POST', '/project', $project)
            ->seeJson([
                'status' => 'success'
            ]);
        
    }

    public function testRemoveTicket()
    {
        $project = $this->project;

        $this->json('POST', '/project', $project)
            ->seeJson([
                'status' => 'success'
            ]);
        
    }

    public function testVoteTicket()
    {
        $project = $this->project;

        $this->json('POST', '/project', $project)
            ->seeJson([
                'status' => 'success'
            ]);
    }

    public function testUnvoteTicket()
    {
        $project = $this->project;

        $this->json('POST', '/project', $project)
            ->seeJson([
                'status' => 'success'
            ]);
    }


    public function testAddTicketComment()
    {
        $project = $this->project;
        $ticket = $this->ticket;
        $comment = $this->comment;
        $comment['_state'] = "NEW";
        $ticket['comments'][] = $comment;
        $project['tickets'][] = $ticket;

        $this->json('POST', '/project', $project)
            ->seeJson([
                'status' => 'success'
            ]);
    }

    public function testAddTicketCommentChild()
    {
        $project = $this->project;
        $ticket = $this->ticket;
        $comment = $this->comment;
        $child = $this->comment;
        $child['_state'] = "NEW";
        $comment['children'][] = $child;
        $ticket['comments'][] = $comment;
        $project['tickets'][] = $ticket;

        $this->json('POST', '/project', $project)
            ->seeJson([
                'status' => 'success'
            ]);
    }

    public function testRemoveTicketCommentChild()
    {
        $project = $this->project;
        $ticket = $this->ticket;
        $comment = $this->comment;
        $child = $this->comment;
        $child['_state'] = "REMOVED";
        $comment['children'][] = $child;
        $ticket['comments'][] = $comment;
        $project['tickets'][] = $ticket;

        $this->json('POST', '/project', $project)
            ->seeJson([
                'status' => 'success'
            ]);
    }

    public function testRemoveTicketComment()
    {
        $project = $this->project;
        $ticket = $this->ticket;
        $comment = $this->comment;
        $comment['_state'] = "REMOVED";
        $ticket['comments'][] = $comment;
        $project['tickets'][] = $ticket;

        $this->json('POST', '/project', $project)
            ->seeJson([
                'status' => 'success'
            ]);
    }

    public function testDestroy()
    {
        $project = $this->project;
        $project['_state'] = "REMOVED";

        $this->json('POST', '/project', $project)
            ->seeJson([
                'status' => 'success'
            ]);
    }
}

<?php

namespace App\Events\Common;

trait Mailable
{
    public function getTemplate()
    {
        return $this->template;
    }

    public function getTo()
    {
        return ['email' => $this->getUser()->email, 'name' => $this->getUser()->first_name];
    }

    public function getFrom()
    {
        return ['email' => config('site.pr.email'), 'name' => config('site.pr.name')];
    }

    public function getSubject()
    {
        return $this->subject;
    }
}

<?php

namespace App\Mail;

use App\Team;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TeamNotificationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $team;
    public $owner;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Team $team, User $owner)
    {
        $this->team = $team;
        $this->owner = $owner;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Vous avez été ajouté à une équipe - GNONEL')
                    ->view('emails.team-notification')
                    ->with([
                        'team' => $this->team,
                        'owner' => $this->owner
                    ]);
    }
} 
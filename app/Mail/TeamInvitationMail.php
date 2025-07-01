<?php

namespace App\Mail;

use App\Team;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TeamInvitationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $team;
    public $owner;
    public $token;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Team $team, User $owner)
    {
        $this->team = $team;
        $this->owner = $owner;
        $this->token = base64_encode($team->member->email);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Invitation à rejoindre une équipe - GNONEL')
                    ->view('emails.team-invitation')
                    ->with([
                        'team' => $this->team,
                        'owner' => $this->owner,
                        'token' => $this->token
                    ]);
    }
} 
<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: EmailInactiveUsersMail.php
 * User: ${USER}
 * Date: 14.${MONTH_NAME_FULL}.2022
 * Time: 16:4
 */

namespace App\Mail;

use App\Models\Frontend\Team\Team;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class EmailInactiveUsersMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $team;

    public function __construct(User $user, Team $team)
    {
        $this->user = $user;
        $this->team = $team;
    }

    public function envelope(): Envelope
    {
        return new Envelope(subject: 'Du warst lange nicht mehr auf Thüringer Tuning Freunde!',);
    }

    public function content(): Content
    {
        return new Content('emails.email-inactive-users',);
    }

    public function attachments(): array
    {
        return [];
    }
}

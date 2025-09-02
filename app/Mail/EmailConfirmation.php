<?php

namespace App\Mail;

    use App\Models\User;
    use Illuminate\Bus\Queueable;
    use Illuminate\Contracts\Queue\ShouldQueue;
    use Illuminate\Mail\Mailable;
    use Illuminate\Mail\Mailables\Content;
    use Illuminate\Mail\Mailables\Envelope;
    use Illuminate\Queue\SerializesModels;

    class EmailConfirmation extends Mailable
    {
        use Queueable, SerializesModels;

        /**
         * Create a new message instance.
         */
        public function __construct(private User $user)
        {
            //
        }

        /**
         * Get the message envelope.
         */
        public function envelope(): Envelope
        {
            return new Envelope(
                subject: 'Email Confirmation',
            );
        }

        /**
         * Get the message content definition.
         */
        public function content(): Content
        {
            $id = $this->user->id;
            $created_at = $this->user->created_at;
            $link = url('') . "/auth/confirm_email/" . base64_encode($id . '/' . $created_at);

            return new Content(
                view: 'auth.email_confirmation',
                with: [
                    'name' => $this->user->name,
                    'email' => $this->user->email,
                    'link' => $link,
                ]
            );
        }

        /**
         * Get the attachments for the message.
         *
         * @return array<int, \Illuminate\Mail\Mailables\Attachment>
         */
        public function attachments(): array
        {
            return [];
        }
    }

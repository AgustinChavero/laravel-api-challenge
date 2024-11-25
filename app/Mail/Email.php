<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Email extends Mailable
{
    use Queueable;
    use SerializesModels;

    public $data;
    public $view;

    /**
     * Create a new message instance.
     *
     * @param array $data
     * @param string $view
     */
    public function __construct($data, $view)
    {
        $this->data = $data;
        $this->view = $view;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view($this->view)
                    ->with(['data' => $this->data])
                    ->subject($this->data['title']);
    }
}

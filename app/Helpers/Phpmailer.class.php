<?php

namespace App\Helpers;

use Exception;
use PHPMailer\PHPMailer\PHPMailer;
use stdClass;

class EnvioEmail
{
    private $mail;
    private $data;
    private $error;

    public function __construct()
    {
        $this->mail = new PHPMailer(true);
        $this->data = new stdClass();

        $this->mail->isSMTP();
        $this->mail->isHTML();
        $this->mail->setLanguage("br");

        $this->mail->SMTPAuth = true;
        $this->mail->SMTPSecure = "tls";
        $this->mail->CharSet = "utf-8";

        $this->mail->Host = MAILHOST;
        $this->mail->Port = MAILPORT;
        $this->mail->Username = MAILUSER;
        $this->mail->Password = MAILPASS;
    }

    public function add($subject, $body, $recipient_name, $recipient_email): EnvioEmail
    {
        $this->data->subject = $subject;
        $this->data->body = $body;
        $this->data->recipient_name = $recipient_name;
        $this->data->recipient_email = $recipient_email;
        return $this;
    }

    public function attach($filePath, $fileName)
    {
        $this->data->attach[$filePath] = $fileName;
    }

    public function send(): bool
    {
        $from_name = NAME_EMAIL;
        $from_email = ENVIAR_EMAIL;
        try {
            $this->mail->Subject = $this->data->subject;
            $this->mail->msgHTML($this->data->body);
            $this->mail->addAddress($this->data->recipient_email, $this->data->recipient_name);
            $this->mail->setFrom($from_email, $from_name);

            if (!empty($this->data->attach)) {
                foreach ($this->data->attach as $path => $name) {
                    $this->mail->addAttachment($path, $name);
                }
            }

            $this->mail->send();
            return true;
        } catch (Exception $exception) {
            $this->error = $exception;
            return false;
        }
    }

    public function error(): ?Exception
    {
        return $this->error;
    }
}
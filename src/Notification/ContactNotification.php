<?php
namespace App\Notification;

use App\Entity\Contact;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Twig\Environment;

class ContactNotification {

    private $mailer;
    private $renderer;

    public function __construct(MailerInterface $mailer, Environment $renderer)
    {
        $this->mailer = $mailer;
        $this->renderer = $renderer;
    }

    public function notify(Contact $contact) {

        $message = (new Email())
            ->subject('Agence : '.$contact->getProperty()->getTitle())
            ->from('noreply@monserver.com')
            ->to('contact@agence.fr')
            ->replyTo($contact->getEmail())
            ->text('Demande d\'un contact');

    //        ->html($this->renderer->render('emails/contact.html.twig', [
    //            'contact' => $contact
    //        ]));

        $this->mailer->send($message);
    }

    /**
     * Get the value of mailer
     */ 
    public function getMailer()
    {
        return $this->mailer;
    }

    /**
     * Set the value of mailer
     *
     * @return  self
     */ 
    public function setMailer($mailer)
    {
        $this->mailer = $mailer;

        return $this;
    }

    /**
     * Get the value of renderer
     */ 
    public function getRenderer()
    {
        return $this->renderer;
    }

    /**
     * Set the value of renderer
     *
     * @return  self
     */ 
    public function setRenderer($renderer)
    {
        $this->renderer = $renderer;

        return $this;
    }
}
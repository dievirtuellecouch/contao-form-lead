<?php

namespace DVC\FormLead\EventListener;

use Contao\CoreBundle\ServiceAnnotation\Hook;
use Contao\Form;
use NotificationCenter\Model\Notification;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;

class FormSentListener
{
    private Request $request;

    public function __construct(
        RequestStack $requestStack
    )
    {
        $this->request = $requestStack->getCurrentRequest();
    }

    /**
     * @Hook("processFormData")
     */
    public function sendLeadNotification(
        array $submittedData, 
        array $formData, 
        ?array $files, 
        array $labels, 
        Form $form
    ): void
    {
        $notification = Notification::findByPk($form->leadNotification);

        if ($notification === null) {
            return;
        }

        $sentNotifications = $notification->send(
            $this->getNotificationTokens($form),
            $strLanguage = ''
        );

        $didSend = count($sentNotifications) > 0;
    }

    private function getNotificationTokens(Form $form): array
    {
        return [
            'form__lead_form_title' => $form->title,
            'form__lead_current_page' => $this->request->getPathInfo(),
        ];
    }
}

<?php namespace PCI\Listeners\Email;

use PCI\Events\Petition\PetitionUpdatedByCreator;

/**
 * Class EmailApprovalRequestToAttendants
 *
 * @package PCI\Listeners\Email
 * @author  Alejandro Granadillo <slayerfat@gmail.com>
 * @link    https://github.com/slayerfat/sistemaPCI Repositorio en linea.
 */
class EmailPetitionUpdatedToAttendants extends EmailPetitionEventToAttendants
{

    /**
     * Handle the event.
     *
     * @param \PCI\Events\Petition\PetitionUpdatedByCreator $event
     */
    public function handle(PetitionUpdatedByCreator $event)
    {
        $petition             = $event->petition;
        $user                 = $event->user;
        $emails['attendants'] = $this->getAttendantsEmail();

        $this->mail->send(
            [
                'emails.petitions.updated-by-creator-attendants',
                'emails.petitions.updated-by-creator-attendants-plain',
            ],
            compact('user', 'petition'),
            function ($message) use ($emails, $user, $petition) {
                /** @var \Illuminate\Mail\Message $message */
                $message->to($emails['attendants'])->subject(
                    "sistemaPCI: El usuario " . $user->name
                    . " ha actualizado el "
                    . trans('models.petitions.singular')
                    . " #$petition->id"
                );
            }
        );
    }
}

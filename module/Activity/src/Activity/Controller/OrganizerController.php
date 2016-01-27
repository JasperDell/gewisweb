<?php

namespace Activity\Controller;

use Activity\Model\Activity;
use Activity\Service\Signup;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\Session\Container as SessionContainer;
use Activity\Form\ModifyRequest as RequestForm;
use Zend\View\Model\ViewModel;

/**
 * Controller that gives some additional details for activities, such as a list of email adresses
 * or an export function specially tailored for the organizer.
 */
class OrganizerController extends AbstractActionController
{
    /**
     * Show the email adresses belonging to an Activity
     */
    public function emailAction()
    {
        $id = (int) $this->params('id');
        $activityService = $this->getServiceLocator()->get('activity_service_activity');

        /** @var $activity Activity*/
        $activity = $activityService->getActivityWithDetails($id);


        if (is_null($activity)) {
            return $this->notFoundAction();
        }

        return [
            'activity' => $activity,
        ];
    }

    /**
     * Return the data for exporting activities
     *
     * @return array
     */
    public function exportAction()
    {
        $id = (int) $this->params('id');
        $activityService = $this->getServiceLocator()->get('activity_service_activity');
        $translatorService = $this->getServiceLocator()->get('activity_service_activityTranslator');
        $langSession = new SessionContainer('lang');


        /** @var $activity Activity*/
        $activity = $activityService->getActivityWithDetails($id);
        $translatedActivity = $translatorService->getTranslatedActivity($activity, $langSession->lang);

        if (is_null($activity)) {
            return $this->notFoundAction();
        }

        return [
            'activity' => $translatedActivity,
            'signupData' => $translatorService->getTranslatedSignedUpData($activity, $langSession->lang),
        ];
    }
}

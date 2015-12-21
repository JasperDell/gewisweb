<?php

namespace Activity\Controller;

use Activity\Model\Activity;
use Activity\Service\Signup;
use Zend\Mvc\Controller\AbstractActionController;
use Activity\Form\Activity as ActivityForm;
use Activity\Form\ActivitySignup as SignupForm;
use Zend\View\Model\JsonModel;

class ApiController extends AbstractActionController
{
    /**
     * View all activities.
     */
    public function listAction()
    {
        $activityService = $this->getActivityService();
        $activities = $activityService->getApprovedActivities();
        $activitiesArray = [];
        foreach ($activities as $activity) {
            $activitiesArray[] = $activity->toArray();
        }

        return new JsonModel($activitiesArray);
    }

    /**
     * View one activity.
     */
    public function viewAction()
    {

    }

    /**
     * Signup for a activity.
     */
    public function signupAction()
    {
        $id = (int)$this->params('id');

        $activityService = $this->getActivityService();
        $signupService = $this->getSignupService();

        $activity = $activityService->getActivity($id);

        $params = [];
        $params['success'] = false;
        //Assure the form is used
        if ($this->getRequest()->isPost()) {
            if ($activity->getCanSignup() && $signupService->isAllowedToSubscribe()) {
                //TODO: check that the activity doesn't have any extra fields
                $signupService->signUp($activity, []);
                $params['success'] = true;
            }
        }

        return new JsonModel($params);
    }

    /**
     * Signup for a activity.
     */
    public function signoffAction()
    {
        $id = (int) $this->params('id');

        $activityService = $this->getActivityService();
        $signupService = $this->getSignupService();

        $activity = $activityService->getActivity($id);

        $params = [];
        $params['success'] = false;

        $identity = $this->getServiceLocator()->get('user_role');
        $user = $identity->getMember();
        if ($this->getRequest()->isPost()) {
            if ($signupService->isAllowedToSubscribe() && $signupService->isSignedUp($activity, $user)) {
                $signupService->signOff($activity, $user);
                $params['success'] = true;
            }
        }

        return new JsonModel($params);
    }

    public function signedupAction()
    {
        $activities = $this->getSignupService()->getSignedUpActivityIds();

        return new JsonModel([
            'activities' => $activities
        ]);
    }

    private function getActivityService()
    {
        return $this->getServiceLocator()->get('activity_service_activity');
    }

    private function getSignupService()
    {
        return $this->getServiceLocator()->get('activity_service_signup');
    }
}

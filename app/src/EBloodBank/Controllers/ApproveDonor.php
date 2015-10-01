<?php
/**
 * Approve donor page controller class file
 *
 * @package    EBloodBank
 * @subpackage Controllers
 * @since      1.0
 */
namespace EBloodBank\Controllers;

use EBloodBank as EBB;
use EBloodBank\Views\View;

/**
 * Approve donor page controller class
 *
 * @since 1.0
 */
class ApproveDonor extends Controller
{
    /**
     * @var \EBloodBank\Models\Donor
     * @since 1.0
     */
    protected $donor;

    /**
     * @return void
     * @since 1.0
     */
    public function __construct($id)
    {
        if (EBB\isValidID($id)) {
            $donorRepository = main()->getEntityManager()->getRepository('Entities:Donor');
            $this->donor = $donorRepository->find($id);
        }
    }

    /**
     * @return void
     * @since 1.0
     */
    public function __invoke()
    {
        if (EBB\isCurrentUserCan('approve_donor')) {
            $this->doActions();
            $view = View::forge('approve-donor', [
                'donor' => $this->getQueriedDonor(),
            ]);
        } else {
            $view = View::forge('error-403');
        }
        $view();
    }

    /**
     * @return void
     * @since 1.0
     */
    protected function doActions()
    {
        switch (filter_input(INPUT_POST, 'action')) {
            case 'approve_donor':
                $this->doApproveAction();
                break;
        }
    }

    /**
     * @return void
     * @since 1.0
     */
    protected function doApproveAction()
    {
        if (EBB\isCurrentUserCan('approve_donor')) {
            $session = main()->getSession();
            $sessionToken = $session->getCsrfToken();
            $actionToken = filter_input(INPUT_POST, 'token');

            if (! $actionToken || ! $sessionToken->isValid($actionToken)) {
                return;
            }

            $em = main()->getEntityManager();
            $donor = $this->getQueriedDonor();

            if (! $donor->isPending()) {
                return;
            }

            $donor->set('status', 'approved');
            $em->flush($donor);

            EBB\redirect(
                EBB\addQueryArgs(
                    EBB\getEditDonorsURL(),
                    array('flag-approved' => 1)
                )
            );
        }
    }

    /**
     * @return \EBloodBank\Models\Donor
     * @since 1.0
     */
    protected function getQueriedDonor()
    {
        return $this->donor;
    }

    /**
     * @return int
     * @since 1.0
     */
    protected function getQueriedDonorID()
    {
        $donor = $this->getQueriedDonor();
        return ($donor) ? (int) $donor->get('id') : 0;
    }
}
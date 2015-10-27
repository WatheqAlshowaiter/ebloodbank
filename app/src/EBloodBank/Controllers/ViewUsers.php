<?php
/**
 * View users page controller class file
 *
 * @package    EBloodBank
 * @subpackage Controllers
 * @since      1.0
 */
namespace EBloodBank\Controllers;

use EBloodBank as EBB;
use EBloodBank\Options;
use EBloodBank\Views\View;

/**
 * View users page controller class
 *
 * @since 1.0
 */
class ViewUsers extends Controller
{
    /**
     * @return void
     * @since 1.0
     */
    public function __invoke()
    {
        if (EBB\isCurrentUserCan('view_users')) {
            $view = View::forge('view-users', array(
                'users' => $this->getQueriedUsers(),
                'pagination.total' => $this->getPagesTotal(),
                'pagination.current' => $this->getCurrentPage(),
            ));
        } else {
            $view = View::forge('error-403');
        }
        $view();
    }

    /**
     * @return int
     * @since 1.0
     */
    public function getPagesTotal()
    {
        $total = 1;
        $limit = (int) Options::getOption('entities_per_page');
        if ($limit >= 1) {
            $total = (int) ceil($this->countAllUsers() / $limit);
        }
        return $total;
    }

    /**
     * @return int
     * @since 1.0
     */
    public function getCurrentPage()
    {
        return max((int) filter_input(INPUT_GET, 'page'), 1);
    }

    /**
     * @return \EBloodBank\Models\User[]
     * @since 1.0
     */
    public function getAllUsers()
    {
        $em = main()->getEntityManager();
        $userRepository = $em->getRepository('Entities:User');

        return $userRepository->findAll([], ['created_at' => 'DESC']);
    }

    /**
     * @return int
     * @since 1.0
     */
    public function countAllUsers()
    {
        $em = main()->getEntityManager();
        $userRepository = $em->getRepository('Entities:User');

        return $userRepository->countAll();
    }

    /**
     * @return \EBloodBank\Models\User[]
     * @since 1.0
     */
    public function getQueriedUsers()
    {
        $em = main()->getEntityManager();
        $userRepository = $em->getRepository('Entities:User');

        $limit = (int) Options::getOption('entities_per_page');
        $offset = ($this->getCurrentPage() - 1) * $limit;

        return $userRepository->findBy([], ['created_at' => 'DESC'], $limit, $offset);
    }

    /**
     * @return int
     * @since 1.0
     */
    public function countQueriedUsers()
    {
        return count($this->getQueriedUsers());
    }
}

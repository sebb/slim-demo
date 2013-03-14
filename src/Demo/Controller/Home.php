<?php
/**
 * Created by JetBrains PhpStorm.
 * User: sebastien
 * Date: 13-03-13
 * Time: 23:19
 * To change this template use File | Settings | File Templates.
 */

namespace Demo\Controller;

use SlimController\SlimController;

/**
 * Class Home
 * @package Demo\Controller
 */
class Home extends SlimController
{
    /**
     *
     */
    public function indexAction()
    {
        $this->render(
            'Home/index.html',
            array(
                'notes' => isset($_SESSION['notes']) ? $_SESSION['notes'] : array()
            )
        );
    }

    /**
     * @return void
     */
    public function addAction()
    {
        if (!isset($_SESSION['notes'])) {
            $_SESSION['notes'] = array();
        }

        $note = $this->app->request()->params('note');

        // TODO This should be validated before being stored, client-side validation is not enough
        $_SESSION['notes'][] =  $note;

        if ($this->app->request()->isAjax()) {

            $this->render(
                'Home/_note.html',
                array(
                    'note' => $note
                )
            );
        } else {

            $this->app->flash('notice', 'Data saved');
            $this->redirect('/');
        }
    }
}
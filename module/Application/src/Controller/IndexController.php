<?php
namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use User\Entity\User;

/**
 * This is the main controller class of the User Demo application. It contains
 * site-wide actions such as Home or About.
 */
class IndexController extends AbstractActionController 
{
    /**
     * Entity manager.
     * @var Doctrine\ORM\EntityManager
     */
    private $entityManager;

    /**
     * User manager.
     * @var User\Service\CompanyManager
     */
    private $companyManager;

    /**
     * Constructor. Its purpose is to inject dependencies into the controller.
     * @param $entityManager
     * @param $companyManager
     */
    public function __construct($entityManager, $companyManager)
    {
       $this->entityManager = $entityManager;
       $this->companyManager = $companyManager;
    }
    
    /**
     * This is the default "index" action of the controller. It displays the 
     * Home page.
     */
    public function indexAction() 
    {
        return new ViewModel();
    }

    /**
     * This is the "map" action. It is used to display the "map" page.
     */
    public function aboutAction()
    {              
        $appName = 'Dispatcher Demo';
        $appDescription = 'This demo shows how to implement role-based access control dispatcher application with Zend Framework 3';

        // Return variables to view script with the help of
        // ViewObject variable container
        return new ViewModel([
            'appName' => $appName,
            'appDescription' => $appDescription
        ]);
    }

    /**
     * This is the "map" action. It is used to display the "map" page.
     */
    public function adminAction()
    {
        $appName = 'Role Demo';
        $appDescription = 'This demo shows how to implement role-based access control with Zend Framework 3';

        // Return variables to view script with the help of
        // ViewObject variable container
        return new ViewModel([
            'appName' => $appName,
            'appDescription' => $appDescription
        ]);
    }

    /**
     * This is the "map" action. It is used to display the "map" page.
     */
    public function fillAction()
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://www.taxicenter.am/api/tenants",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "Accept: */*",
                "Accept-Encoding: gzip, deflate",
                "Cache-Control: no-cache",
                "Connection: keep-alive",
                "Host: www.taxicenter.am",
                "X-TENANT-TOKEN: pX27zsMN2ViQKta1bGfLmVJE"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        $response = json_decode($response, true);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            foreach ($response as $value){
                $data = ['name' => $value['name'], 'address' => $value['address'], 'token' => $value['access_token'], 'phone' => $value['phone']];
                $this->companyManager->addCompany($data);
            }
        }

        return $this->redirect('application', ['action' => 'map']);

    }

    /**
     * This is the "map" action. It is used to display the "map" page.
     */
    public function mapAction()
    {
        $user = $this->currentUser();

        return new ViewModel([
            'user' => $user
        ]);
    }
    
    /**
     * The "settings" action displays the info about currently logged in user.
     */
    public function settingsAction()
    {
        $id = $this->params()->fromRoute('id');
        
        if ($id!=null) {
            $user = $this->entityManager->getRepository(User::class)
                    ->find($id);
        } else {
            $user = $this->currentUser();
        }
        
        if ($user==null) {
            $this->getResponse()->setStatusCode(404);
            return;
        }
        
        if (!$this->access('profile.any.view') && 
            !$this->access('profile.own.view', ['user'=>$user])) {
            return $this->redirect()->toRoute('not-authorized');
        }
        
        return new ViewModel([
            'user' => $user
        ]);
    }
}


<?php

namespace Git\Bundle\GuiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Git\Bundle\GuiBundle\Entity\User;
use Git\Bundle\GuiBundle\Entity\Groups;
Use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{

    public function addAction()
    {
    
    return $this->render('GitGuiBundle:Default:add.html.php');
    

    }

    public function authorizeAction()
    {
      
        return $this->render('GitGuiBundle:Default:authorize.html.php');
    
    }
      
    public function createAction(Request $request)
    {	
    
      
     return $this->render('GitGuiBundle:Default:create.html.php');
    }
    
    public function groupAction()
     {
    
    return $this->render('GitGuiBundle:Default:grouplist.html.php');
    
     }
      public function groupaddAction()
     {
    
    return $this->render('GitGuiBundle:Default:groupadd.html.php');
    
     }
       public function indexAction()
     {
    
    return $this->render('GitGuiBundle:Default:index.html.php');
    
     }
    public function loginAction()
    {
    
        return $this->render('GitGuiBundle:Default:login.html.php');
        
    }
    
     public function loggedOutAction()
    {
    
        return $this->render('GitGuiBundle:Default:logout.html.php');
        
    }
     public function managerepoAction()
    {
    
        return $this->render('GitGuiBundle:Default:managerepo.html.php');
        
    }
      public function repoAction()
    {
    
    	return $this->render('GitGuiBundle:Default:repo.html.php');
    	
    }

  
    

    public function showAction()
    {
    
        return $this->render('GitGuiBundle:Default:show.html.php');
        
    }

    public function submittedAction()
    {
    
    return $this->render('GitGuiBundle:Default:submitted.html.php');
    

    }
      public function userAction()
    {
    
    	return $this->render('GitGuiBundle:Default:userlist.html.php');
    	
    }
   
     
   
    
    
}

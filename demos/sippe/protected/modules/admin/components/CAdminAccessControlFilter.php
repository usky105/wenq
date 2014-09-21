<?php

class CAdminAccessControlFilter extends CAccessControlFilter  
{  
    protected function preFilter($filterChain)  
    {  
        $app=Yii::app();  
        $request=$app->getRequest();  
        $user = Yii::app()->controller->module->getComponent('adminUser');  

       

        $verb=$request->getRequestType();  
        $ip=$request->getUserHostAddress();  

        foreach($this->getRules() as $rule)  
        {  
            $allow = $rule->isUserAllowed($user,$filterChain->controller,$filterChain->action,$ip,$verb);
            var_dump($allow);   
            if(($allow)>0) // allowed  
                break;  
            else if($allow<0) // denied  
            {  
                $message = "";
                $this->accessDenied($user,$message);  
                return false;  
            }  
        }  
        return true;  
    }  
} 


?>
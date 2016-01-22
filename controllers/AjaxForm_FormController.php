<?php
namespace Craft;

class AjaxForm_FormController extends BaseController
{
    protected $allowAnonymous = true;

    public function actionSubmit()
    {
        //misc. controller action validation
        $this->requirePostRequest();

        //instatiate the form model
        $formModel = AjaxForm_FormDataModel::populateModelFromRequest();

        if(!$formModel->template){
            $this->returnErrorJson(["message" => "No form available with name " . $formModel->name]);
            return;
        }
        //validate the form submission
        if($formModel->validate())
        {
            if($formModel->isHuman()){
                //send emails
                if($formModel->template->sendConfirmEmail){
                    if(!$formModel->sendConfirmEmail()){
                        if($formModel->template->redirectError){
                            $this->redirect($formModel->template->redirectError, true, 200);
                        }else{
                            $this->returnErrorJson(["message" => "Unable to send Confirm Email"]);
                        }
                        return;
                    }
                }
                if($formModel->template->sendNotifyEmail){
                    if(!$formModel->sendNotifyEmail()){
                        if($formModel->template->redirectError){
                            $this->redirect($formModel->template->redirectError, true, 200);
                        }else{
                            $this->returnErrorJson(["message" => "Unable to send Notify Email"]);
                        }
                        return;
                    }
                }
            }
            //response
            if($formModel->template->redirect){
                $this->redirect($formModel->template->redirect, true, 200);
            }else{
                $this->returnJson(["message" => "ok"]);
            }
        }else{
            $this->returnErrorJson($formModel->getErrors());
        }
    }
}

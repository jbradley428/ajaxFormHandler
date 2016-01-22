<?php
namespace Craft;

class AjaxForm_FormDataModel extends BaseModel
{
    protected function defineAttributes()
    {
        return array(
            'name' => AttributeType::String,
            'template' => AttributeType::Mixed,
            'toEmail' => AttributeType::String,
            'data' => AttributeType::Mixed,
            'honeypotValue' => AttributeType::String
        );
    }

    public static function populateModelFromRequest($request)
    {

        $formModel = new AjaxForm_FormDataModel();

        //get the name of the form
        $formModel->name = craft()->request->getParam("form");

        //get the associated form template
        $formModel->template = craft()->ajaxForm_form->getFormTemplate($formModel->name);

        //pull the data from the request
        $data = [];
        foreach($formModel->template->fields as $field){
          $data[$field] = craft()->request->getPost($field);
        }
        $formModel->data = $data;
        //populate the honeypotValue
        $formModel->honeypotValue = craft()->request->getPost($formModel->template->honeypot);
        //populate the toEmail field
        $formModel->toEmail = craft()->request->getPost($formModel->template->toEmailField);

        return $formModel;

    }

    public function isHuman()
    {
        if($this->honeypotValue){
            return false;
        }else{
            return true;
        }
    }

    public function sendConfirmEmail()
    {
        //get the global email settings
		$emailSettings = craft()->email->getSettings();

        //create the template params
        $templateParams = $this->data;
        $templateParams['toEmail'] = $this->toEmail;

        //instantiate email model
        $email = new EmailModel();

        //populate with all the things
        //for testing
        $email->fromEmail = $emailSettings['emailAddress'];
		$email->toEmail   = $this->template->notifyEmailToAddress;
		$email->subject   = $this->template->confirmEmailSubject;
		$email->body      = $this->template->confirmEmailBody;

        //send that goodness
		return craft()->email->sendEmail($email, $templateParams);

    }

    public function sendNotifyEmail()
    {
        //get the global email settings
		$emailSettings = craft()->email->getSettings();

        //create the template params
        $templateParams = $this->data;
        $templateParams['toEmail'] = $this->template->notifyEmailToAddress;

        //instantiate email model
        $email = new EmailModel();

        //populate with all the things
        $email->fromEmail = $this->template->notifyEmailToAddress;
		$email->toEmail = $this->template->notifyEmailToAddress;
		$email->subject = $this->template->notifyEmailSubject;
		$email->htmlBody = $this->template->notifyEmailBody;

        //send that goodness
		return craft()->email->sendEmail($email, $templateParams);
    }
}

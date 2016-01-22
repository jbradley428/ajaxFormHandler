<?php
namespace Craft;

class AjaxForm_FormService extends BaseApplicationComponent
{
    public function processFormSubmission()
    {

    }

    /**
	 * Gets the form template for a given name
	 *
	 * @param string $name
	 * @throws Exception
	 * @return AjaxForm_FormTemplateModel
	 */
    /* The following content is what you edit to create a new form */
    public function getFormTemplate($name)
    {
        $emailSettings = craft()->email->getSettings();

        $forms = [];

        //Apply Now Form
        $applyForm = new AjaxForm_FormTemplateModel();

        $applyForm->name = "apply-now";
        $applyForm->honeypot = "referral";
        $applyForm->toEmailField = "email";

        $applyForm->redirect = "/apply-now/thanks";

        $applyForm->fields = ["fromName", "email", "address", "city", "state", "zip", "phone", "message", "resumeField"];

        $applyForm->sendConfirmEmail = false;
        $applyForm->sendNotifyEmail = true;
        $applyForm->notifyEmailToAddress = $emailSettings['emailAddress'];

        $applyForm->notifyEmailSubject = "Apply Now Form";
        $applyForm->notifyEmailBody = "{{fromName}} has applied for a position.<br><br>
            Full Name:<br>
                {{fromName}}<br>
            Email Address:<br>
                {{email}}<br>
            Address:<br>
                {{address}}<br>
            City:<br>
                {{city}}<br>
            State:<br>
                {{state}}<br>
            Zip Code:<br>
                {{zip}}<br>
            Phone:<br>
                {{phone}}<br>
            Comments:<br>
                {{message}}<br>
            Resume:<br>
                {{resumeField}}
        ";

        $forms['apply-now'] = $applyForm;

        //RETURN THE REQUESTED FORM

        return $forms[$name];

    }

}

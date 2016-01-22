<?php
namespace Craft;

class AjaxForm_FormTemplateModel extends BaseModel
{
    protected function defineAttributes()
    {
        return array(
            'name' => AttributeType::String,
            'redirect' => AttributeType::String,
            'redirectError' => AttributeType::String,
            'fields' => AttributeType::Mixed,
            'honeypot' => AttributeType::String,
            'toEmailField' => AttributeType::String,
            'sendConfirmEmail' => AttributeType::Bool,
            'confirmEmailFromAddress' => AttributeType::String,
            'confirmEmailSubject' => AttributeType::String,
            'confirmEmailBody' => AttributeType::String,
            'sendNotifyEmail' => AttributeType::Bool,
            'notifyEmailToAddress' => AttributeType::String,
            'notifyEmailCC' => AttributeType::String,
            'notifyEmailBCC' => AttributeType::Mixed,
            'notifyEmailSubject' => AttributeType::String,
            'notifyEmailBody' => AttributeType::String
        );
    }
}
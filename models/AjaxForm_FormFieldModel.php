<?php
namespace Craft;

class AjaxForm_FormFieldModel extends BaseModel
{
    protected function defineAttributes()
    {
        return array(
            'name' => AttributeType::String,
            'type' => array(AttributeType::Enum, 'values' => "text,number,password,checkbox"),
            'required' => AttributeType::Bool
        );
    }
}
<?php 

namespace Core;

use Core\Classes\SessionData;
use Sirius\Validation\Validator;

abstract class Validation
{
    protected $validation;
    protected $validator;
    protected $request;
    public $errors;
    public $passed = true;

    public function validate()
    {
        $request = array_merge($this->request->request->all(), $this->request->files->all());
        $this->validator = new Validator();
        $this->makeRules($this->validation->rules());
        $this->passed = $this->validator->validate($request);

        if (!$this->passed) {
            $this->errors();
        }

        return $this;
    }

    public function makeRules($rules)
    {
        $validation = [];
        
        // generate rules
        foreach ($rules as $key => $value) {
            foreach ($value as $key1 => $value1) {
                $name = count(explode('(', $value1)) > 0 ? explode('(', $value1)[0] : null;
                $optionsArr = count(explode('(', $value1)) > 1 ? explode('(', $value1)[1] : null;
                if (count(explode(':', str_replace(')', '', $optionsArr))) > 1) {
                    list($optionsName, $optionsValue) = explode(':', str_replace(')', '', $optionsArr));
                }
                $label = explode(':', $key)[1];
                array_push($validation, [
                    'selector' => $key,
                    'name' => $name,
                    'options' => isset($optionsName) && isset($optionsName) ? [$optionsName => $optionsValue] : null,
                    'message' => null,
                    'label' => $label
                ]);
            }
        }

        // make validation rules
        foreach ($validation as $key => $value) {
            $this->validator->add($value['selector'], $value['name'], $value['options'], null, $value['label']);
        }
    }

    public function errors()
    {
        $errors = [];
        $messages_validation = $this->validator->getMessages();
        $messages_custom = $this->validation->messages();
        foreach ($messages_validation as $key => $value) {
            $errors[$key] = $value[0]->getTemplate();
            foreach ($value[0]->getVariables() as $key1 => $value1) {
                $errors[$key] = str_replace('{'.$key1.'}', $value[0]->getVariables()[$key1], $errors[$key]);
            }
        }
        $this->errors = $errors;

        SessionData::get()->getFlashBag()->set('errors', $this->errors);
    }

    abstract function rules();
}
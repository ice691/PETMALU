<?php namespace Natabio\BS4Form;

use Collective\Html\FormBuilder as CollectiveFormBuilder;
use Config;

class BootstrapFormBuilder extends CollectiveFormBuilder
{
    /**
     * An array containing the currently opened form groups.
     *
     * @var array
     */
    protected $groupStack = array();

    /**
     * Open a new form group
     *
     * @param  string  $name
     * @param  mixed   $label
     * @param  array   $options
     * @return \Illuminate\Support\HtmlString
     */
    public function openGroup($name, $label = null, $options = array())
    {
        $options = $this->appendClassToOptions(Config::get('form-builder.group-class'), $options);

        $this->groupStack[] = $name;

        if ($this->hasErrors($name)) {
            $options = $this->appendClassToOptions(Config::get('form-builder.error-class'), $options);
        }

        $label = $label ? $this->label($name, $label) : '';

        return $this->toHtmlString('<div' . $this->html->attributes($options) . '>' . $label);
    }

    /**
     * Close out the opened form group
     *
     * @return \Illuminate\Support\HtmlString
     */
    public function closeGroup()
    {
        $name = array_pop($this->groupStack);

        $errors = $this->getFormattedErrors($name);

        return $this->toHtmlString($errors . '</div>');
    }

    /**
     * Create a form input
     *
     * @param  string  $type
     * @param  string  $name
     * @param  string  $value
     * @param  array   $options
     * @return \Illuminate\Support\HtmlString
     */
    public function input($type, $name, $value = null, $options = array())
    {
        $options = $this->appendClassToOptions(Config::get('form-builder.control-class'), $options);

        if ($this->hasErrors($name)) {
            $options = $this->appendClassToOptions('is-invalid', $options);
        }

        return parent::input($type, $name, $value, $options);
    }

    /**
     * Create a form password
     *
     * @param  string  $name
     * @param  array   $options
     * @return \Illuminate\Support\HtmlString
     */
    public function password($name, $options = array())
    {
        $options = $this->appendClassToOptions(Config::get('form-builder.control-class'), $options);

        if ($this->hasErrors($name)) {
            $options = $this->appendClassToOptions('is-invalid', $options);
        }

        return parent::password($name, $options);
    }

    /**
     * Create a select box
     *
     * @param  string  $name
     * @param  array   $list
     * @param  string  $selected
     * @param  array   $selectAttributes
     * @param  array   $optionsAttributes
     * @return \Illuminate\Support\HtmlString
     */
    public function select(
        $name,
        $list = [],
        $selected = null,
        array $selectAttributes = [],
        array $optionsAttributes = [],
        array $optgroupsAttributes = []
    ) {
        $selectAttributes = $this->appendClassToOptions(Config::get('form-builder.control-class-select'), $selectAttributes);

        if ($this->hasErrors($name)) {
            $selectAttributes = $this->appendClassToOptions('is-invalid', $selectAttributes);
        }

        return parent::select($name, $list, $selected, $selectAttributes, $optionsAttributes, $optgroupsAttributes);
    }

    /**
     * Create a plain form
     *
     * @param  string  $type
     * @param  string  $name
     * @param  string  $value
     * @param  array   $options
     * @return \Illuminate\Support\HtmlString
     */
    public function plainInput($type, $name, $value = null, $options = array())
    {
        return parent::input($type, $name, $value, $options);
    }

    /**
     * Create a plain select box
     *
     * @param  string $name
     * @param  array $list
     * @param  string $selected
     * @param  array $selectAttributes
     * @param  array $optionsAttributes
     * @return \Illuminate\Support\HtmlString
     */
    public function plainSelect($name, $list = array(), $selected = null, array $selectAttributes = [], array $optionsAttributes = [])
    {
        return parent::select($name, $list, $selected, $selectAttributes, $optionsAttributes);
    }

    /**
     * Create a checkable
     *
     * @param  string  $type
     * @param  string  $name
     * @param  mixed   $value
     * @param  bool    $checked
     * @param  array   $options
     * @return \Illuminate\Support\HtmlString
     */
    protected function checkable($type, $name, $value, $checked, $options)
    {
        if ($this->getCheckedState($type, $name, $value, $checked)) {
            $options['checked'] = 'checked';
        }

        return parent::input($type, $name, $value, $options);
    }

    /**
     * Create a checkbox
     *
     * @param  string  $name
     * @param  mixed   $value
     * @param  mixed   $label
     * @param  bool    $checked
     * @param  array   $options
     * @return \Illuminate\Support\HtmlString
     */
    public function checkbox($name, $value = 1, $label = null, $checked = null, $options = array())
    {
        return $this->wrapCheckable(
            $label,
            'checkbox',
            parent::checkbox($name, $value, $checked, $options)
        );
    }

    /**
     * Create a radio button
     *
     * @param  string  $name
     * @param  mixed   $value
     * @param  mixed   $label
     * @param  bool    $checked
     * @param  array   $options
     * @return \Illuminate\Support\HtmlString
     */
    public function radio($name, $value = null, $label = null, $checked = null, $options = array())
    {
        return $this->wrapCheckable(
            $label,
            'radio',
            parent::radio($name, $value, $checked, $options)
        );
    }

    /**
     * Create an inline checkbox
     *
     * @param  string  $name
     * @param  mixed   $value
     * @param  mixed   $label
     * @param  bool    $checked
     * @param  array   $options
     * @return \Illuminate\Support\HtmlString
     */
    public function inlineCheckbox($name, $value = 1, $label = null, $checked = null, $options = array())
    {
        return $this->wrapInlineCheckable(
            $label,
            'checkbox',
            parent::checkbox($name, $value, $checked, $options)
        );
    }

    /**
     * Create an inline radio button
     *
     * @param  string  $name
     * @param  mixed   $value
     * @param  mixed   $label
     * @param  bool    $checked
     * @param  array   $options
     * @return \Illuminate\Support\HtmlString
     */
    public function inlineRadio($name, $value = null, $label = null, $checked = null, $options = array())
    {
        return $this->wrapInlineCheckable(
            $label,
            'radio',
            parent::radio($name, $value, $checked, $options)
        );
    }

    /**
     * Create a textarea
     *
     * @param  string  $name
     * @param  string  $value
     * @param  array   $options
     * @return \Illuminate\Support\HtmlString
     */
    public function textarea($name, $value = null, $options = array())
    {
        $options = $this->appendClassToOptions(Config::get('form-builder.control-class'), $options);

        if ($this->hasErrors($name)) {
            $options = $this->appendClassToOptions('is-invalid', $options);
        }

        return parent::textarea(
            $name,
            $value,
            $options
        );
    }

    /**
     * Create a plain textarea
     *
     * @param  string  $name
     * @param  string  $value
     * @param  array   $options
     * @return \Illuminate\Support\HtmlString
     */
    public function plainTextarea($name, $value = null, $options = array())
    {
        return parent::textarea($name, $value, $options);
    }

    /**
     * Create a submit button element.
     *
     * @param  string $value
     * @param  array  $options
     *
     * @return \Illuminate\Support\HtmlString
     */
    public function submit($value = null, $options = [])
    {
        $options['type'] = 'submit';
        $options = $this->appendClassToOptions(Config::get('form-builder.submit-class'), $options);

        return $this->button($value, $options);
    }

    /**
     * Append the class to the given options array
     *
     * @param  string  $class
     * @param  array   $options
     * @return array
     */
    private function appendClassToOptions($class, array $options = array())
    {
        isset($options['class'])
        ? $options['class'] = $options['class'] . ' ' . $class
        : $options['class'] = $class;

        return $options;
    }

    /**
     * Determine whether the form element with the given name has any validation errors
     *
     * @param  string  $name
     * @return bool
     */
    private function hasErrors($name)
    {
        if (is_null($this->session) || !$this->session->has('errors')) {
            return false;
        }
        // Get errors session
        $errors = $this->getErrorsSession();

        return $errors->has($this->transformKey($name));
    }

    /**
     * Get errors session
     *
     * @return mixed
     */
    private function getErrorsSession()
    {
        return $this->session->get('errors');
    }

    /**
     * Get the formatted errors for the form element with the given name
     *
     * @param  string  $name
     * @return string
     */
    private function getFormattedErrors($name)
    {
        if (!$this->hasErrors($name)) {
            return '';
        }
        // Get errors session
        $errors = $this->getErrorsSession();

        return $errors->first($this->transformKey($name), '<div class="invalid-feedback">:message</div>');
    }

    /**
     * Wrap the given checkable in the necessary wrappers
     *
     * @param  mixed   $label
     * @param  string  $type
     * @param  string  $checkAble
     * @return \Illuminate\Support\HtmlString
     */
    private function wrapCheckable($label, $type, $checkAble)
    {
        return $this->toHtmlString('<div class="' . $type . '"><label>' . $checkAble . ' ' . $label . '</label></div>');
    }

    /**
     * Wrap the given checkable in the necessary inline wrappers
     *
     * @param  mixed   $label
     * @param  string  $type
     * @param  string  $checkAble
     * @return \Illuminate\Support\HtmlString
     */
    private function wrapInlineCheckable($label, $type, $checkAble)
    {
        return $this->toHtmlString('<div class="' . $type . '-inline">' . $checkAble . ' ' . $label . '</div>');
    }

    /**
     * Create an input form group
     *
     * @param  string  $type
     * @param  string  $label
     * @param  string  $name
     * @param  string  $value
     * @param  array   $options
     * @return \Illuminate\Support\HtmlString
     */
    public function inputGroup($type, $label = null, $name, $value = null, $options = array())
    {
        $group = [];

        $group[] = $this->openGroup($name, $label);

        $group[] = $this->input($type, $name, $value, $options);

        $group[] = $this->closeGroup();

        return implode('', $group);
    }

    /**
     * Create a select form group
     *
     * @param  string  $type
     * @param  string  $label
     * @param  string  $name
     * @param  string  $value
     * @param  array   $options
     * @return \Illuminate\Support\HtmlString
     */
    public function selectGroup(
        $label = null,
        $name,
        $list = [],
        $selected = null,
        array $selectAttributes = [],
        array $optionsAttributes = [],
        array $optgroupsAttributes = []
    ) {
        $group = [];

        $group[] = $this->openGroup($name, $label);

        $group[] = $this->select($name, $list, $selected, $selectAttributes, $optionsAttributes, $optgroupsAttributes);

        $group[] = $this->closeGroup();

        return implode('', $group);
    }

    /**
     * Create an password form group
     *
     * @param  string  $label
     * @param  string  $name
     * @param  array   $options
     * @return \Illuminate\Support\HtmlString
     */
    public function passwordGroup($label = null, $name, $options = array())
    {
        $group = [];

        $group[] = $this->openGroup($name, $label);

        $group[] = $this->password($name, $options);

        $group[] = $this->closeGroup();

        return implode('', $group);
    }

    /**
     * Create an texatrea form group
     *
     * @param  string  $label
     * @param  string  $name
     * @param  array   $options
     * @return \Illuminate\Support\HtmlString
     */
    public function textAreaGroup($label = null, $name, $value = null, $options = array())
    {
        $group = [];

        $group[] = $this->openGroup($name, $label);

        $group[] = $this->textarea($name, $value, $options);

        $group[] = $this->closeGroup();

        return implode('', $group);
    }

}

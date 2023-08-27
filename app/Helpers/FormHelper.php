<?php

namespace App\Helpers;

use CodeIgniter\HTTP\RequestInterface;

class FormHelper
{
    protected $request;

    public function __construct(RequestInterface $request)
    {
        $this->request = $request;
    }

    public function form_open($action = '', $attributes = [], $hidden = [])
    {
        $attributes = (!empty($attributes) && is_array($attributes)) ? $attributes : [];
        $hidden = (!empty($hidden) && is_array($hidden)) ? $hidden : [];

        if (!isset($attributes['method'])) {
            $attributes['method'] = 'post';
        }

        if (!isset($attributes['accept-charset'])) {
            $attributes['accept-charset'] = 'UTF-8';
        }

        if (!isset($attributes['enctype']) && strpos($attributes['method'], 'post') === 0) {
            $attributes['enctype'] = 'multipart/form-data';
        }

        if (strpos($action, '://') === false) {
            $action = site_url($action);
        }

        $form = '<form action="' . $action . '"';
        $form .= $this->attributes($attributes, ['method', 'action']);
        $form .= '>';

        if ($hidden) {
            $form .= form_hidden($hidden);
        }

        return $form;
    }

    protected function attributes($attributes, $exclude = [])
    {
        if (empty($attributes)) {
            return '';
        }

        $atts = '';

        if (isset($attributes['style'])) {
            $attributes['style'] = $this->stringify_attributes($attributes['style']);
        }

        foreach ($attributes as $key => $val) {
            if (is_bool($val)) {
                if ($val === true) {
                    $atts .= ' ' . $key . '="' . $key . '"';
                }
            } elseif (!in_array($key, $exclude, true)) {
                $atts .= ' ' . $key . '="' . $val . '"';
            }
        }

        return $atts;
    }

    protected function stringify_attributes($attributes)
    {
        $atts = '';

        foreach ($attributes as $key => $val) {
            $atts .= $key . ':' . $val . ';';
        }

        return $atts;
    }
}

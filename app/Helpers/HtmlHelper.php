<?php

class HtmlHelper
{

    static function test()
    {
        echo "Hii";
    }

    static function WebsiteDropdown($name, $default = '', $label = true, $style = '', $id = '', $hideOptions = [])
    {
        $websites = \App\Models\Website::get();
        $html = '<div>';

        if ($label)
            $html .= '<label>Website</label>';

        if ($style) {
            $style = 'style="' . $style . '"';
        }

        $html .= '<select id="' . $id . '" name="' . $name . '" class="form-control" ' . $style . '><option value="">Select website</option>';
        if (!empty($websites))
            foreach ($websites as $website) {
                if (!in_array($website->website_type, $hideOptions)) {
                    $selected = '';
                    if ($default == $website->website_type) {
                        $selected = 'selected="selected"';
                    }
                    $html .= '<option ' . $selected . ' value="' . $website->website_type . '">' . $website->website_type . '</option>';
                }
            }
        $html .= '</select></div>';
        echo $html;
    }

    static function PriceTypeDropdown($name, $default = '', $label = true, $style = '', $id = '', $hideOptions = [])
    {
        $tasktypes = ['SOP' => 'SOP', 'Essay' => 'Essay'];
        $html = '<div>';

        if ($label)
            $html .= '<label>Price Type</label>';

        if ($style) {
            $style = 'style="' . $style . '"';
        }

        $html .= '<select id="' . $id . '" name="' . $name . '" class="form-control" ' . $style . '><option value="">Select Price Type</option>';
        if (!empty($tasktypes))
            foreach ($tasktypes as $tasktype) {

                $selected = '';
                if ($default == $tasktype) {
                    $selected = 'selected="selected"';
                }
                $html .= '<option ' . $selected . ' value="' . $tasktype . '">' . $tasktype . '</option>';
            }
        $html .= '</select></div>';
        echo $html;
    }



    static function ServicePageDropdown($name, $default = '', $options = ['id' => '', 'style' => '', 'label' => ''], $conditions = ['id' => ['value' => '', 'statement' => '']])
    {

        if (count($conditions) > 0) {
            $services = \App\Models\Service::where(function ($q) use ($conditions) {
                foreach ($conditions as $key => $condition) {
                    if ($condition['value'] && $condition['statement']) {
                        $q->where($key, $condition['statement'], $condition['value']);
                    }
                }
            })->get();
        } else {
            $services = \App\Models\Service::get();
        }
        $id = isset($options['id']) ? $options['id'] : $name;
        $style = isset($options['style']) ? $options['style'] : '';
        $label = isset($options['label']) ? $options['label'] : 'Select Service';
        $html = '<select id="' . $id . '" name="' . $name . '" class="form-control" ' . $style . '>';
        $html .= '<option value="">' . $label . '</option>';
        if (!empty($services))
            foreach ($services as $item) {
                if (isset($item->seo->seo_url_slug) && !empty($item->seo->seo_url_slug) && !empty($item->seo->seo_meta)) {
                    $selected = ($default == $item->seo->seo_url_slug) ? 'selected="selected"' : '';
                    $html .= '<option ' . $selected . ' value="' . $item->seo->seo_url_slug . '">' . $item->seo->seo_meta . '</option>';
                }
            }
        $html .= '</select></div>';
        echo $html;
    }
}
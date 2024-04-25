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
}

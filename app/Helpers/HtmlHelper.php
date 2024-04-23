<?php

class HtmlHelper
{

    static function test()
    {
        echo "Hii";
    }

    static function WebsiteDropdown($name, $default = '')
    {
        $websites = \App\Models\Website::get();
        $html = '<div><label>Website</label><select name="' . $name . '" class="form-control"><option value="">Select website</option>';
        if (!empty($websites))
            foreach ($websites as $website) {
                $selected = '';
                if ($default == $website->website_type) {
                    $selected = 'selected="selected"';
                }
                $html .= '<option ' . $selected . ' value="' . $website->website_type . '">' . $website->website_type . '</option>';
            }
        $html .= '</select></div>';
        echo $html;
    }
}
<?php

namespace Del\Common\View\Helper;

use Del\Icon;

class AlertBox
{
    /**
     * @param array $message array of messages, last item in array should be alert class
     * @return bool|string
     */
    public function alertBox(array $message, $icon = true)
    {
        if(!$message){return false;}
        if(count($message) < 2) {
            $class = 'info';
        } else {
            $class = array_pop($message);
        }

        $alert = '<div class="alert ';
        if($class != 'alert'){$alert .= 'alert-'.$class;}
        $alert .= '"><button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>';

        $num = count($message);
        $x = 1;

        if($icon) {
            if(is_string($icon)) {
                $alert .= $icon;
            } elseif (is_bool($icon)) {
                $defaults = [
                    'info' => Icon::INFO_CIRCLE,
                    'warning' => Icon::WARNING,
                    'danger' => Icon::WARNING,
                    'success' => Icon::CHECK_CIRCLE,
                ];
                $alert .= $defaults[$class];
            }
        }

        foreach($message as $msg)
        {
            $alert .= $msg;
            if($x < $num){$alert .= '<br />';}
            $x ++;
        }
        $alert .= '</div>';
        return $alert;
    }
}
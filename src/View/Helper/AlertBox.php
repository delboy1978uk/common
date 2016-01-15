<?php

namespace Del\Common\View\Helper;

class AlertBox
{
    /**
     * @param array $message array of messages, last item in array should be alert class
     * @return bool|string
     */
    public function alertBox(array $message)
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
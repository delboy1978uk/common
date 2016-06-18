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
        $class = $this->getClass($message);

        $alert = '<div class="alert alert-'.$class.'"><button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>'.$this->renderMessage($message).'</div>';
        return $alert;
    }

    /**
     * @param array $message
     * @return string
     */
    private function getClass(array $message)
    {
        if(count($message) < 2) {
            return 'info';
        }
        $class = array_pop($message);
        $class = ($class != 'alert') ? 'alert-'.$class : '';
        return $class;
    }

    /**
     * @param array $message
     * @return string
     */
    private function renderMessage(array $message)
    {
        $alert = '';
        $num = count($message);
        $x = 1;
        foreach($message as $msg)
        {
            $alert .= $msg;
            if($x < $num){$alert .= '<br />';}
            $x ++;
        }
        return $alert;
    }
}
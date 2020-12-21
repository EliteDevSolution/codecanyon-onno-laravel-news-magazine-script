<?php

if (!function_exists('UserAgentBrowser')) {

    /**
     * description
     *
     * @param
     * @return
     */
    function UserAgentBrowser($purpose)
    {

        if(preg_match('/MSIE/i',$purpose) && !preg_match('/Opera/i',$purpose))
        {
            $bname      = 'Internet Explorer';
            $ub         = "MSIE";
        }
        elseif(preg_match('/Firefox/i',$purpose))
        {
            $bname      = 'Mozilla Firefox';
            $ub         = "Firefox";
        }
        elseif(preg_match('/Chrome/i',$purpose))
        {
            $bname      = 'Google Chrome';
            $ub         = "Chrome";
        }
        elseif(preg_match('/Safari/i',$purpose))
        {
            $bname      = 'Apple Safari';
            $ub         = "Safari";
        }
        elseif(preg_match('/Opera/i',$purpose))
        {
            $bname      = 'Opera';
            $ub         = "Opera";
        }
        elseif(preg_match('/Netscape/i',$purpose))
        {
            $bname      = 'Netscape';
            $ub         = "Netscape";
        }

        return $bname;

    }
}

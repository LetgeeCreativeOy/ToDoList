<?php

class Persona
{
    /**
     * Scheme, hostname and port
     */
    protected $audience;

    /**
     * Constructs a new Persona (optionally specifying the audience)
     */
    public function __construct($audience = NULL)
    {
        $this->audience = $audience ? $audience : $this->guessAudience();
    }

    /**
     * Verify the validity of the assertion received from the user
     *
     * @param string $assertion The assertion as received from the login dialog
     * @return object The response from the Persona online verifier
     */
    public function verifyAssertion($assertion)
    {
        
        $url = 'https://verifier.login.persona.org/verify';
        /*$assert = filter_input(
            INPUT_POST,
            $assertion,
            FILTER_UNSAFE_RAW,
            FILTER_FLAG_STRIP_LOW|FILTER_FLAG_STRIP_HIGH
        );*/
        echo $this->audience;
        $params = 'assertion=' . urlencode($assertion) . '&audience=' .
                   urlencode($this->audience);
        $ch = curl_init();
        $options = array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => TRUE,
            CURLOPT_POST => 2,
            CURLOPT_SSL_VERIFYPEER => true,
            //CURLOPT_SSL_VERIFYPEER => 0,
        
            CURLOPT_SSL_VERIFYHOST => 2,
            CURLOPT_POSTFIELDS => $params
        );
        curl_setopt_array($ch, $options);
        $result = curl_exec($ch);
        curl_close($ch);
        return json_decode($result);
    }

    /**
     * Guesses the audience from the web server configuration
     */
    protected function guessAudience()
    {
        $audience = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'http://' : 'https://';
        $audience .= $_SERVER['SERVER_NAME'] . ':'.$_SERVER['SERVER_PORT'];
        return $audience;
    }
}


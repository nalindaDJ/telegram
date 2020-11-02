<?php
class telegram
{
    protected $botConnection;
    protected $receiver;
    protected $message;
    protected $curlSSL;

    public function botURL($botURL){
         $this->botConnection=$botURL;
         return $this;
    }
    public function receiverId($receiverId){
        $this->receiver=$receiverId;
        return $this;
    }

    public function msg($message){
        $this->message = $message;
        return $this;
    }

    public function ssl($isssl=true){
        if(!$isssl){
            $this->curlSSL=[
                CURLOPT_SSL_VERIFYHOST => 0,
                CURLOPT_SSL_VERIFYPEER => 0
            ];
        }
        return $this;
    }

    public function send(){
        $postData= [
            "chat_id" =>$this->receiver,
            "text" => $this->message
        ];
        $curl = curl_init();

        $curlSettings=[
            CURLOPT_URL => $this->botConnection,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => $postData,
        ];
        if(!empty($this->curlSSL)){
            foreach ($this->curlSSL as $key => $value){
                $curlSettings[$key] = $value;
            }
        }
        curl_setopt_array($curl, $curlSettings);

        $response = curl_exec($curl);
        if (curl_errno($curl)) {
            return curl_error($curl);
        }
        curl_close($curl);
        return $response;

    }
}

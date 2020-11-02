# Telegram PHP class
This PHP class can be used to interface Telegram Bot Api to send messages. To learn how to create and set up a bot, please visit https://core.telegram.org/bots/api

You need to create a Telegram Bot for this method.
https://core.telegram.org/bots#6-botfather

Example Bot URL 
```sh 
https://api.telegram.org/bot{your id}:{token}/sendMessage?chat_id={receiver}&text={message} 
```

Receiver ID can be a username or actual ID 
- @username  or 1234567

When you do testing on loaclhost you can dissble SSL verification of cURL 

Usage:
```sh
$telegram = new telegram();
$result = $telegram
    ->botURL("https://api.telegram.org/bot{your id}:{token}/sendMessage")
    ->receiverId("@username")
    ->msg("Hello! My Name is Nalinda")
    ->ssl(false)
    ->send();
echo json_encode($result);
```

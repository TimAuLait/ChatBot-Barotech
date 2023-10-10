<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Chatbot Barotech</title>
  <link rel="stylesheet" href="">
  <script src="style.css"></script>
</head>
<body>

    <h1>ChatBot Barotech</h1>

    <?php

    function callOpenAI($message){
        $openai_endpoint = "https://api.openai.com/v1/chat/completions";
        $openai_token = "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";

        $data = array(
            "model" => "gpt-3.5-turbo",
            "messages" => array(
                array(
                    "role" => "system",
                    "content" => "ChatGPT"
                ),
                array(
                    "role" => "user",
                    "content" => $message
                )
            ),
            "max_tokens" => 100,
            "temperature" => 0.7
        );

        $headers = array(
            "Content-Type: application/json",
            "Authorization: Bearer ".$openai_token
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $openai_endpoint);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $response = curl_exec($ch);
        curl_close($ch);
        var_dump($response);

        return $response;

    }

    if(isset($_POST['message']) && isset($_POST['ok'])){
        $message = $_POST['message'];
        $reponse = callOpenAI($message);
        $data = json_decode($reponse, true);
        echo "<p>".$data['choices'][0]['message']['content']."</p>";
    }
    ?>

    <form method="POST">
        <input type="text" name="message" placeholder ="Message">
        <input type="submit" value="Envoyer">
    </form>

</body>
</html>
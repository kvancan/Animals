<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

require __DIR__ . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load(); 

function access(){
    $name = $_GET["name"];
    $curl = curl_init();
    $key = $_ENV["x_api_key"];
    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://api.api-ninjas.com/v1/animals?name='.$name.'',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_HTTPHEADER => array(
          'x-api-key:'.$key.''
        ),
      ));
      
      $response = curl_exec($curl);
      
      $response = curl_exec($curl);
      curl_close($curl);
      $value = json_decode($response, true);   
      return $value;
}

function show(){
    $animal_info = [];
    $Animal = access();
    $info["name"] = $Animal[0]["name"];
    $info["location"] = $Animal[0]["characteristics"]["location"];
    $info["slogan"] = $Animal[0]["characteristics"]["slogan"];
    $info["diet"] = $Animal[0]["characteristics"]["diet"];
    $info["population"] = $Animal[0]["characteristics"]["estimated_population_size"];
    array_push($animal_info,$info);
    return $animal_info;

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Information Board</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
    <div class="container">
        <h1>Submit Information</h1>
        <form method="get">
            <div class="form-group">
                <label for="name">Animal Name:</label>
                <input type="text" id="name" name="name" required>
                <button type="submit">Submit</button>
            </div>
        </form>
        <?php 
      
        if (isset($_GET["name"])){

                $infos = show();
              
        
        ?>
    </div>

        <h1>Information Board</h1>
        <div class="info-card">
            <div class="info-item">
                <span class="label">Name:</span>
                <span class="value"><?= $infos[0]["name"] ?></span>
            </div>
            <div class="info-item">
                <span class="label">Location:</span>
                <span class="value"><?= $infos[0]["location"] ?></span>
            </div>
            <div class="info-item">
                <span class="label">Population:</span>
                <span class="value"><?= $infos[0]["population"] ?></span>
            </div>
            <div class="info-item">
                <span class="label">Slogan:</span>
                <span class="value"><?= $infos[0]["slogan"] ?></span>
            </div>
            <div class="info-item">
                <span class="label">Diet:</span>
                <span class="value"><?= $infos[0]["diet"] ?></span>
            </div>
            <?php } ?>
        </div>
    </div>
</body>
<script type="text/javascript" > 

function submitform(){

document.getElementById("artist").submit();

}

document.getElementById('search').addEventListener('keypress', function(event) {
      if (event.keyCode == 13) {
          submitform();
      }
  })

</script>
</html>


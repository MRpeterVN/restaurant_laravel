<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div>
        <?php
if(DB::connection()->getPdo()){
    echo "Connected successfully to database.";
} else {
    echo "Could not connect to database.";
}
      ?>
    </div>
</body>
</html>
<!doctype html>
<html lang="en">
<head>
<!-- Required meta tags -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="stylesheet" href="css/bootstrap.css">
<link href="https://fonts.googleapis.com/css?family=Cairo" rel="stylesheet">
<title>Verification Email Template</title>
</head>

<body>
<div class="container-fluid">
  <div style="" class="container" id="center">
    <div class="card o-hidden border-0 shadow-lg my-5">
      <div class="card-body p-5">
        <!-- Nested Row within Card Body -->
        <div class="row pt-5">
          <h3 style="font: normal normal bold 20px/32px Cairo;">Hello {{$user->name}},</h3>
        </div>
        <div class="row pt-5">
        </div>
        <!-- Verify btn -->
        <div class="row pt-3">
            <h4>Here is the code to reset password</h4>
            <h1 id="">{{$resetPassToken->token}}</h1>
        </div>
        <div class="row pt-3">
        </div>
      </div>
    </div>
  </div>
</div>
<script src="js/bootstrap.js"></script>
</body>
</html>

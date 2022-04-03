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
          <h3 style="font: normal normal bold 20px/32px Cairo;">Hello {{$user->fullName}},</h3>
        </div>
        <div class="row pt-5">
            Please click on the button below to reset your password.</h6>
        </div>
        <!-- Verify btn -->
        <div class="row pt-3"><a  href="{{url('reset-password/').'/'.$resetPassToken->token}}" style="font: 20px/32px Cairo; color: #FFFFFF; background: #0D67CB 0% 0% no-repeat padding-box; box-shadow: 2px 2px 4px #00000029; border-radius: 15px; width: 211px; height: 53px;" class="btn btn-block" id="">Reset Your Password</a> </div>
        <div class="row pt-3">
        </div>
      </div>
    </div>
  </div>
</div>
<script src="js/bootstrap.js"></script>
</body>
</html>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
    <link rel="stylesheet" href="css/index.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/constant.css">

</head>

<body>
    <div class="maxw">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-7">
                    <h2>iGrocery</h2>
                    <div class="left-side-img">
                        <img src="assets/img2.svg" alt="" srcset="" width="70%">
                    </div>
                    <p class="p-title">The Invertory management platform of iGrocery</p>

                </div>
                <div class="col-lg-5" style="display:flex;justify-content:center;align-items:center;">
                    <form style="width:100%">
                        <h4 style="margin-bottom: 20px;">Sign in to iGrocery</h4>
                        <div class="input-container">
                            <label class="my-label" style="font-size: 16px;">Username:</label>
                            <input type="text" class="my-form" name="username" id="username" placeholder="" style="padding: 8px ;">
                            <span id="username-error" style="color:red"></span>

                        </div>

                        <div class="input-container">
                            <label class="my-label" style="font-size: 16px;">Password:</label>
                            <input type="password" name="password" class="my-form" id="password" placeholder="" style="padding: 8px ;">
                            <span id="password-error" style="color:red"></span>
                        </div>
                        <center>
                            <div style="margin: 20px 0;" data-size="normal" data-callback="verifyCallback" class="g-recaptcha" data-sitekey="6LcQzjYlAAAAAGfL9h3KjVPf4bffAA6n_CqS5bYM" data-action="LOGIN"></div>
                        </center>
                        <p id="error" style="color:red;margin-top:20px;"></p>
                        <input type="button" id="lgnbtn" value="Login" class="btn-form" style="padding: 8px;font-size:16px">
                        <p class="have-acc">Don't have account yet? <a href="pages/registration.php">Sign up</a></p>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <div class="loader">
        <div class="lds-ring">
            <div></div>
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script src="js/login.js"></script>

</body>
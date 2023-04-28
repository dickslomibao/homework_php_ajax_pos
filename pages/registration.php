<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/index.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/constant.css">

</head>

<body>
    <div class="maxw">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-7">
                    <h2>iGrocery</h2>
                    <div class="left-side-img">
                        <img src="../assets/img2.svg" alt="" srcset="" width="70%">
                    </div>
                    <p class="p-title">The Invertory management platform of iGrocery</p>
                </div>
                <div class="col-lg-5" style="display:flex;justify-content:center;align-items:center;">
                    <form>
                        <br>
                        <h4 style="margin-bottom: 20px;">Sign up to iGrocery</h4>
                        <div class="input-container">
                            <label class="my-label">Name</label>
                            <input type="text" class="my-form" id="name" placeholder="" name="name">
                            <span id="name-error" style="color:red"></span>
                        </div>
                        <div class="input-container">
                            <label class="my-label">Email</label>
                            <input type="text" class="my-form" id="email" placeholder="" name="email">
                            <span id="email-error" style="color:red"></span>
                        </div>


                        <div class="input-container">
                            <label class="my-label">Username</label>
                            <input type="text" class="my-form" id="username" placeholder="" name="username">
                            <span id="username-error" style="color:red"></span>
                        </div>

                        <div class="row">
                            <div class="col-6">
                                <div class="input-container">
                                    <label class="my-label">Password</label>
                                    <input type="password" class="my-form" id="password" placeholder="" name="password">
                                    <span id="password-error" style="color:red"></span>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="input-container">
                                    <label class="my-label">Re-type Password</label>
                                    <input type="password" class="my-form" id="repass" placeholder="">
                                    <span id="repass-error" style="color:red"></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="checkbox">
                            <label class="form-check-label" for="flexCheckDefault">
                                I agree with the <a role="button" style="color: rgba(0,0,255,.8);">terms and condition</a>.
                            </label>
                        </div>
                        <center>
                            <span id="terms-error" style="color:red"></span>
                        </center>
                        <script src="https://accounts.google.com/gsi/client" async defer></script>
                        <div class="or">
                            <div></div>
                            <p>OR</p>
                            <div></div>
                        </div>
                        <center>
                            <div style="margin: 10px 0;">
                                <div id="g_id_onload" data-auto_select="false" data-client_id="57912920137-6qvfhgm2q128qkb5rlsoonseq4g3q55c.apps.googleusercontent.com" data-callback="handleCredentialResponse" data-context="signup">
                                </div>
                                <div class="g_id_signin" data-text="signup_with" data-type="standard"></div>
                            </div>
                        </center>
                        <input type="button" value="Create an account" class="btn-form" id="submit">
                        <p class="have-acc">Already have an account ? <a href="../">Login</a></p>
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
    <script src="../js/reg.js"></script>
    <script src="../js/jwt.js"></script>
    <script>
        async function handleCredentialResponse(response) {
            const responsePayload = jwt_decode(response.credential);
            console.log("ID: " + responsePayload.sub);
            console.log('Full Name: ' + responsePayload.name);
            console.log('Given Name: ' + responsePayload.given_name);
            console.log('Family Name: ' + responsePayload.family_name);
            console.log("Image URL: " + responsePayload.picture);
            console.log("Email: " + responsePayload.email);
            await $.post("../controller/userController.php", {
                    'gmail': '',
                    'name': responsePayload.name,
                    'email': responsePayload.email,
                },
                function(data, textStatus, jqXHR) {
                    if (data == '200') {
                        location.href = 'home.php';
                    }
             
                },
            );

        }
    </script>

</html>
</body>

</html>
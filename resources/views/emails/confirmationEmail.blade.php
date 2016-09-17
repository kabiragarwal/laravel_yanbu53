<!DOCTYPE html>
<html>
    <head>
        <title>Confirmation Email</title>
    </head>
    <body>
        <div class="container">
            <h1>Hi Thanks for Signup on our site </h1>
            <div> Your verification <a href='{{ url("confirmEmail/{$user->token}")}}'>link is here</a> </div>
        </div>
    </body>
</html>

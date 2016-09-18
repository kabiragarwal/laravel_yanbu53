<!DOCTYPE html>
<html>
    <head>
        <title>Confirmation Email</title>
    </head>
    <body>
        <div class="container">
            <h1>Hi {{$userData->first_name}}! </h1>
            <div>For reset your password, Please <a href='{{ url("password_reset/{$userData->token}")}}'>click here</a> </div>
        </div>
    </body>
</html>

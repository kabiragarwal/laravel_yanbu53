<!DOCTYPE html>
<html>
    <head>
        <title>Contact Us Email</title>
    </head>
    <body>
        <div class="container">
            <h1>Person Name: {{$data['first_name']}} {{$data['last_name']}} </h1>
            <p>Company Name: {{$data['company_name']}} </p>
            <p>Email: {{$data['email']}} </p>
            <p>Message: {{$data['message']}} </p>
        </div>
    </body>
</html>

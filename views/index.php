<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form action="/logout" method="post">
        <input type="submit" name="logout" value="Logout" />
    </form>
    <div class="container">
        <main class="container">
            <form class="login col-md-6 mx-auto container mt-5 pt-5 mb-5 pb-2" method="post" action="/routes">
                <h1>Select a Time Range</h1>
                <div class="form-label-group">
                    <label for="">Time and Date From</label>
                    <input type="date" id="dateFrom" class="form-control my-2" placeholder="date from" required autofocus="" name="dateFrom">
                    <input type="time" id="timeFrom" class="form-control my-2" placeholder="time from" required autofocus="" name="timeFrom">
                </div>

                <div class="form-label-group">
                    <label for="">Time and Date To</label>
                    <input type="date" id="dateTill" class="form-control my-2" required name="dateTill">
                    <input type="time" id="timeTill" class="form-control my-2" required autofocus="" name="timeTill">
                </div>
                <button class="btn btn-lg btn-primary btn-block" type="submit" name="submit">Get Route</button>
            </form>
        </main>
    </div>
</body>
</html>
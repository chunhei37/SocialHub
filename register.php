<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <meta name="description" content=""/>
    <meta name="author" content=""/>
    <title>Social Hub - Register</title>
    <!-- Bootstrap core CSS-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css"
          integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
</head>
<body>
<div class="container">
    <div class="card mx-auto mt-5">
        <div class="card-header">Register</div>
        <div class="card-body">
            <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
            <form id="form" name="form" method="post" action="register_action.php">
                <div class="form-group">
                    <label>Email: </label><input class="form-control" type="email" name="email"
                                                 placeholder="Enter your email" required=/>
                    <div class="form-row">
                        <div class="col-md-6">
                            <label>First Name: </label><input class="form-control" type="text" name="fname"
                                                              placeholder="Enter your first name" required/>
                        </div>
                        <div class="col-md-6">
                            <label>Last Name: </label><input class="form-control" type="text" name="lname"
                                                             placeholder="Enter your last name" required/> <br>
                        </div>
                    </div>
                    <label>Password: </label><input class="form-control" type="password" name="password1"
                                                    placeholder="Enter your password" required/> <br>
                    <label>Re-Enter Password: </label><input class="form-control" type="password" name="password2"
                                                             placeholder="Enter your password once again" required/> <br>
                    <label>Gender: </label><select class="form-control" name="gender" form="form">
                        <option value="Female">Female</option>
                        <option value="Male">Male</option>
                        <option value="Other">Other</option>
                    </select> <br>
                    <label>Birthday: </label><input class="form-control" type="date" name="bday" required/> <br>
                    <input class="btn btn-primary btn-block" type="submit" name="button" value="Submit"/>
            </form>
        </div>
    </div>
</div>
<!-- Bootstrap core JavaScript-->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"
        integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4"
        crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js"
        integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1"
        crossorigin="anonymous"></script>
</html>

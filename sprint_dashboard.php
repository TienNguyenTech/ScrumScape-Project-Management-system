<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap link-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <style>
        body {
            background-color: #F3EFEF;
        }
        .drop-shadow {
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        }

        .navbar-toggler img {
            width:20px;
            height:20px
        }

        .navbar-toggler {
            border-width: 0px
        }

        .admin-card *{
            color: black;
            font-family: "Montserrat", sans-serif;
            margin: 8px;
        }

        .sublinks {
            font-size: 13px;
        }

        .admin-card a:hover {
            color: grey
        }

        .admin-card {
            border-radius: 20px;
            margin: 80px;
        }

        .sublinks img {
            width: 15px;
            height: 15px;
        }
    </style>
</head>

<body>
    <!-- Collapsible sidebar -->
    <div class="nav-flex-column">
        <div class="collapse" id="navbarToggleExternalContent">
          <div class="bg-white p-4">
            <h4 class="text-dark">Menu</h4>
            <button class="btn btn-primary"> Option 1 </button>
            <button class="btn btn-primary"> Option 2 </button>
            <button class="btn btn-primary"> Option 3 </button>
          </div>
        </div>
    </div>
    
    <!-- Navigation bar -->
    <nav class="navbar navbar-light bg-white drop-shadow container-fluid-m3">
        <a class="navbar-brand" href="sprint_dashboard.php">
            <img src="assets/logo.png" style="width: 130px;" class="d-inline-block align-top" alt="logo">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation">
            <img src="assets/dropdown.svg">
        </button>
    </nav>

    <!-- Admin Card -->
    <div class="admin-card card drop-shadow" style="width: 20rem;">
        <div class="card-body">
            <h5 class="card-title"> Welcome, FirstName! </h5>
            <img src="/user_icon.svg"/ style="width:40px">
            <h6> You are a Admin.</h6>
            <a href="#" class="btn btn-link sublinks"> 
                <img src="/reset_pass.svg"/> Reset Password
            </a>
            <a href="#" class="btn btn-link sublinks"> 
                <img src="/view_team.svg"/> View My Team
            </a>
            <a href="#" class="btn btn-link sublinks"> 
                <img src="/add_teammem.svg"/> Add a Team Member
            </a>
        </div>
    </div>

    <!-- Bootstrap optional javascript-->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</body>
</html>
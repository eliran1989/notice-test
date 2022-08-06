<!DOCTYPE html>
<html lang="en" dir='rtl'>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>רמת הוד -לוח מודעות</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="./script.js"></script>

  <style>
   .equal {
        display: flex;
        display: -webkit-flex;
        flex-wrap: wrap;
    }

    .equal .card{
      width: 100%;
    }

    .card svg{
      position:absolute;
      left:10px;
      top:10px;
      cursor:pointer;
    }
  </style>






</head>
<body>


<nav class="navbar navbar-dark bg-primary navbar-expand-lg">
  <div class="container">
  <a class="navbar-brand" href="#">רמת-הוד לוח מודעות</a>


    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#" data-bs-toggle="modal" data-bs-target="#addModal">הוספת מודעה</a>
        </li>
      </ul>
    </div>

  </div>
</nav>




<div class="container">




<div class="modal fade" id="confirmDeleteModal" data-bs-keyboard="false" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
       האם למחוק את המודעה?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">ביטול</button>
        <button type="button" class="btn btn-primary" data-bs-dismiss="modal"  id='confirmDelete'>מחיקה</button>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">הוספת מודעה</h5>
        <button type="button" class="btn-close" style='margin:0' data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

      <form id="form_notice">
          <div class="mb-3">
            <label for="name" class="form-label">שם מפרסם</label>
            <input type="text" class="form-control" id="name" name="name" required=""/>
            <div class="invalid-feedback">חובה למלא שם מפרסם</div>
          </div>
          <div class="mb-3">
            <label for="email" class="form-label">אימייל</label>
            <input type="email" class="form-control" id="email" name="email" required=""/>
            <div class="invalid-feedback">יש להקליד כתובת אימייל בצורה תיקנית</div>
          </div>
          <div class="mb-3">
            <label for="content" class="form-label">תוכן המודעה</label>
            <textarea class="form-control" id="content" rows="3" required="" name="content"></textarea>
            <div class="invalid-feedback">חובה למלא את תוכן המודעה</div>
          </div>
      </form>


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="cancel_notice">ביטול</button>
        <button type="button" class="btn btn-primary" id="save_notice">הוספת מודעה</button>
      </div>
    </div>
  </div>
</div>



<div class="row" id='notice_loading'>
    <div class="col-xs-12 col-sm-4 mt-3 equal">
        <div class="card" >
            <div class="card-body">
            <h6 class="card-title placeholder-glow">
                <span class="placeholder col-6"></span>
             </h6>
            <h6 class="card-title placeholder-glow">
                <span class="placeholder col-5"></span>
             </h6>
             <p class="card-text placeholder-glow">
                <span class="placeholder col-7"></span>
                <span class="placeholder col-4"></span>
                <span class="placeholder col-4"></span>
                <span class="placeholder col-6"></span>
                <span class="placeholder col-8"></span>
          </p>
          <h6 class="card-title placeholder-glow">
                <span class="placeholder col-3"></span>
             </h6>
            </div>
        </div>
    </div>
    <div class="col-xs-12 col-sm-4 mt-3">
        <div class="card" >
            <div class="card-body">
            <h6 class="card-title placeholder-glow">
                <span class="placeholder col-6"></span>
             </h6>
            <h6 class="card-title placeholder-glow">
                <span class="placeholder col-5"></span>
             </h6>
             <p class="card-text placeholder-glow">
                <span class="placeholder col-7"></span>
                <span class="placeholder col-4"></span>
                <span class="placeholder col-4"></span>
                <span class="placeholder col-6"></span>
                <span class="placeholder col-8"></span>
          </p>
          <h6 class="card-title placeholder-glow">
                <span class="placeholder col-3"></span>
             </h6>
            </div>
        </div>
    </div>
    <div class="col-xs-12 col-sm-4 mt-3">
        <div class="card" >
            <div class="card-body">
            <h6 class="card-title placeholder-glow">
                <span class="placeholder col-6"></span>
             </h6>
            <h6 class="card-title placeholder-glow">
                <span class="placeholder col-5"></span>
             </h6>
             <p class="card-text placeholder-glow">
                <span class="placeholder col-7"></span>
                <span class="placeholder col-4"></span>
                <span class="placeholder col-4"></span>
                <span class="placeholder col-6"></span>
                <span class="placeholder col-8"></span>
          </p>
          <h6 class="card-title placeholder-glow">
                <span class="placeholder col-3"></span>
             </h6>
            </div>
        </div>
    </div>
        
</div>


        <div class="toast" style="position: fixed; bottom: 10px; right:10px">
          <div class="toast-header"></div>
          <div class="toast-body">
          </div>
        </div>
      </div>

</body>
</html>
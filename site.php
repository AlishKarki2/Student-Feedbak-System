<html>
<head>
  <style>
    * {
      box-sizing: border-box;
    }

    .header {
      background-color: purple;
      color: white;
      font-size: 36px;
      padding: 20px;
      text-align: center;
    }

    .subheader {
      font-size: 24px;
      margin-bottom: 20px;
    }

    .container {
      display: flex;
      flex-wrap: wrap;
      justify-content: space-around;
    }

    .card {
      width: 300px;
      margin: 10px;
      border: 1px solid black;
    }

    .card-image {
      width: 100%;
      height: 200px;
      object-fit: cover;
    }

    .card-label {
      font-size: 18px;
      font-weight: bold;
      padding: 10px;
    }
  </style>
</head>
<body>
  <div class="header">
    University Overview
    <div class="subheader">
      UIED puts great pride in the parts that make up its whole.
    </div>
  </div>
  <div class="container">
    <div class="card">
      <img src="img1" alt="Student Profile" class="card-image">
      <div class="card-label">
        Student Profile
      </div>
    </div>
    <div class="card">
      <img src="img2" alt="Teaching Staff" class="card-image">
      <div class="card-label">
        Teaching Staff
      </div>
    </div>
    <div class="card">
      <img src="img3" alt="Schools & Departments" class="card-image">
      <div class="card-label">
        Schools & Departments
      </div>
    </div>
  </div>
</body>
</html>

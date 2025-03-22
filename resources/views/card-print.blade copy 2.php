<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ID Card</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #f0f0f0;
        }

        .card-container {
            position: relative;
            display: inline-block;
        }

        .profile-photo {
            position: absolute;
            width: 79px;
            height: 100px;
            object-fit: cover;
            top: 68px;
            right: 23px;
            border: 1px solid #fff;
            background-color: white;
            z-index: 5;
        }

        .card {
            width: 3.41in;
            height: 2.11in;
            background: url('https://api.darululoom-islamia.org/images/card.png') no-repeat center center;
            background-size: cover;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 10;
            /* Ensure card stays above */
        }

        .qr-code {        
            position: absolute;
            width: 39px;
            height: 39px;
            object-fit: cover;
            top: 122px;
            right: 134px;
            background-color: white;
            z-index: 5;
        }

        .student-name {
            position: absolute;
            text-align: left;
            font-size: 11px;
            font-weight: bold;
            text-transform: uppercase !important;
            left: 20px;
            top: 95px;
            color: #13345B;
            z-index: 555;
        }
        .student-details {
            position: absolute;
            text-align: left;
            font-size: 8px;
            font-weight: bold;
            left: 54px;
            top: 125px;
            color: #60605F;
            z-index: 555;
            line-height: 10px;
        }

    </style>
</head>
<body>

    <div class="card-container">
        <img src="https://api.darululoom-islamia.org/images/student_photo/student_profile_photo_3.jpg" alt="Profile Photo" class="profile-photo">
        <img src="data:image/svg+xml;base64,{!! base64_encode(QrCode::format('svg')->size(100)->generate('https://www.darululoom-islamia.org/student-profile')) !!}" alt="QR Code" class="qr-code">
        <div class="card"></div>
        <div >
            <p class="student-name">Aniruddho Roy Antik </p>
           
         <div class="student-details">
            10235009020302 <br>
            1900 <br>
              +880 1931 034992 <br>
             +880 1931 034992
         </div>
        </div>
    </div>

   
   

           
       
   


</body>
</html>

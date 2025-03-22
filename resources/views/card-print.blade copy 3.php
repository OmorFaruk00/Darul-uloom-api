<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ID Card</title>
    <style>

@page {
    size: 8.5in 11in; /* Letter size */
    margin: 0.5in; /* 0.5 inch margin */
}
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            background-color: #fff;
        }

        .card-container {              
            position: relative;
            display: inline-block;
            /* top: 10%;
            left: 30%; */
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
            <p class="student-name">{{$student->student_name_english}} </p>
           
         <div class="student-details">
            {{$student->reg_no}} <br>
            {{$student->dob}} <br>
            {{$student->std_birth_no}} <br>
            {{$student->f_cellno1}}
         </div>
        </div>
    </div>

   
   

           
       
   


</body>
</html>

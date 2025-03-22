<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Card</title>
    {{-- <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;700&display=swap" rel="stylesheet"> --}}

    <link href="https://fonts.googleapis.com/css2?family=Akrobat:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
       @page {
            size: 15in 12in;
            margin: 0px 0px;
        }

        body {
            /* font-family: 'Poppins', sans-serif; */
            font-family: 'Akrobat', sans-serif; 
            width: 15.625in;
            height: 8.375in;
            margin: 0;
            padding: 0;
            text-align: center;
            position: relative;
        }

        .card-container {
            width: 15in;
            height: 8in;
            background: url("{{ $backgroundUrl }}") no-repeat center center;
            background-size: contain;
            position: relative; /* Keep it above the image */
            z-index: 5; /* Higher z-index to be above the image */
        }

        .profile-photo {
            position: absolute;
            width: 310px;
            height: 350px;
            object-fit: cover;
            top: 268px;
            right: 255px;
            background-color: white;
            z-index: 1;
        }
        .qr-code {
            position: absolute;
            width: 145px;
            height: 141px;
            object-fit: cover;
            top: 460px;
            right: 670px;
            background-color: white;
            z-index: 1;

        }

        .student-name {
            font-family: 'Poppins', sans-serif;
            position: absolute;
            text-align: left;
            font-size: 35px;
            font-weight: 700;
            text-transform: uppercase !important;
            left: 205px;
            top: 362px;
            color: #13345B;
            z-index: 5555;
            letter-spacing: -1px;
        }
        .student-details {
            position: absolute;
            text-align: left;
            font-size: 31px;
            font-weight: bold;
            left: 308px;
            top: 471px;
            color: #201e1e;
            z-index: 5555;
            line-height: 34px;
        }
    </style>
</head>
<body>
    <div class="card-container"></div>
    <img src="{{ $photoUrl }}" alt="Profile Photo" class="profile-photo">

    <img src="data:image/svg+xml;base64,{!! base64_encode(QrCode::format('svg')->size(100)->generate($qrCode)) !!}" alt="QR Code" class="qr-code">
    <p class="student-name">{{ $student->student_name_english }} </p>
           
    <div class="student-details">
       &nbsp;{{ $student->reg_no }} <br>
       &nbsp;{{ $student->dob }} <br>
       &nbsp;{{ $student->std_birth_no }} <br>
       &nbsp;+88{{ $student->f_cellno1 }}
    </div>
   </div>
</body>
</html>

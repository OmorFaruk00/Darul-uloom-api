<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Card</title>
    <style>
  @page {
            size: 3.625in 2.375in;
            margin: 0;
        }

        body {
            width: 3.625in;
            height: 2.375in;
            margin: 0;
            padding: 0;
            text-align: center;
            position: relative;
        }

        .card-container {
            width: 3.625in;
            height: 2.375in;
            background: url("{{ $backgroundUrl }}") no-repeat center center;
            background-size: contain;
            position: relative; /* Keep it above the image */
            z-index: 5; /* Higher z-index to be above the image */
        }

        .profile-photo {
            position: absolute;
    width: 90px;
    height: 138px;
    object-fit: cover;
    top: 78px;
    right: 17px;
    background-color: white;
    z-index: 1;
        }
        .qr-code {
            position: absolute;
    width: 42px;
    height: 42px;
    object-fit: cover;
    top: 135px;
    right: 141px;
    background-color: white;
    z-index: 1;

        }

        .student-name {
            position: absolute;
            text-align: left;
            font-size: 12px;
            font-weight: bold;
            text-transform: uppercase !important;
            left: 20px;
            top: 104px;
            color: #13345B;
            z-index: 5555;
        }
        .student-details {
            position: absolute;
            text-align: left;
            font-size: 10px;
            font-weight: bold;
            left: 54px;
            top: 141px;
            color: #201e1e;
            z-index: 5555;
            line-height: 10.5px;
        }
    </style>
</head>
<body>
    <div class="card-container"></div>
    <img src="{{ $photoUrl }}" alt="Profile Photo" class="profile-photo">

    <img src="data:image/svg+xml;base64,{!! base64_encode(QrCode::format('svg')->size(100)->generate($qrCode)) !!}" alt="QR Code" class="qr-code">
    <p class="student-name">{{ $student->student_name_english }} </p>
           
    <div class="student-details">
       {{ $student->reg_no }} <br>
       {{ $student->dob }} <br>
       {{ $student->std_birth_no }} <br>
        +88{{ $student->f_cellno1 }}
    </div>
   </div>
</body>
</html>

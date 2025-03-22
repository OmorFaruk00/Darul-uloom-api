<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ID Card</title>
  <link rel="stylesheet" href="https://api.fontshare.com/v2/css?f[]=akrobat@400,500,600,700&display=swap">


    <style>

    
        body {
            font-family: 'Akrobat', sans-serif;
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
            width: 137px;
            height: 189px;
            object-fit: cover;
            top: 97px;
            right: 29px;
            border: 1px solid #fff;
            background-color: white;
            z-index: 5;
        }

        .card {
            width: 5.41in;
            height: 3.11in;
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
            width: 60px;
            height: 62px;
            object-fit: cover;
            top: 184px;
            right: 213px;
            background-color: white;
            z-index: 5;
        }

        .student-name {
            position: absolute;
            text-align: left;
            font-size: 14.67px;
            font-weight: bold;
            text-transform: uppercase !important;
            left: 34px;
            top: 145px;
            color: #13345B;
            z-index: 5555;
        }
        .student-details {
            position: absolute;
            text-align: left;
            font-size: 11.67px;
            font-weight: bold;
            left: 88px;
            top: 189px;
            color: #201e1e;
            z-index: 5555;
            line-height: 14px;
        }
        /* .blood {
            position: absolute;
            text-align: left;
            font-size: 8px;
            font-weight: bold;
            color: #60605F;
            left: 174px;
            top: 150px;
            z-index: 555;
} */

    </style>
</head>
<body>

    <div class="card-container">
        <img src="{{ $photoUrl }}" alt="Profile Photo" class="profile-photo">
        <img src="data:image/svg+xml;base64,{!! base64_encode(QrCode::format('svg')->size(100)->generate( $qrCode )) !!}" alt="QR Code" class="qr-code">
        <div class="card"></div>
        {{-- <div >
            <p class="student-name">{{ $student->student_name_english }} </p>
           
         <div class="student-details">
            {{ $student->reg_no }} <br>
            {{ $student->dob }} <br>
            {{ $student->std_birth_no }} <br>
             +88{{ $student->f_cellno1 }}
         </div>
        </div> --}}

        
       
       <p class="student-name">{{ $student['student_name_english'] }} </p>
        <div class="student-details">
            {{ $student['reg_no'] }}<br>
            {{ $student['dob'] }} <br>
            {{ $student['std_birth_no'] }} <br>
             +88{{ $student['f_cellno1'] }}
         </div>

        {{-- <p class="blood">A+</p> --}}    
    </div>

   
   

           
       
   


</body>
</html>

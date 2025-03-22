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
        .card {
            width: 3.41in;
            height: 2.11in;
            /* background: url('https://api.darululoom-islamia.org/images/card.png') no-repeat center center; */
            background: url('https://api.darululoom-islamia.org/images/student_photo/student_profile_photo_3.jpg') no-repeat center center;
            background-size: cover;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            border-radius: 10px;
            z-index: 10;
            overflow: hidden; 
        }
    
        .profile-photo {
            position: absolute;
            width: 76px;
            height: 87px;
            object-fit: cover;
            top: 67px;
            right: 25px;
            border: 1px solid #fff;
            background-color: white;
            z-index: 1000;
        }
        .qr-code {
            position: absolute;
            width: 39px;
            height: 39px;
            object-fit: cover;
            top: 121px;
            right: 133px;
            border: 1px solid #fff;
            background-color: white;
            z-index: 1000;
        }

        .details {
            position: absolute;
            text-align: left;
            font-size: 12px;
            font-weight: bold;
            left: 20px;
            top: 20px;
            color: black;
        }
    </style>
</head>
<body>
    <div class="card">
        {{-- <img src="https://api.darululoom-islamia.org/images/student_photo/student_profile_photo_3.jpg" alt="Student Photo" class="profile-photo"> --}}
        <img src="https://api.darululoom-islamia.org/images/card.png" alt="Student Photo" class="profile-photo">


        <img src="data:image/svg+xml;base64,{!! base64_encode(QrCode::format('svg')->size(100)->generate('https://www.darululoom-islamia.org/student-profile')) !!}" alt="QR Code" class="qr-code">
        <div class="details">

           

            

            Name: Aniruddho Roy Antik <br>
            ID No: 10235009020302 <br>
            DOB: 1900 <br>
            Gov ID: +880 1931 034992 <br>
            Phone: +880 1931 034992
        </div>
    </div>


</body>
</html>

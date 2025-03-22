<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Card</title>
    <style>
        @page {
            size: 3.45in 2.3in;
            margin: 0;
        }

        body {
            width: 3.45in;
            height: 2.3in;
            margin: 0;
            padding: 0;
        }

        .card-container {
            width: 3.45in;
            height: 2.3in;
            background: url("{{ $backgroundUrl }}") no-repeat;
            background-size: contain;
            position: relative;
            z-index: 555;
        }

        .profile-photo {
            position: absolute;
            width: 160px;
            height: 212px;
            object-fit: cover;
            top: 120px;
            right: 20px;
            border: 1px solid #fff;
            background-color: white;
            z-index: 5;
        }

        .qr-code {
            position: absolute;
            bottom: 10px;
            right: 10px;
            width: 1in;
            height: 1in;
        }

        .student-name {
            font-size: 12px;
            text-align: center;
            position: absolute;
            bottom: 40px;
            left: 0;
            right: 0;
        }

        .student-details {
            font-size: 10px;
            text-align: center;
            position: absolute;
            bottom: 10px;
            left: 0;
            right: 0;
        }
    </style>
</head>
<body>
    <div class="card-container">
        {{-- <img src="{{ $photoUrl }}" alt="Profile Photo" class="profile-photo"> --}}
        {{-- <img src="data:image/svg+xml;base64,{!! base64_encode(QrCode::format('svg')->size(100)->generate($qrCode)) !!}" alt="QR Code" class="qr-code"> --}}

        {{-- <p class="student-name">{{ $student->student_name_english }}</p>
        <div class="student-details">
            {{ $student->reg_no }}<br>
            {{ $student->dob }}<br>
            {{ $student->std_birth_no }}<br>
            +88{{ $student->f_cellno1 }}
        </div> --}}
    </div>
</body>
</html>

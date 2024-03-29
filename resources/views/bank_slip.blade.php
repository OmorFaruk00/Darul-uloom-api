<!doctype html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Bank Deposits Slip</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        table,
        td,
        th {
            border: 1px solid #000;`
            font-size: 9px !important;
            padding: 1px 5px;
        }

        .b-none {
            border-top: 2px solid #fff;
            border-bottom: 2px solid #fff;
            border-left: 2px solid #fff;
            border-right: 2px solid #fff;
        }

        .bt-none {
            border-top: 2px solid #fff;
        }

        .bb-none {
            border-bottom: 2px solid #fff;
        }

        .br-none {
            border-right: 2px solid #fff;
        }

        .bl-none {
            border-left: 2px solid #fff;
        }

        .tc {
            text-align: center;
        }

        .tr {
            text-align: right;
        }

        /*width*/
        .w-1 {
            width: 1%;
        }

        .w-10 {
            width: 10%;
        }

        .w-15 {
            width: 15%;
        }

        .w-40 {
            width: 40%;
        }

        /*margin*/
        .mt-1 {
            margin-top: 2px;
        }

        .mt-5 {
            margin-top: 5px;
        }

        .mt-8 {
            margin-top: 16px;
        }

        .mt-15 {
            margin-top: 30px;
        }

        .f-12 {
            font-size: 12px !important;
        }

        .f-19 {
            font-size: 14px !important;
        }

        /*padding*/
        .p-0 {
            padding: 0 !important;
        }

        /*new*/
        .test{
            font-size: 10px !important;
        }
     

    </style>
</head>

<body>


    <!-- <div style="width:100%;" class="test"> -->
    <div style="width: 100%">

        <!--EXIM Copy-->
        <div style="width: 33%;border-right: 1px dotted #000;float: left; overflow:hidden;padding:0px;">

            <table class="b-none">
                <tr>
                    <td colspan="2" class="bb-none br-none" style="">Receipt No.
                        <b>{{ $recieve_id ?? '' }}</b>
                    </td>
                    <td><p style="font-size: 5px" >Copy of Accounts</p> </td>
                </tr>

                <tr>
                    <th class='f-12 bt-none' colspan="3">
                        Export Import Bank of Bangladesh Limited
                    </th>
                </tr>
            </table>

            <div style="width: 220px;margin: 0 auto;">

                <table class="mt-1 b-none">
                    <tr>
                        <td class="tc f-12 bb-none p-0">

                            House # 49, Block # H, Road # 11,
                            Kazi's Heritage, Banani , Dhaka- 1213

                        </td>
                    </tr>
                    <tr>
                        <td style="text-transform: capitalize" class="tc f-12 bb-none p-0"><b>Banani Branch</b></td>
                    </tr>
                    <tr>
                        <td class="tc f-12 bb-none p-0">

                            MSND Account No: 6113100002042

                        </td>
                    </tr>

                    <tr>
                        <th class="tc f-19 bb-none p-0">Dhaka International University</th>
                    </tr>
                    <tr>
                        <th class="tc f-12 p-0">Receipt of Fees</th>
                    </tr>
                </table>


                <table class="mt-5 b-none">
                    <tr>
                        <td colspan="2" class="bb-none">Name: <b>{{ $student->student_name_english }}</b></td>
                    </tr>

                    <tr>
                        <td colspan="2" class="bb-none bt-none">Department:
                            <b>{{ $student->department_name ?? '' }}</b>
                        </td>
                    </tr>

                    <tr>
                        <td colspan="2" class="bb-none bt-none">Reg. Code: <b>N/A</b></td>
                    </tr>

                    <tr>
                        <td class="bb-none br-none">Session: <b>N/A </b></td>
                        <td class="bb-none">Batch: <b>{{ number_format($payable ?? 0) }}</b></td>
                    </tr>

                    <tr>
                        <td class="br-none">Roll No: <b>N/A </b></td>
                        <td>Semester: <b>N/A</b></td>
                    </tr>
                </table>

                <div style="height: 180px">
                    <table class="mt-8">
                        <tr  class="">
                            <th class="">Sl.No.</th>
                            <th>Description</th>
                            <th class="w-40">Amount (In Taka)</th>
                        </tr>


                        <tr>
                            <td>1</td>
                            <td>ADMISSION FORM</td>
                            <td class="tc">{{ number_format($payable ?? 0) }}</td>
                        </tr>

                        <tr>
                            <td></td>
                            <td class="tr"><strong>Total :</strong></td>
                            <td class="tc">{{ number_format($payable ?? 0) }}</td>
                        </tr>
                    </table>
                </div>


                <table class="mt-8 b-none">
                    <tr>
                        <td class="bb-none" colspan="2">Received taka (In
                            words) <span
                                style="text-transform: capitalize"><b> 
                                    taka</b></span>
                            only.
                        </td>
                    </tr>
                </table>

                <table class="mt-15 b-none">


                    <tr>
                        <td class="br-none bt-none" style="padding-top: 65px" colspan="2">
                            <span style="border-top: 1px solid #000;">omor</span>
                            <p> it</p>
                            <p >Dhaka International University</p>
                        </td>
                        <td class="br-none bt-none" style="padding-top: 65px" colspan="2"><span
                                style="border-top: 1px solid #000;">Signature Of
                                Student</span>
                    </tr>
                </table>

            </div>

        </div>

        <!--DIU Copy by Student-->
        <div style="width: 33%;border-right: 1px dotted #000;float: left;">

            <table class="b-none">
                <tr>
                    <td colspan="2" class="bb-none br-none" style="padding-left: 13px">Receipt No.
                        <b>{{ $recieve_id ?? '' }}</b>
                    </td>
                    <td class="tr w-40 bb-none">Copy of DIU</td>
                </tr>

                <tr>
                    <th class='f-12 bt-none' colspan="3">

                        Export Import Bank of Bangladesh Limited

                    </th>
                </tr>
            </table>

            <div style="width: 220px;margin: 0 auto;">

                <table class="mt-1 b-none">
                    <tr>
                        <td class="tc f-12 bb-none p-0">
                            House # 49, Block # H, Road # 11,
                            Kazi's Heritage, Banani , Dhaka- 1213
                        </td>
                    </tr>
                    <tr>
                        <td style="text-transform: capitalize" class="tc f-12 bb-none p-0"><b>Banani Branch </b></td>
                    </tr>
                    <tr>
                        <td class="tc f-12 bb-none p-0">

                            MSND Account No: 6113100002042

                        </td>
                    </tr>

                    <tr>
                        <th class="tc f-19 bb-none p-0">Dhaka International University</th>
                    </tr>
                    <tr>
                        <th class="tc f-12 p-0">Receipt of Fees</th>
                    </tr>
                </table>

                <table class="mt-5 b-none">
                    <tr>
                        <td colspan="2" class="bb-none">Name: <b>{{ $student->student_name_english }}</b></td>
                    </tr>

                    <tr>
                        <td colspan="2" class="bb-none bt-none">Department:
                            <b>{{ $student->department_name ?? '' }}</b>
                        </td>
                    </tr>

                    <tr>
                        <td colspan="2" class="bb-none bt-none">Reg. Code: <b>N/A</b></td>
                    </tr>

                    <tr>
                        <td class="bb-none br-none">Session: <b>N/A </b></td>
                        <td class="bb-none">Batch: <b>{{ number_format($payable ?? 0) }} </b></td>
                    </tr>

                    <tr>
                        <td class="br-none">Roll No: <b>N/A</b></td>
                        <td>Semester: <b>N/A</b></td>
                    </tr>
                </table>

                <div style="height: 180px">
                    <table class="mt-8">
                        <tr>
                            <th class="w-15">Sl.No.</th>
                            <th>Description</th>
                            <th class="w-40">Amount (In Taka)</th>
                        </tr>


                        <tr>
                            <td>1</td>
                            <td>ADMISSION FORM</td>
                            <td class="tc">{{ number_format($payable ?? 0) }}</td>
                        </tr>

                        <tr>
                            <td></td>
                            <td class="tr"><strong>Total :</strong></td>
                            <td class="tc">{{ number_format($payable ?? 0) }}</td>
                        </tr>
                    </table>
                </div>

                <table class="mt-8 b-none">
                    <tr>
                        <td class="bb-none" colspan="2">Received taka (In
                            words) <span
                                style="text-transform: capitalize"><b> 
                                    taka</b></span>
                            only.
                        </td>
                    </tr>
                </table>

                <table class="mt-15 b-none">


                    <tr>
                        <td class="br-none bt-none" style="padding-top: 65px" colspan="2">
                            <span style="border-top: 1px solid #000;"> omor</span>
                            <p> it</p>
                            <p >Dhaka International University</p>
                        </td>
                        <td class="br-none bt-none" style="padding-top: 65px" colspan="2"><span
                                style="border-top: 1px solid #000;">Signature Of
                                Student</span>
                    </tr>
                </table>

            </div>
        </div>

        <!--Student Copy-->
        <div style="width: 33%;float: left;margin-left: 5px">

            <table class="b-none">
                <tr>
                    <td colspan="2" class="bb-none br-none" style="padding-left: 13px">Receipt No.
                        <b>{{ $recieve_id ?? '' }}</b>
                    </td>
                    <td class="tr w-40 bb-none">Students Copy</td>
                </tr>

                <tr>
                    <th class='f-12 bt-none' colspan="3">

                        Export Import Bank of Bangladesh Limited

                    </th>
                </tr>
            </table>

            <div style="width: 220px;margin: 0 auto;">

                <table class="mt-1 b-none">
                    <tr>
                        <td class="tc f-12 bb-none p-0">

                            House # 49, Block # H, Road # 11,
                            Kazi's Heritage, Banani , Dhaka- 1213

                        </td>
                    </tr>
                    <tr>
                        <td style="text-transform: capitalize" class="tc f-12 bb-none p-0"><b> Banani Branch</b></td>
                    </tr>
                    <tr>
                        <td class="tc f-12 bb-none p-0">

                            MSND Account No: 6113100002042

                        </td>
                    </tr>

                    <tr>
                        <th class="tc f-19 bb-none p-0">Dhaka International University</th>
                    </tr>
                    <tr>
                        <th class="tc f-12 p-0">Receipt of Fees</th>
                    </tr>
                </table>

                <table class="mt-5 b-none">
                    <tr>
                        <td colspan="2" class="bb-none">Name: <b>{{ $student->student_name_english }}</b></td>
                    </tr>

                    <tr>
                        <td colspan="2" class="bb-none bt-none">Department:
                            <b>{{ $student->department_name ?? '' }}</b>
                        </td>
                    </tr>

                    <tr>
                        <td colspan="2" class="bb-none bt-none">Reg. Code: <b>N/A</b></td>
                    </tr>

                    <tr>
                        <td class="bb-none br-none">Session: <b>N/A </b></td>
                        <td class="bb-none">Batch: <b>{{ number_format($payable ?? 0) }} </b></td>
                    </tr>

                    <tr>
                        <td class="br-none">Roll No: <b>N/A</b></td>
                        <td>Semester: <b>N/A</b></td>
                    </tr>
                </table>

                <div style="height: 180px">
                    <table class="mt-8">
                        <tr>
                            <th class="w-15">Sl.No.</th>
                            <th>Description</th>
                            <th class="w-40">Amount (In Taka)</th>
                        </tr>


                        <tr>
                            <td>1</td>
                            <td>ADMISSION FORM</td>
                            <td class="tc">{{ number_format($payable ?? 0) }}</td>
                        </tr>

                        <tr>
                            <td></td>
                            <td class="tr"><strong>Total :</strong></td>
                            <td class="tc">{{ number_format($payable ?? 0) }}</td>
                        </tr>
                    </table>
                </div>

                <table class="mt-8 b-none">
                    <tr>
                        <td class="bb-none" colspan="2">Received taka (In
                            words) <span
                                style="text-transform: capitalize"><b> 
                                    taka</b></span>
                            only.
                        </td>
                    </tr>
                </table>

                <table class="mt-15 b-none">


                    <tr>
                        <td class="br-none bt-none" style="padding-top: 65px" colspan="2">
                            <span style="border-top: 1px solid #000;"> omor</span>
                            <p> it</p>
                            <p >Dhaka International University</p>
                        </td>
                        <td class="br-none bt-none" style="padding-top: 65px" colspan="2"><span
                            style="border-top: 1px solid #000;">Signature Of
                                Student</span>
                    </tr>
                </table>

            </div>
        </div>

    </div>


   
</body>

</html>

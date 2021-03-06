<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Attendance Feeback</title>
    @include('layouts.css')
</head>
<body>
<div class="container-fluid">
    <section>
        <article style="font-family: Raleway">
            <h1>Attendance Appraisal</h1>
            <p>
                Dear <span>{{$user->firstname}}</span>,<br>
                Your Attendance records have been of good conduct,<br>
                and hereby warrants praise from Management.<br>
                Continuous punctuality will be rewarded.
            </p>
            <br>
            <p>
                Management,<br>
                <span>{{$admin->lastname . ", " . $admin->firstname}}</span>,<br>

                <span style="font-style: italic; font-family: 'Times New Roman'">
                        ActivEdge Technologies Limited<br>
                        No. 4b, Utomi Airie Avenue, Off Admiralty Way, Lekki Phase 1, Lagos<br>
                        Tel: +234(0)1-4532753 M:+234-803-958-2985<br>
                        <span class="text-yellow text-bold">Lagos | Nairobi | Harare | Kampala</span><br>
                    </span>
            </p>
        </article>
    </section>
</div>
</body>
</html>
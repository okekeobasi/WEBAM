@section('custom_css')
    <style>
        @if ($errors->has('firstname'))
          #fname {
            border-color: red;
        }

        @endif

        @if ($errors->has('lastname'))
        #lname {
            border-color: red;
        }

        @endif

        @if ($errors->has('username'))
        #uname {
            border-color: red;
        }

        @endif

        @if ($errors->has('email'))
        #email {
            border-color: red;
        }

        @endif

        @if ($errors->has('number'))
        #number {
            border-color: red;
        }

        @endif

        @if ($errors->has('password'))
        #password {
            border-color: red;
        }

        @endif

        @if ($errors->has('password_2'))
        #password_2 {
            border-color: red;
        }

        @endif

        @if ($errors->has('file'))
        #file {
            border-color: red;
        }

        @endif

        @if ($errors->has('time'))
        #timepicker {
            border-color: red;
        }

        @endif

        @if ($errors->has('date'))
        #datepicker {
            border-color: red;
        }
        @endif

        @if ($errors->has('staffId'))
        #staff {
            border-color: red;
        }
        @endif

    </style>
@endsection
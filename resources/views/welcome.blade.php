<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Group Name Exam</title>

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        
        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
            
        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
        </style>
    </head>
    <body class="p-3">
        <div>
            <h4 class="text-center">Welcome</h4>
        </div>
        <div class="p-5">
            <table class="table">
                <thead>
                    <tr>
                        <th class="text-center">Group Name</th>
                    </tr>
                </thead>
                <tbody>
                    @if (isset($allGroups))
                        @foreach ($allGroups as $row)
                            <tr>
                                <td class="text-center">
                                    <a href="{{ route('calllists', ['clid' => $row->id]) }}">{{ $row->groupname }}</a>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td>
                                No Records
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
            @if (isset($allGroups))
                {{ $allGroups->links() }}
            @endif
        </div>
        <div class="footer text-right">
            authored by Davette Adrian C. Trinidad
        </div>
    </body>
</html>

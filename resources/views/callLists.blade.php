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
            <h4 class="text-center">Call Lists</h4>
        </div>
        <div class="p-5">
            <table class="table">
                <thead>
                    <tr>
                        <th>Level</th>
                        <th>Name</th>
                        <th colspan="4">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if (isset($calls))
                        @foreach ($calls as $row)
                            <tr>
                                <form action="{{ route('changelevel') }}" method="POST">
                                    @csrf
                                    <td>{{ $row->level }}</td>
                                    <td style="font-size: 22px">{{ $row->name }}</td>
                                    <td>
                                        <button class="btn btn-outline-primary" type="submit" name="actionBtn" value="top">Top</button>
                                        <input type="text" value="{{ $row->id }}" name="idToChange" hidden readonly>
                                    </td>
                                    <td>
                                        <button class="btn btn-outline-success" type="submit" name="actionBtn" value="up">Up</button>
                                        <input type="text" value="{{ $row->id }}" name="idToChange" hidden readonly>
                                    </td>
                                    <td>
                                        <button class="btn btn-outline-danger" type="submit" name="actionBtn" value="down">Down</button>
                                        <input type="text" value="{{ $row->id }}" name="idToChange" hidden readonly>
                                    </td>
                                    <td>
                                        <button class="btn btn-outline-warning" type="submit" name="actionBtn" value="bottom">Bottom</button>
                                        <input type="text" value="{{ $row->id }}" name="idToChange" hidden readonly>
                                    </td>
                                </form>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="3" class="text-center">No Records</td>
                        </tr>
                    @endif
                </tbody>
            </table>
            @if (isset($allGroups))
                {{ $allGroups->links() }}
            @endif
        </div>
    </body>
</html>

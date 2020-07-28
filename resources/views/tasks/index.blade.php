<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    {{-- Bootstrap css CDN--}}
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous"> -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    {{-- Bootstrap js CDN --}}
    <!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script> -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <title>ToDo List App</title>
</head>
<body>
<div class="container">
    <div class="col-md-offset-2 col-md-8">
        <div class="row">
            <h1>To Do List</h1>
        </div>

        {{-- Display Success Message--}}
        @if (Session::has('success'))
        <div class="alert alert-success">
            <strong>Success:</strong> {{ Session::get('success') }}
        </div>
        @endif
        

        {{-- Display Error Message --}}
        @if (count($errors) > 0)
        <div class="alert alert-danger">
            <strong>Error:</strong>
            <ul>
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>

        @endif

        <div class="row" style='margin-top: 10px; margin-bottom: 10px;'>
            <form action="{{ route('tasks.store')}}" method='POST'>
            {{ csrf_field() }}

                <div class="col-md-9">
                    <input type="text" name='newTaskName' class='form-control'>
                </div>

                <div class="col-md-3">
                    <input type="submit" class='btn btn-primary btn-block' value='Add Task'>
                </div>
                

            </form>
        </div>

        {{-- Display stored task --}}
        @if (count($storedTasks) > 0)
            <table class="table">
                <thead>
                    <th>Task #</th>
                    <th>Name</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </thead>
                <tbody>
                @foreach ($storedTasks as $storedTask)
                <tr>
                    <th>{{ $storedTask->id }}</th>
                    <td>{{ $storedTask->name}}</td>
                    <td><a href="{{ route('tasks.edit', $storedTask->id) }}" class='btn btn-default'>Edit</a></td>
                    <td>
                    <form action="{{ route('tasks.destroy',  $storedTask->id) }}" method='POST'>
                        {{ csrf_field() }}
                        <input type="hidden" name="_method" value= 'DELETE'>
                        <input type="submit" class='btn btn-danger' value='Delete'>
                    </form>
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
        @endif

        <div class="row text-center">
        {{ $storedTasks->links() }}
        </div>
    </div>
</div>
    
</body>
</html>
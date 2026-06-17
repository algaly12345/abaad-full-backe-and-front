<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,minimum-scale=1">
    <title>Upload Form</title>
    <link href="{{asset('/assets/css/style.css') }}" id="app-style" rel="stylesheet" type="text/css" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer">
</head>
<body>
{{--<form class="upload-form">--}}
<body>
<div class="container mt-5">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h2>Laravel Video Upload Form- ScratchCode.io</h2>
        </div>
        <div class="panel-body">
            @if ($message = Session::get('success'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{{ $message }}</strong>
                </div>
            @endif

            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <strong>Whoops!</strong> There were some problems with your input.
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form class="upload-form" action="{{ route('store.video') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <input type="text" name="estate_id" value="{{(int )session('estate_id')}}" />
                    <div class="col-md-12">
                        <label for="files"><i class="fa-solid fa-folder-open fa-2x"></i>Select files ...</label>
                        <input id="files" type="file" name="files[]" multiple>
                        <div class="col-md-6 form-group">
                            <label>Select Video:</label>
                            <input type="file" name="video" class="form-control"/>
                        </div>
                        <div class="col-md-6 form-group">
                            <button type="submit" class="btn btn-success">Save</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
{{--</form>--}}
</body>
</html>

<script>
    // Declare global variables for easy access
    const uploadForm = document.querySelector('.upload-form');
    const filesInput = uploadForm.querySelector('#files');

    // Attach onchange event handler to the files input element
    filesInput.onchange = () => {
        // Append all the file names to the label
        uploadForm.querySelector('label').innerHTML = '';
        for (let i = 0; i < filesInput.files.length; i++) {
            uploadForm.querySelector('label').innerHTML += '<span><i class="fa-solid fa-file"></i>' + filesInput.files[i].name + '</span>';
        }
    };



    // Attach submit event handler to form
    uploadForm.onsubmit = event => {
        event.preventDefault();
        // Make sure files are selected
        if (!filesInput.files.length) {
            uploadForm.querySelector('.result').innerHTML = 'Please select a file!';
        } else {
            // Create the form object
            let uploadFormDate = new FormData(uploadForm);
            // Initiate the AJAX request
            let request = new XMLHttpRequest();
            // Ensure the request method is POST
            request.open('POST', uploadForm.action);
            // Attach the progress event handler to the AJAX request
            request.upload.addEventListener('progress', event => {
                // Add the current progress to the button
                uploadForm.querySelector('button').innerHTML = 'Uploading... ' + '(' + ((event.loaded/event.total)*100).toFixed(2) + '%)';
                // Update the progress bar
                uploadForm.querySelector('.progress').style.background = 'linear-gradient(to right, #25b350, #25b350 ' + Math.round((event.loaded/event.total)*100) + '%, #e6e8ec ' + Math.round((event.loaded/event.total)*100) + '%)';
                // Disable the submit button
                uploadForm.querySelector('button').disabled = true;
            });
            // The following code will execute when the request is complete
            request.onreadystatechange = () => {
                if (request.readyState == 4 && request.status == 200) {
                    // Output the response message
                    uploadForm.querySelector('.result').innerHTML = request.responseText;
                }
            };
            // Execute request
            request.send(uploadFormDate);
        }
    };
</script>

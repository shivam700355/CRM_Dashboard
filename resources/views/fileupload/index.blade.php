<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>File Upload</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="min-vh-100 bg-light">
    <div class="container-fluid mt-5">
        <div class="row justify-content-center align-items-center ">
            <div class="col-12 col-md-6">
                <div class="card shadow shadow-md rounded">
                    <div class="card-header fs-5">
                        <div class="spinner-border text-primary" role="status" id="spinner"
                            style="height:1.5rem;width:1.5rem;" hidden>
                            <span class="visually-hidden">Loading...</span>
                        </div>&nbsp;&nbsp;File Upload Form
                    </div>
                    <div class="card-body">
                        <div id="success" class="mb-3 rounded" hidden>
                            <div id="successMsg" class="text-center text-success fs-6 fw-semibold row">File Uploaded
                                successfully</div>
                        </div>
                        <div id="error" class="mb-3 rounded" hidden>
                            <div id="errorMsg" class="text-center text-danger fs-6 fw-semibold row">Error in Uploading
                                File
                            </div>
                        </div>
                        <form id="uploadForm" enctype="multipart/form-data" autocomplete="on">
                            <div class="mb-3">
                                <label for="aoeName" class="form-label">AOE Name <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="aoeName" name="aoeName"
                                    placeholder="Enter your AOE Name" required autocomplete>
                                <div class="invalid-feedback">Please enter AOE Name</div>
                            </div>
                            <div class="mb-3">
                                <label for="mobileNumber" class="form-label">Mobile Number <span
                                        class="text-danger">*</span></label>
                                <input type="tel" class="form-control" id="mobileNumber" name="mobileNumber"
                                    placeholder="Enter your mobile number" pattern="[0-9]{10}" required>
                                <div class="invalid-feedback">Please enter a 10-digit mobile number.</div>
                            </div>
                            <div class="mb-3">
                                <label for="source" class="form-label">Source <span
                                        class="text-danger">*</span></label>
                                <textarea class="form-control" id="source" name="source" rows="3"
                                    placeholder="Enter your Source" required></textarea>
                                <div class="invalid-feedback">Please enter Source name.</div>
                            </div>
                            <div class="mb-3">
                                <label for="fileInput" class="form-label">Choose File <span
                                        class="text-danger">*</span></label>
                                <input class="form-control" type="file" id="fileInput" name="files[]" required
                                    multiple>
                                <div class="invalid-feedback">Please choose a file.</div>
                            </div>

                            <button type="submit" class="btn btn-primary">Upload</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- File Upload Script -->
    <script>
        document.getElementById('uploadForm').addEventListener('submit', async function(event) {
            event.preventDefault(); // Prevent default form submission
            const uploadForm = document.getElementById('uploadForm');
            const success = document.getElementById('success');
            const successMsg = document.getElementById('successMsg');
            const error = document.getElementById('error');
            const errorMsg = document.getElementById('errorMsg');
            const fileInput = document.getElementById('fileInput');
            const spinner = document.getElementById('spinner');
            const aoe_name = document.getElementById('aoeName');
            const mobile = document.getElementById('mobileNumber');
            const source = document.getElementById('source');
            const selectedFiles = fileInput.files;
            console.log(selectedFiles);
            try {
                // Show spinner
                spinner.hidden = false;
                successMsg.innerHTML = '';
                errorMsg.innerHTML = '';
                // Iterate through selected files
                for (let i = 0; i < selectedFiles.length; i++) {
                    const file = selectedFiles[i];
                    console.log(`uploading file: ${i}`);
                    // Create FormData for POST request
                    const formData = new FormData();
                    formData.append('aoeName', aoe_name.value);
                    formData.append('mobileNumber', mobile.value);
                    formData.append('source', source.value);
                    formData.append('file', file, file.name);

                    // Make API call (using fetch as an example)
                    const response = await fetch('/upload', {
                        method: 'POST',
                        body: formData,
                    });
                    const data = await response.json();
                    console.log(data);
                    if (response.ok) {
                        success.hidden = false;
                        error.hidden = true;
                        const newElement = document.createElement('div');
                        newElement.textContent = data.message;
                        successMsg.appendChild(newElement);
                    } else {
                        error.hidden = false;
                        success.hidden = true;
                        const newElement = document.createElement('div');
                        newElement.textContent = data.message;
                        errorMsg.appendChild(newElement);
                    }
                }
                uploadForm.reset();
            } catch (error) {
                error.hidden = false;
                success.hidden = true;
                errorMsg.textContent = error;
            } finally {
                spinner.hidden = true;
            }
        });
    </script>
</body>

</html>

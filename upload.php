<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="animate.min.css">
    <link rel="stylesheet" type="text/css" href="css/registration.css">
    <title>Upload Identification</title>
    <style>
        .container {
            max-width: 100%;
            width: 80%;
            margin: auto;
        }

        .upload-box {
            border: 2px dashed #ccc;
            border-radius: 10px;
            padding: 30px;
            text-align: center;
            background: #f8f9fa;
            cursor: pointer;
            width: 100%;
            max-width: 500px;
            margin: auto;
            position: relative;
        }

        .upload-box:hover {
            border-color: #073B4C;
        }

        .upload-box input[type="file"] {
            position: absolute;
            width: 100%;
            height: 100%;
            opacity: 0;
            cursor: pointer;
            left: 0;
            top: 0;
        }

        @media (min-width: 1024px) { 
            .container {
                max-width: 60%;
            }

            .upload-box {
                max-width: 700px;
                padding: 40px;
            }
        }


.custom-alert {
    display: flex;
    align-items: center;
    justify-content: space-between;
    background-color: #ffcccc;
    color: #a94442; 
    font-size: 14px;
    padding: 8px 12px;
    border: 1px solid #a94442;
    border-radius: 5px;
    max-width: 400px;
    margin: 10px auto;
    box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
    animation: fadeIn 0.3s ease-in-out;
}

/* Error Icon */
.error-icon {
    font-size: 16px;
    margin-right: 8px;
}

/* Close Button */
.close-btn {
    background: none;
    border: none;
    color: #a94442;
    font-size: 18px;
    cursor: pointer;
    padding: 0 5px;
}

/* Fade-in Animation */
@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(-5px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}
    </style>
</head>
<body>

    <div class="background-overlay"></div>

    <div class="container">
        <h2 class="text-center fw-bold mb-3">
            <a href="index.html" class="home-peddle">Peddle</a>
        </h2>
        <p class="text-center text-muted mb-5">Upload Identification Document</p>
        <p class="text-center text-muted">Upload a valid ID <br>(Driver's License, Passport, or BVN document).</p>


        <form action="process/doc_process.php" method="post" enctype="multipart/form-data">

<!-- Beginning of Session Error message -->
<?php
            if(isset($_SESSION["errormsg"])){
        ?>
            <div class="custom-alert error-alert">
            <span class="error-icon">⚠️</span>
            <span class="error-message">
                    <?php
                        echo $_SESSION["errormsg"];
                        unset($_SESSION["errormsg"]);
                    ?>
            </span>
            <button class="close-btn" onclick="this.parentElement.style.display='none'">&times;</button>
            </div>
        <?php
            }
        ?>
<!-- End of Session Error message  -->

            <div class="mb-3">
                <label for="idtype" class="form-label">Select ID Type</label>
                <select class="form-select" id="idtype" name="file_type">
                    <option value="">Choose...</option>
                    <option value="passport">Passport</option>
                    <option value="driver_license">Driver's License</option>
                    <option value="bvn">BVN Document</option>
                </select>
            </div>

            <!-- Upload Box -->
            <div class="upload-box" id="drop-area">
                <img src="images2/pdf-file.png" alt="PDF Icon" width="50" >
                <p id="file-name">Click to upload your ID (PDF, JPG, PNG)</p>
                <input type="file" id="idUpload" name="id_document" accept=".pdf,.jpg,.jpeg,.png">
            </div>

            <!-- Preview Area -->
            <div id="preview-container" style="display: none; margin-top: 10px;">
                <p ><strong>Uploaded Document:</strong></p>
                <img id="preview-image" src="" alt="Preview" style="max-width: 100%; display: none;">
                <a id="preview-link" href="#" target="_blank" style="display: none;">View File</a>
            </div>

            <button name="btndoc" class="btn w-100 mt-3 login-button" type="submit">Next</button>
        </form>
    </div>

    <script src="jquerymin.js"></script>
    <script src="bootstrap/js/bootstrap.bundle.js"></script>
    <script src="swiper/js/swiper-bundle.min.js"></script>
    <script src="swiper/js/swiper-init.js"></script>
    <script src="js/peddle.js"></script>
    <script>
        document.getElementById('idUpload').addEventListener('change', function() {
            const file = this.files[0];
            const fileNameElement = document.getElementById('file-name');
            const previewContainer = document.getElementById('preview-container');
            const previewImage = document.getElementById('preview-image');
            const previewLink = document.getElementById('preview-link');

            if (file) {
                fileNameElement.textContent = file.name;
                previewContainer.style.display = "block";

                if (file.type.startsWith("image/")) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        previewImage.src = e.target.result;
                        previewImage.style.display = "block";
                        previewLink.style.display = "none";
                    };
                    reader.readAsDataURL(file);
                } else if (file.type === "application/pdf") {
                    previewImage.style.display = "none";
                    previewLink.href = URL.createObjectURL(file);
                    previewLink.style.display = "block";
                    previewLink.textContent = "View PDF";
                } else {
                    previewContainer.style.display = "none";
                }
            }
        });
    </script>
</body>
</html>
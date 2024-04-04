<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Şifre Sıfırlama Formu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>

<div class="container mt-5">
    <h3>Şifre Sıfırlama Formu</h3>
    <form id="resetPasswordForm">
        <div class="mb-3">
            <label for="email" class="form-label">E-posta Adresi</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <button type="submit" class="btn btn-primary" id="submitButton">Doğrulama Kodu Gönder</button>
    </form>

    <div id="otpInput" style="display: none;" class="mt-3">
        <div class="mb-3">
            <label for="otp" class="form-label">OTP Kodu</label>
            <input type="text" class="form-control" id="otp" name="otp" required>
        </div>
        <button type="button" class="btn btn-primary" id="otpSubmitButton">Doğrula</button>
    </div>

    <div id="passwordInput" style="display: none;" class="mt-3">
        <div class="mb-3">
            <label for="otp" class="form-label">Yeni Şifreniz</label>
            <input type="text" class="form-control" id="password" name="password" required>
        </div>
        <div class="mb-3">
            <label for="otp" class="form-label">Yeni Şifreniz Tekrar</label>
            <input type="text" class="form-control" id="repassword" name="repassword" required>
        </div>
        <button type="button" class="btn btn-primary" id="passwordSubmitButton">Şifreyi Güncelle</button>
    </div>

    <div id="message" class="mt-3"></div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script>
    $(document).ready(function() {
        $('#resetPasswordForm').submit(function(event) {
            event.preventDefault();
            var formData = $(this).serialize();
            $.ajax({
                type: 'POST',
                url: 'ajax.php',
                data: formData,
                success: function(response) {
                    if (response == 'success') {
						$('#resetPasswordForm').hide();
                        $('#otpInput').show();
                    } else {
                        $('#message').html('<div class="alert alert-danger" role="alert">' + response + '</div>');
                    }
                }
            });
        });

        $('#otpSubmitButton').click(function() {
            var otp = $('#otp').val();
            $.ajax({
                type: 'POST',
                url: 'ajax.php',
                data: { otp: otp },
                success: function(response) {
                    if (response == 'success') {
						$('#resetPasswordForm').hide();
                        $('#otpInput').hide();
                        $('#passwordInput').show();
                        $('#message').html('<div class="alert alert-success" role="alert">Doğrulama Kodu Doğru</div>');
                    } else {
                        $('#message').html('<div class="alert alert-danger" role="alert">Doğrulama Kodu Yanlış</div>');
                    }
                }
            });
        });
    });
</script>

</body>
</html>

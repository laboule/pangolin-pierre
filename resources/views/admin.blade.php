<!DOCTYPE html>
<html>

<head>
    <title>INTERFACE ADMIN</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
</head>

<body>
    <div class="container" data-appurl="{{env("APP_URL")}}">
        <div class="d-flex flex-column align-items-center mt-3">
            <h3>INTERFACE ADMIN</h3>
            <div class="d-flex align-items-center align-self-start my-1">
                <input type="text" class="form-control mr-1" placeholder="access_id du rêve" id="access_id" name="access_id" />
                <button class="btn btn-primary" id="button-publish">Valider</button>
            </div>
            <div class="align-self-start">
                <div class="alert alert-danger alert-dismissible fade show" id="alert-error" role="alert">
                    Le rêve est déjà publié ou n'existe pas !
                    <button type="button" class="close" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="alert alert-success alert-dismissible fade show" id="alert-success" role="alert">
                    Le rêve a été publié !
                    <button type="button" class="close" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
            <table class="table table-dark mt-3">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nom</th>
                        <th scope="col">Date du rêve</th>
                        <th scope="col">Langue</th>
                        <th scope="col">URL</th>
                        <th scope="col">Email</th>
                        <th scope="col">Access ID</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($dreams as $dream)
                    <tr>
                        <th scope="row">{{$dream->id}}</th>
                        <td>{{$dream->user_name ?? "inconnu"}}</td>
                        <td>{{$dream->date ?? "inconnue"}}</td>
                        <td>{{$dream->dream_language ?? "inconnu"}}</td>
                        <td><a href="{{$dream->url ?? "#"}}" target="_blank">Ecouter</a></td>
                        <td>{{$dream->user_email ?? "inconuu"}}</td>
                        <td>{{$dream->access_id ?? "inconnu"}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <style>
    body {
        background-color: lightgrey;
    }

    .alert {
        display: none;
    }

    </style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
    $(function() {
        const appUrl = $(".container").data("appurl");
        $("#button-publish").click(async () => {
            $(".alert").hide()
            const accessId = $("#access_id").val();
            if (accessId) {
                let res = await $.get(appUrl + "/api/publish_dream/" + accessId)
                if (res.error) {
                    $('#alert-error').show()
                }
                if (res.success) {
                    $('#alert-success').show()
                }
            }
        })

        $(".close").click(function() { $(".alert").hide() })
    });

    </script>
</body>

</html>

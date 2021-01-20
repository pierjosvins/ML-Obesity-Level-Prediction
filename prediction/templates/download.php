<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test Results</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
</head>
<body class="bg-light">
    <div class="container">
        <div class="card mt-5">
            <p style="margin: 8px 0 8px 0; font-size: 18px;">
                Based on his personal information, we, <strong>Dont Be Obese</strong>, attest that <strong>{{first_name}} 
                {{last_name}}</strong>, has a {{predicted_class}}.
            </p>
            <div id="personalInfo">
                <div class="card-header">
                    <h3 style="font-size: 20px;" class="text-center">Personal Information</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <table style="font-size: 16px; margin-bottom: 8px;">
                            <tbody>
                                <tr>
                                    <td>Age</td>
                                    <td>{{age}}</td>
                                </tr>
                                <tr>
                                    <td>Height (m)</td>
                                    <td>{{height}}</td>
                                </tr>
                                <tr>
                                    <td>Weight (Kg)</td>
                                    <td>{{weight}}</td>
                                </tr>
                                <tr>
                                    <td>Frequency of vegetables consumption</td>
                                    <td>{{fcvc}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <hr/>
            <div>
                <h3 style="font-size: 20px;" class="text-center">Prediction Results</h3>
                <table style="font-size: 16px;" id="predict-section" class="table table-striped">
                    <tbody>
                        <tr>
                            <td><h3>Level</h3></td>
                            <td><h3>Probability</h3></td>
                        </tr>
                        {% for classe, prob in classes_prob %}
                        <tr>
                            <td>{{classe}}</td>
                            <td>{{prob}} %</td>
                        </tr>
                        {% endfor %}
                    </tbody>
                </table>
            </div>
        </div>
        <p style="margin-top: 8px; padding: auto; font-size: 16px;" class="text-center">&copy; <strong>Dont Be Obese</strong>, <a href="https://pierjos-colere-website.web.app" target="_blank">Pierjos COLERE</a>, 2021<p>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
</html>

{% extends 'base.php' %}

{%block title %}Prediction{% endblock %}

{% block content %}
    <div class="container">
        <div class="alert alert-success" role="alert">
            Welcome to <strong>Dont Be Obese</strong>! Please Don't be obese by checking your obesity level anyday, anytime and  anywhere.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="card mt-5">
            <div id="personalInfo">
                <div class="card-header">
                    <h3 class="text-center">Personal Information</h3>
                </div>
                <div class="card-body">
                    <form action="" method="post">{% csrf_token %}
                        <div class="row">
                            <div class="col-md-6 col-12">
                                <label for="age">Your Age</label>
                                {{form.age}}
                            </div>
                            <div class="col-md-6 col-12">
                                <label for="height">Your Height</label>
                                {{form.height}}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-12">
                                <label for="weight">Your Weight</label>
                                {{form.weight}}
                            </div>
                            <div class="col-md-6 col-12">
                                <label for="fcvc">Frequency of vegetables consumption (FCVC)</label>
                                {{form.fcvc}}
                            </div>
                            <div class="col-12">
                                {{form.download}}
                            </div>
                        </div>
                </div>
            </div>
            <p id="see" onclick="showInFo();" style = "display: none;" class="btn btn-secondary mb-4">Show Personal Information</p>
            
            <div class="card-header">
                <h3 class="text-center mb-2">Algorithm and Prediction</h3>
            </div>
            <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 col-12">
                            <label class="text-center" for="learning">Learning Method</label>
                            {{form.learning}}
                        </div>
                        <div class="col-md-6 col-12">
                            <label class="text-center" for="algo">Algorithm</label>
                            {{form.algo}}
                        </div>
                    </div>
                    <button onclick="showInFo();" type="submit" class="btn btn-primary form-control">Predict Obesity Level</button>
                    {% if predicted_class %}
                    <div id="predictionInfo">
                        <hr />
                        <div class="row">
                            <div class="col-12 text-center">
                                <p class="alert {% if predicted_class == 'Normal Weight' %}alert-success{% else %}alert-danger{% endif%}">
                                    It seems you have a <strong>{{predicted_class}}</strong> .<br>
                                    See the results below for more information!!!
                                </p>
                                {% if classes_prob %}
                                    
                                    <table id="predict-section" class="table table-striped">
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
                                    <div class="row">
                                        <div class="col-md-6 col-12 mb-4">
                                            <button onclick="Download();" type="submit" class="btn btn-info form-control">Download Results</button>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <a class="btn btn-primary form-control" href="{% url 'name' %}"> Modify Names Before Downloading</a>
                                        </div>
                                    </div>
                                    
                                {% endif %}
                            </div>
                        </div>
                    </div>
                    {% endif %}
                </form>
            </div>
        </div>
        <p class="text-center">&copy; <a href="https://pierjos-colere-website.web.app" target="_blank">Pierjos COLERE</a>, 2021<p>
    </div>
    
{% endblock %}

{% block script %}
    <script>

        $(document).ready(function() {
            showInFo();
        });

        function getAlgo(a)
        {
            var algo = document.getElementById("algo");
            console.log(algo);

            if (a == 'classification')
            {
                algo.innerHTML =
                    '<select>'+
                        '<option value="randomforest">RandomForest</option>'+
                        '<option value="knn">KNN</option>'+
                        '<option value="svm">SVM</option>'+
                    '</select>';
            }
        }

        function showInFo()
        {
            
            var personalInfo = document.getElementById("personalInfo").style.display;
            var predictionInfo = document.getElementById("predictionInfo").style.display;
            document.getElementById("download").value = "no";

            if(personalInfo == 'none')
            {
                document.getElementById("personalInfo").style.display = "block";
                document.getElementById("predictionInfo").style.display = 'none';
                document.getElementById("see").style.display = 'none';
                
            }
            else
            {
                document.getElementById("personalInfo").style.display = "none";
                document.getElementById("predictionInfo").style.display = "block";
                document.getElementById("see").style.display = "block";
            }

        }
        
        function Download()
        {
            document.getElementById("download").value = "yes";
        }
        
    </script>
{% endblock %}
{% extends 'base.php' %}

{%block title %}Information{% endblock %}

{% block content %}
    <div class="container">
        <div class="alert alert-success" role="alert">
            Welcome to <strong>Dont Be Obese</strong>! Please Don't be obese by checking your obesity level anyday, anytime and  anywhere.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        
        <div class="card mt-5">
            <div class="alert alert-success text-center" role="alert">
                Please the fields below. They will be important if you want to download test resultats.
            </div>
            <div id="personalInfo">
                <div class="card-body">
                    <form action="" method="post">{% csrf_token %}
                        <div class="row">
                            <div class="col-12">
                                <label for="last_name">Your LastName</label>
                                {{form.last_name}}
                            </div>
                            <div class="col-12">
                                <label for="first_name">Your FirstName</label>
                                {{form.first_name}}
                            </div>
                            <button type="submit" class="btn btn-primary form-control">Validate</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <p class="text-center">&copy; <a href="https://pierjos-colere-website.web.app" target="_blank">Pierjos COLERE</a>, 2021<p>
    </div>
    
{% endblock %}

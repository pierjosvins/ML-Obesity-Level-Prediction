{% extends 'base.php' %}

{% block content %}
<div class="row">
    <div class="nav navbar-dark  bg-dark flex-column navbar-expand-lg bg-light nav-pills col-md-2 col-12 pl-2" id="v-pills-tab" role="tablist" aria-orientation="vertical">
        <a class="nav-link active" href="{% url 'home' %}" >Accueil</a>
        <a class="nav-link" href="{% url 'resultat' %}" aria-selected="false">Résultats</a>
        <a class="nav-link" >EDT</a>
        <a class="nav-link" >Etats de dossiers</a>
        <a class="nav-link" >Stages</a>
        <a class="nav-link" >Demandes</a>
        <a class="nav-link" >Forum</a>
    </div>
    <div class="col-md-10 col-12">
        {% block page_content %}
        {% endblock %}
    </div>
</div>
    
{% endblock %}
from django.shortcuts import render, redirect
from django.http import HttpResponse
from django.core.mail import send_mail
from django.template.loader import get_template
from xhtml2pdf import pisa
from django import forms

from joblib import load
import numpy as np
#from keras.models import load_model

from .forms import newForm
from .forms import nameForm


def home(request):
    
    if request.session['last_name']:

        if request.method == 'POST':

            form = newForm(request.POST)

            if form.is_valid():
                age = float(form.cleaned_data['age'])
                height = float(form.cleaned_data['height'])
                weight = float(form.cleaned_data['weight'])
                fcvc = float(form.cleaned_data['fcvc'])
                algo = form.cleaned_data['algo']
                download = form.cleaned_data['download']
                
                x_new = np.array([age, height, weight, fcvc]).reshape(1, -1)
                
                mean_age = 24.31259990857412
                std_age = 6.345968273732241
                
                mean_height = 1.7016773533870182
                std_height = 0.09330481986792002

                mean_weight = 86.58605812648037
                std_weight = 26.19117174520469

                mean_fcvc = 2.4190430615821916
                std_fcvc = 0.5339265785033023
                x_new[0][0] = (x_new[0][0] - mean_age) / std_age
                x_new[0][1] = (x_new[0][1] - mean_height) / std_height
                x_new[0][2] = (x_new[0][2] - mean_weight) / std_weight
                x_new[0][3] = (x_new[0][3] - mean_fcvc) / std_fcvc
                classes = ['Insufficient Weight', 'Normal Weight', 'Obesity Type I', 'Obesity Type II',
                            'Obesity Type III', 'Overweight Level I', 'Overweight Level II']
            
                if algo == 'knn':
                    KNN = load('prediction/KNN.joblib')
                    predicted_class = classes[KNN.predict(x_new)[0]]
                    classes_index = np.argsort(KNN.predict_proba(x_new), axis=1)[0][::-1]
                    probabilities = np.around(np.sort(KNN.predict_proba(x_new), axis=1)[0][::-1], decimals=4)
                    classes_prob = []

                    for i in classes_index:
                        classes_prob.append(classes[i])
        
                if algo == 'randomforest':
                    RandomForest = load('prediction/RandomForest.joblib')
                    predicted_class = classes[RandomForest.predict(x_new)[0]]
                    classes_index = np.argsort(RandomForest.predict_proba(x_new), axis=1)[0][::-1]
                    probabilities = np.around(np.sort(RandomForest.predict_proba(x_new), axis=1)[0][::-1], decimals=4)
                    classes_prob = []

                    for i in classes_index:
                        classes_prob.append(classes[i])

                if algo == 'smv':
                    SVM = load('prediction/SVM.joblib')
                    predicted_class = classes[SVM.predict(x_new)[0]]
                    classes_index = np.argsort(SVM.predict_proba(x_new), axis=1)[0][::-1]
                    probabilities = np.around(np.sort(SVM.predict_proba(x_new), axis=1)[0][::-1], decimals=4)
                    classes_prob = []

                    for i in classes_index:
                        classes_prob.append(classes[i])
                
                classes_prob = zip(classes_prob, probabilities * 100)
                
                if download == 'yes':

                    template_path = 'download.php'
                
                    context = {'age': age, 'height':height, 'weight': weight, 'fcvc':fcvc,'predicted_class': predicted_class, 
                        'classes_prob':classes_prob,'last_name': request.session['last_name'], 'first_name': request.session['first_name']}
                    
                    # Create a Django response object, and specify content_type as pdf
                    response = HttpResponse(content_type='application/pdf')
                    
                    #if download:
                    response['Content-Disposition'] = 'attachment; filename="obesity level test.pdf"'
                    
                    # find the template and render it.
                    template = get_template(template_path)
                    html = template.render(context)

                    # create a pdf
                    pisa_status = pisa.CreatePDF(html, dest=response)
                    
                    form.download = 'no'
                    print(form.download)

                    # if error then show some funy view
                    if pisa_status.err:
                        return HttpResponse('We had some errors <pre>' + html + '</pre>')
                    return response

                return render(request, 'home.php', {'form': form, 'predicted_class': predicted_class, 
                            'classes_prob':classes_prob,})
            else:
                return render(request, 'home.php', {'form': form})
        else:
            
            form = newForm()
            return render(request, 'home.php', {'form': form})

    else:
        return redirect('name')



def name(request):

    if request.method == 'POST':
        form = nameForm(request.POST)
        if form.is_valid():
            last_name = form.cleaned_data['last_name']
            first_name = form.cleaned_data['first_name']

            request.session['last_name'] = last_name
            request.session['first_name'] = first_name
            return redirect('home')
        else:
            return render(request, 'information.php', {'form': form})
    else:

        if request.session['last_name']:
            form = nameForm({'last_name':request.session['last_name'], 'first_name':request.session['first_name']})
        else:
            form = nameForm()
        
        return render(request, 'information.php', {'form': form})
    
    

from django import forms

class newForm(forms.Form):
    fcvc_choice =(
        (0, "0"), (1, "1"), (2, "2"), 
        (3, "3"), (4, "4"), (5, "5"),
        (6, "6"),(7, "7"), (8, "8"), 
        (9, "9"), (10, "10")  
    )
    learning_choice = (
        ("classification", "Classification"),
    )

    algo_choice = {
        'classification':
        (
            ('randomforest', 'RandomForest'),
            ('knn', 'KNN'),
            ('smv', 'SVM'),
        ),
        
    }
    age = forms.FloatField(initial = 21, max_value=100, min_value=0, widget=forms.NumberInput(attrs={'class': 'form-control mb-4', 'id': 'age', 'step': '1'}))
    height = forms.FloatField(initial = 1.60, max_value=3.0, min_value=0, widget=forms.NumberInput(attrs={'class': 'form-control mb-4', 'id': 'height', 'step': '0.01'}))
    weight = forms.FloatField(initial = 60, max_value=500, min_value=0, widget=forms.NumberInput(attrs={'class': 'form-control mb-4', 'id': 'weight', 'step': '0.01'}))
    fcvc = forms.ChoiceField(initial=3, choices=fcvc_choice, widget= forms.Select({'class': 'form-control mb-4', 'id': 'weight'}))
    learning = forms.ChoiceField(choices=learning_choice, widget= forms.Select({'class': 'form-control mb-4', 'id': 'learning', 'onchange' : "getAlgo(this.value);"}))
    algo = forms.ChoiceField(choices=algo_choice['classification'], widget= forms.Select({'class': 'form-control mb-4', 'id': 'algo'}))
    download = forms.CharField(initial="no", max_length=100, widget=forms.TextInput(attrs={'class': 'form-control mb-4', 'id': 'download', 'hidden': 'hidden'}))

class nameForm(forms.Form):
    
    last_name = forms.CharField(max_length=255, widget=forms.TextInput(attrs={'class': 'form-control mb-4', 'id': 'last_name'}))
    first_name = forms.CharField(max_length=255, widget=forms.TextInput(attrs={'class': 'form-control mb-4', 'id': 'first_name'}))
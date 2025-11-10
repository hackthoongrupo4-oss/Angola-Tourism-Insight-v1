from flask import Flask, request, jsonify
import pandas as pd
import joblib

# Inicializa o Flask
app = Flask(__name__)

# Carrega o modelo treinado
modelo = joblib.load('modelo-prev-turista.joblib') 

# Rota de teste
@app.route('/')
def home():
    return "API de previsão de turistas funcionando!"

# Rota de previsão
@app.route('/prever', methods=['POST'])
def prever():
    try:
        # Recebe os dados no formato JSON e  Converte em DataFrame
        
        dados = request.get_json()              
        df = pd.DataFrame([dados])
        
        # Faz a previsão e Retorna a previsão em JSON
        predicao = modelo.predict(df)    
        return jsonify({'previsao': float(predicao[0])})
    
    except Exception as e:
        return jsonify({'erro': str(e)})

if __name__ == '__main__':
    app.run(debug=True)


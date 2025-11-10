# api-turistas-prev

Esta API foi desenvolvida com *Python + Flask* para prever o número de turistas com base em variáveis climáticas, sazonais e regionais (Luanda, Benguela e Lubango). O modelo de Machine Learning foi previamente treinado e salvo em `modelo_turistas.joblib`.

Objetivo

Oferecer uma solução inteligente para prever o fluxo mensal de turistas, auxiliando na tomada de decisões para planejamento sustentável em:
- Alojamentos
- Transportes
- Saneamento básico
- Serviços públicos e privados

Tecnologias

- Python 3.10
- Flask
- Scikit-learn
- Joblib
- Pandas / Numpy

Estrutura Esperada da Requisição

A API aceita uma requisição *POST* em `/prever` com um JSON no seguinte formato:

json
{
  "ano": 2023,
  "mes": 7,
  "precipitacao": 10.5,
  "precipitacao_media_historica": 8.2,
  "temperatura_media": 26.3,
  "temperatura_media_historica": 25.1,
  "temp_maxima": 31.0,
  "temp_maxima_historica": 30.2,
  "temp_minima_historica": 20.5,
  "feriado": 1,
  "localidade_Benguela": 0,
  "localidade_Luanda": 1,
  "localidade_Lubango": 0
}
Resposta Esperada

json
{
  "previsao_turistas": 15234
}



Como Executar Localmente

1. Clone o projeto:
bash
git clone https://github.com/GitSadrack/api-turistas.git
cd api-turistas


2. Instale as dependências:
bash
pip install flask pandas joblib scikit-learn


3. Execute a API:
bash
python api-prev-turistas.py



4. Acesse:

http://127.0.0.1:5000/prever




Testar com Python

python
import requests

url = 'http://127.0.0.1:5000/prever'
dados = {
    "ano": 2023,
    "mes": 8,
    ...
}

resposta = requests.post(url, json=dados)
print(resposta.json())

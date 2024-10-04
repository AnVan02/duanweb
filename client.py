import requests

# Define the URL of the PHP API
url = 'http://localhost/study/server.php'

# Define the POST data (as a dictionary)
warranty_data = {
    'SoSerial': '23283187255',
    
}

# Make a POST request to the API
response = requests.get(url, json=warranty_data)

# Print the JSON response
if response.status_code == 200:
    data = response.json()
    print("Get Response:", data)
else:
    print("Failed to retrieve data:", response.status_code)

